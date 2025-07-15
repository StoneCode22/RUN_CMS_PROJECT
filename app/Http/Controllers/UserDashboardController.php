<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Models\Feedback;

class UserDashboardController extends Controller
{
    public function stats()
    {
        $matricNo = Auth::user()->matric_no;

        $total_complaints = Complaint::where('user_id', $matricNo)->count();
        $pending_complaints = Complaint::where('user_id', $matricNo)->where('status', 'processing')->count();
        $resolved_complaints = Complaint::where('user_id', $matricNo)->where('status', 'resolved')->count();
        $rejected_complaints = Complaint::where('user_id', $matricNo)->where('status', 'rejected')->count();

        return response()->json([
            'total_complaints' => $total_complaints,
            'pending_complaints' => $pending_complaints,
            'resolved_complaints' => $resolved_complaints,
            'rejected_complaints' => $rejected_complaints,
        ]);
    }

    public function activities()
    {
        $matricNo = Auth::user()->matric_no;

        $activities = Complaint::where('user_id', $matricNo)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($c) {
                return [
                    'id' => $c->id,
                    'type' => 'Complaint',
                    'title' => $c->subject, // Use 'subject' for the title
                    'status' => $c->status,
                    'date' => $c->created_at->toDateTimeString(),
                ];
            });

        return response()->json($activities);
    }
}

