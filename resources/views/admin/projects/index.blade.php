@extends('layouts.admin.index')

@section('content')
{{--    {{ \App\User::whereHas('role', function ($query) { $query->where('role_id', '=', 7); })->pluck('id') }}--}}
    @include('admin.projects.partials.filter-results')
    @include('admin.projects.partials.project-list')
@stop