<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_of_trasaction',
    ];

    public function sellings()
    {
        return $this->hasMany(Selling::class, 'transaction_id', 'id');
    }

    public function buyings()
    {
        return $this->hasMany(Buying::class, 'transaction_id', 'id');
    }
}
