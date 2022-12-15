<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    use HasFactory;

    protected $fillable = [
        'trasaction_id',
        'buyer_id',
        'item_id',
        'qty',
        'price',
        'amount',
        'status',
    ];

    public function seller()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
