<?php

namespace App\Models;

use App\Traits\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stripe\Exception\OAuth\InvalidRequestException;

class Plan extends Model
{
    static $HASHIDS_NUMBER = 3;

    use HasFactory, Hashids, SoftDeletes;

    protected $fillable = [
        'name',
        // 'slug',
        // 'price_monthly_id',
        // 'price_yearly_id',
        'stripe_product_id',
        'discount',
        'order',
        'active'
    ];

    protected $attributes = [
        'discount' => 0,
        'order' => 100,
        'active' => true,
    ];

    public function getStripeProduct()
    {
        $stripe = \Laravel\Cashier\Cashier::stripe();
        try{
            return $stripe->products->retrieve($this->stripe_product_id);
        }
        catch(InvalidRequestException){
            return null;
        }
    }

    public function getStripePrices()
    {
        $stripe = \Laravel\Cashier\Cashier::stripe();
        return $stripe->prices->search(['query' => 'active:\'true\' AND product:\'' . $this->stripe_product_id . '\'']);
    }
}
