@extends('layouts.admin.index')

@section('content')

    <div class="row">
        <div class="large-12 columns">

            <div class="data-card-small">
                <div class="data-header">
                    <i class="fa fa-database" aria-hidden="true"></i> Environments
                </div>

                <div class="data-content">

                    <div class="row">

                        <div class="large-4 columns">
                            @include('admin.environments.partials.environments.req')
                        </div>

                        <div class="large-4 columns">
                            @include('admin.environments.partials.environments.dev')
                        </div>

                        <div class="large-4 columns">
                            @include('admin.environments.partials.environments.qa')
                        </div>

                    </div>

                    <div class="row">

                        <div class="large-4 columns">
                            @include('admin.environments.partials.environments.uat')
                        </div>

                        <div class="large-4 columns">
                            @include('admin.environments.partials.environments.prod')
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@stop