<div class="row">

    <div class="large-12 columns">
        <div class="data-card-small">
            <div class="data-header">
                Add a new user
            </div>

            <div class="data-content">
                <form id="user-create-form" method="post" action="/users/create">
                    <div class="row">
                        <div class="large-12 columns end">
                            <label>First Name
                                <input type="text" name="first_name" placeholder="First Name">
                            </label>

                            @if($errors->has('first_name'))
                                {!!  $errors->first('first_name', '<span class="failure-text is-visible">:message</span>') !!}
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="large-12 columns end">
                            <label>Last Name
                                <input type="text" name="last_name" placeholder="Last Name">
                            </label>

                            @if($errors->has('last_name'))
                                {!!  $errors->first('last_name', '<span class="failure-text is-visible">:message</span>') !!}
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="large-12 columns end">
                            <label>Role
                                <?php $roles = \App\Role::all(); ?>

                                <select name="role">
                                    @foreach($roles as $role)
                                        <option value="{!! $role->id !!}">{!! $role->name !!}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="large-12 columns end">
                            <label>Jurisdiction Type
                                Dropdown
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="large-12 columns end">
                            <label>Email Address
                                <input type="text" name="email" placeholder="Email Address">
                            </label>

                            @if($errors->has('email'))
                                {!!  $errors->first('email', '<span class="failure-text is-visible">:message</span>') !!}
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="large-12 columns">

                            <label>Generate Password
                                <input type="text" name="password" id="password" placeholder="Generate password">
                                <input type="button" class="button" value="Generate" onclick="createPassword()">
                            </label>

                        </div>

                    </div>

                    <div class="row">
                        <div class="large-12 columns text-center">
                            <input type="submit" class="button" value="Add User">
                            <input type="button" class="button" value="Clear Form" onclick="resetForm()">
                        </div>
                    </div>

                    @if($errors->any())
                        <script>
                            $(document).ready(function() {
                                $('#add-user-reveal').foundation('toggle');
                            });
                        </script>
                    @endif

                    {{ csrf_field() }}

                </form>

                {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

                <script>
                    function createPassword() {
                        var random_number = Math.floor(Math.random() * (16 - 8 + 1)) + 8;
                        var password = '';
                        var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!?#<>%$()';

                        for( var i=0; i < random_number; i++ )
                            password += possible.charAt(Math.floor(Math.random() * possible.length));

                        document.getElementById('password').value = password;
                    }

                    function resetForm() {
                        document.getElementById('user-create-form').reset();
                    }
                </script>
            </div>
        </div>
    </div>

</div>