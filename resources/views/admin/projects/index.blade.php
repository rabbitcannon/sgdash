@extends('layouts.admin.index')

@section('content')
    <style>
        .small-list {
            height: 25px;
            overflow: hidden;
        }

        .big-list {
            height: auto;
        }
    </style>

    <div id="comment-underlay"></div>

    @include('admin.projects.partials.project-list')
@stop