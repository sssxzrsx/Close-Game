<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $orders = $user->orders()
            ->latest()
            ->paginate(10);

        return view('profile.index', compact('user', 'orders'));
    }
}