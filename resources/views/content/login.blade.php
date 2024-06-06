@extends('Layout.layout-login')

@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="p-5 mb-3">
                                    <div class="text-center">
                                        <img src="/images/logo.png" alt="Logo"
                                            style="width: 250px; height: auto; margin-bottom:40px;">
                                        <h3>Selamat Datang!</h3>
                                    </div>
                                    <h4 class="card-title text-center mb-4 mt-1"></h4>
                                    <hr>
                                    <form method="POST" action="{{ url('/post-login') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="Enter email" required>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Password" required>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                        <div class="form-group">
                                            <a href="{{ url('/forgot-password') }}">Forgot Password?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
