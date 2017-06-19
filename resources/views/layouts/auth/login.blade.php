@extends('layouts.auth.index')

@section('content')

    <div id="body-overlay">
        <div id="login-container">

            <div class="row">
                <div class="large-4 large-offset-4 columns">

                    <div class="data-card-small shadowbox">
                        <div class="data-header">

                            <div class="row">
                                <div class="large-3 columns">Login</div>
                                <div class="large-9 columns text-right">
                                    <span style="font-size: 13px;">
                                        <a href="#">
                                            Forgot password?
                                        </a>
                                    </span>
                                </div>
                            </div>

                        </div>
                        <div class="data-content">

                            {!! Form::open(['url' => '/auth/login']) !!}

                            <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    {!! Form::text('login_email', null, ['type' => 'text', 'id' => 'login_email', 'placeholder' => 'Email address']) !!}
                                    @if($errors->has('login_email'))
                                    {!!  $errors->first('login_email', '<span class="failure-text is-visible">:message</span>') !!}
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="large-12 medium-12 small-12 columns">
                                    <input id="login_password" name="login_password" type="password" placeholder="Password" />
                                    @if($errors->has('login_password'))
                                    {!!  $errors->first('login_password', '<span class="failure-text is-visible">:message</span>') !!}
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="large-12 medium-12 small-12 columns text-center">
                                    <div class="pad-button">
                                        <input type="submit" value="Login" class="button" />
                                    </div>
                                </div>
                            </div>


                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@stop