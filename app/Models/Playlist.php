<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $attributes = [
        'protected' => false
    ];

    protected $guarded = [
        'protected'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
