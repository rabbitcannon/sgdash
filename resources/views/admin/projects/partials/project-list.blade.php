<div class="row expanded">
    <div class="large-12 columns">

        @include('layouts.partials.react-script', ['script' => 'admin/projects'])

        <div id="project-list"></div>

        <div class="reveal small animated fadeIn" id="add-project-reveal" data-reveal style="padding: 0px;">
            @include('admin.projects.partials.new')
        </div>

        <div id="loader" style="display: block;">
            <div class="load-image">
                <img src="/images/preloaders/loader.svg" />
            </div>
        </div>

        @include('layouts.partials.react-script', ['script' => 'admin/projects'])


    </div>
</div>