<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ComplaintController extends Controller
{
    // Show complaint detail
    public function show($id)
    {
        $matricNo = Auth::user()->matric_no;
        $complaint = Complaint::with(['user', 'comments.user'])
            ->where('id', $id)
            ->where('user_id', $matricNo)
            ->first();
        if (!$complaint) {
            abort(403, 'Unauthorized or complaint not found.');
        }
        return view('User.complaint-detail', compact('complaint'));
    }

    // Add a comment to a complaint
    public function comment(Request $request, $id)
    {
        $request->validate(['content' => 'required|string']);
        $complaint = Complaint::findOrFail($id);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->complaint_id = $complaint->id;
        $comment->content = $request->content;
        if ($request->hasFile('attachment')) {
            $comment->attachment = $request->file('attachment')->store('attachments');
        }
        $comment->save();

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }

    // Escalate a complaint
    public function escalate(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string',
            'level' => 'required|string',
        ]);
        $complaint = Complaint::findOrFail($id);
        $complaint->status = 'escalated';
        $complaint->escalation_reason = $request->reason;
        $complaint->escalation_level = $request->level;
        $complaint->save();

        // Optionally add to timeline...

        return redirect()->back()->with('success', 'Complaint escalated successfully.');
    }

    // Mark complaint as resolved
    public function resolve(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->status = 'resolved';
        $complaint->save();

        // Optionally add to timeline...

        return redirect()->back()->with('success', 'Complaint marked as resolved.');
    }

    // Show the edit form
    public function edit($id)
    {
        $complaint = Complaint::findOrFail($id);
        return view('User.edit-complaint', compact('complaint'));
    }

    // Update the complaint
    public function update(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->update($request->all());
        return redirect()->route('user.complaint-detail', ['id' => $id])->with('success', 'Complaint updated successfully.');
    }

    // Delete the complaint
    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();
        return redirect()->route('user.view-complaints')->with('success', 'Complaint deleted successfully.');
    }

    // Store a new complaint
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'description' => 'required|string',
            'suggested_solution' => 'nullable|string',
            'urgency' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,png,pdf|max:5120',
            'anonymous' => 'required|boolean',
            'terms' => 'accepted',
        ]);

        $isAnonymous = $request->input('anonymous') == 1;

        $complaint = new Complaint($validated);
        $complaint->is_anonymous = $isAnonymous;
        $complaint->user_id = $isAnonymous ? null : Auth::id();

        // Handle file upload if needed
        if ($request->hasFile('attachment')) {
            $complaint->attachment = $request->file('attachment')->store('attachments', 'public');
        }

        $complaint->save();

        if ($isAnonymous) {
            session()->push('anonymous_complaints', $complaint->id);
        }

        // Send confirmation email to user (if not anonymous)
        if (!$isAnonymous && $complaint->user_id) {
            $user = \App\Models\User::find($complaint->user_id);
            if ($user && $user->email) {
                \Mail::to($user->email)->send(new \App\Mail\ComplaintReceived($complaint));
            }
        }

        return redirect()->route('user.submit')->with('success', 'Complaint submitted successfully!');
    }

    // Create a new complaint
    public function create()
    {
        $anonymousIds = session('anonymous_complaints', []);
        $complaints = Complaint::where(function($query) use ($anonymousIds) {
                $query->where('user_id', Auth::id());
                if (!empty($anonymousIds)) {
                    $query->orWhereIn('id', $anonymousIds);
                }
            })
            ->latest()
            ->take(2)
            ->get();
        return view('User.submit', compact('complaints'));
    }

    public function index()
    {
        $complaints = Complaint::where('user_id', Auth::id())->latest()->get();
        return view('User.submit', compact('complaints'));
    }

    public function showComplaints()
    {
        $complaints = Complaint::all(); // or whatever logic you use
        return view('your_view_name', compact('complaints'));
    }

    public function list(Request $request)
    {
        $userId = Auth::id();
        $query = Complaint::where('user_id', $userId);

        // Filtering by status
        if ($request->status && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('subject', 'like', "%$search%")
                  ->orWhere('category', 'like', "%$search%");
            });
        }

        // Date filter (optional, implement if needed)
        if ($request->date && $request->date !== 'all') {
            $now = now();
            switch ($request->date) {
                case 'today':
                    $query->whereDate('created_at', $now->toDateString());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year);
                    break;
                case 'year':
                    $query->whereYear('created_at', $now->year);
                    break;
            }
        }

        $complaints = $query->orderBy('created_at', 'desc')->paginate(5);

        return response()->json($complaints);
    }
}
