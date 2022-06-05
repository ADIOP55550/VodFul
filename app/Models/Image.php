<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'filename',
        'aspect_ratio',
    ];

    public function movie(){
        return $this->belongsTo(Movie::class);
    }
}
