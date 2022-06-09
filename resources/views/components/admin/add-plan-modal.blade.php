<div id="add-plan-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <form method="POST" action="{{route('admin.plans.store')}}">
            @csrf
            <h2 class="uk-modal-title">Add plan</h2>

            <div class="uk-margin">
                <label>
                    Name (empty if stripe name shall be used):
                    <input class="uk-input" type="text" name="name">
                </label>
            </div>
            <div class="uk-margin">
                <label>
                    Stripe product id:
                    <input class="uk-input" type="text" required name="stripe_product_id">
                </label>
            </div>

            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                <button class="uk-button uk-button-primary" type="submit">Save</button>
            </p>
        </form>
    </div>
</div>
