<style>
    .comments-inner {
        height: 100%;
    }
</style>

<div class="row expanded">
    <div class="large-12 columns">

        <div class="data-card-small">
            <div class="data-header">

                <div class="row expanded">
                    <div class="large-11 columns">
                        <i class="fa fa-filter"></i> Filter
                    </div>

                    <div class="large-1 columns">
                        <button id="toggle-collapse" type="button"  style="margin-left: 70px;">
                            <i id="collapse-chevron" class="fa fa-angle-double-up override"></i>
                        </button>
                    </div>
                </div>

            </div>

            <div class="data-content">

                <div id="filter-form">

                    {!! Form::open(['url' => '/admin/search/projects', 'method' => 'post']) !!}

                    <div class="row expanded">
                        <fieldset class="large-3 columns">
                            <legend>Creation Date</legend>
                            <hr/>
                            <div id="date-picker-start"></div>
                            <div id="date-picker-end"></div>
                        </fieldset>

                        <fieldset class="large-3 columns">
                            <legend>Project Code</legend>
                            <hr/>
{{--                            {{ Form::text('project_code', null, ['placeholder' => 'Project Code']) }}--}}
                            <input type="text" name="project_code" placeholder="Project Code">
                        </fieldset>

                        <fieldset class="large-3 columns">
                            <legend>Project Name</legend>
                            <hr/>
                            {{ Form::text('project_name', null, ['placeholder' => 'Project Name']) }}
                        </fieldset>

                        <fieldset class="large-3 columns">
                            <legend>Project Status</legend>
                            <hr/>

                            <ul name="project-status-list" class="column-list">
                                @foreach($project_statuses as $project_status)
                                    <li>
                                        <input class="project_status" name="project_status[]" value="{!! $project_status->id !!}" type="checkbox">

                                        <label for="{!! $project_status->id !!}">
                                            {!! $project_status->name !!}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </fieldset>
                    </div>

                    <div class="row expanded">
                        <fieldset class="large-4 columns">
                            <legend>Project Manager</legend>
                            <hr/>

                            <ul class="column-list">
                                @foreach($project_managers as $project_manager)
                                    <li>
                                        <input name="project_managers[]" value="{!! $project_manager->id !!}" type="checkbox">
                                        <label>{!! $project_manager->first_name !!} {!! $project_manager->last_name !!}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </fieldset>

                        <fieldset class="large-4 columns">
                            <legend>Development Manager</legend>
                            <hr/>

                            <ul class="column-list">
                                @foreach($dev_managers as $dev_manager)
                                    <li>
                                        <input name="dev_managers[]" value="{!! $dev_manager->id !!}" type="checkbox">
                                        <label>{!! $dev_manager->first_name !!} {!! $dev_manager->last_name !!}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </fieldset>

                        <fieldset class="large-4 columns">
                            <legend>Account Manager</legend>
                            <hr/>

                            <ul class="column-list">
                                @foreach($account_managers as $account_manager)
                                    <li>
                                        <input name="account_managers[]" value="{!! $account_manager->id !!}" type="checkbox">
                                        <label>{!! $account_manager->first_name !!} {!! $account_manager->last_name !!}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </fieldset>
                    </div>

                    <hr />
                    <div class="row expanded">
                        <div class="large-12 columns text-center pad-box">
                            <button type="reset" class="button cancel-button">
                                <i class="fa fa-times" aria-hidden="true"></i> Clear Form
                            </button>

                            <button id="search-btn" type="submit" class="button ">
                                <i class="fa fa-search" aria-hidden="true"></i> Search
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>

@include('layouts.partials.react-script', ['script' => 'admin/projects'])


<script>
    $(document).ready(function() {
        $('button#toggle-collapse').on('click', function() {
            $('div#filter-form').animate({opacity: 'toggle', height: 'toggle'}, 250, "linear");

            var $chevron = $('i#collapse-chevron');
            $chevron.toggleClass('fa-angle-double-up fa-angle-double-down');
        });
    });
</script>