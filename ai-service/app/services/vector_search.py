# app/services/vector_search.py

import os
import warnings
warnings.filterwarnings('ignore', category=FutureWarning)

from openai import OpenAI
import chromadb
from chromadb.config import Settings
from dotenv import load_dotenv

load_dotenv()

class VectorSearch:
    def __init__(self):
        # OpenAI client for embeddings
        self.openai_client = OpenAI(api_key=os.getenv("OPENAI_API_KEY"))
        self.embedding_model = os.getenv("OPENAI_EMBEDDING_MODEL", "text-embedding-3-small")
        
        # ChromaDB client
        self.client = chromadb.PersistentClient(
            path="vector_store",
            settings=Settings(anonymized_telemetry=False)
        )
        self.collection = self.client.get_collection(name="tikamed_products")
    
    def search(self, query: str, top_k: int = 3):
        """Hybrid search: Product code matching + semantic search"""
        import re
        
        # Extract potential product codes from query (e.g., NPS_PD36.16, NCI_BL)
        product_code_pattern = r'[A-Z]{2,4}[_\d\.]+[\w\.]*\d+'
        potential_codes = re.findall(product_code_pattern, query.upper())
        
        # If product codes found, do metadata filtering first
        if potential_codes:
            print(f"🔍 Detected product codes: {potential_codes}")
            # Try exact text search in documents
            where_filter = {"$or": []}
            for code in potential_codes:
                where_filter["$or"].append({"$contains": code})
            
            try:
                # Get all documents and filter by text content
                all_docs = self.collection.get()
                code_results = []
                
                for idx, doc in enumerate(all_docs['documents']):
                    # Check if any product code appears in the document
                    for code in potential_codes:
                        if code in doc.upper():
                            code_results.append({
                                "content": doc,
                                "score": 0.0,  # Exact match = highest priority
                                "metadata": all_docs['metadatas'][idx] if all_docs.get('metadatas') else {}
                            })
                            break
                
                if code_results:
                    print(f"✅ Found {len(code_results)} documents with product codes")
                    return code_results[:top_k]
            except Exception as e:
                print(f"⚠️ Code search failed: {e}")
        
        # Fall back to semantic search
        print("🔍 Using semantic search...")
        query_embedding = self._get_openai_embedding(query)
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
    
    def _get_openai_embedding(self, text: str):
        """Generate embedding using OpenAI"""
        try:
            response = self.openai_client.embeddings.create(
                model=self.embedding_model,
                input=text
            )
            return response.data[0].embedding
        except Exception as e:
            print(f"❌ OpenAI embedding error: {str(e)}")
            raise


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