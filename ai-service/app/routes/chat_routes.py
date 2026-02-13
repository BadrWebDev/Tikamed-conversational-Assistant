from fastapi import APIRouter, HTTPException
from app.models.schemas import ChatRequest, ChatResponse, SourceDocument
from app.services.intent_classifier import IntentClassifier
from app.services.rag_service import RAGService
from app.services.web_search_service import WebSearchService
import uuid
import re
import time

print("🚀 CHAT ROUTES MODULE LOADED - NEW VERSION WITH DEBUGGING")

router = APIRouter(prefix="/api/v1", tags=["chat"])

# Initialize services
rag_service = RAGService()
web_search_service = WebSearchService()

def split_questions(message: str) -> list:
    """Split message into multiple questions if present"""
    # Split by common patterns: "and", "?", "also", line breaks
    # Keep the questions intact
    questions = []
    
    # First, split by "?" but keep it
    parts = message.split('?')
    for i, part in enumerate(parts):
        part = part.strip()
        if not part:
            continue
        # Add back the "?"
        if i < len(parts) - 1:
            part += "?"
        # Further split by "and" or "also" for compound questions
        sub_parts = re.split(r'\s+and\s+(?=[A-Z])|also,?\s+', part, flags=re.IGNORECASE)
        questions.extend([q.strip() for q in sub_parts if q.strip()])
    
    # If no good splits, return original message
    return questions if len(questions) > 1 else [message]

def process_single_question(question: str, conv_id: str):
    """Process a single question and return answer parts"""
    start_time = time.time()
    
    intent = IntentClassifier.classify(question)
    print(f"🔍 Query: '{question}' → Intent: {intent}")
    
    if intent == "faq":
        answer = IntentClassifier.get_faq_answer(question)
        elapsed = time.time() - start_time
        print(f"⚡ FAQ answered in {elapsed:.2f}s")
        return {
            "answer": answer,
            "type": "faq",
            "sources": None
        }
    
    elif intent == "rag":
        try:
            rag_response = rag_service.answer_question(question)
            sources = rag_response.get("sources", [])
            best_score = min([s["score"] for s in sources]) if sources else 1.0
            
            # Use more lenient threshold for product code queries
            has_product_code = any(re.search(pattern, question.upper()) 
                                 for pattern in IntentClassifier.PRODUCT_CODE_PATTERNS)
            threshold = 0.70 if has_product_code else 0.55
            
            print(f"📊 RAG best score: {best_score:.4f} | Threshold: {threshold:.2f} | Has product code: {has_product_code}")
            
            if best_score > threshold:
                print(f"⚠️ RAG results not relevant (score: {best_score:.2f}), falling back to web search")
                web_response = web_search_service.search_and_answer(question)
                elapsed = time.time() - start_time
                print(f"⚡ Web fallback answered in {elapsed:.2f}s")
                return {
                    "answer": web_response["answer"],
                    "type": "web_search",
                    "sources": None
                }
            
            formatted_sources = [
                SourceDocument(
                    content=doc["content"],
                    page=doc.get("page"),
                    score=doc["score"]
                )
                for doc in sources
            ]
            
            elapsed = time.time() - start_time
            print(f"⚡ RAG answered in {elapsed:.2f}s")
            return {
                "answer": rag_response["answer"],
                "type": "rag",
                "sources": formatted_sources
            }
        except TimeoutError as e:
            elapsed = time.time() - start_time
            print(f"⏱️ RAG timeout after {elapsed:.2f}s: {str(e)}")
            return {
                "answer": "Je suis désolé, le traitement de votre question prend trop de temps. Veuillez réessayer avec une question plus simple ou réessayer dans quelques instants.",
                "type": "error",
                "sources": None
            }
        except Exception as e:
            elapsed = time.time() - start_time
            print(f"❌ RAG error after {elapsed:.2f}s: {str(e)}")
            return {
                "answer": "Je suis désolé, une erreur s'est produite lors du traitement de votre question. Veuillez réessayer.",
                "type": "error",
                "sources": None
            }
    
    elif intent == "web_search":
        try:
            web_response = web_search_service.search_and_answer(question)
            elapsed = time.time() - start_time
            print(f"⚡ Web search answered in {elapsed:.2f}s")
            return {
                "answer": web_response["answer"],
                "type": "web_search",
                "sources": None
            }
        except Exception as e:
            elapsed = time.time() - start_time
            print(f"❌ Web search error after {elapsed:.2f}s: {str(e)}")
            return {
                "answer": "Je suis désolé, une erreur s'est produite lors de la recherche web. Veuillez réessayer.",
                "type": "error",
                "sources": None
            }
    
    else:
        elapsed = time.time() - start_time
        print(f"⚡ Fallback response in {elapsed:.2f}s")
        return {
            "answer": "I'm not sure how to help with that. Could you rephrase your question?",
            "type": "fallback",
            "sources": None
        }

@router.post("/chat", response_model=ChatResponse)
async def chat(request: ChatRequest):
    """
    Main chat endpoint - supports multiple questions
    
    Flow:
    1. Split message into multiple questions if present
    2. Process each question independently
    3. Combine answers with clear separation
    """
    request_start = time.time()
    try:
        # Generate conversation ID if not provided
        conv_id = request.conversation_id or str(uuid.uuid4())
        
        # Split into multiple questions
        questions = split_questions(request.message)
        print(f"📝 Found {len(questions)} question(s)")
        
        if len(questions) == 1:
            # Single question - process normally
            result = process_single_question(questions[0], conv_id)
            total_time = time.time() - request_start
            print(f"✅ Total request time: {total_time:.2f}s")
            return ChatResponse(
                answer=result["answer"],
                response_type=result["type"],
                sources=result["sources"],
                conversation_id=conv_id
            )
        
        else:
            # Multiple questions - process each and combine
            combined_answers = []
            all_sources = []
            response_types = []
            
            for i, question in enumerate(questions, 1):
                result = process_single_question(question, conv_id)
                
                # Format answer with question number
                combined_answers.append(f"**Question {i}:** {question}\n\n{result['answer']}")
                response_types.append(result["type"])
                
                # Collect sources if any
                if result["sources"]:
                    all_sources.extend(result["sources"])
            
            # Combine all answers
            final_answer = "\n\n---\n\n".join(combined_answers)
            
            # Determine primary response type (prioritize: rag > faq > web_search > fallback)
            if "rag" in response_types:
                primary_type = "rag"
            elif "faq" in response_types:
                primary_type = "faq"
            elif "web_search" in response_types:
                primary_type = "web_search"
            else:
                primary_type = "fallback"
            
            total_time = time.time() - request_start
            print(f"✅ Total request time (multiple questions): {total_time:.2f}s")
            return ChatResponse(
                answer=final_answer,
                response_type=primary_type,
                sources=all_sources if all_sources else None,
                conversation_id=conv_id
            )
    
    except TimeoutError as e:
        total_time = time.time() - request_start
        print(f"⏱️ Request timeout after {total_time:.2f}s: {str(e)}")
        raise HTTPException(
            status_code=504, 
            detail="Request timeout. The operation took too long to complete. Please try again with a simpler question."
        )
    except Exception as e:
        total_time = time.time() - request_start
        print(f"❌ Request error after {total_time:.2f}s: {str(e)}")
        raise HTTPException(status_code=500, detail=f"Error processing request: {str(e)}")