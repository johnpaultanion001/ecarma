<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'type_id', 'id');
    }
}
