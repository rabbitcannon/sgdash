@include('layouts.partials.ui.header')

<?php
  $get_path = Request::path();
  $new_path = str_replace('admin/', '', $get_path);
  $user = \App\User::find(Auth::user()->id);
?>

<section>
    <div class="row expanded">
        <div class="large-12 columns user-login-bar">
            <div class="row expanded">

                <div class="large-6 columns">
                    <span id="admin-header-text">
                        <a href="/admin">
                            SciPlay Admin
                        </a>
                    </span>&nbsp;

                </div>

                <div class="large-6 columns text-right">
                    @include('layouts.partials.ui.user-panel')
                </div>

            </div>
        </div>

    </div>
</section>

<section>
    <div class="row expanded">
        <div class="large-2 columns">
            @include('layouts.admin.partials.side-menu', ['position' => $new_path])
        </div>
        <div class="large-10 columns">
            {{-- START Content --}}
            {{--</div>--}}
            <div class="m-scene pad-box" id="main">
                <div class="m-header scene_element scene_element--fadein">
                    <div id="content-container">
                        <div>
                            @include('layouts.admin.partials.breadcrumb', ['position' => $new_path])
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
            {{-- END Content --}}
        </div>
    </div>
</section>

@include('layouts.partials.ui.footer')

