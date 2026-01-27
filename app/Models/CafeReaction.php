<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CafeReaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'cafe_id',
        'visitor_id',
        'energy_count',
    ];

    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }
}
