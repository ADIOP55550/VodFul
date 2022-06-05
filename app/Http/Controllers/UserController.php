<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        Gate::authorize('view', $user);
        return view('profile.index', ['user' => $user]);
    }

    public function paymentMethod()
    {
        $user = Auth::user();
        return view('profile.payment-method', [
            'intent' => $user->createSetupIntent()
        ]);
    }

    public function subscribe(string $plan_id, string $interval)
    {
        Gate::allowIf(fn($user) => !!$user);
        $user = Auth::user();

        $plan = Plan::fromHashId($plan_id);
        return $user->newSubscription(
            'default',
            ($interval == 'month' ? $plan->price_monthly_id : $plan->price_yearly_id)
        )->checkout([
            'success_url' => route('profile'),
            'cancel_url' => route('homepage'),
        ]);

    }

    public function manageSubscriptions()
    {
        Auth::user()->createOrGetStripeCustomer();
        return Auth::user()->redirectToBillingPortal(route('profile'));
    }
}
