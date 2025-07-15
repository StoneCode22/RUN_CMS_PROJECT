<?php

namespace App\Models;

// Import necessary Laravel classes for user authentication and notifications
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Complaint;

// The User model represents a user in your application.
// It extends Authenticatable so it can be used for authentication (login/logout).
class User extends Authenticatable
{
    // Use these traits to add extra features:
    // - HasFactory: allows you to create user records easily for testing
    // - Notifiable: allows the user to receive notifications (like email)
    use HasFactory, Notifiable;

    // The $fillable array lists the fields that can be mass-assigned.
    // This means you can create or update a user with these fields using an array.
    protected $fillable = [
        'name',        // The user's name
        'matric_no',   // The user's matriculation number (used as username)
        'phone',       // The user's phone number
        'department',  // The user's department
        'email',       // The user's email address (optional)
        'password',    // The user's password (should be hashed)
        'status',      // The user's status (active/inactive)
        'role',        // The user's role (student/staff/admin)
    ];

    // The $hidden array lists fields that should NOT be visible when
    // the user model is converted to an array or JSON (for security).
    protected $hidden = [
        'password',        // Hide the password
        'remember_token',  // Hide the remember token (used for "remember me" login)
    ];

    // This method tells Laravel to use 'matric_no' as the unique identifier
    // for authentication instead of the default 'email' field.
    public function getAuthIdentifierName()
{
    return 'matric_no';
}

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

}
