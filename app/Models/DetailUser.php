<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailUser extends Model
{
    protected $fillable = [
        'user_id',
        'position_id',
        'manage_by',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function manage_by_who(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manage_by');
    }
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
}
