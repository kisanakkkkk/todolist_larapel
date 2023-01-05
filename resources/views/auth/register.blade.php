@extends('app')

@section('title', 'Register - Todolist Laravel')

@section('import')
    @vite(['resources/css/auth/register.scss', 'resources/js/auth/register.ts'])
@endsection

@section('content')
    <div class="container pt-2 pb-2">
        <h2 class="text-center mt-5 mb-5">Register</h2>
        <div class="inner-container">
            <form action="{{ route('post_register') }}" method="POST" id="register-form" class="text-center d-flex flex-column justify-content-center">
                @csrf
                <div class="mb-3 form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="mt-2 form-control" value="{{ old('username') }}">
                    <span class="error" id="error-username">{{ $errors->first('username') }}</span>
                </div>
                <div class="mb-3 form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="mt-2 form-control" value="{{ old('email') }}">
                    <span class="error" id="error-email">{{ $errors->first('email') }}</span>
                </div>
                <div class="mb-3 form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="mt-2 form-control">
                    <span class="error" id="error-password">{{ $errors->first('password') }}</span>
                </div>
                <div class="mb-3 form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm-password" class="mt-2 form-control">
                    <span class="error" id="error-confirm-password">{{ $errors->first('confirm_password') }}</span>
                </div>
                <button class="btn btn-primary mt-3" name="login" value="Login">Register</button>
            </form>
        </div>
    </div>
@endsection
