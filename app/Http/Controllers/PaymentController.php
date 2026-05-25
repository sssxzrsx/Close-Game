<?php
// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('items.game')->first();
        
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }
        
        return view('payment.show', compact('cart'));
    }
    
    public function process(Request $request)
    {
        $request->validate([
            'method' => 'required|in:card,crypto,sbp',
            'steam_login' => 'required|string|min:3|max:255',
        ], [
            'method.required' => 'Выберите способ оплаты',
            'steam_login.required' => 'Укажите ваш Steam логин',
            'steam_login.min' => 'Steam логин должен быть минимум 3 символа',
        ]);
        
        try {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->with('items.game')->first();
            
            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Корзина пуста');
            }

            $totalAmount = 0;
            foreach ($cart->items as $item) {
                $price = $item->game->discount_price ?? $item->game->price;
                $totalAmount += $price * ($item->quantity ?? 1);
            }
            
            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'created',
                'total_amount' => $totalAmount,
                'payment_method' => $request->method,
                'steam_login' => $request->steam_login,
            ]);
            
            foreach ($cart->items as $item) {
                $price = $item->game->discount_price ?? $item->game->price;
                $order->items()->create([
                    'game_id' => $item->game_id,
                    'title' => $item->game->title,
                    'price' => $price,
                    'quantity' => $item->quantity ?? 1,
                    'sum' => $price * ($item->quantity ?? 1),
                ]);
            }
            
            $cart->items()->delete();
            $cart->delete();
            
            return redirect()->route('profile')->with('success', 'Заказ успешно создан! Ожидайте подтверждения.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Ошибка при создании заказа: ' . $e->getMessage())->withInput();
        }
    }
}