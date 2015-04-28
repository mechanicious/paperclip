@extends('admin._layout')
@include('admin._alert')
@section('content')
	<div class="account-container">
    <div class="content clearfix">
        <form action="{{ route('admin.create') }}" method="post">
            <h1>Member Signup</h1>
            <div class="login-fields">
                <p>Please provide your details</p>

                    <!-- Alerts -->
                    @yield('error')
                    @yield('warning')
                    @yield('success')
                    @yield('info')

                <div class="field">
                    <label for="authtoken">Authentication token:</label>
                    <input class="login password-field" id="authtoken" name="authtoken" placeholder="Authtoken" type="password" value="" autofocus>
                </div><!-- /auth -->

                <div class="field">
                    <label for="firstname">Firstname:</label>
                    <input class="login username-field" id="firstname" name="firstname" placeholder="Firstname" type="text" 
                    value="{{ Session::get('input.firstname') }}">
                </div><!-- /field -->

                <div class="field">
                    <label for="lastname">Lastname:</label>
                    <input class="login username-field" id="lastname" name="lastname" placeholder="Lastname" type="text" 
                    value="{{Session::get('input.lastname') }}">
                </div><!-- /field -->
    
                <div class="field">
                    <label for="email">Email:</label>
                    <input class="login username-field" id="email" name="email" placeholder="Email" type="email" 
                    value="{{ Session::get('input.email') }}">
                </div><!-- /field -->

                <div class="field">
                    <label for="password">Password:</label>
                    <input class="login password-field" id="password" name="password" placeholder="Password" type="password" 
                    value="">
                </div><!-- /password -->

                <div class="field">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input class="login password-field" id="password_confirmation" name="password_confirmation" placeholder="Password" type="password" value="">
                </div><!-- /password -->
            </div><!-- /login-fields -->

            <div class="login-actions">
                <!-- <span class="login-checkbox">
                <input class="field login-checkbox" id="Field" name="Field" tabindex="4" type="checkbox" value="First Choice"> <label class="choice" for="Field">Keep me signed in</label></span> -->
                <button class="button btn btn-success btn-large">Sign Up</button>
            </div><!-- .actions -->
        </form>
    </div><!-- /content -->
</div><!-- /account-container -->
@stop