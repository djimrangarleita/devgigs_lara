<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\InputBag;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'location',
        'email',
        'website',
        'description',
        'tags',
        'logo',
        'user_id'
    ];

    public function scopeFilter(Builder $query, InputBag $inputBag)
    {
        if ($tag = $inputBag->get('tag')) {
            $query->where('tags', 'like', "%$tag%");
        }
        if ($search = $inputBag->get('search')) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('tags', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
