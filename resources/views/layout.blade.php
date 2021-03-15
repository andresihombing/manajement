<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Alvin Bengkel</title>
  
  <link rel="stylesheet" href="/bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css">  
  <link rel="stylesheet" href="/bower_components/admin-lte/dist/css/adminlte.min.css">  
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('style')
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    @include('header')
    <!-- Main Sidebar Container -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">            
      <!-- /.content-header -->      
      @yield('content')
    </div>


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">      
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>    

    <!-- Main Footer -->
    @include('footer')
  </div>  

  <!-- REQUIRED SCRIPTS -->
  
  <script src="/bower_components/admin-lte/plugins/jquery/jquery.min.js"></script>  
  <script src="/bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>  
  <script src="/bower_components/admin-lte/dist/js/adminlte.min.js"></script>  
  @yield('script')
</body>

</html>