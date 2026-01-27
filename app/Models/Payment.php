<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_type',
        'transaction_id',
        'snap_token',
        'transaction_status',
        'gross_amount',
        'transaction_time',
    ];

    /* ================= RELATIONS ================= */

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }
}
