<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\FeedbackReplyMail;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminFeedbackController extends Controller
{
    public function index(Request $request)
    {
        $this->validateFilters($request);
        $query = $this->filteredQuery($request)->with(['user', 'repliedBy']);

        $feedbacks = $query->latest()->paginate(10)->withQueryString();
        $pendingCount = Feedback::where('status', 'pending')->count();
        $repliedCount = Feedback::where('status', 'replied')->count();

        return view('admin.feedbacks.index', compact('feedbacks', 'pendingCount', 'repliedCount'));
    }

    public function print(Request $request)
    {
        $this->validateFilters($request);
        $feedbacks = $this->filteredQuery($request)->with(['user', 'repliedBy'])->get();

        return view('admin.feedbacks.print', compact('feedbacks'));
    }

    private function validateFilters(Request $request): void
    {
        $request->validate([
            'status' => ['nullable', 'in:pending,replied'],
            'category' => ['nullable', 'in:' . implode(',', array_keys(Feedback::CATEGORIES))],
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date'],
            'q' => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function filteredQuery(Request $request): Builder
    {
        return Feedback::query()
            ->when($request->filled('status'), fn (Builder $query) => $query->where('status', $request->status))
            ->when($request->filled('category'), fn (Builder $query) => $query->where('category', $request->category))
            ->when($request->filled('date_from'), fn (Builder $query) => $query->whereDate('created_at', '>=', $request->date_from))
            ->when($request->filled('date_to'), fn (Builder $query) => $query->whereDate('created_at', '<=', $request->date_to))
            ->when($request->filled('q'), function (Builder $query) use ($request) {
                $keyword = $request->q;
                $query->where(function (Builder $query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%")
                        ->orWhere('subject', 'like', "%{$keyword}%")
                        ->orWhere('message', 'like', "%{$keyword}%");
                });
            });
    }

    public function show(Feedback $feedback)
    {
        $feedback->load(['user', 'repliedBy']);
        return view('admin.feedbacks.show', compact('feedback'));
    }

    public function reply(Request $request, Feedback $feedback)
    {
        $request->validate([
            'reply_message' => ['required', 'string', 'min:5'],
        ], [
            'reply_message.required' => 'Pesan tanggapan / balasan wajib diisi.',
            'reply_message.min' => 'Pesan balasan minimal 5 karakter.',
        ]);

        $replyMessage = $request->reply_message;

        // Update feedback in DB
        $feedback->update([
            'admin_reply' => $replyMessage,
            'status' => 'replied',
            'replied_at' => now(),
            'replied_by' => Auth::id(),
        ]);

        // Send email to the user
        try {
            Mail::to($feedback->email)->send(new FeedbackReplyMail($feedback, $replyMessage));
            $mailSent = true;
        } catch (\Exception $e) {
            Log::error('Error sending feedback reply email: ' . $e->getMessage());
            $mailSent = false;
        }

        $notice = $mailSent
            ? 'Balasan berhasil disimpan dan email telah dikirimkan ke ' . $feedback->email . '.'
            : 'Balasan berhasil disimpan di database (Pengiriman email dicatat di sistem).';

        return redirect()->route('admin.feedbacks.show', $feedback)->with('success', $notice);
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('admin.feedbacks.index')->with('success', 'Kritik & saran berhasil dihapus.');
    }
}
