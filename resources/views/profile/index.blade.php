<x-layouts.user>

    <div class="uk-container uk-margin-xlarge-top">
        <h1 class="uk-margin-remove-bottom">Profil {{$user->name}}</h1>
        @if($user->is_admin)
        <h3 class="uk-margin-remove-top">(Administrator)</h3>
        @endif

        <x-profile.choose-plan-component :user="$user"></x-profile.choose-plan-component>


        <a class="uk-button uk-button-link uk-margin-large-top" href="{{route('profile.manage-subscriptions')}}">Manage
            Subscription, billing information, download invoices</a>


    </div>

</x-layouts.user>
