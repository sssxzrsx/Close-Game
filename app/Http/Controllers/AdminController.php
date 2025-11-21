<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Game;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $games = Game::with('category')->latest()->get();
        $categories = Category::all();
        return view('admin.dashboard', compact('games', 'categories'));
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

    public function deleteGame(Game $game)
    {
        if ($game->image) {
            Storage::disk('public')->delete($game->image);
        }
        $game->delete();
        return back()->with('success', 'Игра удалена');
    }
}
