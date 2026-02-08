import os
from dotenv import load_dotenv
from google import genai
from google.genai import types

load_dotenv()

class WebSearchService:
    def __init__(self):
        self.client = genai.Client(api_key=os.getenv("GEMINI_API_KEY"))
        self.model_name = "gemini-2.0-flash"
    
    def search_and_answer(self, question: str) -> dict:
        """Search the web and generate an answer using Gemini's grounding"""
        print(f"🌐 Web search for: {question}")
        
        try:
            # Enable Google Search grounding
            response = self.client.models.generate_content(
                model=self.model_name,
                contents=question,
                config=types.GenerateContentConfig(
                    tools=[types.Tool(google_search=types.GoogleSearch())]
                )
            )
            
            return {
                "answer": response.text,
                "sources": []  # Gemini includes citations in the text
            }
        
        except Exception as e:
            return {
                "answer": f"Web search error: {str(e)}",
                "sources": []
            }