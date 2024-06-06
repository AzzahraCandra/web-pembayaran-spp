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
                                        <h3>Reset Password</h3>
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

                                    <form method="post" action="{{ route('password.update') }}">
                                        {{ csrf_field() }}
                                        <input type="text" value="{{ request()->token }}" class="d-none" name="token">
                                        <input type="text" value="{{ request()->email }}" class="d-none" name="email">
                                        <div class="form-group">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Enter Password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation" class="form-label">Password
                                                Confirmation</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="form-control" placeholder="Re-enter Password" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Update
                                                Password</button>
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
