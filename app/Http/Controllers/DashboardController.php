<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Example Eloquent queries (adjust to your models/relationships)
        $totalComplaints = $user->complaints()->count();
        $pendingComplaints = $user->complaints()->where('status', 'pending')->count();
        $resolvedComplaints = $user->complaints()->where('status', 'resolved')->count();
        $feedbackCount = $user->feedbacks()->count();

        $recentActivities = $user->activities()->latest()->take(10)->get();

        return view('User.dashboard', compact(
            'totalComplaints',
            'pendingComplaints',
            'resolvedComplaints',
            'feedbackCount',
            'recentActivities'
        ));
    }

    public function stats()
    {
        $user = Auth::user();

        $total = Complaint::where('user_id', $user->id)->count();
        $pending = Complaint::where('user_id', $user->id)->where('status', 'pending')->count();
        $resolved = Complaint::where('user_id', $user->id)->where('status', 'resolved')->count();
        $feedback = Complaint::where('user_id', $user->id)->whereNotNull('feedback')->count();

        return response()->json([
            'total_complaints' => $total,
            'pending_complaints' => $pending,
            'resolved_complaints' => $resolved,
            'feedback_count' => $feedback,
        ]);
    }

    public function activities()
    {
        $user = Auth::user();

        $complaints = Complaint::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($complaint) {
                return [
                    'id' => $complaint->id,
                    'category' => $complaint->category,
                    'subject' => $complaint->subject,
                    'urgency' => $complaint->urgency,
                    'status' => $complaint->status,
                    'date' => $complaint->created_at->toDateString(),
                ];
            });

        return response()->json($complaints);
    }
}
