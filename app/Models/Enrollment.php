<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
    ];

    // Define the inverse relationship with subjects
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Define the relationship with users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
