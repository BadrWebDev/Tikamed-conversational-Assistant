# app/services/rag_service.py

import os
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
            response = self.client.models.generate_content(
                model=self.model_name,
                contents=prompt
            )
            
            return {
                "answer": response.text,
                "sources": results
            }
        
        except ResourceExhausted:
            return {
                "answer": "⚠️ The AI service is temporarily unavailable due to quota limits.",
                "sources": results
            }
        except PermissionDenied:
            return {
                "answer": "❌ AI service permission error. Please contact support.",
                "sources": results
            }
        except Exception as e:
            return {
                "answer": f"❌ Unexpected AI error: {str(e)}",
                "sources": results
            }


# Test
if __name__ == "__main__":
    rag = RAGService()
    question = "Parle-moi du système de piliers temporaires IPHYSIO"
    result = rag.answer_question(question)
    
    print("\n" + "=" * 80)
    print("ANSWER:")
    print("=" * 80)
    print(result["answer"])
    print("\n" + "=" * 80)
    print(f"Used {len(result['sources'])} source chunks")