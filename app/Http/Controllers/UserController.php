<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\UpdateUserPassword;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
    public function deleteProfile(Request $request)
    {
        if (!$request->is_sure)
            return back()->with("status.error", "Checkbox was not checked, nothing has been deleted");
        $user = User::query()->findOrFail(Auth::user()->id);
        $user->forceDelete();
        return to_route('homepage');
    }

    public function updatePassword(UpdateUserPassword $updateUserPassword, Request $request)
    {
        $updateUserPassword->update(Auth::user(), $request->all());
        return to_route('homepage')->with('status.success', 'Password updated!');
    }

    public function subscribe(string $plan_id, string $priceDataEnc)
    {
        Gate::allowIf(fn ($user) => !!$user);
        $user = Auth::user();

        $priceData = decrypt($priceDataEnc);

        $plan = Plan::fromHashId($plan_id);
        $prices = $plan->getStripePrices();

        $found_prices = Arr::where($prices->data, fn ($v) => ($v->recurring->interval == $priceData['interval']) && ($v->recurring->interval_count == $priceData['interval_count']));
        $price = head($found_prices);



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
