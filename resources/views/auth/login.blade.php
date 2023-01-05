@extends('app')

@section('title', 'Login - Todolist Laravel')

@section('import')
    @vite(['resources/css/auth/login.scss', 'resources/js/auth/login.ts'])
@endsection

@section('content')

    @if (Session::has('register_success'))
        <div class="alert alert-success" role="alert">
            {{ session('register_success') }}
        </div>
    @endif

    @error('login_failed')
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('login_failed') }}
        </div>
    @enderror

    <div class="container pt-2 pb-2">
        <h2 class="text-center mt-5 mb-5">Login</h2>
        <div class="inner-container">
            <form action="{{ route('post_login') }}" method="POST" class="text-center d-flex flex-column justify-content-center">
                @csrf
                <div class="mb-3 form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required class="mt-2 form-control">
                    <span class="error"></span>
                </div>
                <div class="mb-3 form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required class="mt-2 form-control">
                </div>
                <button class="btn btn-primary mt-3" name="login" value="Login">Login</button>
            </form>
        </div>
    </div>
@endsection
