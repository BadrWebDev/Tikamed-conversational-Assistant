# ai-service/app/services/pdf_processor.py

import os
from typing import List
from pypdf import PdfReader
from langchain_text_splitters import RecursiveCharacterTextSplitter
from dotenv import load_dotenv

load_dotenv()

class PDFProcessor:
    def __init__(self):
        # Get chunking settings from .env
        self.chunk_size = int(os.getenv("CHUNK_SIZE", 1000))
        self.chunk_overlap = int(os.getenv("CHUNK_OVERLAP", 200))
        
    def load_and_chunk_pdf(self, pdf_path: str) -> List[str]:
        """
        Load a PDF file and split it into chunks.
        
        Args:
            pdf_path: Path to the PDF file
            
        Returns:
            List of text chunks
        """
        # Step 1: Extract text from PDF
        text = self._extract_text_from_pdf(pdf_path)
        
        # Step 2: Split into chunks
        chunks = self._split_text_into_chunks(text)
        
        return chunks
    
    def _extract_text_from_pdf(self, pdf_path: str) -> str:
        """Extract all text from a PDF file."""
        reader = PdfReader(pdf_path)
        text = ""
        
        for page in reader.pages:
            text += page.extract_text()
        
        return text
    
    def _split_text_into_chunks(self, text: str) -> List[str]:
        """Split text into overlapping chunks."""
        splitter = RecursiveCharacterTextSplitter(
            chunk_size=self.chunk_size,
            chunk_overlap=self.chunk_overlap,
            length_function=len,
        )
        
        chunks = splitter.split_text(text)
        return chunks


# Test function - we'll run this separately to see the output
if __name__ == "__main__":
    processor = PDFProcessor()
    pdf_path = "data/Prosthetic_Guide_BoneLEVEL_ETK_EN_TOPRINT.pdf"
    
    chunks = processor.load_and_chunk_pdf(pdf_path)
    
    print(f"Total chunks created: {len(chunks)}")
    print("\n--- First 3 chunks ---\n")
    
    for i, chunk in enumerate(chunks[:3]):
        print(f"CHUNK {i+1}:")
        print(chunk)
        print(f"\nLength: {len(chunk)} characters")
        print("-" * 80)