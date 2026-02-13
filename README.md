# Tikamed Conversational Assistant 🦷💬

An intelligent dental products chatbot built with RAG (Retrieval-Augmented Generation) technology, combining semantic search, product code recognition, and web search capabilities. Built for **Tikamed Digital Solutions** to help customers find information about dental prosthetic products.

![Laravel](https://img.shields.io/badge/Laravel-12.50.0-red)
![FastAPI](https://img.shields.io/badge/FastAPI-0.115.6-teal)
![OpenAI](https://img.shields.io/badge/OpenAI-GPT--4o--mini-blue)
![Python](https://img.shields.io/badge/Python-3.9+-green)
![PHP](https://img.shields.io/badge/PHP-8.2+-purple)

---

## 📋 Table of Contents
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Project Structure](#-project-structure)
- [Architecture](#-architecture)
- [Installation](#-installation)
- [Usage](#-usage)
- [Cost Optimization](#-cost-optimization)
- [Screenshots](#-screenshots)
- [Contributing](#-contributing)

---

## ✨ Features

### 🎯 Smart Intent Classification
- **Product Code Search**: Recognizes 44+ product code patterns (e.g., `NPS_PD36.16`)
- **130+ French Keywords**: Enhanced dental terminology support (pilier, vis, prothèse, etc.)
- **Hybrid Search**: Combines regex matching + semantic embeddings for accurate results

### 🤖 AI-Powered Responses
- **RAG Pipeline**: OpenAI GPT-4o-mini with ChromaDB vector store
- **Cost-Effective**: ~$0.00033 per query = **30,000 queries with $10**
- **Multi-Language**: Supports French and English automatically
- **Context-Aware**: Retrieves relevant product documentation before answering

### 🔍 Triple Search Strategy
1. **FAQ Search**: Quick answers for common questions
2. **RAG Search**: Semantic search in product catalogue (27 documents)
3. **Web Search**: Fallback using Gemini's Google Search (free tier)

### 💎 Modern UI/UX
- **AWS-Style Chat Widget**: Professional design with avatar and status indicator
- **Mobile Responsive**: Fullscreen chat experience on phones (100vw × 100vh)
- **Smooth Animations**: Fade-in effects, typing indicators, smooth scrolling
- **Purple Theme**: Custom branding (rgb(163, 40, 167))

### ⚡ Performance & Reliability
- **Timeout Handling**: 30s timeouts with graceful error messages
- **Real-time Processing**: FastAPI async endpoints
- **Persistent Storage**: ChromaDB vector store with semantic chunking

---

## 🛠️ Tech Stack

### Frontend
- **Laravel 12.50.0** - PHP web framework for the main application
- **Alpine.js 3.x** - Reactive state management for chat widget
- **Bootstrap 5.3.3** - UI components and responsive grid
- **Blade Templates** - Laravel's templating engine
- **Tailwind CSS** - Utility-first CSS framework

### Backend (AI Service)
- **FastAPI 0.115.6** - High-performance Python web framework
- **OpenAI GPT-4o-mini** - Language model for RAG ($0.150/1M input tokens)
- **OpenAI text-embedding-3-small** - Embeddings ($0.020/1M tokens)
- **Google Gemini 2.0 Flash** - Web search (free tier)
- **ChromaDB** - Vector database for semantic search
- **PyPDF2** - PDF parsing for product catalogues
- **python-dotenv** - Environment variable management

### AI & ML
- **Semantic Chunking** - Intelligent document splitting by meaning
- **Vector Embeddings** - 1536-dimension OpenAI embeddings
- **Cosine Similarity** - Vector search ranking
- **Intent Classification** - Rule-based + semantic hybrid approach

---

## 📁 Project Structure

```
Tikamed-conversational-Assistant/
│
├── 📂 laravel-app/                      # Frontend Laravel Application
│   ├── app/
│   │   ├── Http/Controllers/
│   │   │   └── ChatController.php       # Handles chat API requests
│   │   └── Models/
│   ├── resources/
│   │   └── views/
│   │       ├── welcome.blade.php        # Landing page
│   │       └── chat/
│   │           └── index.blade.php      # Chat widget UI (2807 lines)
│   ├── routes/
│   │   └── web.php                      # Laravel routes
│   ├── public/
│   │   └── image/                       # Brand assets
│   ├── composer.json                    # PHP dependencies
│   └── .env                             # Laravel config
│
├── 📂 ai-service/                       # AI Backend (FastAPI)
│   ├── main.py                          # FastAPI entry point
│   ├── requirements.txt                 # Python dependencies
│   ├── .env                             # AI service config (OpenAI keys)
│   │
│   ├── app/
│   │   ├── routes/
│   │   │   └── chat_routes.py           # /chat endpoint
│   │   │
│   │   ├── services/
│   │   │   ├── intent_classifier.py     # Route queries (FAQ/RAG/Web)
│   │   │   ├── rag_service.py           # RAG pipeline (GPT-4o-mini)
│   │   │   ├── embeddings_manager.py    # Create & manage embeddings
│   │   │   ├── vector_search.py         # Hybrid search (regex + semantic)
│   │   │   ├── pdf_processor.py         # PDF chunking
│   │   │   ├── semantic_pdf_processor.py # Smart semantic chunking
│   │   │   └── web_search_service.py    # Gemini web search (free)
│   │   │
│   │   └── models/
│   │       └── schemas.py               # Pydantic request/response models
│   │
│   ├── data/                            # Product catalogues (PDFs)
│   │   └── Prosthetic_Guide_BoneLEVEL_ETK_EN_TOPRINT.pdf
│   │
│   └── vector_store/                    # ChromaDB persistent storage
│       └── chroma.sqlite3               # Vector embeddings database
│
├── 📄 OPENAI_MIGRATION.md               # Migration guide & cost analysis
├── 📄 TIMEOUT_FIXES.md                  # Timeout handling documentation
└── 📄 README.md                         # This file
```

---

## 🏗️ Architecture

### Request Flow

```
┌─────────────────────────────────────────────────────────────────┐
│                         USER (Browser)                          │
└───────────────────────────┬─────────────────────────────────────┘
                            │
                            ↓
┌─────────────────────────────────────────────────────────────────┐
│  Laravel Frontend (Port 8080)                                   │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │  Chat Widget (Alpine.js)                                  │  │
│  │  - User input handling                                    │  │
│  │  - Message display                                        │  │
│  │  - Loading states                                         │  │
│  └────────────────────────┬─────────────────────────────────┘  │
└───────────────────────────┼─────────────────────────────────────┘
                            │ POST /api/chat
                            ↓
┌─────────────────────────────────────────────────────────────────┐
│  ChatController.php                                             │
│  - Validates input                                              │
│  - Forwards to AI service                                       │
└───────────────────────────┬─────────────────────────────────────┘
                            │ POST http://localhost:8002/chat
                            ↓
┌─────────────────────────────────────────────────────────────────┐
│  FastAPI AI Service (Port 8002)                                 │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │  Intent Classifier                                        │  │
│  │  - 130+ French keywords                                   │  │
│  │  - 44 product code patterns                               │  │
│  │  - Routes to: FAQ / RAG / Web Search                      │  │
│  └────┬─────────────┬─────────────────┬──────────────────────┘  │
│       │             │                 │                         │
│       ↓             ↓                 ↓                         │
│  ┌─────────┐  ┌──────────┐  ┌─────────────────┐               │
│  │   FAQ   │  │   RAG    │  │  Web Search     │               │
│  │ (JSON)  │  │          │  │  (Gemini Free)  │               │
│  └─────────┘  └────┬─────┘  └─────────────────┘               │
│                    │                                            │
│              ┌─────┴──────┐                                     │
│              ↓            ↓                                     │
│        ┌──────────┐  ┌──────────────┐                          │
│        │ ChromaDB │  │ OpenAI GPT   │                          │
│        │ Vectors  │  │ 4o-mini      │                          │
│        │ Search   │  │ Generation   │                          │
│        └──────────┘  └──────────────┘                          │
└─────────────────────────────────────────────────────────────────┘
                            │
                            ↓
                    Return JSON Response
```

### RAG Pipeline Details

```
1. User Question
   ↓
2. Embed Query (OpenAI text-embedding-3-small)
   ↓
3. Hybrid Search:
   ├─→ Regex Match: Check for product codes (NPS_PD36.16)
   └─→ Vector Search: Cosine similarity in ChromaDB
   ↓
4. Retrieve Top 3 Chunks
   ↓
5. Build Context Prompt
   ↓
6. GPT-4o-mini Generation (max 1000 tokens)
   ↓
7. Return Answer + Sources
```

---

## 🚀 Installation

### Prerequisites
- **PHP 8.2+** with Composer
- **Python 3.9+** with pip
- **Node.js 16+** with npm
- **OpenAI API Key** (get from https://platform.openai.com/api-keys)
- **Gemini API Key** (optional, for web search - https://aistudio.google.com/apikey)

### Step 1: Clone Repository
```bash
git clone https://github.com/yourusername/Tikamed-conversational-Assistant.git
cd Tikamed-conversational-Assistant
```

### Step 2: Setup Laravel Frontend
```bash
cd laravel-app

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Create .env file
cp .env.example .env
php artisan key:generate

# Build assets
npm run build

# Start Laravel server
php artisan serve --port=8080
```

Laravel will run at: `http://localhost:8080`

### Step 3: Setup AI Service
```bash
cd ai-service

# Create virtual environment
python -m venv venv
source venv/bin/activate  # Windows: venv\Scripts\activate

# Install dependencies
pip install -r requirements.txt

# Create .env file
cp .env.example .env
```

**Edit `ai-service/.env`** and add your API keys:
```env
OPENAI_API_KEY=sk-your-actual-openai-key-here
OPENAI_MODEL=gpt-4o-mini
OPENAI_EMBEDDING_MODEL=text-embedding-3-small
GEMINI_API_KEY=your-gemini-key-here  # For web search
```

### Step 4: Create Vector Embeddings
```bash
# Inside ai-service/ directory
python -m app.services.embeddings_manager
```

This will:
- Load your PDF from `data/`
- Create semantic chunks
- Generate OpenAI embeddings
- Store in ChromaDB (`vector_store/`)

### Step 5: Start AI Service
```bash
uvicorn main:app --reload --port 8002
```

AI service will run at: `http://localhost:8002`

### Step 6: Test the Application
Open browser: `http://localhost:8080`

Try asking:
- "Quelles sont les spécifications du NPS_PD36.16?"
- "Comment installer un pilier de cicatrisation?"
- "What is a dental implant?"

---

## 📖 Usage

### Testing with cURL

**Chat endpoint:**
```bash
curl -X POST http://localhost:8002/chat \
  -H "Content-Type: application/json" \
  -d '{"message": "Quelles sont les spécifications du NPS_PD36.16?"}'
```

**Response:**
```json
{
  "answer": "Le NPS_PD36.16 est un pilier droit avec les spécifications suivantes: ...",
  "sources": [
    {
      "content": "Product documentation...",
      "metadata": {"page": 5, "section": "Specifications"}
    }
  ]
}
```

### Python Test Script

```python
import requests

response = requests.post(
    "http://localhost:8002/chat",
    json={"message": "Comment choisir un pilier?"}
)
print(response.json()["answer"])
```

### Frontend Integration

The chat widget is embedded in `resources/views/chat/index.blade.php`:

```javascript
// Alpine.js component
Alpine.data('chatWidget', () => ({
    messages: [],
    userInput: '',
    async sendMessage() {
        const response = await fetch('/api/chat', {
            method: 'POST',
            body: JSON.stringify({ message: this.userInput })
        });
        const data = await response.json();
        this.messages.push({ text: data.answer, sender: 'bot' });
    }
}))
```

---

## 💰 Cost Optimization

### Current Configuration (Optimized for $10 Budget)

**Models:**
- **GPT-4o-mini**: $0.150/1M input, $0.600/1M output
- **text-embedding-3-small**: $0.020/1M tokens
- **Gemini 2.0 Flash**: FREE for web search

**Per Query Cost Breakdown:**
```
Query Embedding:      50 tokens × $0.020/1M = $0.000001
RAG Context:        1000 tokens × $0.150/1M = $0.00015
GPT Response:        300 tokens × $0.600/1M = $0.00018
─────────────────────────────────────────────────────
Total per query:                           ~$0.00033
```

**With $10 Budget:**
- **~30,000 queries** total
- **100 queries/day** = 10 months of usage
- **1,000 queries/day** = 1 month of usage

### Cost Monitoring

**OpenAI Dashboard:**
https://platform.openai.com/usage

**Set Billing Alerts:**
- Warning at $8 (80% of budget)
- Hard limit at $10

### Further Optimization Options

If you need even lower costs:
1. **Reduce max_tokens**: 1000 → 500 tokens
2. **Reduce top_k**: 3 chunks → 2 chunks
3. **Switch to GPT-3.5-turbo**: 3x cheaper (but lower quality)

See [OPENAI_MIGRATION.md](OPENAI_MIGRATION.md) for full cost analysis.

---

## 🎨 Screenshots

### Desktop View
![Chat Widget Desktop](docs/screenshot-desktop.png)

### Mobile View
![Chat Widget Mobile](docs/screenshot-mobile.png)

### RAG Response Example
![RAG Response](docs/screenshot-rag.png)

---

## 🧪 Testing

### Run Tests
```bash
# Laravel tests
cd laravel-app
php artisan test

# Python tests
cd ai-service
pytest
```

### Test Questions

**Product Code Search:**
```
Quelles sont les spécifications du NPS_PD36.16?
Donnez-moi les informations sur le pilier NPS_SA17.12
```

**Semantic Search:**
```
Comment installer un pilier de cicatrisation?
Quel couple de serrage recommandé pour les vis prothétiques?
```

**Web Search Fallback:**
```
Quels sont les avantages des implants dentaires?
What is a dental crown?
```

---

## 🔧 Configuration

### Key Environment Variables

**Laravel (.env):**
```env
APP_URL=http://localhost:8080
AI_SERVICE_URL=http://localhost:8002
```

**AI Service (.env):**
```env
OPENAI_API_KEY=sk-...
OPENAI_MODEL=gpt-4o-mini
OPENAI_EMBEDDING_MODEL=text-embedding-3-small
GEMINI_API_KEY=...
VECTOR_STORE_PATH=./vector_store
CHUNK_SIZE=1000
CHUNK_OVERLAP=200
```

---

## 📚 Documentation

- **[OPENAI_MIGRATION.md](OPENAI_MIGRATION.md)** - Migration guide, cost analysis, troubleshooting
- **[TIMEOUT_FIXES.md](TIMEOUT_FIXES.md)** - Timeout handling and error recovery
- **API Docs**: http://localhost:8002/docs (FastAPI Swagger UI)
- **OpenAI Docs**: https://platform.openai.com/docs
- **ChromaDB Docs**: https://docs.trychroma.com

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/amazing-feature`
3. Commit changes: `git commit -m 'Add amazing feature'`
4. Push to branch: `git push origin feature/amazing-feature`
5. Open a Pull Request

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👥 Authors

- **Tikamed Digital Solutions** - Dental products and digital healthcare solutions
- Built with ❤️ using OpenAI GPT-4o-mini, FastAPI, and Laravel

---

## 🆘 Support

For issues and questions:
- **GitHub Issues**: https://github.com/yourusername/Tikamed-conversational-Assistant/issues
- **Email**: support@tikamed.com
- **Documentation**: See docs/ folder

---

## 🎯 Roadmap

- [ ] Multi-language support (Arabic, Spanish)
- [ ] Voice input/output
- [ ] Image recognition for product identification
- [ ] Admin dashboard for analytics
- [ ] Multi-PDF catalogue support
- [ ] Export conversation history
- [ ] Integration with CRM systems

---

**Built with 🦷 for better dental healthcare**