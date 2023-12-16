@extends('layout.app')

@section('title', 'Register - Task Manager')

@section('content')
    <div class="container">
         <div class="row my-4">
            <div class="col-12 text-center">
                <h2>Register</h2>
                <strong>Register here.</strong>
            </div>
        </div>
        <div class="row my-4 justify-content-center">
            <div class="card">
              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif
                <div class="card-body">
                  <form action="{{ route('register.user')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp" aria-required="true" placeholder="Name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <small id="nameHelp">Enter your name.</small>
                    </div>
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
                    <button type="submit" class="btn btn-primary">Register</button>
                    <hr>
                    <a href="{{route('login.view')}}"> Already Registered !! Login here..</a>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection
