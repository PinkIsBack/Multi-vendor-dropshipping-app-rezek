<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Syndash - Bootstrap4 Admin Template</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset("assets/images/favicon-32x32.png")}}" type="image/png" />
    <!-- loader-->
    <link href="{{ asset("assets/css/pace.min.css")}}" rel="stylesheet" />
    <script src="{{ asset("assets/js/pace.min.js")}}"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.min.css")}}" />
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset("assets/css/icons.css")}}" />
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset("assets/css/app.css")}}" />
</head>

<body class="bg-forgot">
<!-- wrapper -->
<div class="wrapper">
    <div class="authentication-forgot d-flex align-items-center justify-content-center">
        <div class="card shadow-lg forgot-box">
            <div class="card-body p-md-5">
                <div class="text-center">
                    <img src="{{ asset("assets/images/icons/forgot-2.png")}}" width="140" alt="" />
                </div>
                <h4 class="mt-5 font-weight-bold"> {{ env('SHOPIFY_APP_NAME','Shopify App') }}</h4>
                <p class="text-muted">Enter your shop domain to log in or install this app.</p>
                <form action="{{ route('home') }}" accept-charset="UTF-8">
                <div class="form-group mt-5">
                    <label>Shop Domain</label>
                    <input type="text" name="shop"  required class="form-control form-control-lg radius-30" placeholder="example.myshopify.com" />
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block radius-30">Store Login</button> <a href="{{route('login')}}" class="btn btn-link btn-block"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end wrapper -->
</body>

</html>
