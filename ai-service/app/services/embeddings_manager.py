# app/services/embeddings_manager.py

import os
from dotenv import load_dotenv
from openai import OpenAI
import chromadb
from chromadb.config import Settings
from app.services.semantic_pdf_processor import SemanticPDFProcessor

load_dotenv()

class EmbeddingsManager:
    def __init__(self):
        # OpenAI client for embeddings
        self.openai_client = OpenAI(api_key=os.getenv("OPENAI_API_KEY"))
        self.embedding_model = os.getenv("OPENAI_EMBEDDING_MODEL", "text-embedding-3-small")
        
        # Vector store path
        self.vector_store_path = "vector_store"
        
        # Create ChromaDB client
        self.chroma_client = chromadb.PersistentClient(
            path=self.vector_store_path,
            settings=Settings(anonymized_telemetry=False)
        )
        
        # Create or get collection
        self.collection = self.chroma_client.get_or_create_collection(
            name="tikamed_products",
            metadata={"description": "Dental prosthetic products catalogue - Semantic Chunking"}
        )
    
    def create_embeddings(self, pdf_path):
        """Load PDF → Semantic Chunk → Embed → Store"""
        print(f"📄 Loading and chunking PDF with semantic processor: {pdf_path}")
        processor = SemanticPDFProcessor()
        chunks = processor.load_and_chunk_pdf(pdf_path)
        print(f"✅ Created {len(chunks)} semantic chunks")
        
        print("\n🔄 Creating embeddings and storing in ChromaDB...")
        
        for i, chunk in enumerate(chunks):
            # Extract text content from semantic chunk dict
            chunk_text = chunk["content"]
            chunk_metadata = chunk["metadata"]
            
            # Get embedding
            embedding = self._get_openai_embedding(chunk_text)
            
            # Store in ChromaDB with enriched metadata
            metadata = {
                "source": pdf_path,
                "chunk_index": i,
                "page": chunk_metadata.get("page"),
                "section": chunk_metadata.get("section", ""),
                "type": chunk_metadata.get("type", "text")
            }
            
            self.collection.add(
                ids=[f"chunk_{i}"],
                embeddings=[embedding],
                documents=[chunk_text],
                metadatas=[metadata]
            )
            
            if (i + 1) % 5 == 0:
                print(f"  Processed {i + 1}/{len(chunks)} chunks...")
        
        print(f"\n✅ Stored {len(chunks)} embeddings in ChromaDB!")
        print(f"📁 Vector store saved to: {self.vector_store_path}/")
    
    def _get_openai_embedding(self, text):
        """Get embedding using OpenAI text-embedding-3-small"""
        response = self.openai_client.embeddings.create(
            model=self.embedding_model,
            input=text
        )
        return response.data[0].embedding


# Test
if __name__ == "__main__":
    manager = EmbeddingsManager()
    manager.create_embeddings("data/Prosthetic_Guide_BoneLEVEL_ETK_EN_TOPRINT.pdf")