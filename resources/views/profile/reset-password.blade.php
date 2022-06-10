<x-layouts.user>

    <div class="uk-margin-xlarge-top uk-margin-bottom uk-container uk-light">

        <div class="uk-card uk-margin-auto uk-width-medium">
            <div class="uk-margin-top">
                @if ($errors->any())
                <div class="uk-alert-danger uk-dark" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
            </div>

            <form action="/reset-password" method="POST">
                @csrf
                <input class="uk-input" type="hidden" required id="email-input" name="email"
                    value="{{ request()->email ?? '' }}" autofocus>

                <div class="uk-margin">
                    <label class="uk-form-label" for="password-input">
                        Password:
                    </label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="password-input" required name="password" type="password">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="repeat-password-input">
                        Repeat password:
                    </label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="repeat-password-input" required name="password_confirmation"
                            type="password">
                    </div>
                </div>

                <input type="hidden" name="token" value="{{request()->route('token')}}">

                <button class="uk-button uk-width-1-1 uk-button-secondary">Reset password</button>
            </form>
        </div>

    </div>

</x-layouts.user>
