<div class="data-card-small" style="margin: 0px;">
    <div class="data-header">
        <div class="row">
            <div class="large-6">
                Add new project
            </div>
            <div class="large-6">
                <button class="close-button" data-close aria-label="Close modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>

    <div class="data-content">

        {{ Form::open(['url' => '/admin/project/create', 'class' => 'no-smoothState', 'method' => 'post']) }}

            <div class="row">
                <div class="large-12 columns">
                    <label>Project Code
                        <input type="text" name="project_code" placeholder="Project Code" value="{{ old('project_code') }}">
                    </label>

                    @if($errors->has('project_code'))
                        {!!  $errors->first('project_code', '<span class="failure-text is-visible">:message</span>') !!}
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label>Project Name
                        <input type="text" name="project_name" placeholder="Project Name" value="{{ old('project_name') }}">
                    </label>

                    <div>
                        @if($errors->has('project_name'))
                            {!! $errors->first('project_name', '<span class="failure-text is-visible">:message</span>') !!}
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label>Current Project Trend
                        {{  Form::select('trend_create', Config::get('projects.trend')) }}
                    </label>

                    <div>
                        @if($errors->has('trend_create'))
                            {!! $errors->first('trend_create', '<span class="failure-text is-visible">:message</span>') !!}
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label>
                        Development Manager
                    </label>

                    <select name="dev_manager" >
                        <option selected>-- Select One --</option>
                        @foreach($dev_managers as $dev_manager)
                            <option value="{!! $dev_manager->id !!}">
                                {!! $dev_manager->first_name !!} {!! $dev_manager->last_name !!}
                            </option>
                        @endforeach
                    </select>

                    <div>
                        @if($errors->has('dev_manager'))
                            {!! $errors->first('dev_manager', '<span class="failure-text is-visible">:message</span>') !!}
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label>
                        Account Manager
                    </label>

                    <select name="acct_manager" >
                        <option selected>-- Select One --</option>
                        @foreach($account_managers as $account_manager)
                            <option value="{!! $account_manager->id !!}">
                                {!! $account_manager->first_name !!} {!! $account_manager->last_name !!}
                            </option>
                        @endforeach
                    </select>

                    <div>
                        @if($errors->has('acct_manager'))
                            {!! $errors->first('acct_manager', '<span class="failure-text is-visible">:message</span>') !!}
                        @endif
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="large-12 columns">
                <label>
                    Project Manager
                </label>

                <select name="project_manager" >
                    <option selected>-- Select One --</option>
                    @foreach($project_managers as $project_manager)
                        <option value="{!! $project_manager->id !!}">
                            {!! $project_manager->first_name !!} {!! $project_manager->last_name !!}
                        </option>
                    @endforeach
                </select>

                <div>
                    @if($errors->has('project_manager'))
                        {!! $errors->first('project_manager', '<span class="failure-text is-visible">:message</span>') !!}
                    @endif
                </div>
            </div>
        </div>

            <div class="row">
                <div class="large-6 columns">
                    <label>REQ
                        <div class="row">
                            <div class="large-5 columns">
                                <input type="text" name="req_eta" placeholder="Date">
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-6 columns">
                                @if($errors->has('status_req'))
                                    {!!  $errors->first('req_eta', '<span class="failure-text is-visible">:message</span>') !!}
                                @endif
                            </div>
                        </div>
                    </label>

                    <div>
                        @foreach($statuses as $status)
                            <input type="radio" name="req_status" value="{!! $status->id !!}">
                            <label class="{!! strtolower($status->name) !!}">{{ $status->name }}</label>
                        @endforeach
                    </div>

                </div>

                <div class="large-6 columns">
                    <label>Dev
                        <div class="row">
                            <div class="large-5 columns">
                                <input type="text" name="dev_eta" placeholder="Date">
                            </div>
                        </div>
                    </label>

                    <div>
                        @foreach($statuses as $status)
                            <input type="radio" name="dev_status" value="{!! $status->id !!}">
                            <label class="{!! strtolower($status->name) !!}">{{ $status->name }}</label>
                        @endforeach
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <hr />
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns">
                    <label>QA
                        <div class="row">
                            <div class="large-5 columns">
                                <input type="text" name="qa_eta" placeholder="Date">
                            </div>
                        </div>
                    </label>

                    <div>
                        @foreach($statuses as $status)
                            <input type="radio" name="qa_status" value="{!! $status->id !!}">
                            <label class="{!! strtolower($status->name) !!}">{{ $status->name }}</label>
                        @endforeach
                    </div>

                </div>

                <div class="large-6 columns">
                    <label>UAT
                        <div class="row">
                            <div class="large-5 columns">
                                <input type="text" name="uat_eta" placeholder="Date">
                            </div>
                        </div>
                    </label>

                    <div>
                        @foreach($statuses as $status)
                            <input type="radio" name="uat_status" value="{!! $status->id !!}">
                            <label class="{!! strtolower($status->name) !!}">{{ $status->name }}</label>
                        @endforeach
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <hr />
                </div>
            </div>

            <div class="row">
                <div class="large-6 columns end">
                    <label>PROD
                        <div class="row">
                            <div class="large-5 columns">
                                <input type="text" name="prod_eta" placeholder="Date">
                            </div>
                        </div>
                    </label>

                    <div>
                        @foreach($statuses as $status)
                            <input type="radio" name="prod_status" value="{!! $status->id !!}">
                            <label class="{!! strtolower($status->name) !!}">{{ $status->name }}</label>
                        @endforeach
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="large-12 columns text-center pad-box">
                    <button type="submit" class="button">
                        <i class="fa fa-save" aria-hidden="true"></i> Save Project
                    </button>

                    <button type="reset" class="button cancel-button">
                        <i class="fa fa-times" aria-hidden="true"></i> Clear Form
                    </button>
                </div>
            </div>

            @if($errors->any())
                <script>
                    $(document).ready(function() {
                        $('#add-project-reveal').foundation('toggle');
                    });
                </script>
            @endif

        {{ Form::close() }}

    </div>
</div>


