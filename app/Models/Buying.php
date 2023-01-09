<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buying extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'seller_id',
        'item_id',
        'type_id',
        'qty',
        'price',
        'amount',
        'status',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
