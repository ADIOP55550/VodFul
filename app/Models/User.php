<?php

namespace App\Models;

use App\Traits\Hashids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use function Illuminate\Events\queueable;


/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property boolean $is_admin
 *
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Hashids, Billable;

    protected static function booted()
    {
        static::updated(queueable(function ($customer) {
            if ($customer->hasStripeId()) {
                $customer->syncStripeCustomerDetails();
            }
        }));
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $guarded = [
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function watchStatuses()
    {
        return $this->hasMany(WatchStatus::class);
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function favourites()
    {
        return $this->belongsTo(Playlist::class, 'favourites_id', 'id');
    }

    public function ignored()
    {
        return $this->belongsTo(Playlist::class, 'ignored_id', 'id');
    }
}
