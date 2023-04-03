<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function category () {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'image',
        'owner_name',
        'phone',
        'address',
        'coordinates',
        'is_publish',
        'condition',
        'type',
        'views',
    ];
}
