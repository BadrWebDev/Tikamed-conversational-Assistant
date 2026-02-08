from fastapi import APIRouter, HTTPException
from app.models.schemas import ChatRequest, ChatResponse, SourceDocument
from app.services.intent_classifier import IntentClassifier
from app.services.rag_service import RAGService
import uuid
from datetime import datetime

router = APIRouter(prefix="/api/v1", tags=["chat"])

# Initialize services
rag_service = RAGService()

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
            
            # Convert sources to SourceDocument models
            sources = [
                SourceDocument(
                    content=doc["content"],
                    page=doc.get("page"),
                    score=doc["score"]
                )
                for doc in rag_response.get("sources", [])
            ]
            
            return ChatResponse(
                answer=rag_response["answer"],
                response_type="rag",
                sources=sources,
                conversation_id=conv_id
            )
        
        elif intent == "web_search":
            # Placeholder for web search (implement later)
            return ChatResponse(
                answer="Web search functionality coming soon. For now, try asking about our products!",
                response_type="fallback",
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