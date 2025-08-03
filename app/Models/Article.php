<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // Enable factory functionality for creating test data
    use HasFactory;
    
    // Fields that can be mass assigned (filled from forms)
    protected $fillable = ['title', 'body', 'user_id'];

    // Relationship: Each article belongs to one user (author)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
