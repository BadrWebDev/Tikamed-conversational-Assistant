import re
from typing import Literal

class IntentClassifier:
    """Determines if question needs FAQ, RAG, or Web Search"""
    
    # Predefined FAQs (you'll expand this)
    FAQ_DATABASE = {
    # English
    "hours": "We're open Monday-Friday, 9 AM - 6 PM.",
    "contact": "Email: info@tikamed.com | Phone: +123-456-7890",
    "location": "We're headquartered in Sallanches, France.",
    "where": "We're headquartered in Sallanches, France.",
    "hi": "Hello! How can I help you today?",
    "what is tikamed": "Tikamed Digital Solutions is a leading provider of premium dental implant products, specializing in bone level implants and prosthetic solutions.",
    "about tikamed": "Tikamed Digital Solutions is a leading provider of premium dental implant products, specializing in bone level implants and prosthetic solutions.",
    "who is tikamed": "Tikamed Digital Solutions is a leading provider of premium dental implant products, specializing in bone level implants and prosthetic solutions.",
    "your products": "We specialize in premium dental implant products including: Bone Level Implants, Healing Abutments, Cover Screws, Prosthetic Solutions (Direct Clip Abutments, Temporary Abutments), and complete ranges of components for dental professionals.",
    "what products": "We specialize in premium dental implant products including: Bone Level Implants, Healing Abutments, Cover Screws, Prosthetic Solutions (Direct Clip Abutments, Temporary Abutments), and complete ranges of components for dental professionals.",
    "products do you": "We specialize in premium dental implant products including: Bone Level Implants, Healing Abutments, Cover Screws, Prosthetic Solutions (Direct Clip Abutments, Temporary Abutments), and complete ranges of components for dental professionals.",
    # French
    "bonjour": "Bonjour ! Comment puis-je vous aider aujourd'hui ?",
    "salut": "Bonjour ! Comment puis-je vous aider aujourd'hui ?",
    "qu'est-ce que tikamed": "Tikamed Digital Solutions est un fournisseur leader de produits d'implants dentaires premium, spécialisé dans les implants bone level et les solutions prothétiques.",
    "c'est quoi tikamed": "Tikamed Digital Solutions est un fournisseur leader de produits d'implants dentaires premium, spécialisé dans les implants bone level et les solutions prothétiques.",
    "qui est tikamed": "Tikamed Digital Solutions est un fournisseur leader de produits d'implants dentaires premium, spécialisé dans les implants bone level et les solutions prothétiques.",
    "à propos de tikamed": "Tikamed Digital Solutions est un fournisseur leader de produits d'implants dentaires premium, spécialisé dans les implants bone level et les solutions prothétiques.",
    "vos produits": "Nous sommes spécialisés dans les produits d'implants dentaires premium incluant : Implants Bone Level, Piliers de Cicatrisation, Vis de Couverture, Solutions Prothétiques (Piliers à Clip Direct, Piliers Temporaires), et une gamme complète de composants pour les professionnels dentaires.",
    "quels produits": "Nous sommes spécialisés dans les produits d'implants dentaires premium incluant : Implants Bone Level, Piliers de Cicatrisation, Vis de Couverture, Solutions Prothétiques (Piliers à Clip Direct, Piliers Temporaires), et une gamme complète de composants pour les professionnels dentaires.",
    "produits proposez": "Nous sommes spécialisés dans les produits d'implants dentaires premium incluant : Implants Bone Level, Piliers de Cicatrisation, Vis de Couverture, Solutions Prothétiques (Piliers à Clip Direct, Piliers Temporaires), et une gamme complète de composants pour les professionnels dentaires.",
    "horaires": "Nous sommes ouverts du lundi au vendredi, de 9h à 18h.",
    "localisation": "Notre siège est à Sallanches, France.",
    "où êtes-vous": "Notre siège est à Sallanches, France."
    }
    
    # Product code patterns (highest priority)
    PRODUCT_CODE_PATTERNS = [
        r"NCI_", r"NCI3_", r"NPS_", r"APS_", r"ARS_", r"NTD", r"NFE_", r"NVD_",
        r"UPV", r"VMD", r"NVP_", r"NPV_", r"NPC_", r"NPA_", r"TCP", r"BCC", r"BCO",
        r"ETK_", r"ANA_", r"NAT", r"CMO_", r"CCL_", r"CCR_", r"CMR_", r"UMA_",
        r"OPS_", r"UPA_", r"KIE_", r"NPE_", r"NPI_", r"NPU_", r"130NAT", r"130NTR",
        r"044", r"144", r"192", r"335", r"760", r"485"
    ]
    
    # Keywords that trigger RAG search (English + French)
    PRODUCT_KEYWORDS = [
        # French - Product Lines (Priority for French chatbot)
        "implant", "implantaire", "prothétique", "prothèse", "bone level", "niveau osseux",
        "catalogue", "produit", "spécification", "prix", "référence", "gamme", "système",
        "iphysio", "naturactis", "euroteknika", "lyra", "etk",
        
        # French - Components
        "pilier", "vis", "cicatrisation", "couverture", "diamètre", "analogue",
        "transfert", "temporaire", "provisoire", "restauration", "empreinte",
        "scanbody", "capuchon", "protection", "coulable", "calcinable", "mandrin",
        "tournevis", "faux moignon", "cylindre", "insert", "bague", "coiffe",
        
        # French - Types & Solutions
        "droit", "droite", "angulé", "angulée", "tétra", "pluriel", "conique", 
        "clip", "direct", "directe", "esthétibase", "équator", "o-ring", 
        "amovible", "scellée", "cimentée", "transvissée", "vissée", "vissé",
        "rotationnel", "rotationnelle", "non-rotationnel", "profile designer",
        "ailette", "ailé", "all in bar", "barre",
        
        # French - Technical Terms
        "supra-implantaire", "hauteur", "couple", "serrage", "pick-up", "pop-in", "pop-up",
        "laboratoire", "titane", "cobalt", "chrome", "joint", "gaine", "étanche",
        "interface", "connexion", "ajusté", "calibré",
        
        # French - Prosthetic Types
        "couronne", "bridge", "pont", "prothèse fixe", "prothèse amovible",
        "overdenture", "barre de rétention", "attachement",
        
        # French - Dimensions & Profiles
        "diamètre", "ø3", "ø4", "ø6", "ep", "np", "rp", "wp", "mp",
        "profile", "forme", "hauteur gingivale", "émergence",
        
        # English - Product Lines
        "implant", "prosthetic", "bone level", "etk", "iphysio", "naturactis",
        "catalog", "product", "specification", "price", "reference",
        
        # English - Components
        "abutment", "screw", "healing", "cover", "diameter", "analog", "transfer",
        "temporary", "final", "restoration", "impression", "coping", "scanbody",
        "cap", "protection", "castable", "burn-out", "mandrel", "screwdriver",
        
        # English - Types
        "straight", "angulated", "tetra", "plural", "conical", "clip", "direct",
        "esthetibase", "equator", "o-ring", "removable", "cemented", "screwed",
        "rotational", "non-rotational", "profile designer", "winged", "all in bar",
        
        # English - Technical Terms
        "supra-implant", "height", "torque", "pick-up", "pop-in", "pop-up",
        "laboratory", "titanium", "cobalt", "chrome", "seal", "sheath"
    ]
    
    # Keywords that need web search
    WEB_SEARCH_KEYWORDS = [
        "latest research", "recent study", "news", 
        "compared to", "industry standard", "market trend"
    ]
    
    @staticmethod
    def classify(message: str) -> Literal["faq", "rag", "web_search"]:
        """Determine intent from message"""
        message_lower = message.lower()
        message_upper = message.upper()
        
        # Check FAQ first (exact matches)
        for faq_key in IntentClassifier.FAQ_DATABASE.keys():
            if faq_key in message_lower:
                return "faq"
        
        # Check for product codes (HIGHEST PRIORITY)
        if any(re.search(pattern, message_upper) for pattern in IntentClassifier.PRODUCT_CODE_PATTERNS):
            return "rag"
        
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