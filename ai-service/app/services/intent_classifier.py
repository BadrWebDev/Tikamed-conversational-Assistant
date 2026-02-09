import re
from typing import Literal

class IntentClassifier:
    """Determines if question needs FAQ, RAG, or Web Search"""
    
    # Predefined FAQs (you'll expand this)
    FAQ_DATABASE = {
    "hours": "We're open Monday-Friday, 9 AM - 6 PM.",
    "contact": "Email: info@tikamed.com | Phone: +123-456-7890",
    "location": "We're headquartered in Sallanches, France.",
    "where": "We're headquartered in Sallanches, France.",
    "hi": "Hello! How can I help you today?"
    }
    
    # Keywords that trigger RAG search
    PRODUCT_KEYWORDS = [
        "implant", "prosthetic", "bone level", "etk", 
        "catalog", "product", "specification", "price"
    ]
    
    # Keywords that need web search
    WEB_SEARCH_KEYWORDS = [
        "latest research", "recent study", "news", 
        "compared to", "industry standard",
        "what is", "define", "definition", "explain"  # Add these
    ]
    
    @staticmethod
    def classify(message: str) -> Literal["faq", "rag", "web_search"]:
        """Determine intent from message"""
        message_lower = message.lower()
        
        # Check FAQ first (exact matches)
        for faq_key in IntentClassifier.FAQ_DATABASE.keys():
            if faq_key in message_lower:
                return "faq"
        
        # Check for product-related queries
        if any(keyword in message_lower for keyword in IntentClassifier.PRODUCT_KEYWORDS):
            return "rag"
        
        # Check for web search needs
        if any(keyword in message_lower for keyword in IntentClassifier.WEB_SEARCH_KEYWORDS):
            return "web_search"
        
        # Default to RAG (safest option)
        return "rag"
    
    @staticmethod
    def get_faq_answer(message: str) -> str:
        """Get predefined FAQ answer"""
        message_lower = message.lower()
        
        for faq_key, answer in IntentClassifier.FAQ_DATABASE.items():
            if faq_key in message_lower:
                return answer
        
        return "I don't have a predefined answer for that."