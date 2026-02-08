from pydantic import BaseModel, Field
from typing import Optional, Literal
from datetime import datetime

class ChatRequest(BaseModel):
    """Request from frontend"""
    message: str = Field(..., min_length=1, max_length=1000)
    conversation_id: Optional[str] = None
    
class SourceDocument(BaseModel):
    """A chunk retrieved from vector DB"""
    content: str
    page: Optional[int] = None
    score: float

class ChatResponse(BaseModel):
    """Response to frontend"""
    answer: str
    response_type: Literal["faq", "rag", "web_search", "fallback"]
    sources: Optional[list[SourceDocument]] = None
    conversation_id: str
    timestamp: datetime = Field(default_factory=datetime.now)

class HealthResponse(BaseModel):
    """Health check response"""
    status: str
    vector_db_status: str
    total_documents: int