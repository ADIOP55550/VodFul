<x-layouts.user>

    <div class="uk-margin-xlarge-top uk-margin-bottom">
        <div class="uk-container uk-margin-bottom">
            <h1 class="uk-margin-remove-bottom">Profil {{$user->name}}</h1>
            @if($user->is_admin)
            <h3 class="uk-margin-remove-top">(Administrator)</h3>
            @endif
        </div>

        <div class="uk-section uk-section-primary uk-light uk-section-xlarge">
            <div class="uk-container">
                <x-profile.choose-plan-component :user="$user"></x-profile.choose-plan-component>
                @if ($user->subscription('default'))
                <div class="uk-width-1-1">
                    <a class="uk-button uk-button-link uk-margin-medium-top uk-margin-medium-bottom uk-margin-auto uk-display-block"
                        href="{{route('profile.manage-subscriptions')}}">Manage
                        Subscription, billing information, download invoices</a>
                </div>

                @endif
            </div>
        </div>

        <div class="uk-section uk-section-secondary uk-light">
            <div class="uk-container">
                <x-profile.favourites />
            </div>
        </div>
        <div class="uk-section uk-section-secondary uk-light">
            <div class="uk-container">
                <x-profile.recently-watched />
            </div>
        </div>
    </div>

</x-layouts.user>
