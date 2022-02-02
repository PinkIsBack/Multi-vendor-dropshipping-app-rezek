<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ZA Dropship Login</title>
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png"/>
    <link href="{{ asset('assets/css/pace.min.css')}}" rel="stylesheet"/>
    <script src="{{ asset('assets/js/pace.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css')}}"/>
    <link rel="stylesheet" href="{{ asset("assets/css/app.css")}}"/>
</head>

<body class="bg-login  pace-done">
<div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99"
         style="transform: translate3d(100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
</div>
<!-- wrapper -->
<div class="wrapper">
    <div class="d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-12 col-lg-10 mx-auto">
                <div class="card radius-15">
                    <div class="row no-gutters">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5">
                                <div class="text-center">
                                    <img src="{{ asset('assets/images/logo-icon.png')}}" width="80" alt="">
                                    <h3 class="mt-4 font-weight-bold">Welcome</h3>
                                </div>
                                <div class="input-group shadow-sm rounded mt-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent border-0 cursor-pointer">
                                            <img src="https://cdn3.iconfinder.com/data/icons/social-media-2068/64/_shopping-512.png" alt="" width="16">
                                        </span>
                                    </div>
                                    <input type="button"  class="form-control  border-0"  onclick="window.location.href='{{url('app/login')}}'" value="Log in with Shopify store">
                                </div>
                                <div class="login-separater text-center"> <span>OR LOGIN WITH EMAIL</span>
                                    <hr>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                <div class="form-group mt-4">
                                    <label>Email Address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="form-group col text-right">
                                        <a href="{{ route('password.request') }}"><i class="bx bxs-key mr-2"></i>Forget
                                            Password?</a>
                                    </div>
                                </div>
                                <div class="btn-group mt-3 w-100">
                                    <button type="submit" class="btn btn-primary btn-block">Log In</button>
                                </div>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <p class="mb-0">Don't have an account? <a href="{{ route('register') }}">Sign up</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img src="{{ asset('assets/images/login-images/login-frent-img.jpg')}}" class="card-img login-img h-100 d-md-block d-sm-none "
                                 alt="...">
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

