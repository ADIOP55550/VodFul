<x-layouts.user>

    <div class="uk-margin-xlarge-top uk-margin-bottom uk-container">

        <div class="uk-card uk-card-primary uk-margin-auto uk-width-medium" uk-card-default>
            <div class="uk-card-header">
                <h3 class="uk-card-title">Email Verification</h3>
            </div>
            <div class="uk-card-body">
                <p>
                    You must verif your email address,
                    a link to do that was sent to your inbox.
                </p>
            </div>
            <div class="uk-card-footer">
                <form method="POST" action="{{route('verification.send')}}">
                    @csrf
                    <button class="uk-button uk-button-default">Send again</button>
                </form>
            </div>
        </div>

    </div>

</x-layouts.user>
