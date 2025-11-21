<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $items = $cart->items()->with('game')->get();

        $total = $items->sum(fn($item) => ($item->game->discount_price ?? $item->game->price) * $item->quantity);

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Game $game)
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $item = $cart->items()->where('game_id', $game->id)->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            $cart->items()->create(['game_id' => $game->id, 'quantity' => 1]);
        }

        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }

    public function remove(CartItem $item)
    {
        $item->delete();
        return redirect()->route('cart.index')->with('success', 'Товар удалён');
    }

    public function clear()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->items()->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Корзина очищена');
    }
}
