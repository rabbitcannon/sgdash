<div class="row expanded">
    <div class="large-12 columns">

        <div id="project-list"></div>

        <div id="loader" style="display: block;">
            <img src="/images/preloaders/loader.svg" />
        </div>

        @include('layouts.partials.react-script', ['script' => 'public/projects'])

    </div>
</div>