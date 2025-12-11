<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SubscriberController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $email = strtolower(trim($request->email));

        // Проверяем, не подписан ли уже
        $existing = Subscriber::where('email', $email)->first();
        
        if ($existing) {
            return response()->json([
                'success' => true,
                'message' => 'Вы уже подписаны на уведомления о запуске!',
                'already_subscribed' => true,
            ]);
        }

        // Создаём новую подписку
        Subscriber::create([
            'email' => $email,
            'ip_address' => $request->ip(),
            'source' => $request->input('source', 'website'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Спасибо! Мы сообщим вам о запуске проекта.',
            'already_subscribed' => false,
        ]);
    }
}

