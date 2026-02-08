# app/services/vector_search.py

import os
import warnings
warnings.filterwarnings('ignore', category=FutureWarning)

import google.generativeai as genai
import chromadb
from chromadb.config import Settings
from dotenv import load_dotenv

load_dotenv()
genai.configure(api_key=os.getenv("GEMINI_API_KEY"))

class VectorSearch:
    def __init__(self):
        self.client = chromadb.PersistentClient(
            path="vector_store",
            settings=Settings(anonymized_telemetry=False)
        )
        self.collection = self.client.get_collection(name="tikamed_products")
    
    def search(self, query: str, top_k: int = 3):
        query_embedding = self._get_gemini_embedding(query)
        results = self.collection.query(
            query_embeddings=[query_embedding],
            n_results=top_k
        )
        
        formatted_results = []
        if results['documents'] and results['documents'][0]:
            for i, doc in enumerate(results['documents'][0]):
                formatted_results.append({
                    "content": doc,
                    "score": results['distances'][0][i] if results.get('distances') else 0.0,
                    "metadata": results['metadatas'][0][i] if results.get('metadatas') else {}
                })
        return formatted_results
    
    def _get_gemini_embedding(self, text: str):
        result = genai.embed_content(
            model="models/gemini-embedding-001",
            content=text,
            task_type="retrieval_query"
        )
        return result['embedding']


# Test
if __name__ == "__main__":
    searcher = VectorSearch()
    question = "Do you have healing abutments 1.5mm?"
    print(f"🔍 Searching for: {question}\n")
    
    results = searcher.search(question, top_k=3)
    print(f"✅ Found {len(results)} relevant chunks:\n")
    
    for i, result in enumerate(results, 1):
        print(f"--- CHUNK {i} (Score: {result['score']:.4f}) ---")
        print(result['content'][:300] + "...")
        print()