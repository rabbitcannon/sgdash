<div class="data-card-small">
    <div class="data-header">
        <i class="fa fa-database" aria-hidden="true"></i> Environments
    </div>

    <div class="data-content">

        <div class="row">
            <div class="large-12 columns">

                @include('environments.panels.req')
                @include('environments.panels.dev')
                @include('environments.panels.qa')
                @include('environments.panels.uat')
                @include('environments.panels.prod')

            </div>
        </div>

    </div>
</div>