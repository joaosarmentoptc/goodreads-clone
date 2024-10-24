<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Book extends Model
{

    use HasFactory;

    protected $fillable = ['title', 'description', 'author', 'isbn'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->belongsToMany(User::class, 'user_book_rating')
                    ->withPivot('rating')->withTimestamps();
    }

    public function avgRating(): int {
        return $this->ratings()->avg('rating') ?: 0;
    }

    public function userRating(int $userId): ?int
    {

        if ($userId) {
            $rating = $this->ratings()->where('user_id', $userId)->first();
            return $rating ? $rating->pivot->rating : null;
        }
        return null;
    }

}
