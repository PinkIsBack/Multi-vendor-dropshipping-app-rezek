<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ZA Dropship Register</title>

    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png"/>
    <link href="{{ asset('assets/css/pace.min.css')}}" rel="stylesheet"/>
    <script src="{{ asset('assets/js/pace.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css')}}"/>
    <link rel="stylesheet" href="{{ asset("assets/css/app.css")}}"/>
</head>

<body class="bg-register  pace-done">
<div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99"
         style="transform: translate3d(100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
</div>
<!-- wrapper -->
<div class="wrapper">
    <div class=" d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-12 col-lg-10 mx-auto">
                <div class="card radius-15">
                    <div class="row no-gutters">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5">
                                <div class="text-center">
                                    <img src="{{ asset('assets/images/logo-icon.png')}}" width="80" alt="">
                                    <h3 class="mt-4 font-weight-bold">Create an Account</h3>
                                </div>
                                @include('layouts.flash_message')
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group mt-4">
                                        <label>Email Address</label>
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" required autocomplete="email"
                                               placeholder="example@user.com">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') }}" required autocomplete="name" autofocus
                                               placeholder="eg: Jhon Doe">

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>

                                        <div class="input-group" id="show_hide_password">
                                            <input id="password" type="password"
                                                   class="border-right-0 form-control @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="new-password">
                                            <div class="input-group-append"><a href="javascript:;"
                                                                               class="input-group-text bg-transparent border-left-0"><i
                                                        class="bx bx-hide"></i></a>
                                            </div>
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Confirm Password</label>

                                        <div class="input-group" id="show_hide_password">
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required autocomplete="new-password">
                                            <div class="input-group-append"><a href="javascript:;"
                                                                               class="input-group-text bg-transparent border-left-0"><i
                                                        class="bx bx-hide"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">I read and agree to
                                                Terms
                                                &amp; Conditions</label>
                                        </div>
                                    </div>
                                    <div class="btn-group mt-3 w-100">
                                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center mt-4">
                                    <p class="mb-0">Already have an account? <a
                                            href="{{ route('login') }}">Login</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img src="{{ asset('assets/images/login-images/register-frent-img.jpg')}}"
                                 class="card-img login-img h-100 d-lg-block d-md-block d-sm-none d-none" alt="...">
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </div>
</div>

<!--Password show & hide js -->
<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>


</body>
</html>

