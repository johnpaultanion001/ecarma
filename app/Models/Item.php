<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        'type_id',
        'selling_price',
        'buying_price',
        'unit_id',
        'description',
        'stock',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
