<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'refund_amount',
        'reason',
        'proof_image',
        'status',
    ];

    /* ================= RELATIONS ================= */

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
