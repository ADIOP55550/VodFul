<x-layouts.user>

    <div class="uk-margin-xlarge-top uk-margin-bottom uk-container">

        <div class="uk-card uk-margin-auto uk-width-medium">
            <form action="{{route('password.request')}}" method="POST">
                @csrf
                <div class="uk-margin">
                    <label class="uk-form-label" for="email-input">
                        Email:
                    </label>
                    <div class="uk-form-controls">
                        <input class="uk-input" type="email" required id="email-input" name="email"
                            value="{{ old('email') }}" autofocus>
                    </div>
                </div>
                <button class="uk-button uk-width-1-1 uk-button-secondary">remember password</button>
            </form>
        </div>

    </div>

</x-layouts.user>
