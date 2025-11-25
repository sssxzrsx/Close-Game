<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->latest()->get();
        return view('support.index', compact('tickets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|min:5',
        ]);

        Ticket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Ваше обращение отправлено. Наш менеджер ответит в ближайшее время.');
    }

    public function adminIndex()
    {
        $tickets = Ticket::with('user')->latest()->get();
        return view('admin.tickets', compact('tickets'));
    }

    public function answer(Request $request, Ticket $ticket)
    {
        $request->validate([
            'answer' => 'required|string|min:3',
        ]);

        $ticket->update([
            'answer' => $request->answer,
            'status' => 'answered',
        ]);

        return back()->with('success', 'Ответ отправлен пользователю.');
    }

    public function delete(Ticket $ticket)
{
    if (!$ticket->answer) {
        return back()->with('error', 'Нельзя удалить обращение без ответа.');
    }

    $ticket->delete();
    return back()->with('success', 'Обращение успешно удалено.');
}
}
