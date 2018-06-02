@extends('layouts.master')

@section('title', "Sign Up")

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-5 tradivas-user-text">
                <h2>Sign Into Your Account</h2>
                <p>If you already have an account, sign in</p>
                <a href="/login" class="btn tradivas-btn">Sign In</a>
            </div>
            <div class="col-7">
                <h2>Create New Account</h2>
                <form method="POST" action="/attempt_register" class="tradivas-user-form">
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
                    <div class="form-group row">
                        <label for="password_confirm" class="col-3 col-form-label">Confirm Password</label>
                        <div class="col-9">
                            <input type="password" id="password_confirm" name="password_confirmation" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="col-9 offset-3 submit">
                        <button type="submit" class="btn login-btn tradivas-btn">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
