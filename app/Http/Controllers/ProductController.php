<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Game::with('category');
        
        if ($request->category && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }
        
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        $games = $query->orderBy('id', 'desc')->paginate(12);
        $categories = Category::all();
        
        return view('catalog.index', compact('games', 'categories'));
    }
    
    public function show(Game $game)
    {
        $related = Game::where('category_id', $game->category_id)
            ->where('id', '!=', $game->id)
            ->limit(4)
            ->get();
        
        return view('catalog.show', compact('game', 'related'));
    }
}