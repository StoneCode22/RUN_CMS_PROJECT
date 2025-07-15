<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function viewComplaints()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $complaints = \App\Models\Complaint::where('user_id', $user->matric_no)->orderBy('created_at', 'desc')->get();
        return view('User.view-complaints', compact('complaints'));
    }
}
