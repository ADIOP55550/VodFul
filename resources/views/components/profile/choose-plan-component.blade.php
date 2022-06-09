@if(!$user->subscribed("default"))
@if(!$user->isAdmin())

<h1 class="uk-margin-top uk-text-center uk-animation-fade" id="choose-plan">
    You have no plan yet, choose your plan and unlock all possibilities:
</h1>

@php
$stripe = Laravel\Cashier\Cashier::stripe();
@endphp

<div class="uk-container uk-container-small">
    <div class="uk-margin-top uk-grid-medium uk-child-width-expand" uk-grid uk-height-match="target: .uk-card-body"
        uk-scrollspy="target: >div; cls: uk-animation-slide-bottom; delay: 200">
        @foreach(\App\Models\Plan::query()->where('active', true)->orderBy('order')->get() as $plan)
        @php
        $product = $plan->getStripeProduct();
        $prices = $stripe->prices->search(['query'=>'active:\'true\' AND product:\'' . $product->id .'\'']);
        @endphp
        <div style="max-width: 40em">
            <div class="uk-card uk-card-secondary">
                <div class="uk-card-body">
                    <h2>{{$plan->name ?? $product->name}}</h2>
                    <p class="uk-width-3-4">{{$product->description}}</p>
                    @if(count($product->images) > 0)
                    <img class="uk-position-top-right uk-width-1-4 uk-position-small" src="{{$product->images[0]}}">
                    @endif
                </div>
                <div class="uk-flex uk-flex-column uk-card-footer">
                    @foreach($prices as $price)
                    <a href="{{route('plan.subscribe', ['plan'=>$plan->hashid(), 'interval'=>$price->recurring->interval])}}"
                        class="uk-button {{$price->id == $product->default_price ? 'uk-button-secondary' : 'uk-button-default'}} uk-margin-bottom">{{$price->unit_amount/100}}
                        {{strtoupper($price->currency)}}
                        every {{$price->recurring->interval_count != 1 ? $price->recurring->interval_count.' ' :
                        ''}}{{\Illuminate\Support\Str::plural($price->recurring->interval,
                        $price->recurring->interval_count)}}</a>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endif


{{--
<h2>{{$plan->name}}</h2>
<p>{{$plan->description}}</p>
@php
$stripe = Laravel\Cashier\Cashier::stripe();
if (!isset($plan))
throw new \Error();
// $price_month = $stripe->prices->retrieve($plan->price_monthly_id ,[]);
// $price_year = $stripe->prices->retrieve($plan->price_yearly_id ,[]);
// $prices = [$price_year, $price_month];
@endphp
@foreach($prices as $price)
<a href="{{route('plan.subscribe', ['plan'=>$plan->hashid(), 'interval'=>$price->recurring->interval])}}"
    class="uk-button {{$loop->first ? 'uk-button-secondary' : 'uk-button-default'}} uk-margin-top">{{$price->unit_amount/100}}
    {{strtoupper($price->currency)}}
    every {{$price->recurring->interval_count != 1 ? $price->recurring->interval_count.' ' :
    ''}}{{\Illuminate\Support\Str::plural($price->recurring->interval,
    $price->recurring->interval_count)}}</a>
@endforeach --}}











{{-- <a href="{{route('plan.subscribe', ['plan'=>$plan->hashid(), 'interval'=>$price_month->recurring->interval])}}"
    --}} {{--
    class="uk-button {{$loop->first ? 'uk-button-secondary' : 'uk-button-default'}} uk-margin-top">{{$price_month->unit_amount/100}}
    {{strtoupper($price_month->currency)}}--}}
    {{-- every {{$price_month->recurring->interval_count != 1 ?
    $price_month->recurring->interval_count.' ' :
    ''}}{{\Illuminate\Support\Str::plural($price_month->recurring->interval,
    $price_month->recurring->interval_count)}}</a>--}}
{{-- <a href="{{route('plan.subscribe', ['plan'=>$plan->hashid(), 'interval'=>$price_year->recurring->interval])}}" --}}
    {{--
    class="uk-button {{$loop->first ? 'uk-button-secondary' : 'uk-button-default'}} uk-margin-top">{{$price_year->unit_amount/100}}
    {{strtoupper($price_year->currency)}}--}}
    {{-- every {{$price_year->recurring->interval_count != 1 ?
    $price_year->recurring->interval_count.' ' :
    ''}}{{\Illuminate\Support\Str::plural($price_year->recurring->interval,
    $price_year->recurring->interval_count)}}</a>--}}




{{-- QUERY STRIPE API --}}

{{-- @php--}}
{{-- use Laravel\Cashier\Cashier;--}}
{{-- $stripe = Cashier::stripe();--}}
{{-- $products = $stripe->products->search([ 'query' => 'active:\'true\'']);--}}
{{-- @endphp--}}

{{-- <div class="uk-child-width-1-1 uk-child-width-1-2@m uk-grid-match uk-margin-top" uk-grid>--}}

    {{-- @foreach($products as $product)--}}
    {{-- <div>--}}
        {{-- <div class="uk-card uk-card-secondary uk-card-body">--}}
            {{-- --}}{{-- @dump($product)--}}
            {{-- <h2>{{$product->name}}</h2>--}}
            {{-- <p>{{$product->description}}</p>--}}
            {{-- @php--}}
            {{-- if(!isset($stripe) || !isset($product))--}}
            {{-- throw new \Error('');--}}
            {{-- $prices = $stripe->prices->search(['query'=>'active:\'true\' AND product:\'' . $product->id .
            '\'']);--}}
            {{-- @endphp--}}
            {{-- @foreach($prices as $price)--}}
            {{-- <a href="#{{\Illuminate\Support\Str::slug($product->name)}}" --}} {{--
                class="uk-button {{$loop->first ? 'uk-button-secondary' : 'uk-button-default'}} uk-margin-top">{{$price->unit_amount/100}}
                {{strtoupper($price->currency)}}--}}
                {{-- every {{$price->recurring->interval_count != 1 ? $price->recurring->interval_count.' ' :
                ''}}{{\Illuminate\Support\Str::plural($price->recurring->interval,
                $price->recurring->interval_count)}}</a>--}}
            {{-- @endforeach--}}
            {{-- </div>--}}
        {{-- </div>--}}
    {{-- @endforeach--}}
    {{-- </div>--}}
