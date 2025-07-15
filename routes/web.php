<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Mail;

// This file defines all the web routes for the Laravel application.
// Each route tells Laravel what to do when a user visits a specific URL.

// The default home route ("/") redirects users to the login page.
Route::get('/', function () {
    return redirect()->route('login');
});

// =====================
// AUTHENTICATION ROUTES
// =====================

// Show the login form when visiting "/login"
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Show the registration form when visiting "/register"
// (You are using the same form for both login and register)
Route::get('/register', [LoginController::class, 'showLoginForm'])->name('register');

// Handle login form submission (POST request to "/login")
Route::post('/login', [LoginController::class, 'login']);

// Handle registration form submission (POST request to "/register")
Route::post('/register', [LoginController::class, 'register']);

// Handle logout (POST request to "/logout")
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// =====================
// ADMIN ROUTES
// =====================
// All admin routes are grouped under the "/admin" URL prefix.
// Example: "/admin/dashboard", "/admin/feedback", etc.
Route::prefix('admin')->group(function () {
    // Show the admin login form

    // Show the admin login form
    Route::get('login', [\App\Http\Controllers\AdminLoginController::class, 'showLoginForm'])->name('admin.login');

    // Handle admin login POST
    Route::post('login', [\App\Http\Controllers\AdminLoginController::class, 'login'])->name('admin.login.submit');

    // Handle admin logout
    Route::post('logout', [\App\Http\Controllers\AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        // Quick Actions: Generate Report and Export Data
        Route::get('/generate-report', [AdminController::class, 'generateReport']);
        Route::get('/export-data', [AdminController::class, 'exportData']);
        // Admin dashboard page
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Admin complaint management page
        Route::get('/complaint-management', function () {
            return view('admin.complaint-management');

        })->name('admin.complaint-management');

        // API: Get all complaints as JSON for admin view
        Route::get('/complaints', function () {
            $complaints = \App\Models\Complaint::with('user')->orderBy('created_at', 'desc')->get()->map(function ($complaint) {
                $matricNo = ($complaint->user && $complaint->user->matric_no) ? $complaint->user->matric_no : null;
                return [
                    'id' => $complaint->id,
                    'student' => $matricNo ? $matricNo : 'Anonymous',
                    'email' => $complaint->user ? $complaint->user->email : 'N/A',
                    'category' => $complaint->category,
                    'subject' => $complaint->subject,
                    'status' => $complaint->status ?? 'pending',
                    'priority' => $complaint->priority ?? 'medium',
                    'date' => $complaint->created_at ? $complaint->created_at->format('Y-m-d H:i:s') : '',
                    'description' => $complaint->description,
                    'suggested_solution' => $complaint->suggested_solution,
                ];
            });
            return response()->json($complaints);
        });

        // API: Get a single complaint by ID as JSON for admin view (for modal)
        Route::get('/complaints/{id}', function ($id) {
            $complaint = \App\Models\Complaint::with('user')->findOrFail($id);
            $matricNo = ($complaint->user && $complaint->user->matric_no) ? $complaint->user->matric_no : null;
            return response()->json([
                'id' => $complaint->id,
                'student' => $matricNo ? $matricNo : 'Anonymous',
                'email' => $complaint->user ? $complaint->user->email : 'N/A',
                'category' => $complaint->category,
                'subject' => $complaint->subject,
                'status' => $complaint->status ?? 'pending',
                'priority' => $complaint->priority ?? 'medium',
                'date' => $complaint->created_at ? $complaint->created_at->format('Y-m-d H:i:s') : '',
                'description' => $complaint->description,
                'suggested_solution' => $complaint->suggested_solution,
            ]);
        });

        // API: Update complaint status
        Route::post('/complaints/{id}/update', function (\Illuminate\Http\Request $request, $id) {
            $complaint = \App\Models\Complaint::findOrFail($id);
            $complaint->status = $request->input('status');
            $complaint->save();
            return response()->json(['success' => true]);
        });

        // Admin feedback page
        Route::get('/feedback', function () {
            $reviews = \App\Models\Review::with('user')->orderBy('created_at', 'desc')->get();
            $totalFeedback = \App\Models\Review::count();
            $avgRating = \App\Models\Review::avg('rating') ?? 0;
            $pendingReview = \App\Models\Review::where('status', 'pending')->count();
            $thisMonth = \App\Models\Review::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
            return view('admin.feedback', compact('reviews', 'totalFeedback', 'avgRating', 'pendingReview', 'thisMonth'));
        })->name('admin.feedback');

        // Admin settings page
        Route::get('/settings', function () {
            return view('admin.settings');
        })->name('admin.settings');

        // Admin users management page
        Route::get('/users', function () {
            return view('admin.users');
        })->name('admin.users');

        // API: Get all users as JSON (for dashboard stats)
        Route::get('/users-list', function () {
            $users = \App\Models\User::all(['id', 'name', 'email', 'matric_no', 'phone', 'department', 'role', 'status', 'created_at']);
            // Split name into first and last name for frontend, and ensure phone is present
            $users = $users->map(function($u) {
                $names = explode(' ', $u->name);
                $u->first_name = $names[0] ?? '';
                $u->last_name = $names[1] ?? '';
                $u->phone = $u->phone ?? '';
                return $u;
            });
            return response()->json($users);
        });

        // API: Delete user by ID
        Route::delete('/delete-user/{id}', function ($id) {
            $user = \App\Models\User::find($id);
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
            $user->delete();
            return response()->json(['success' => true]);
        });
        // API: Toggle user status (active/inactive)
        Route::patch('/toggle-user-status/{id}', function (\Illuminate\Http\Request $request, $id) {
            $user = \App\Models\User::find($id);
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
            $status = $request->input('status');
            if (!in_array($status, ['active', 'inactive'])) {
                return response()->json(['error' => 'Invalid status'], 400);
            }
            $user->status = $status;
            $user->save();
            return response()->json(['success' => true, 'status' => $user->status]);
        });
        // API: Update user details
        Route::put('/update-user/{id}', function (\Illuminate\Http\Request $request, $id) {
            $user = \App\Models\User::find($id);
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
            // Update name from first_name and last_name
            $firstName = $request->input('first_name');
            $lastName = $request->input('last_name');
            if ($firstName !== null && $lastName !== null) {
                $user->name = trim($firstName . ' ' . $lastName);
            }
            $user->email = $request->input('email', $user->email);
            $user->matric_no = $request->input('user_id', $user->matric_no);
            $user->phone = $request->input('phone', $user->phone);
            $user->role = $request->input('role', $user->role);
            $user->status = $request->input('status', $user->status);
            $user->department = $request->input('department', $user->department);
            if ($request->filled('password')) {
                $user->password = bcrypt($request->input('password'));
            }
            $user->save();
            return response()->json($user);
        });
        // API: Delete review by ID (moved inside admin group)
        Route::delete('/reviews/{id}', function ($id) {
            $review = \App\Models\Review::find($id);
            if (!$review) {
                return response()->json(['error' => 'Review not found'], 404);
            }
            $review->delete();
            return response()->json(['success' => true]);
        });
        // API: Mark review as reviewed
        Route::patch('/reviews/{id}/mark-reviewed', function ($id) {
            $review = \App\Models\Review::find($id);
            if (!$review) {
                return response()->json(['error' => 'Review not found'], 404);
            }
            $review->status = 'reviewed';
            $review->save();
            return response()->json(['success' => true]);
        });
    });
});

