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
                                        <img src="/images/undraw_forgot_password_re_hxwm.svg" alt="Logo"
                                            style="width: 250px; height: auto; margin-bottom:40px;">
                                        <h3>Forgot Your Password?</h3>
                                        <p>Please enter your mail to password reset request</p>
                                    </div>
                                    <h4 class="card-title text-center mb-4 mt-1"></h4>
                                    <hr>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $errors)
                                                    <li>{{ $errors }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (session()->has('status'))
                                        <div class="alert alert-success">
                                            {{ session()->get('status') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('password.email') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="Enter email" required>

                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Request Password
                                                Reset</button>
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
