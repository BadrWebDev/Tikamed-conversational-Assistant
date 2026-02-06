# app/services/embeddings_manager.py

import os
from dotenv import load_dotenv
import google.generativeai as genai
import chromadb
from chromadb.config import Settings
from app.services.pdf_processor import PDFProcessor

# Load environment variables
load_dotenv()

# Configure Gemini
genai.configure(api_key=os.getenv("GEMINI_API_KEY"))

class EmbeddingsManager:
    def __init__(self):
        # Path to vector store
        self.vector_store_path = "vector_store"
        
        # Create ChromaDB client (persistent storage)
        self.client = chromadb.PersistentClient(
            path=self.vector_store_path,
            settings=Settings(anonymized_telemetry=False)
        )
        
        # Create or get collection
        self.collection = self.client.get_or_create_collection(
            name="tikamed_products",
            metadata={"description": "Dental prosthetic products catalogue"}
        )
    
    def create_embeddings(self, pdf_path):
        """
        Main function: Load PDF → Chunk → Embed → Store
        """
        print(f"📄 Loading and chunking PDF: {pdf_path}")
        processor = PDFProcessor()
        chunks = processor.load_and_chunk_pdf(pdf_path)
        print(f"✅ Created {len(chunks)} chunks")
        
        print("\n🔄 Creating embeddings and storing in ChromaDB...")
        
        for i, chunk in enumerate(chunks):
            # Get embedding from Gemini
            embedding = self._get_gemini_embedding(chunk)
            
            # Store in ChromaDB
            self.collection.add(
                ids=[f"chunk_{i}"],
                embeddings=[embedding],
                documents=[chunk],
                metadatas=[{"source": pdf_path, "chunk_index": i}]
            )
            
            if (i + 1) % 5 == 0:
                print(f"  Processed {i + 1}/{len(chunks)} chunks...")
        
        print(f"\n✅ Stored {len(chunks)} embeddings in ChromaDB!")
        print(f"📁 Vector store saved to: {self.vector_store_path}/")
    
    def _get_gemini_embedding(self, text):
        """
        Convert text to embedding using Gemini (OLD SDK)
        """
        result = genai.embed_content(
            model="models/gemini-embedding-001",
            content=text,
            task_type="retrieval_document"
        )
        return result['embedding']

# Test function
if __name__ == "__main__":
    manager = EmbeddingsManager()
    manager.create_embeddings("data/Prosthetic_Guide_BoneLEVEL_ETK_EN_TOPRINT.pdf")