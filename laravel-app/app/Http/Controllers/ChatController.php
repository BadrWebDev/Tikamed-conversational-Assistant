<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat.index');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        try {
            // Use 45 second timeout (gives backend 30s + 15s buffer)
            $response = Http::timeout(45)->post('http://127.0.0.1:8000/api/v1/chat', [
                'message' => $request->message,
                'conversation_id' => session()->getId()
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json([
                'error' => 'Failed to get response from AI service'
            ], 500);

        } catch (\Exception $e) {
            Log::error('Chat API Error: ' . $e->getMessage());

            return response()->json([
                'error' => 'Error connecting to AI service: ' . $e->getMessage()
            ], 500);
        }
    }
}