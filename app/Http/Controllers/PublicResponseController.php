<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class PublicResponseController extends Controller
{
    public function index()
    {
        // Fetch only anonymous complaints (where user_id is null or is_anonymous is true)
        $anonymousComplaints = Complaint::where(function($query) {
            $query->whereNull('user_id')
                  ->orWhere('is_anonymous', true);
        })->orderByDesc('created_at')->get();

        return view('public_responses', compact('anonymousComplaints'));
    }
}
