<x-layouts.user>

    <div class="uk-container uk-margin-xlarge-top">
        <div class="uk-flex uk-flex-column uk-flex-middle" uk-grid>
            <img src="/images/logo/logo_shadow.svg" width="250" alt="logo" class="uk-margin-medium-top">

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

            <form action="{{ route('password.confirm') }}" method="post"
                class="uk-light uk-margin-auto uk-margin-bottom">
                @csrf
                <h1>Confirm your password:</h1>
                <div class="uk-margin">
                    <label for="password-input">
                        Password:
                    </label>
                    <div class="uk-inline">
                        <span class="uk-form-icon" uk-icon="icon: lock"></span>
                        <input class="uk-input" id="password-input" name="password" required type="password">
                    </div>
                </div>
                <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">Confirm</button>

            </form>
            <a href="{{route('password.request')}}">Forgot password?</a>
            <br />


        </div>
    </div>

</x-layouts.user>
