<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'due_at',
        'user_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
    'due_at' => 'datetime',
    ];
}
