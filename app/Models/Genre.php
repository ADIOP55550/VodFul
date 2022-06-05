<?php

namespace App\Models;

use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Genre extends Model
{
    static  $HASHIDS_NUMBER = 1;

    use HasFactory, \App\Traits\Hashids;

    public $timestamps = false;

    protected $fillable = ["name"];

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

}
