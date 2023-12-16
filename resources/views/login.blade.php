@extends('layout.app')

@section('title', 'Login - Task Manager')

@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col-12 text-center">
                <h2>Login</h2>
                <strong>login here.</strong>
            </div>
        </div>
        <div class="row my-4 justify-content-center">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <form action="{{ route('login.user')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <small id="emailHelp" class="form-text">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" aria-describedby="passwordHelp" placeholder="Password">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <small id="passwordHelp">Enter your password.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                        <hr>
                        <a href="{{route('register.view')}}"> Not Registered User !! Register here..</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
