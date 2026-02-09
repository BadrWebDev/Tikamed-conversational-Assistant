from fastapi import APIRouter, HTTPException
from app.models.schemas import ChatRequest, ChatResponse, SourceDocument
from app.services.intent_classifier import IntentClassifier
from app.services.rag_service import RAGService
from app.services.web_search_service import WebSearchService
import uuid

print("🚀 CHAT ROUTES MODULE LOADED - NEW VERSION WITH DEBUGGING")

router = APIRouter(prefix="/api/v1", tags=["chat"])

# Initialize services
rag_service = RAGService()
web_search_service = WebSearchService()

@router.post("/chat", response_model=ChatResponse)
async def chat(request: ChatRequest):
    """
    Main chat endpoint
    
    Flow:
    1. Classify intent
    2. Route to appropriate service
    3. Format response
    """
    try:
        # Generate conversation ID if not provided
        conv_id = request.conversation_id or str(uuid.uuid4())
        
        # Classify the question
        intent = IntentClassifier.classify(request.message)
        print(f"🔍 Query: '{request.message}' → Intent: {intent}")
        
        # Handle based on intent
        if intent == "faq":
            answer = IntentClassifier.get_faq_answer(request.message)
            return ChatResponse(
                answer=answer,
                response_type="faq",
                sources=None,
                conversation_id=conv_id
            )
        
        elif intent == "rag":
            # Use your RAG service
            rag_response = rag_service.answer_question(request.message)
            
            # Check if results are relevant enough
            sources = rag_response.get("sources", [])
            best_score = min([s["score"] for s in sources]) if sources else 1.0
            
            # Use more lenient threshold for product code queries
            import re
            has_product_code = any(re.search(pattern, request.message.upper()) 
                                 for pattern in IntentClassifier.PRODUCT_CODE_PATTERNS)
            threshold = 0.70 if has_product_code else 0.55
            
            print(f"📊 RAG best score: {best_score:.4f} | Threshold: {threshold:.2f} | Has product code: {has_product_code}")
            
            # If best match is too irrelevant, fallback to web search
            if best_score > threshold:
                print(f"⚠️ RAG results not relevant (score: {best_score:.2f}), falling back to web search")
                web_response = web_search_service.search_and_answer(request.message)
                
                return ChatResponse(
                    answer=web_response["answer"],
                    response_type="web_search",
                    sources=None,
                    conversation_id=conv_id
                )
            
            # Convert sources to SourceDocument models
            formatted_sources = [
                SourceDocument(
                    content=doc["content"],
                    page=doc.get("page"),
                    score=doc["score"]
                )
                for doc in sources
            ]
            
            return ChatResponse(
                answer=rag_response["answer"],
                response_type="rag",
                sources=formatted_sources,
                conversation_id=conv_id
            )
        
        elif intent == "web_search":
            # Use web search service
            web_response = web_search_service.search_and_answer(request.message)
            
            return ChatResponse(
                answer=web_response["answer"],
                response_type="web_search",
                sources=None,
                conversation_id=conv_id
            )
        
        else:
            # Fallback
            return ChatResponse(
                answer="I'm not sure how to help with that. Could you rephrase your question?",
                response_type="fallback",
                sources=None,
                conversation_id=conv_id
            )
    
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Error processing request: {str(e)}")