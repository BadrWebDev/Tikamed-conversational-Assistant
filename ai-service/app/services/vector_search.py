# app/services/vector_search.py

import os
import google.generativeai as genai
import chromadb
from chromadb.config import Settings
from dotenv import load_dotenv

load_dotenv()
genai.configure(api_key=os.getenv("GEMINI_API_KEY"))

class VectorSearch:
    def __init__(self):
        # Connect to existing ChromaDB
        self.client = chromadb.PersistentClient(
            path="vector_store",
            settings=Settings(anonymized_telemetry=False)
        )
        
        # Get the collection we created earlier
        self.collection = self.client.get_collection(name="tikamed_products")
    
    def search(self, query: str, top_k: int = 3):
        """
        Search for similar chunks to the query
        
        Args:
            query: User's question
            top_k: How many results to return (default 3)
            
        Returns:
            List of matching text chunks
        """
        # Convert query to embedding
        query_embedding = self._get_gemini_embedding(query)
        
        # Search ChromaDB
        results = self.collection.query(
            query_embeddings=[query_embedding],
            n_results=top_k
        )
        
        # Extract just the text chunks
        chunks = results['documents'][0] if results['documents'] else []
        
        return chunks
    
    def _get_gemini_embedding(self, text: str):
        """Convert text to embedding using Gemini"""
        result = genai.embed_content(
            model="models/gemini-embedding-001",
            content=text,
            task_type="retrieval_query"  # Note: "query" not "document"
        )
        return result['embedding']


# Test it!
if __name__ == "__main__":
    searcher = VectorSearch()
    
    # Test query
    question = "Do you have healing abutments 1.5mm?"
    print(f"🔍 Searching for: {question}\n")
    
    chunks = searcher.search(question, top_k=3)
    
    print(f"✅ Found {len(chunks)} relevant chunks:\n")
    for i, chunk in enumerate(chunks, 1):
        print(f"--- CHUNK {i} ---")
        print(chunk[:300] + "...")  # First 300 chars
        print()