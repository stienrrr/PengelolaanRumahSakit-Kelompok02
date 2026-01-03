@extends('auth.main-auth', ['title' => 'Login'])

@section('content')
    <div class="card my-5 col-xl-9 col-xxl-8 mx-auto rounded-4 overflow-hidden p-4">
        <div class="row g-4">
            <div class="col-lg-6 d-flex">
                <div class="card-body">
                    <img src="{{ asset('dashboard/assets/images/logo1.png') }}" class="mb-4" width="145" alt="">
                    <h4 class="fw-bold">Get Started Now</h4>
                    <p class="mb-0">Enter your credentials to login your account</p>
                    <div class="form-body mt-4">
                        <form class="row g-3" action="{{ route('authenticate') }}" method="POST">
                            @csrf
                            <div class="col-12">
                                <label for="inputEmailAddress" class="form-label">Email / Username</label>
                                <input type="text" class="form-control" id="inputEmailAddress" name="account"
                                    placeholder="Enter account has been registered..." required>
                            </div>
                            <div class="col-12">
                                <label for="inputChoosePassword" class="form-label">Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" class="form-control border-end-0" id="inputChoosePassword"
                                        placeholder="********" placeholder="Enter Password" name="password" required>
                                    <a href="javascript:;" class="input-group-text bg-transparent"><i
                                            class="bi bi-eye-slash-fill"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                </div>
                            </div>
                            {{-- <div class="col-md-6 text-end"> <a href="auth-boxed-forgot-password.html">Forgot Password ?</a>
                            </div> --}}
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-grd-primary">Login</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-start">
                                    <p class="mb-0">Don't have an account yet? <a href="{{ route('register') }}">Sign up
                                            here</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-lg-flex d-none">
                <div class="p-3 rounded-4 w-100 d-flex align-items-center justify-content-center bg-grd-primary">
                    <img src="{{ asset('dashboard/assets/images/auth/login1.png') }}" class="img-fluid" alt="">
                </div>
            </div>

        </div><!--end row-->
    </div>
@endsection
