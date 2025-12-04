<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show()
    {
        return view('payment.show');
    }

    public function process(Request $request)
    {
        $request->validate([
            'method' => 'required',
        ]);

        $method = $request->input('method');
        
        return redirect()->route('cart.index')->with('success', "Оплата через {$method} успешно совершена!");
    }
}
