<div>

    @if($user->subscribed("default"))
        <h3>
            Your plan: @dump($user->subscription('default'))
        </h3>
    @else
        <h2 class="uk-margin-top" id="choose-plan">
            You have no plan yet, choose your plan and unlock all possibilities:
        </h2>

        <div class="uk-child-width-1-1 uk-child-width-1-2@m uk-grid-match uk-margin-top uk-container uk-container-small"
             uk-grid>
            @foreach(\App\Models\Plan::all() as $plan)
                <div>
                    <div class="uk-card uk-card-secondary uk-card-body">
                        <h2>{{$plan->name}}</h2>
                        <p>{{$plan->description}}</p>
                        @php
                            $stripe = Laravel\Cashier\Cashier::stripe();
                            if (!isset($plan))
                                throw new \Error();
                            $price_month = $stripe->prices->retrieve($plan->price_monthly_id ,[]);
                            $price_year = $stripe->prices->retrieve($plan->price_yearly_id ,[]);
                            $prices = [$price_year, $price_month];
                        @endphp
                        @foreach($prices as $price)
                            <a href="{{route('plan.subscribe', ['plan'=>$plan->hashid(), 'interval'=>$price->recurring->interval])}}"
                               class="uk-button {{$loop->first ? 'uk-button-secondary' : 'uk-button-default'}} uk-margin-top">{{$price->unit_amount/100}} {{strtoupper($price->currency)}}
                                every {{$price->recurring->interval_count != 1 ? $price->recurring->interval_count.' ' : ''}}{{\Illuminate\Support\Str::plural($price->recurring->interval, $price->recurring->interval_count)}}</a>
                        @endforeach
                        {{--                    <a href="{{route('plan.subscribe', ['plan'=>$plan->hashid(), 'interval'=>$price_month->recurring->interval])}}"--}}
                        {{--                       class="uk-button {{$loop->first ? 'uk-button-secondary' : 'uk-button-default'}} uk-margin-top">{{$price_month->unit_amount/100}} {{strtoupper($price_month->currency)}}--}}
                        {{--                        every {{$price_month->recurring->interval_count != 1 ? $price_month->recurring->interval_count.' ' : ''}}{{\Illuminate\Support\Str::plural($price_month->recurring->interval, $price_month->recurring->interval_count)}}</a>--}}
                        {{--                    <a href="{{route('plan.subscribe', ['plan'=>$plan->hashid(), 'interval'=>$price_year->recurring->interval])}}"--}}
                        {{--                       class="uk-button {{$loop->first ? 'uk-button-secondary' : 'uk-button-default'}} uk-margin-top">{{$price_year->unit_amount/100}} {{strtoupper($price_year->currency)}}--}}
                        {{--                        every {{$price_year->recurring->interval_count != 1 ? $price_year->recurring->interval_count.' ' : ''}}{{\Illuminate\Support\Str::plural($price_year->recurring->interval, $price_year->recurring->interval_count)}}</a>--}}
                    </div>
                </div>
            @endforeach
        </div>
    @endif




    {{--    QUERY STRIPE API --}}

    {{--    @php--}}
    {{--        use Laravel\Cashier\Cashier;--}}
    {{--        $stripe = Cashier::stripe();--}}
    {{--        $products = $stripe->products->search([ 'query' => 'active:\'true\'']);--}}
    {{--    @endphp--}}

    {{--    <div class="uk-child-width-1-1 uk-child-width-1-2@m uk-grid-match uk-margin-top" uk-grid>--}}

    {{--        @foreach($products as $product)--}}
    {{--            <div>--}}
    {{--                <div class="uk-card uk-card-secondary uk-card-body">--}}
    {{--                    --}}{{--                    @dump($product)--}}
    {{--                    <h2>{{$product->name}}</h2>--}}
    {{--                    <p>{{$product->description}}</p>--}}
    {{--                    @php--}}
    {{--                        if(!isset($stripe) || !isset($product))--}}
    {{--                            throw new \Error('');--}}
    {{--                        $prices = $stripe->prices->search(['query'=>'active:\'true\' AND product:\'' . $product->id . '\'']);--}}
    {{--                    @endphp--}}
    {{--                    @foreach($prices as $price)--}}
    {{--                        <a href="#{{\Illuminate\Support\Str::slug($product->name)}}"--}}
    {{--                           class="uk-button {{$loop->first ? 'uk-button-secondary' : 'uk-button-default'}} uk-margin-top">{{$price->unit_amount/100}} {{strtoupper($price->currency)}}--}}
    {{--                            every {{$price->recurring->interval_count != 1 ? $price->recurring->interval_count.' ' : ''}}{{\Illuminate\Support\Str::plural($price->recurring->interval, $price->recurring->interval_count)}}</a>--}}
    {{--                    @endforeach--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        @endforeach--}}
    {{--    </div>--}}


</div>
