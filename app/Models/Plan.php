<?php

namespace App\Models;

use App\Traits\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    static $HASHIDS_NUMBER = 3;

    use HasFactory, Hashids;

    protected $fillable = [
        'name',
        'slug',
        'price_monthly_id',
        'price_yearly_id',
        'discount'
    ];

    protected $attributes = [
        'discount' => 0
    ];


}
