<div class="data-card-small">
    <div class="data-header">
        Add a new project
    </div>

    <div class="data-content">

        <form action="/admin/project/create" class="no-smoothState">

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
                            {!!  $errors->first('project_name', '<span class="failure-text is-visible">:message</span>') !!}
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

        </form>

    </div>
</div>


