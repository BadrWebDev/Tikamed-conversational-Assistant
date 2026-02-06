# app/services/rag_service.py

import os
import google.generativeai as genai
from app.services.vector_search import VectorSearch
from dotenv import load_dotenv

load_dotenv()
genai.configure(api_key=os.getenv("GEMINI_API_KEY"))

class RAGService:
    def __init__(self):
        self.searcher = VectorSearch()
        self.model = genai.GenerativeModel('gemini-2.0-flash')
    
    def answer_question(self, question: str) -> dict:
        """Main RAG pipeline: Search → Generate Answer"""
        print(f"📝 Question: {question}")
        
        # Step 1: Find relevant chunks
        print("🔍 Searching vector database...")
        chunks = self.searcher.search(question, top_k=3)
        
        if not chunks:
            return {
                "answer": "I couldn't find relevant information in our catalogue.",
                "sources": []
            }
        
        # Step 2: Build prompt for Gemini
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
        
        # Step 3: Generate answer with Gemini
        print("🤖 Generating answer with Gemini...")
        response = self.model.generate_content(prompt)
        
        return {
            "answer": response.text,
            "sources": chunks
        }


# Test it!
if __name__ == "__main__":
    rag = RAGService()
    
    # Test question
    question = "Do you have healing abutments in 1.5mm height?"
    
    result = rag.answer_question(question)
    
    print("\n" + "="*80)
    print("ANSWER:")
    print("="*80)
    print(result['answer'])
    print("\n" + "="*80)
    print(f"Used {len(result['sources'])} source chunks")