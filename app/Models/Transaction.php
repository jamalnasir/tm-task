<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaction extends Model
{
    use HasFactory;

    const DECLINED = 0;
    const AUTHORIZED = 1;

    public static $transactionStatuses = [
        self::DECLINED => 'Declined',
        self::AUTHORIZED => 'Authorized'
    ];

    protected $fillable = [
        "transaction_id",
        "token",
        "transaction_type",
        "transaction_status",
        "merchant_code",
        "merchant_name",
        "merchant_country",
        "currency",
        "amount",
        "transaction_currency",
        "transaction_amount",
        "auth_code",
        "transaction_date"
    ];

    public function scopePendingTransactions(Builder $query)
    {
        return $query->where('sync_status', '<>', 2);
    }

    public function platforms(): BelongsToMany {
        return $this->belongsToMany(Platform::class)->withTimestamps();
    }
}
