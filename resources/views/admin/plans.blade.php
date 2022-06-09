<x-layouts.admin>
    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", ()=>{
            UIkit.util.on('#plans', 'moved', (ev)=>{
                console.log(ev);
                setTimeout(() => {
                    const cards = document.querySelectorAll('.plan-card');
                    axios.post('{{route("admin.plans.reorder")}}',
                        {
                            ids: Array.from(cards).map(v=>v.getAttribute('data-id')),
                        },
                        {
                            withCredentials: true,
                        }
                    )
                    .then(console.log);
                }, 1);
            });
        });
    </script>
    @endpush

    @php
    $plans = App\Models\Plan::withTrashed()->orderBy("order")->get();
    @endphp

    <div class="uk-container uk-margin-top uk-margin-bottom">
        <span>Drag plans to reorder</span>

        <ul id="plans" class="uk-margin-top uk-grid-small uk-child-width-1-2 uk-child-width-1-4@s" uk-sortable=""
            uk-grid>

            @forelse ($plans as $plan)
            <li>
                <div @class(['uk-card', 'uk-card' , 'uk-card-body' , 'uk-text-center' , 'plan-card' , 'uk-card-default'
                    , 'uk-box-shadow-large' ]) data-id="{{$plan->hashid()}}">
                    @php
                    $prod = $plan->getStripeProduct();
                    @endphp
                    <h3>
                        {{$plan->name ?? $prod->name}}
                    </h3>
                    <p>
                        {{$plan->description ?? $prod->description}}
                    </p>
                    @if(!$plan->active)
                    <div class="uk-card-badge uk-label uk-label-default">HIDDEN</div>
                    @endif
                    <div class="uk-flex uk-margin-top">
                        <form method="POST"
                            action="{{route('admin.plans.toggle-visibility', ['id'=>$plan->hashid()])}}">
                            @csrf
                            <button class="uk-button uk-button-default uk-button-small uk-margin-left">{{$plan->active ?
                                'Hide' : 'Show'}}</button>
                        </form>
                        @if($plan->trashed())
                        <div class="uk-card-badge uk-label uk-label-danger">DELETED</div>
                        <form method="POST" action="{{route('admin.plans.restore', ['id'=>$plan->hashid()])}}">
                            @csrf
                            <button class="uk-button uk-button-default uk-button-small uk-margin-left">Restore</button>
                        </form>
                        @else
                        <form method="POST" action="{{route('admin.plans.destroy', ['plan'=>$plan->hashid()])}}">
                            @csrf
                            @method('delete')
                            <button class="uk-button uk-button-danger uk-button-small uk-margin-left">Delete</button>
                        </form>
                        @endif
                    </div>
                </div>
            </li>
            @empty
            <h3>
                Brak planów
            </h3>
            @endforelse
        </ul>
        <div class="uk-margin-large-top">
            <button class="uk-button uk-button-primary uk-margin uk-display-inline-block"
                uk-toggle="#add-plan-modal">Add plan</button>
            <a href="https://dashboard.stripe.com/test/dashboard" target="_blank"
                class="uk-button uk-button-primary uk-margin uk-display-inline-block uk-margin-remove-top">Manage prices</a>

        </div>
    </div>


    <x-admin.add-plan-modal/>
</x-layouts.admin>
