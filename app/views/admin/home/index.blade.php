@extends('admin._layout')
@include('admin._alert')
@section('content')
	<div class="account-container">
    <div class="content clearfix">
        <form action="{{ route('admin.home') }}" method="post">
            <h1>Member Login</h1>
            <div class="login-fields">
                <p>Please provide your details</p>
                    @yield('error')
                    @yield('warning')
                    @yield('success')
                    @yield('info')
                <div class="field">
                    <label for="username">Email:</label>
                    <input class="login username-field" id="email" name="email" placeholder="Email" type="email" value="" autofocus>
                </div><!-- /field -->

                <div class="field">
                    <label for="password">Password:</label>
                    <input class="login password-field" id="password" name="password" placeholder="Password" type="password" value="">
                </div><!-- /password -->
            </div><!-- /login-fields -->

            <div class="login-actions">
                <span class="login-checkbox">
                <input class="field login-checkbox" id="remember" name="remember" tabindex="4" type="checkbox" value="First Choice"> <label class="choice" for="remember">Keep me signed in</label></span>
                <button class="button btn btn-success btn-large">Sign In</button>
            </div><!-- .actions -->
        </form>
    </div><!-- /content -->
</div><!-- /account-container -->

<div class="login-extra">
    <a href="#">Reset Password</a>
</div><!-- /login-extra -->
@stop