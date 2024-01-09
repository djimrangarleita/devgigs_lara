<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\InputBag;

class Listing extends Model
{
    use HasFactory;

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
}
