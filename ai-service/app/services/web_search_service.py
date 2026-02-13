import os
from concurrent.futures import ThreadPoolExecutor, TimeoutError as FuturesTimeoutError
from dotenv import load_dotenv
from google import genai
from google.genai import types

load_dotenv()

class WebSearchService:
    def __init__(self):
        self.client = genai.Client(api_key=os.getenv("GEMINI_API_KEY"))
        self.model_name = "gemini-2.0-flash"
        self.timeout = 30  # 30 seconds timeout
    
    def search_and_answer(self, question: str) -> dict:
        """Search the web and generate an answer using Gemini's grounding"""
        print(f"🌐 Web search for: {question}")
        
        # Create concise prompt
        prompt = f"""Answer this question briefly and concisely in 2-4 sentences. Focus only on the key points.

Question: {question}

Provide a short, direct answer."""
        
        try:
            # Use ThreadPoolExecutor with timeout to prevent hanging
            with ThreadPoolExecutor(max_workers=1) as executor:
                future = executor.submit(
                    self.client.models.generate_content,
                    model=self.model_name,
                    contents=prompt,
                    config=types.GenerateContentConfig(
                        tools=[types.Tool(google_search=types.GoogleSearch())],
                        max_output_tokens=300,  # Limit response length
                        temperature=0.5  # Lower temperature for focused answers
                    )
                )
                
                try:
                    response = future.result(timeout=self.timeout)
                    return {
                        "answer": response.text,
                        "sources": []  # Gemini includes citations in the text
                    }
                except FuturesTimeoutError:
                    print(f"⏱️ Web search timeout after {self.timeout}s")
                    return {
                        "answer": "Je suis désolé, la recherche prend trop de temps. Veuillez réessayer dans quelques instants.",
                        "sources": []
                    }
        
        except Exception as e:
            print(f"❌ Web search error: {str(e)}")
            return {
                "answer": "Je suis désolé, je ne peux pas effectuer de recherche web pour le moment. Notre service rencontre des difficultés temporaires. Veuillez réessayer dans quelques instants.",
                "sources": []
            }