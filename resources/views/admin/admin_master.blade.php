<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.body.head')
  </head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

<div class="wrapper">

    @include('admin.body.header')

  <!-- Left side column. contains the logo and sidebar -->
    @include('admin.body.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    @yield('admin')

  </div>
  <!-- /.content-wrapper -->
  @include('admin.body.footer')

  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

	<!-- Vendor JS -->
    @include('admin.body.script')
</body>
</html>
