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
        // 'price_monthly_id',
        // 'price_yearly_id',
        'stripe_product_id',
        'discount'
    ];

    protected $attributes = [
        'discount' => 0
    ];

    public function getStripeProduct()
    {
        $stripe = \Laravel\Cashier\Cashier::stripe();
        return $stripe->products->retrieve($this->stripe_product_id);
    }

    public function getStripePrices()
    {
        $stripe = \Laravel\Cashier\Cashier::stripe();
        return $stripe->prices->search(['query' => 'active:\'true\' AND product:\'' . $this->stripe_product_id . '\'']);
    }
}
