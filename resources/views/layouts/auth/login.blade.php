@extends('layouts.auth.index')

@section('content')

    <div id="body-overlay">
        <div id="login-container">

            <div class="row">
                <div class="large-4 large-offset-4 columns">

                    {{-- Login Panel START --}}

                    <div id="login-frame">

                        <div class="data-card-small shadowbox">
                            <div class="data-header">

                                <div class="row">
                                    <div class="large-3 columns">Login</div>
                                    <div class="large-9 columns text-right">
                                        <span style="font-size: 13px;">
                                            <div>
                                                <a id="register-link" href="#">
                                                    Register
                                                </a>
                                            </div>
                                            <div>
                                                <a href="#">
                                                    Forgot password
                                                </a>
                                            </div>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="data-content">

                                {{-- Login Panel START --}}

                                {!! Form::open(['url' => '/auth/login']) !!}

                                <div class="row">
                                    <div class="large-12 medium-12 small-12 columns">
                                        {!! Form::text('login_email', null, ['type' => 'text', 'id' => 'login_email', 'placeholder' => 'Email address']) !!}
                                        @if($errors->login->has('login_email'))
                                        {!!  $errors->login->first('login_email', '<span class="failure-text is-visible">:message</span>') !!}
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="large-12 medium-12 small-12 columns">
                                        <input id="login_password" name="login_password" type="password" placeholder="Password" />
                                        @if($errors->login->has('login_password'))
                                        {!!  $errors->login->first('login_password', '<span class="failure-text is-visible">:message</span>') !!}
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="large-12 medium-12 small-12 columns text-center">
                                        <div class="pad-button">
                                            <input type="submit" name="login_button" value="Login" class="button" />
                                        </div>
                                    </div>
                                </div>

                                {!! Form::close() !!}


                            </div>
                        </div>
                    </div>

                    {{-- Login Panel END --}}

                    {{-- Register Panel START --}}

                    <div id="register-frame" style="display: none;">

                        <div class="data-card-small shadowbox">
                            <div class="data-header">

                                <div class="row">
                                    <div class="large-3 columns">Register</div>
                                    <div class="large-9 columns text-right">
                                        <span style="font-size: 13px;">
                                            <div>
                                                <a id="cancel-link" href="#">
                                                    Cancel
                                                </a>
                                            </div>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="data-content">

                                {!! Form::open(['url' => '/register']) !!}

                                <div class="row">
                                    <div class="large-12 medium-12 small-12 columns">
                                        {!! Form::text('first_name', null, ['type' => 'text', 'id' => 'first_name', 'placeholder' => 'First Name']) !!}
                                        @if($errors->register->has('first_name'))
                                            {!! $errors->register->first('first_name', '<span class="failure-text is-visible">:message</span>') !!}
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="large-12 medium-12 small-12 columns">
                                        {!! Form::text('last_name', null, ['type' => 'text', 'id' => 'last_name', 'placeholder' => 'Last Name']) !!}
                                        @if($errors->register->has('last_name'))
                                            {!! $errors->register->first('last_name', '<span class="failure-text is-visible">:message</span>') !!}
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="large-12 medium-12 small-12 columns">
                                        {!! Form::text('register_email', null, ['type' => 'text', 'id' => 'register_email', 'placeholder' => 'Email address']) !!}
                                        @if($errors->register->has('register_email'))
                                            {!!  $errors->register->first('register_email', '<span class="failure-text is-visible">:message</span>') !!}
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="large-12 medium-12 small-12 columns">
                                        <input id="register_password" name="register_password" type="password" placeholder="Password" />
                                        @if($errors->register->has('register_password'))
                                            {!! $errors->register->first('register_password', '<span class="failure-text is-visible">:message</span>') !!}
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="large-12 medium-12 small-12 columns">
                                        <input id="register_password_confirmation" name="register_password_confirmation" type="password" placeholder="Confirm" />
                                        @if($errors->register->has('register_password_confirmation'))
                                            {!! $errors->register->first('register_password', '<span class="failure-text is-visible">:message</span>') !!}
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="large-12 medium-12 small-12 columns text-center">
                                        <div class="pad-button">
                                            <input type="submit" value="Register" class="button" />
                                        </div>
                                    </div>
                                </div>

                                @if($errors->register->any())
                                    <script>
                                        $(document).ready(function() {
                                            $('#register-frame').show();
                                            $('#login-frame').hide();
                                        });
                                    </script>
                                @endif

                                {!! Form::close() !!}


                            </div>
                        </div>
                    </div>

                    {{-- Register Panel END --}}

                </div>

            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('a#register-link').on('click', function(event) {
                event.preventDefault();

                $('div#login-frame').removeClass('slideInLeft').addClass('animated slideOutLeft').fadeOut(250);

                setTimeout(function () {
                    $('div#register-frame').removeClass('slideOutRight').addClass('animated slideInRight').fadeIn(300);
                }, 275);

            });
            $('a#cancel-link').on('click', function(event) {
                event.preventDefault();

                $('div#register-frame').removeClass('slideInRight').addClass('slideOutRight').fadeOut(250);

                setTimeout(function () {
                    $('div#login-frame').removeClass('slideOutLeft').addClass('slideInLeft').fadeIn(300);
                }, 275);

            });
        });
    </script>

@stop