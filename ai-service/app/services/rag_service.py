# app/services/rag_service.py

import os
import asyncio
from concurrent.futures import ThreadPoolExecutor, TimeoutError as FuturesTimeoutError
from dotenv import load_dotenv
from google import genai
from google.api_core.exceptions import ResourceExhausted, PermissionDenied
from app.services.vector_search import VectorSearch

load_dotenv()

class RAGService:
    def __init__(self):
        self.searcher = VectorSearch()
        self.client = genai.Client(api_key=os.getenv("GEMINI_API_KEY"))
        self.model_name = "gemini-2.0-flash"
        self.timeout = 30  # 30 seconds timeout for API calls

    def answer_question(self, question: str) -> dict:
        """Main RAG pipeline: Search → Generate Answer"""
        print(f"📝 Question: {question}")
        
        print("🔍 Searching vector database...")
        results = self.searcher.search(question, top_k=3)
        
        if not results:
            return {
                "answer": "I couldn't find relevant information in our catalogue.",
                "sources": []
            }
        
        chunks = [item['content'] for item in results]
        context = "\n\n".join([f"[Document {i+1}]\n{chunk}" for i, chunk in enumerate(chunks)])
        
        prompt = f"""You are a helpful assistant for Tikamed Digital Solutions, a dental products company.

Based on the following product information from our catalogue, answer the user's question.

CATALOGUE INFORMATION:
{context}

USER QUESTION: {question}

INSTRUCTIONS:
- Answer in the same language as the question
- Be specific and reference product codes when available
- If the information is not in the catalogue, say so
- Keep the answer concise and professional

ANSWER:"""
        
        print("🤖 Generating answer with Gemini...")
        try:
            # Use ThreadPoolExecutor with timeout to prevent hanging
            with ThreadPoolExecutor(max_workers=1) as executor:
                future = executor.submit(
                    self.client.models.generate_content,
                    model=self.model_name,
                    contents=prompt
                )
                
                try:
                    response = future.result(timeout=self.timeout)
                    return {
                        "answer": response.text,
                        "sources": results
                    }
                except FuturesTimeoutError:
                    print(f"⏱️ Timeout after {self.timeout}s")
                    return {
                        "answer": "Je suis désolé, la génération de réponse prend trop de temps. Veuillez réessayer avec une question plus simple.",
                        "sources": results
                    }
        
        except ResourceExhausted:
            print("⚠️ ResourceExhausted error")
            return {
                "answer": "Je suis désolé, notre service d'intelligence artificielle a atteint sa limite d'utilisation. Nos équipes travaillent pour résoudre ce problème. Veuillez réessayer dans quelques instants.",
                "sources": results
            }
        except PermissionDenied:
            print("❌ PermissionDenied error")
            return {
                "answer": "Je suis désolé, une erreur de permission s'est produite. Veuillez contacter notre support technique.",
                "sources": results
            }
        except Exception as e:
            print(f"❌ Unexpected error: {str(e)}")
            return {
                "answer": "Je suis désolé, une erreur inattendue s'est produite. Notre équipe technique a été informée. Veuillez réessayer dans quelques instants.",
                "sources": results
            }


# Test
if __name__ == "__main__":
    rag = RAGService()
    question = "Montrez-moi les implants bone level"
    result = rag.answer_question(question)
    
    print("\n" + "=" * 80)
    print("ANSWER:")
    print("=" * 80)
    print(result["answer"])
    print("\n" + "=" * 80)
    print(f"Used {len(result['sources'])} source chunks")