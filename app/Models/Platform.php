<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform_name',
        'status'
    ];

    public function transactions(): BelongsToMany {
        return $this->belongsToMany(Transaction::class)->withTimestamps();
    }
}
