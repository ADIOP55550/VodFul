<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Models\Plan;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Stripe\Exception\InvalidRequestException;

class AdminPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.plans');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plans');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlanRequest $request)
    {
        $valid = $request->validated();

        try {
            $stripe = \Laravel\Cashier\Cashier::stripe();
            $stripe->products->retrieve($valid['stripe_product_id']);
        } catch (InvalidRequestException) {
            return back()->withInput()->with('status.error', 'There is no stripe product with given id.');
        }

        $plan = Plan::factory()->create($valid);
        return back()->with('status.success', 'Plan created');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $plan_id
     * @return \Illuminate\Http\Response
     */
    public function show(string $plan_id)
    {
        $plan = Plan::fromHashId($plan_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $plan_id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $plan_id)
    {
        $plan = Plan::fromHashId($plan_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string $plan_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlanRequest $request, string $plan_id)
    {
        $validated = $request->validated();
        $plan = Plan::fromHashId($plan_id);

        $plan->fill($validated);

        return back()->with('status.success', 'Ok');
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  string $plan_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $plan_id)
    {
        $plan = Plan::fromHashId($plan_id);

        $plan->order = 10000;
        $plan->update();

        $plan->delete();

        return back()->with('status.success', 'Plan was deleted.' . $this->getUndoForm(route('admin.plans.restore', ['id' => $plan_id]), 'restore'));
    }

    /**
     * Restore soft deleted plan.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function restore(string $id)
    {
        $plan = Plan::fromHashId($id);
        $plan->restore();

        return back()->with('status.success', 'Plan was restored.' . $this->getUndoForm(route('admin.plans.destroy', ['plan' => $id]), 'delete', 'delete'));
    }


    public function reorder(Request $request)
    {
        $reordered = array_map(fn ($v) => Plan::fromHashId($v), $request->ids);
        foreach ($reordered as $i => $plan) {
            $plan->order = $i;
            $plan->update();
        }

        return ['status' => 'ok'];
    }

    public function toggleVisibility(string $plan_id)
    {
        $plan = Plan::fromHashId($plan_id);

        $plan->active = !$plan->active;
        $plan->update();

        return back()->with('status.success', 'Ok');
    }
}
