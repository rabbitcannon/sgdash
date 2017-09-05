@extends('layouts.admin.index')

@section('content')
    <h1>This is just a sample results return page, this needs to be brought into React display.</h1>


    <div>
        {{ count($projects) }}
    </div>


    <div class="data-table">
        <div class="data-table-header">
            <div class="row expanded">
                <div class="large-10 columns">
                    <i class="fa fa-bar-chart"></i> Current projects: <span class="counter">{{ count($projects) }}</span>
                </div>
                <div class="large-2 columns text-right">
                    <a class="no-smoothState" data-toggle="add-project-reveal">
                        <i class="fa fa-plus-circle"></i> Add
                    </a>
                </div>
            </div>
        </div>

        <div class="data-table-content">

            <table class="idtable">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>REQ</th>
                    <th>DEV</th>
                    <th>QA</th>
                    <th>UAT</th>
                    <th>PROD</th>
                    <th>Trend</th>
                    <th>Edit</th>
                </tr>
                </thead>

                <tbody>

                    @foreach($projects as $project)
                        <tr id="row-static">
                            <td>
                                {{ $project->code }}
                            </td>
                            <td>
                                <div>
                                    {{ $project->name }}
                                </div>
                                <div class="comment-container">
                                    <a href="#">
                                        <small><i class="fa fa-comments"></i> comments: {{ count($project->comments) }}</small>
                                    </a>
                                </div>
                            </td>
                            <td>
                            <span class={{ $project->req_status }}>
                                {{ $project->req_eta }}
                            </span>
                            </td>
                            <td>
                            <span class={this.classSetter(this.state.dev_status)}>
                                {{ $project->dev_eta }}
                            </span>
                            </td>
                            <td>
                            <span class={this.classSetter(this.state.qa_status)}>
                                {{ $project->qa_eta }}
                            </span>
                            </td>
                            <td>
                            <span class={this.classSetter(this.state.uat_status)}>
                                {{ $project->uat_eta }}
                            </span>
                            </td>
                            <td>
                            <span class={this.classSetter(this.state.prod_status)}>
                                {{ $project->prod_eta }}
                            </span>
                            </td>
                            <td width="15">
                            <span class={this.classTrendSetter(this.state.trend)}>
                                <i class="fa fa-2x fa-arrow-circle-{{ $project->trend }}"></i>
                            </span>
                            </td>
                            <td width="50" class="text-center">
                                <button id="initiate-edit" onClick={this.edit.bind(this)}>
                                    <i class="fa fa-pencil-square-o fa-2x"></i>
                                </button>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

        </div>
    </div>

@stop