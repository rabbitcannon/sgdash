<div class="row">
    <div class="large-12 medium-12 small-12 columns">

        <div class="callout alert" data-closable>
            <div class="alert">
                <h5>
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{ $title }}
                </h5>
            </div>

            <div>
                <p>
                    {{ $slot }}
                </p>

                <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>

    </div>
</div>