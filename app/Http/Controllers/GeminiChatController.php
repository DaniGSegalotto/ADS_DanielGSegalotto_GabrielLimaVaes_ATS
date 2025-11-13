<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeminiChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        // 1️⃣ Recupera o histórico da conversa salvo na sessão
        $conversation = session('conversation', []);

        // Adiciona a nova mensagem do usuário
        $conversation[] = [
            'role' => 'user',
            'parts' => [['text' => $message]],
        ];

        try {
            // 2️⃣ Faz a requisição para a API do Gemini
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key=AIzaSyBI2-92R3l9pJXxuBWiYe53rC0j2xviopc', [
                'contents' => $conversation, // envia todo o histórico
                'system_instruction' => [
                    'parts' => [[
                        'text' => "
Você é um assistente automotivo inteligente chamado **Assistente Razera**.

Seu papel é conversar naturalmente com o usuário para entender:
- O tipo de uso do carro (cidade, estrada ou misto)
- O orçamento aproximado
- O número de pessoas ou bagagem
- O estilo desejado (econômico, confortável, potente, moderno etc.)

Regras:
- Fale como uma pessoa real, de forma leve e direta.
- Faça perguntas de acordo com as respostas anteriores.
- Não repita perguntas nem reinicie a conversa.
- Use frases curtas (até 2 por vez).
- Assim que tiver informações suficientes, recomende um tipo de veículo e explique o motivo.
- Use emojis leves quando fizer sentido (🚗😉💬).
"
                    ]]
                ]
            ]);

            // 3️⃣ Processa a resposta do modelo
            $data = $response->json();
            $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Desculpe, não consegui entender.';

            // 4️⃣ Salva a resposta do modelo no histórico
            $conversation[] = [
                'role' => 'model',
                'parts' => [['text' => $reply]],
            ];

            // Atualiza o histórico na sessão
            session(['conversation' => $conversation]);

            // 5️⃣ Retorna a resposta para o front-end
            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            return response()->json([
                'reply' => 'Erro ao conectar com o servidor 😔',
                'error' => $e->getMessage(),
            ]);
        }
    }

    // 6️⃣ (Opcional) Endpoint para resetar a conversa
    public function resetConversation()
    {
        session()->forget('conversation');
        return response()->json(['status' => 'ok']);
    }
}