// =====================
// USER ROUTES
// =====================
// All user routes are grouped under the "/user" URL prefix.
// These routes are protected by the "auth" middleware, so only logged-in users can access them.
Route::prefix('user')->middleware('auth')->group(function () {
    // Welcome page for users
    Route::get('welcome', function () {
        return view('User.welcome');
    })->name('user.welcome');

    // User dashboard page
    Route::get('dashboard', function () {
        return view('User.dashboard');
    })->name('user.dashboard');

    // Complaint detail page (uses controller to pass $complaint)
    Route::get('complaint-detail/{id}', [App\Http\Controllers\ComplaintController::class, 'show'])->name('user.complaint-detail');

    // View all complaints page
    Route::get('view-complaints', [\App\Http\Controllers\User\ComplaintController::class, 'viewComplaints'])->name('user.view-complaints');

    // Feedback page
    Route::get('feedback', function () {
        return view('User.feedback');
    })->name('user.feedback');

    // Reviews page
    Route::get('reviews/{complaint_id}', function ($complaint_id) {
        return view('User.reviews', compact('complaint_id'));
    })->name('user.reviews');

    // Submit new complaint page (FIXED)
    Route::get('submit', [App\Http\Controllers\ComplaintController::class, 'create'])->name('user.submit');

    // Profile settings page
    Route::get('profile-settings', function () {
        return view('User.profile-settings');
    })->name('user.profile-settings');

    // Complaint actions for authenticated users

    // Submit review for a complaint
    Route::post('submit-review', [\App\Http\Controllers\ReviewController::class, 'submit'])->name('user.submit-review');
    // Post a comment
    Route::post('complaint-detail/{id}/comment', [App\Http\Controllers\ComplaintController::class, 'comment'])->name('complaint.comment');

    // Escalate complaint
    Route::post('complaint-detail/{id}/escalate', [App\Http\Controllers\ComplaintController::class, 'escalate'])->name('complaint.escalate');

    // Mark as resolved
    Route::post('complaint-detail/{id}/resolve', [App\Http\Controllers\ComplaintController::class, 'resolve'])->name('complaint.resolve');

    // Update complaint (show form and submit update)
    Route::get('complaint-detail/{id}/edit', [App\Http\Controllers\ComplaintController::class, 'edit'])->name('complaint.edit');
    Route::post('complaint-detail/{id}/update', [App\Http\Controllers\ComplaintController::class, 'update'])->name('complaint.update');

    // Delete complaint
    Route::delete('complaint-detail/{id}/delete', [App\Http\Controllers\ComplaintController::class, 'destroy'])->name('complaint.delete');

    // User dashboard statistics
    Route::get('dashboard/stats', [UserDashboardController::class, 'stats'])->name('api.user.dashboard.stats');
    Route::get('dashboard/activities', [App\Http\Controllers\UserDashboardController::class, 'activities'])->name('api.user.dashboard.activities');

    Route::get('complaints/list', [App\Http\Controllers\ComplaintController::class, 'list'])->name('user.complaints.list');
});

// =====================
// FALLBACK ROUTE
// =====================
// If a user visits a URL that doesn't match any of the routes above,
// Public page for anonymous complaint responses
use App\Http\Controllers\PublicResponseController;
Route::get('/anonymous-responses', [PublicResponseController::class, 'index'])->name('public.responses');
// show the login page with a 404 (not found) status.
Route::fallback(function () {
    return redirect()->route('login');
});


Route::middleware(['auth'])->group(function () {
    Route::post('/user/complaints/store', [ComplaintController::class, 'store'])->name('user.complaints.store');
});

// Test route to send a test email using Gmail SMTP
Route::get('/test-email', function () {
    Mail::raw('Testing email from Laravel using Gmail SMTP.', function ($message) {
        $message->to(Auth::user()->email)
                ->subject('Laravel Gmail SMTP Test');
    });
    return "Email sent to " . Auth::user()->email . "!";
});
