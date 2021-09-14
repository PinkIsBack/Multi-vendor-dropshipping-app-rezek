<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DropX </title>
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png"/>
    <link href="{{ asset('assets/css/pace.min.css')}}" rel="stylesheet"/>
    <script src="{{ asset('assets/js/pace.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css')}}"/>
    <link rel="stylesheet" href="{{ asset("assets/css/app.css")}}"/>
</head>

<body class="bg-forgot  pace-done">
<div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99"
         style="transform: translate3d(100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
</div>
<!-- wrapper -->
<div class="wrapper">
    <div class="authentication-forgot d-flex align-items-center justify-content-center">
        <div class="card shadow-lg forgot-box">
            <div class="card-body p-md-5">
                <div class="text-center">
                    <img src="{{ asset('assets/images/icons/forgot-2.png')}}" width="140" alt="">
                </div>
                <h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
                <p class="text-muted">Enter your registered email ID to reset the password</p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group mt-5">
                        <label>Email</label>
                        <input id="email" type="email" placeholder="example@user.com"
                               class="form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block radius-30">Send</button>
                </form>
                <a href="{{ route('login') }}" class="btn btn-link btn-block"><i class="bx bx-arrow-back mr-1"></i>Back
                    to Login</a>
            </div>
        </div>
    </div>
</div>


</body>
</html>

