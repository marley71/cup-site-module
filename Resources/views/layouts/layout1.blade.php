<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Smarty V3</title>
    <meta name="description" content="...">

    <meta name="viewport" content="width=device-width, maximum-scale=5, initial-scale=1, user-scalable=0">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <!-- up to 10% speed up for external res -->
    <link rel="dns-prefetch" href="https://fonts.googleapis.com/">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com/">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <!-- preloading icon font is helping to speed up a little bit -->
    <link rel="preload" href="/{{config('cupparis-site.public_path')}}/assets/fonts/flaticon/Flaticon.woff2" as="font" type="font/woff2" crossorigin>

    <link rel="stylesheet" href="/{{config('cupparis-site.public_path')}}/assets/css/core.min.css">
    <link rel="stylesheet" href="/{{config('cupparis-site.public_path')}}/assets/css/vendor_bundle.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap">

    <!-- favicon -->
    <link rel="shortcut icon" href="/{{$route_prefix}}/favicon.ico">
    <link rel="apple-touch-icon" href="demo.files/logo/icon_512x512.png">

    <link rel="manifest" href="/{{config('cupparis-site.public_path')}}/assets/images/manifest/manifest.json">
    <meta name="theme-color" content="#377dff">
    <style href="/admin/assets/css/cup_site.css"></style>
</head>

<body>
    <div id="wrapper">
        <!-- HEADER -->
        @include('cup_site.layout1.includes.header')
        <!-- /HEADER -->

        <!-- SUB-HEADER -->
        @include('cup_site.layout1.includes.sub-header')
        <!-- /SUB-HEADER -->

        @yield('content')

        <!-- Footer -->
        @include('cup_site.layout1.includes.footer')
        <!-- /Footer -->

    </div><!-- /#wrapper -->

<script src="/{{config('cupparis-site.public_path')}}/assets/js/core.min.js"></script>

</body>
</html>

