<x-layouts.user>

    <div class="uk-margin-xlarge-top uk-margin-bottom">
        <div class="uk-container uk-margin-bottom uk-light">
            <h1 class="uk-margin-remove-bottom">Hello, {{$user->name}}</h1>
            @if($user->is_admin)
            <h3 class="uk-margin-remove-top">(Administrator)</h3>
            @endif
        </div>

        @if (!$user->isAdmin())
        <div @class(['uk-section', 'uk-section-primary' , 'uk-light' , 'uk-section-xlarge'=> !$user->subscribed()])>
            <div class="uk-container">
                @if ($user->subscribed())
                <h2>
                    Your plan:
                    @php($plan = App\Models\Plan::withTrashed()->where('stripe_product_id',
                    $user->subscription()->items[0]->stripe_product)->firstOrFail())
                    {{$plan->name ?? $plan->getStripeProduct()->name}}
                </h2>
                <div class="uk-width-1-2@l uk-width-1-1 uk-margin-auto">
                    <a class="uk-button uk-button-large uk-button-default uk-margin-medium-top uk-margin-medium-bottom uk-margin-auto uk-display-block"
                        href="{{route('profile.manage-subscriptions')}}">Manage
                        Subscription, billing information, download invoices</a>
                </div>
                @else
                <x-profile.choose-plan-component :user="$user"></x-profile.choose-plan-component>
                @endif
            </div>
        </div>
        @endif


        <div class="uk-section uk-section-muted">
            <div class="uk-container">

                <h2 class="">Profile management</h2>
                <div>
                    <a href="#confirm-password-reset" uk-toggle class="uk-button uk-button-secondary">
                        Change password
                    </a>
                    <a href="#confirm-delete" uk-toggle class="uk-button uk-button-danger">
                        Delete account
                    </a>
                </div>
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


    <div id="confirm-delete" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Delete profile?</h2>
            </div>
            <div class="uk-modal-body">
                <p>Are you sure that you want to delete your profile?
                    All your payments <u>will not</u> be refunded<br />
                    This action cannot be undone!</p>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <form method="POST" action="{{route('profile.delete')}}">
                    @csrf
                    @method('delete')
                    <label class="uk-margin-bottom uk-display-block">
                        I understand that this action is irreversible, delete my account
                        <input type="checkbox" name="is_sure" />
                    </label>
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                    <button class="uk-button uk-button-danger" type="submit">DELETE</button>
                </form>
            </div>
        </div>
    </div>


    <div id="confirm-password-reset" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Reset password?</h2>
            </div>
            <form method="POST" action="{{route('profile.update-password')}}">
                @csrf
                <div class="uk-modal-body">
                    <label>
                        Current password:
                        <input required class="uk-input" type="password" name="current_password">
                    </label>
                    <label>
                        New password:
                        <input required minlength="8" class="uk-input" type="password" name="password">
                    </label>
                    <label>
                        Repeat new password:
                        <input required minlength="8" class="uk-input" type="password" name="password_confirmation">
                    </label>
                </div>
                <div class="uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                    <button class="uk-button uk-button-primary" type="submit">Reset password</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($errors->updatePassword->all() as $message)
    <script>
        UIkit.notification({
            message: '{{$message}}',
            status: 'danger',
            pos: '{{request()->is("admin*") ? "bottom-right" : "top-right"}}',
            timeout: 6000
        });
    </script>

    {{-- @dump($errors)
    @dump($errors->all())
    @dump($errors->updatePassword)
    @dump($errors->updatePassword->all())
    {{json_encode($errors->all(":message"))}}
    @dump($errors->bags) --}}
    @endforeach


</x-layouts.user>
