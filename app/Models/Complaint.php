<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'subject',
        'category',
        'location',
        'date',
        'description',
        'suggested_solution',
        'urgency',
        'attachment',
        'is_anonymous',
        'user_id',
        'status',
        'priority',
    ];

    public function user()
    {
        // Link complaints.user_id (matric_no) to users.matric_no
        return $this->belongsTo(User::class, 'user_id', 'matric_no');
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class, 'complaint_id');
    }

}
