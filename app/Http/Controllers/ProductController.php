<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $query = Game::query()->with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $games = $query->get();

        return view('catalog.index', compact('categories', 'games'));
    }
    public function show(Game $game)
    {
        $related = Game::where('category_id', $game->category_id)
                       ->where('id', '!=', $game->id)
                       ->take(4)
                       ->get();

        return view('catalog.show', compact('game', 'related'));
    }
}
