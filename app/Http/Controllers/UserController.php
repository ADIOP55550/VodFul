<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Util;

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
        Gate::allowIf(fn ($user) => !!$user);
        $user = Auth::user();

        $plan = Plan::fromHashId($plan_id);

        $prices = $plan->getStripePrices();

        $price = Arr::where($prices->data, fn ($v) => $v->recurring->interval == $interval)[0];

        return $user->newSubscription(
            'default',
            $price->id
        )->checkout([
            'success_url' => route('profile.index'),
            'cancel_url' => route('homepage'),
        ]);
    }

    public function manageSubscriptions()
    {
        Auth::user()->createOrGetStripeCustomer();
        return Auth::user()->redirectToBillingPortal(route('profile.index'));
    }

    public function toggleAdmin(string $id)
    {
        $user = Auth::user();
        $u = User::fromHashId($id);

        if ($u->id == $user->id)
            abort(409);

        $u->is_admin = !$u->is_admin;
        $u->update();
        return back()->with(
            'status.info',
            'User '
                . htmlentities($u->name)
                . ($u->is_admin ? ' is now an admin' : ' is no longer admin')
                . $this->getUndoForm(route('admin.users.toggle-admin', ['id' => $id]))
        );
    }
}
