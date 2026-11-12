<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $userFeedbacks = collect();
        if ($user) {
            $userFeedbacks = Feedback::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->latest()
                ->get();
        }

        return view('feedback.index', compact('userFeedbacks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'category' => ['required', 'in:' . implode(',', array_keys(Feedback::CATEGORIES))],
            'message' => ['required', 'string', 'min:10'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'category.required' => 'Kategori masukan wajib dipilih.',
            'category.in' => 'Kategori masukan tidak valid.',
            'message.required' => 'Isi pesan kritik / saran wajib diisi.',
            'message.min' => 'Pesan minimal 10 karakter.',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'subject' => Feedback::CATEGORIES[$request->category],
            'category' => $request->category,
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Terima kasih! Kritik & saran Anda telah berhasil dikirim dan tersimpan di database BNN Kota Jakarta Timur. Kami akan membalas melalui email Anda.');
    }
}
