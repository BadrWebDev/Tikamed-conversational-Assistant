import os
import fitz  # PyMuPDF
from typing import List, Dict
from dotenv import load_dotenv

load_dotenv()

class SemanticPDFProcessor:
    """
    Advanced PDF processor that chunks based on document structure
    instead of arbitrary character counts.
    """
    
    def __init__(self):
        self.min_chunk_size = 400  # Minimum chars per chunk (increased)
        self.max_chunk_size = 1500  # Maximum chars per chunk
    
    def load_and_chunk_pdf(self, pdf_path: str) -> List[Dict]:
        """
        Load PDF and create semantic chunks based on structure.
        
        Returns:
            List of dicts with {content, metadata}
        """
        doc = fitz.open(pdf_path)
        all_chunks = []
        
        for page_num in range(len(doc)):
            page = doc[page_num]
            page_chunks = self._process_page(page, page_num + 1)
            all_chunks.extend(page_chunks)
        
        doc.close()
        
        # Merge small chunks
        merged_chunks = self._merge_small_chunks(all_chunks)
        
        print(f"✅ Created {len(merged_chunks)} semantic chunks (from {len(all_chunks)} raw chunks)")
        return merged_chunks
    
    def _process_page(self, page, page_num: int) -> List[Dict]:
        """Process a single page and extract semantic chunks"""
        chunks = []
        
        # Get full page text for reference
        full_text = page.get_text()
        
        # Skip cover pages and mostly empty pages
        if len(full_text.strip()) < 50:
            return chunks
        
        # Extract text blocks with position info
        blocks = page.get_text("dict")["blocks"]
        
        current_header = ""
        accumulated_text = ""
        
        for block in blocks:
            if block["type"] == 0:  # Text block
                block_text = ""
                block_spans = []
                
                for line in block["lines"]:
                    line_text = ""
                    for span in line["spans"]:
                        line_text += span["text"]
                        block_spans.append(span)
                    block_text += line_text + "\n"
                
                # Skip page numbers, footers, headers
                if self._is_noise(block_text):
                    continue
                
                # Check if this block is a section header
                is_header = self._is_meaningful_header(block_text, block_spans)
                
                if is_header:
                    # Save previous section if it's substantial
                    if len(accumulated_text.strip()) > 100:
                        chunks.append({
                            "content": f"{current_header}\n{accumulated_text}".strip(),
                            "metadata": {
                                "page": page_num,
                                "section": current_header,
                                "type": "text"
                            }
                        })
                        accumulated_text = ""
                    
                    current_header = block_text.strip()
                else:
                    accumulated_text += block_text
                
                # If accumulated text is getting long, chunk it
                if len(accumulated_text) > self.max_chunk_size:
                    chunks.append({
                        "content": f"{current_header}\n{accumulated_text}".strip(),
                        "metadata": {
                            "page": page_num,
                            "section": current_header,
                            "type": "text"
                        }
                    })
                    accumulated_text = ""
        
        # Add remaining text if substantial
        if len(accumulated_text.strip()) > 100:
            chunks.append({
                "content": f"{current_header}\n{accumulated_text}".strip(),
                "metadata": {
                    "page": page_num,
                    "section": current_header,
                    "type": "text"
                }
            })
        
        # Extract tables as separate chunks
        tables = page.find_tables()
        if tables:
            for table_num, table in enumerate(tables.tables):
                table_text = self._extract_table_text(table)
                if table_text and len(table_text) > 100:
                    chunks.append({
                        "content": f"{current_header} - Table:\n{table_text}",
                        "metadata": {
                            "page": page_num,
                            "section": current_header,
                            "type": "table"
                        }
                    })
        
        return chunks
    
    def _is_noise(self, text: str) -> bool:
        """Detect and filter out page numbers, footers, headers"""
        text_clean = text.strip()
        
        # Skip very short text
        if len(text_clean) < 3:
            return True
        
        # Skip page numbers (single digits or simple numbers)
        if text_clean.isdigit() and len(text_clean) < 4:
            return True
        
        # Skip common footer/header patterns
        noise_patterns = [
            "Part2_", "PP_", ".indd", "CATAL_ML",
            "©", "®", "™"
        ]
        
        if any(pattern in text_clean for pattern in noise_patterns):
            return True
        
        return False
    
    def _is_meaningful_header(self, text: str, spans) -> bool:
        """Detect meaningful section headers (not just any bold text)"""
        if not spans:
            return False
        
        text_clean = text.strip()
        
        # Must be reasonable length for a header
        if len(text_clean) < 5 or len(text_clean) > 150:
            return False
        
        # Check formatting
        span = spans[0]
        font_size = span.get("size", 0)
        font_flags = span.get("flags", 0)
        
        is_bold = (font_flags & 16) != 0
        is_large = font_size > 11
        is_uppercase = text_clean.isupper() and len(text_clean) > 5
        
        # Must have at least 2 header indicators
        header_score = sum([is_bold, is_large, is_uppercase])
        
        # Common meaningful header keywords in this document
        header_keywords = [
            "PROSTHETIC", "HEALING", "ABUTMENT", "IMPRESSION",
            "TEMPORIZATION", "RESTORATION", "SOLUTION",
            "BONE LEVEL", "CEMENTED", "SCREWED"
        ]
        
        has_keyword = any(keyword in text_clean.upper() for keyword in header_keywords)
        
        return (header_score >= 2) or (has_keyword and is_bold)
    
    def _merge_small_chunks(self, chunks: List[Dict]) -> List[Dict]:
        """Merge chunks that are too small with adjacent chunks"""
        if not chunks:
            return chunks
        
        merged = []
        i = 0
        
        while i < len(chunks):
            current = chunks[i]
            
            # If chunk is too small and not last chunk
            if len(current["content"]) < self.min_chunk_size and i < len(chunks) - 1:
                # Merge with next chunk
                next_chunk = chunks[i + 1]
                merged_content = current["content"] + "\n\n" + next_chunk["content"]
                
                merged.append({
                    "content": merged_content,
                    "metadata": {
                        "page": current["metadata"]["page"],
                        "section": current["metadata"]["section"] or next_chunk["metadata"]["section"],
                        "type": current["metadata"]["type"]
                    }
                })
                i += 2  # Skip next chunk since we merged it
            else:
                merged.append(current)
                i += 1
        
        return merged
    
    def _extract_table_text(self, table) -> str:
        """Convert table to text representation"""
        table_text = ""
        
        try:
            for row in table.extract():
                row_text = " | ".join([str(cell).strip() if cell else "" for cell in row])
                if row_text.strip():
                    table_text += row_text + "\n"
        except Exception as e:
            print(f"⚠️ Error extracting table: {e}")
        
        return table_text.strip()


# Test function
if __name__ == "__main__":
    processor = SemanticPDFProcessor()
    pdf_path = "data/Prosthetic_Guide_BoneLEVEL_ETK_EN_TOPRINT.pdf"
    
    chunks = processor.load_and_chunk_pdf(pdf_path)
    
    print(f"\nTotal chunks created: {len(chunks)}")
    print("\n--- First 5 chunks ---\n")
    
    for i, chunk in enumerate(chunks[:5]):
        print(f"CHUNK {i+1} (Page {chunk['metadata']['page']}, Type: {chunk['metadata']['type']}):")
        print(f"Section: {chunk['metadata']['section']}")
        print(f"Length: {len(chunk['content'])} chars")
        print(chunk['content'][:400] + "...")
        print("-" * 80)