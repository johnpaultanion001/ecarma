<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'unit_id', 'id');
    }
}
