<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = ['tweet'];

    public function user()
    {
        // tweet多数：user1
        return $this->belongsTo(User::class);
    }

    // 🔽 追加
    public function liked()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
