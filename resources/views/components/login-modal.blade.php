@section('head')
@parent
<script src="{{ asset('/js/homepage/login.js') }}"></script>

@if (isset($openLogin) && $openLogin)
<script>
    document.addEventListener('DOMContentLoaded', () => {
                    openLoginModal();
                });
</script>
@endif
@if (isset($openRegister) && $openRegister)
<script>
    document.addEventListener('DOMContentLoaded', () => {
                    openRegisterModal();
                });
</script>
@endif
@endsection

<div id="login-modal" class="uk-modal-full uk-animation-slide-bottom-medium uk-animation-fast" uk-modal>
    <div class="uk-modal-dialog uk-open">
        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
        <div class="uk-flex uk-flex-column splash-bg uk-flex-middle uk-height-viewport" uk-grid>
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
            <ul class="uk-subnav uk-subnav-pill uk-hidden" id="login-switcher"
                uk-switcher="animation: uk-animation-fade">
                <li><a href="#">Log in</a></li>
                <li><a href="#">Register</a></li>
            </ul>
            <ul class="uk-switcher uk-margin">
                <li id="login-form-wrapper">
                    <form action="{{ route('login') }}" method="post" class="uk-light uk-margin-auto uk-margin-bottom">
                        @csrf
                        <h1>Log in:</h1>
                        <div class="uk-margin">
                            <label for="username-input">
                                Username:
                            </label>
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input class="uk-input" type="text" id="username-input" name="email" autofocus>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label for="password-input">
                                Password:
                            </label>
                            <div class="uk-inline">
                                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                <input class="uk-input" id="password-input" name="password" type="password">
                            </div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline uk-margin-small-right">
                                <input class="uk-checkbox" id="remember-check" name="remember" type="checkbox">
                            </div>
                            <label for="remember-check">
                                Remember me
                            </label>
                        </div>


                        <button class="uk-button uk-button-secondary uk-width-1-1" type="submit">Log in</button>

                    </form>
                    <a href="{{route('password.request')}}">Forgot password?</a>
                    <br/>
                    <a href="#register" uk-switcher-item="next">Don't have an account? Register!</a>
                </li>
                <li id="register-form-wrapper">
                    <form action="{{ route('register') }}" method="post"
                        class="uk-light uk-margin-auto uk-margin-bottom uk-form-horizontal">
                        @csrf
                        <h1>Register:</h1>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="full-name-input">
                                Full Name:
                            </label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="text" required id="full-name-input" name="name" {{
                                    old('name') }} autofocus>
                            </div>
                        </div>
                        <div class="uk-margin">
                            <label class="uk-form-label" for="email-input">
                                Email:
                            </label>
                            <div class="uk-form-controls">
                                <input class="uk-input" type="email" required id="email-input" name="email" {{
                                    old('email') }} autofocus>
                            </div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label" for="password-input">
                                Password:
                            </label>
                            <div class="uk-form-controls">
                                <input class="uk-input" id="password-input" required name="password" {{ old('password')
                                    }} type="password">
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

                        <div class="uk-margin">
                            <label class="uk-form-label" for="accept-tos-checkbox">
                                Accept Terms Of Service (required)
                            </label>
                            <div class="uk-form-controls">
                                <input class="uk-checkbox" type="checkbox" name="acceptTOS" id="accept-tos-checkbox"
                                    required>
                            </div>
                        </div>

                        <button class="uk-button uk-button-secondary uk-width-1-1 uk-margin-top" type="submit">
                            Register
                        </button>

                    </form>
                    <a href="#login" uk-switcher-item="previous">Already have an account?</a>
                </li>
            </ul>

        </div>
    </div>
</div>
