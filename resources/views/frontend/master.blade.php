<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.body.head')
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
    @include('frontend.body.header')
<!-- ============================================== HEADER : END ============================================== -->
    @yield('content')
<!-- /#top-banner-and-menu -->

<!-- ============================================================= FOOTER ============================================================= -->
    @include('frontend.body.footer')
<!-- ============================================================= FOOTER : END============================================================= -->

<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
    @include('frontend.body.script')
</body>
</html>
