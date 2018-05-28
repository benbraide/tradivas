@extends('layouts.master')

@section('title', "Sign In")

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-5 tradivas-user-text">
                <h2>Create New Account</h2>
                <p>If you don't already have an account, create one to be able to:</p>
                <ul>
                    <li>Check out faster</li>
                    <li>Save multiple shipping addresses</li>
                    <li>Access your order history</li>
                    <li>Track new orders</li>
                    <li>Save items to your wishlist</li>
                </ul>
                <a href="/register" class="btn tradivas-btn">Sign Up</a>
            </div>
            <div class="col-7">
                <h2>Sign Into Your Account</h2>
                <form method="POST" action="/attempt_login" class="tradivas-user-form">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-3 col-form-label">Email</label>
                        <div class="col-9">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-3 col-form-label">Password</label>
                        <div class="col-9">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-check row">
                        <div class="col-9 offset-3">
                            <input type="checkbox" name="remember" class="form-check-input" id="dropdownCheck" checked>
                            <label class="form-check-label" for="dropdownCheck">Remember me</label>
                        </div>
                    </div>
                    <div class="col-9 offset-3 submit">
                        <button type="submit" class="btn login-btn tradivas-btn">Sign in</button>
                        <a href="/password">Forgot your Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection