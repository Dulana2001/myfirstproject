<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdImage extends Model
{
    protected $fillable = ['advertisement_id', 'file_path', 'is_primary', 'sort_order'];

    public function advertisement()
    {
        return $this->belongsTo(Advertisement::class);
    }
}