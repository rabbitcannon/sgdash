@extends('layouts.admin.index')

@section('content')
    {{--{{ App\Project::pluck('created_at') }}--}}
    <div id="comment-underlay"></div>

    @include('admin.projects.partials.project-list')
@stop