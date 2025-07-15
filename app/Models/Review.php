<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'complaint_id',
        'user_id',
        'rating',
        'title',
        'description',
        'category',
        'status',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
