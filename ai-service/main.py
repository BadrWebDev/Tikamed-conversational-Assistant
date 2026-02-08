from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from app.routes import chat_routes
from app.models.schemas import HealthResponse
from app.services.vector_search import VectorSearch

app = FastAPI(
    title="Tikamed AI Service",
    description="RAG-powered chatbot for dental products",
    version="1.0.0"
)

# CORS - allows Laravel frontend to call this API
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # Change to your Laravel URL in production
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# Include routes
app.include_router(chat_routes.router)

# Health check endpoint
@app.get("/health", response_model=HealthResponse)
async def health_check():
    """Check if service is running and vector DB is accessible"""
    try:
        vector_search = VectorSearch()
        collection = vector_search.collection
        doc_count = collection.count()
        
        return HealthResponse(
            status="healthy",
            vector_db_status="connected",
            total_documents=doc_count
        )
    except Exception as e:
        return HealthResponse(
            status="degraded",
            vector_db_status=f"error: {str(e)}",
            total_documents=0
        )

@app.get("/")
async def root():
    return {
        "message": "Tikamed AI Service",
        "docs": "/docs",
        "health": "/health"
    }