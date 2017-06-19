<div class="row expanded">
    <div class="large-12 columns">

        <div id="project-list"></div>

        <div class="reveal small animated fadeIn" id="add-project-reveal" data-reveal>
            @include('admin.projects.partials.new')
        </div>

        <div id="loader" style="display: block;">
            <img src="/images/preloaders/loader.svg" />
        </div>

        @include('layouts.partials.react-script', ['script' => 'admin/projects'])

    </div>
</div>