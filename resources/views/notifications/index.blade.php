@extends('layouts.main.index')

@section('content')


    <?php $user = \App\User::find(Auth::user()->id); ?>

    @include('notifications.partials.notification-list')

@stop