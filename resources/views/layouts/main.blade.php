<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Mainsystem &rsaquo; @yield('title') &mdash; @yield('sub-title')</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  {{-- <link rel="stylesheet" href="../node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css"> --}}
  {{-- <link rel="stylesheet" href="../node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css"> --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.bootstrap4.min.css"/>

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('stisla-master/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('stisla-master/assets/css/components.css')}}">

  {{-- Datepicker Dependencies --}}

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

  {{-- Custom Clock Dependencies --}}
  <link rel="stylesheet" href="{{asset('custom/Jam.css')}}">
  <script src="{{asset('custom/Jam.js')}}"></script>
  {{-- <link rel="stylesheet" href="{{asset('custom/Jam2.css')}}"> --}}
  <script src="{{asset('custom/Jam2.js')}}"></script>

</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        @include('layouts.topnav')
      </nav>
      <div class="main-sidebar">
        @include('layouts.sidebar')
      </div>

      <!-- Main Content -->
      <div class="main-content">
        @include('sweetalert::alert')
        @yield('content')
      </div>
      @include('layouts.footer')
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{asset('stisla-master/assets/js/stisla.js')}}"></script>

  <!-- JS Libraies -->
  {{-- <script src="../node_modules/datatables/media/js/jquery.dataTables.min.js"></script> --}}
  {{-- <script src="../node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script> --}}
  {{-- <script src="../node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script> --}}
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>



  <!-- Template JS File -->
  <script src="{{asset('stisla-master/assets/js/scripts.js')}}"></script>
  <script src="{{asset('stisla-master/assets/js/custom.js')}}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('stisla-master/assets/js/page/bootstrap-modal.js')}}"></script>
  <script src="{{asset('stisla-master/assets/js/page/modules-datatables.js')}}"></script>
  <script src="{{asset('stisla-master/assets/js/page/components-user.js')}}"></script>
  <script src="{{asset('stisla-master/assets/js/page/modules-sweetalert.js')}}"></script>


  @yield('footer')

</body>
</html>
