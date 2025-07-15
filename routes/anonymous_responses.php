<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicResponseController;

// ...existing code...

// Public page for anonymous complaint responses
Route::get('/anonymous-responses', [PublicResponseController::class, 'index'])->name('public.responses');
