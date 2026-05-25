<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Game;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $categories = Category::all();
        $games = Game::with('category')->latest()->paginate(5);
        $tickets = Ticket::with('user')->latest()->get();
        $orders = Order::with('user', 'items')->latest()->paginate(15);
        $users = User::withCount('orders')->latest()->paginate(15);

        return view('admin.dashboard', compact('categories', 'games', 'tickets', 'orders', 'users'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => str()->slug($request->name),
        ]);

        return back()->with('success', 'Категория добавлена');
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();

        return back()->with('success', 'Категория удалена');
    }

    public function storeGame(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = $request->file('image')?->store('games', 'public');

        Game::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'category_id' => $request->category_id,
            'image' => $path,
        ]);

        return back()->with('success', 'Игра добавлена');
    }

    public function editGame(Game $game)
    {
        $categories = Category::all();
        return view('admin.edit-game', compact('game', 'categories'));
    }

    public function updateGame(Request $request, Game $game)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = $game->image;

        if ($request->hasFile('image')) {
            if ($game->image) {
                Storage::disk('public')->delete($game->image);
            }
            $path = $request->file('image')->store('games', 'public');
        }

        $game->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'category_id' => $request->category_id,
            'image' => $path,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Игра обновлена');
    }

    public function deleteGame(Game $game)
    {
        if ($game->image) {
            Storage::disk('public')->delete($game->image);
        }

        $game->delete();

        return back()->with('success', 'Игра удалена');
    }
    
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:created,processing,paid,completed,cancelled'
        ]);
        
        $order->update(['status' => $request->status]);
        
        $statusText = [
            'created' => 'Новый',
            'processing' => 'В обработке',
            'paid' => 'Оплачен',
            'completed' => 'Выполнен',
            'cancelled' => 'Отменен'
        ];
        
        return back()->with('success', 'Статус заказа #' . $order->id . ' изменен на "' . $statusText[$request->status] . '"');
    }
    
    public function getOrderDetails(Order $order)
    {
        $statusMap = [
            'created' => '🟡 Новый',
            'processing' => '🔄 В обработке',
            'paid' => '✅ Оплачен',
            'completed' => '✔️ Выполнен',
            'cancelled' => '❌ Отменен',
        ];
        
        $paymentMap = [
            'card' => 'Банковская карта',
            'crypto' => 'Криптовалюта',
            'sbp' => 'СБП',
        ];
        
        return response()->json([
            'id' => $order->id,
            'user_name' => $order->user->name ?? $order->user->email,
            'steam_login' => $order->steam_login ?? '—',
            'payment_method' => $paymentMap[$order->payment_method] ?? $order->payment_method ?? '—',
            'created_at' => $order->created_at->format('d.m.Y H:i'),
            'status' => $order->status,
            'status_text' => $statusMap[$order->status] ?? $order->status,
            'total_amount' => number_format($order->total_amount, 2),
            'items' => $order->items->map(function($item) {
                return [
                    'title' => $item->title,
                    'price' => number_format($item->price, 2),
                    'quantity' => $item->quantity,
                    'sum' => number_format($item->sum, 2),
                ];
            })
        ]);
    }
    
    public function banUser(User $user)
    {
        if (isset($user->is_admin) && $user->is_admin) {
            return back()->with('error', 'Нельзя заблокировать администратора');
        }
        
        $user->update(['is_banned' => true]);
        
        return back()->with('success', 'Пользователь ' . ($user->name ?? $user->email) . ' заблокирован');
    }
    
    public function unbanUser(User $user)
    {
        $user->update(['is_banned' => false]);
        
        return back()->with('success', 'Пользователь ' . ($user->name ?? $user->email) . ' разблокирован');
    }
}