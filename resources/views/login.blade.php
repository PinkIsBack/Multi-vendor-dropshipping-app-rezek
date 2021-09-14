<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopify App — Installation</title>

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        *{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box}body{padding:2.5em 0;color:#212b37;font-family:-apple-system,BlinkMacSystemFont,San Francisco,Roboto,Segoe UI,Helvetica Neue,sans-serif}.container{width:100%;text-align:center;margin-left:auto;margin-right:auto}@media screen and (min-width:510px){.container{width:510px}}.title{font-size:1.5em;margin:2em auto;display:flex;align-items:center;justify-content:center;word-break:break-all}.subtitle{font-size:.8em;font-weight:500;color:#64737f;line-height:2em}.error{line-height:1em;padding:.5em;color:red}input.marketing-input{width:100%;height:52px;padding:0 15px;box-shadow:0 0 0 1px #ddd;border:0;border-radius:5px;background-color:#fff;font-size:1em;margin-bottom:15px}input.marketing-input:focus{color:#000;outline:0;box-shadow:0 0 0 2px #5e6ebf}button.marketing-button{display:inline-block;width:100%;padding:1.0625em 1.875em;background-color:#5e6ebf;color:#fff;font-weight:700;font-size:1em;text-align:center;outline:0;border:0 solid transparent;border-radius:5px;cursor:pointer}button.marketing-button:hover{background:linear-gradient(to bottom,#5c6ac4,#4959bd);border-color:#3f4eae}button.marketing-button:focus{box-shadow:0 0 .1875em .1875em rgba(94,110,191,.5);background-color:#223274;color:#fff}
    </style>
</head>
<body>

<main class="container" role="main">
    <h3 class="title">
        {{ env('SHOPIFY_APP_NAME','Shopify App') }}


    </h3>
    <p class="subtitle">
        <label for="shop">Enter your shop domain to log in or install this app.</label>
    </p>

    <form action="{{ route('home') }}" accept-charset="UTF-8">

        <input id="shop" name="shop" type="text" autofocus="autofocus" placeholder="example.myshopify.com" class="marketing-input">
        <button type="submit" class="marketing-button">Install</button>
    </form>
</main>

</body>
</html>
