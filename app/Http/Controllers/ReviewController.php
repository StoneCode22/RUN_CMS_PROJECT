<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Models\Review;

class ReviewController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'complaint_id' => 'required|exists:complaints,id',
            'rating' => 'required|integer|min:1|max:5',
            'feedbackTitle' => 'required|string|max:255',
            'feedbackDescription' => 'required|string',
        ]);

        $review = new Review();
        $review->complaint_id = $request->complaint_id;
        $review->user_id = Auth::user()->id;
        $review->rating = $request->rating;
        $review->title = $request->feedbackTitle;
        $review->description = $request->feedbackDescription;
        $review->category = $request->category ?? null;
        $review->status = 'unreviewed';
        $review->save();

        return redirect()->route('user.complaint-detail', ['id' => $request->complaint_id])
            ->with('success', 'Review submitted successfully!');
    }
}
