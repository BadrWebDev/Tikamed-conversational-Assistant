# app/services/rag_service.py

import os
from dotenv import load_dotenv
from openai import OpenAI
from app.services.vector_search import VectorSearch

load_dotenv()

class RAGService:
    def __init__(self):
        self.searcher = VectorSearch()
        self.client = OpenAI(api_key=os.getenv("OPENAI_API_KEY"))
        self.model_name = os.getenv("OPENAI_MODEL", "gpt-4o-mini")
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
- If the information is not in the catalogue
- Keep the answer concise and professional

ANSWER:"""
        
        print("🤖 Generating answer with OpenAI GPT-4o-mini...")
        try:
            response = self.client.chat.completions.create(
                model=self.model_name,
                messages=[
                    {
                        "role": "system",
                        "content": "You are a helpful assistant for Tikamed Digital Solutions, a dental products company. Answer questions based on the provided catalogue information."
                    },
                    {
                        "role": "user",
                        "content": prompt
                    }
                ],
                temperature=0.7,
                max_tokens=1000,
                timeout=self.timeout
            )
            
            return {
                "answer": response.choices[0].message.content,
                "sources": results
            }
        
        except Exception as e:
            print(f"❌ OpenAI error: {str(e)}")
            return {
                "answer": "Je suis désolé, une erreur s'est produite lors de la génération de la réponse. Veuillez réessayer.",
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