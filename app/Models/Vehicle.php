<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'price',
        'capacity',
        'purpose',
        'images',
        'user_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

