<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'location_id',
        'title', 'slug', 'description', 'price',
        'is_negotiable', 'status', 'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_negotiable' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function images()
    {
        return $this->hasMany(AdImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(AdImage::class)->where('is_primary', true);
    }
}