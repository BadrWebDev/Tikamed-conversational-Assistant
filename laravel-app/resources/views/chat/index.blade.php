<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tikamed - AI Assistant</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
    
    <!-- Hero Section -->
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 py-6">
                <h1 class="text-3xl font-bold text-gray-900">Tikamed Digital Solutions</h1>
                <p class="text-gray-600 mt-2">Premium Dental Implant Products</p>
            </div>
        </header>

        <main class="flex-1 max-w-7xl mx-auto px-4 py-12">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    Welcome to Tikamed
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Explore our comprehensive range of dental implant solutions. 
                    Need help? Chat with our AI assistant below!
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-3 gap-8 mb-16">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-blue-600 text-3xl mb-4">🦷</div>
                    <h3 class="text-xl font-semibold mb-2">Bone Level Implants</h3>
                    <p class="text-gray-600">Premium quality implants for optimal osseointegration</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-blue-600 text-3xl mb-4">🔧</div>
                    <h3 class="text-xl font-semibold mb-2">Prosthetic Solutions</h3>
                    <p class="text-gray-600">Complete range of abutments and components</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-blue-600 text-3xl mb-4">💬</div>
                    <h3 class="text-xl font-semibold mb-2">Expert Support</h3>
                    <p class="text-gray-600">24/7 AI-powered product assistance</p>
                </div>
            </div>
        </main>
    </div>

    <!-- Chat Widget -->
    <div x-data="chatWidget()" class="fixed bottom-6 right-6 z-50">
        
        <!-- Chat Toggle Button -->
        <button 
            @click="toggleChat()"
            x-show="!isOpen"
            class="bg-blue-600 hover:bg-blue-700 text-white rounded-full p-4 shadow-lg transition-all duration-300 flex items-center gap-2"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            <span class="font-medium">Chat with AI</span>
        </button>

        <!-- Chat Window -->
        <div 
            x-show="isOpen"
            x-transition
            class="bg-white rounded-lg shadow-2xl w-96 h-[600px] flex flex-col"
        >
            <!-- Header -->
            <div class="bg-blue-600 text-white p-4 rounded-t-lg flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-lg">Tikamed Assistant</h3>
                    <p class="text-sm text-blue-100">Ask me anything!</p>
                </div>
                <button @click="toggleChat()" class="hover:bg-blue-700 rounded p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Messages Container -->
            <div 
                x-ref="messagesContainer"
                class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50"
            >
                <!-- Welcome Message -->
                <div class="flex gap-3">
                    <div class="bg-blue-100 rounded-full h-8 w-8 flex items-center justify-center flex-shrink-0">
                        🤖
                    </div>
                    <div class="bg-white rounded-lg p-3 shadow-sm max-w-[80%]">
                        <p class="text-sm text-gray-800">
                            Hello! I'm your Tikamed assistant. Ask me about our dental implant products, prosthetic solutions, or any technical specifications!
                        </p>
                    </div>
                </div>

                <!-- Messages Loop -->
                <template x-for="(msg, index) in messages" :key="index">
                    <div :class="msg.isUser ? 'flex gap-3 justify-end' : 'flex gap-3'">
                        <!-- Bot Avatar -->
                        <div x-show="!msg.isUser" class="bg-blue-100 rounded-full h-8 w-8 flex items-center justify-center flex-shrink-0">
                            🤖
                        </div>

                        <!-- Message Bubble -->
                        <div :class="msg.isUser ? 'bg-blue-600 text-white' : 'bg-white'" class="rounded-lg p-3 shadow-sm max-w-[80%]">
                            <p class="text-sm whitespace-pre-wrap" :class="msg.isUser ? 'text-white' : 'text-gray-800'" x-text="msg.text"></p>
                            
                            <!-- Response Type Badge -->
                            <span x-show="!msg.isUser && msg.type" 
                                  :class="{
                                      'bg-green-100 text-green-800': msg.type === 'faq',
                                      'bg-purple-100 text-purple-800': msg.type === 'rag',
                                      'bg-orange-100 text-orange-800': msg.type === 'web_search',
                                      'bg-gray-100 text-gray-800': msg.type === 'fallback'
                                  }"
                                  class="text-xs px-2 py-1 rounded-full mt-2 inline-block"
                                  x-text="msg.type.toUpperCase()">
                            </span>

                            <!-- Sources (if RAG response) -->
                            <div x-show="!msg.isUser && msg.sources && msg.sources.length > 0" class="mt-3 pt-3 border-t border-gray-200">
                                <p class="text-xs text-gray-600 font-semibold mb-2">📚 Sources from catalog:</p>
                                <template x-for="(source, idx) in msg.sources" :key="idx">
                                    <div class="text-xs bg-gray-50 p-2 rounded mb-2">
                                        <p class="text-gray-700" x-text="source.content.substring(0, 150) + '...'"></p>
                                        <p class="text-gray-500 text-xs mt-1">Relevance: <span x-text="(1 - source.score).toFixed(2)"></span></p>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- User Avatar -->
                        <div x-show="msg.isUser" class="bg-blue-600 rounded-full h-8 w-8 flex items-center justify-center flex-shrink-0 text-white">
                            👤
                        </div>
                    </div>
                </template>

                <!-- Loading Indicator -->
                <div x-show="isLoading" class="flex gap-3">
                    <div class="bg-blue-100 rounded-full h-8 w-8 flex items-center justify-center flex-shrink-0">
                        🤖
                    </div>
                    <div class="bg-white rounded-lg p-3 shadow-sm">
                        <div class="flex gap-1">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input Area -->
            <div class="p-4 border-t">
                <form @submit.prevent="sendMessage()" class="flex gap-2">
                    <input 
                        type="text"
                        x-model="currentMessage"
                        placeholder="Ask about our products..."
                        class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 text-sm"
                        :disabled="isLoading"
                    >
                    <button 
                        type="submit"
                        :disabled="isLoading || !currentMessage.trim()"
                        class="bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white px-4 py-2 rounded-lg transition-colors"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function chatWidget() {
            return {
                isOpen: false,
                isLoading: false,
                currentMessage: '',
                messages: [],

                toggleChat() {
                    this.isOpen = !this.isOpen;
                    if (this.isOpen) {
                        this.$nextTick(() => this.scrollToBottom());
                    }
                },

                async sendMessage() {
                    if (!this.currentMessage.trim()) return;

                    // Add user message
                    this.messages.push({
                        text: this.currentMessage,
                        isUser: true
                    });

                    const userMessage = this.currentMessage;
                    this.currentMessage = '';
                    this.isLoading = true;
                    this.scrollToBottom();

                    try {
                        const response = await fetch('/chat', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ message: userMessage })
                        });

                        const data = await response.json();

                        if (response.ok) {
                            this.messages.push({
                                text: data.answer,
                                isUser: false,
                                type: data.response_type,
                                sources: data.sources || []
                            });
                        } else {
                            this.messages.push({
                                text: '❌ ' + (data.error || 'Something went wrong'),
                                isUser: false,
                                type: 'error'
                            });
                        }
                    } catch (error) {
                        console.error('Chat error:', error);
                        this.messages.push({
                            text: '❌ Network error. Is the AI service running?',
                            isUser: false,
                            type: 'error'
                        });
                    } finally {
                        this.isLoading = false;
                        this.scrollToBottom();
                    }
                },

                scrollToBottom() {
                    this.$nextTick(() => {
                        const container = this.$refs.messagesContainer;
                        if (container) {
                            container.scrollTop = container.scrollHeight;
                        }
                    });
                }
            }
        }
    </script>
</body>
</html>