<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Position extends Model
{
    protected $fillable = [
        'name',
        'level',
        'created_by',
    ];

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
