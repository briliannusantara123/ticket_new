<!DOCTYPE html>
<html lang="en">
<head>
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>MSI Ticket</title>

  <!-- General CSS Files -->
  <link rel="shortcut icon" href="img/hero/hero-right.png">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css"/>


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css"
        integrity="sha256-pODNVtK3uOhL8FUNWWvFQK0QoQoV3YA9wGGng6mbZ0E=" crossorigin="anonymous" />
        <script type="text/javascript" src="jquery.js"></script>

  

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">
  <style type="text/css">
    
    footer a{
      color: lightblue;
    }
  </style>
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto" method="GET" action="/barang">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            
          </ul>
          <div class="search-element">
            
            <div class="search-backdrop"></div>
           
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{asset('../assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi,{{auth()->user()->username}} </div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="/" class="dropdown-item has-icon text-primary">
                <i class="fas fa-home"></i> Kembali Ke Halaman Utama
              </a>
              <a href="/logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
              
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#">MSI Ticket</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="#"><img src="img/wk.png" alt="" style="width: 30px;height: 30px;"></a>
          </div>
          <ul class="sidebar-menu">
            @if (Auth()->user()->role == '1')
              <li><a href="/dashboard" class=""><i class="fa fa-fire"></i> <span>Dashboard</span></a></li>
              <li class="menu-header">Starter</li>
                <li class="nav-item dropdown">
              
              
              <li class="nav-item dropdown">
                <li><a href="/requestheader" class=""><i class="fas fa-book"></i> <span>Request</span></a></li>
              </li>
          </li>
        </ul>
      </aside>
             
  @endif

@if (Auth()->user()->role == '2')
              <li><a href="/dashboard" class=""><i class="fa fa-fire"></i> <span>Dashboard</span></a></li>
              <li class="menu-header">Starter</li>
                <li class="nav-item dropdown">
              
              
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master</span></a>
                <ul class="dropdown-menu">

                <li><a href="/company" class=""><i class="fas fa-home"></i> <span>Company</span></a></li>
                <li><a href="/jabatan" class=""><i class="fas fa-book"></i> <span>Jabatan</span></a></li>
              <li><a href="/paket" class=""><i class="fas fa-book"></i> <span>Paket</span></a></li>
              <li><a href="/typesupport" class=""><i class="fas fa-book"></i> <span>Type Support</span></a></li>
              <li><a href="/projects" class=""><i class="fas fa-book"></i> <span>Projects</span></a></li>
              <li><a href="/users" class=""><i class="fas fa-users"></i> <span>Users</span></a></li>
                </ul>
              <li><a href="/transaksi" class=""><i class="fas fa-book"></i> <span>Transaksi</span></a></li>
              <li><a href="/requestheader" class=""><i class="fas fa-book"></i> <span>Request</span></a></li>
              
            </li>
          </li>
        </ul>
      </aside>
             
  @endif
  @if (Auth()->user()->role == '3')
  <li><a href="/dashboard" class=""><i class="fa fa-fire"></i> <span>Dashboard</span></a></li>
              <li class="menu-header">Starter</li>
    <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Master</span></a>
                <ul class="dropdown-menu">

                <li><a href="/company" class=""><i class="fas fa-home"></i> <span>Company</span></a></li>
                <li><a href="/users" class=""><i class="fas fa-users"></i> <span>Users</span></a></li>
              
                </ul>
                <li><a href="/requestheader" class=""><i class="fas fa-book"></i> <span>Request</span></a></li>
  @endif
  @if (Auth()->user()->role == '4')
              <li><a href="/dashboard" class=""><i class="fa fa-fire"></i> <span>Dashboard</span></a></li>
              <li class="menu-header">Starter</li>
                <li class="nav-item dropdown">
              <!-- <li><a href="/transaksi" class=""><i class="fas fa-book"></i> <span>Transaksi</span></a></li> -->
              <li><a href="/requestheader" class=""><i class="fas fa-book"></i> <span>Request</span></a></li>
              <li><a href="/transaksi" class=""><i class="fas fa-book"></i> <span>History Transaksi</span></a></li>
              
  @endif
            

            
        </aside>
      </div>
      <!-- Main Content -->
      @yield('content')
          <div class="section-body">
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2020 <div class="bullet"></div> Website By <a href="https://www.instagram.com/briliansatrian_10/">Brilian Satria Nusantara</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>




  <!-- JS Libraies -->
@yield('footer')
  <!-- Template JS File -->
 <script src="{{asset('../assets/js/scripts.js')}}"></script>
  <script src="{{asset('../assets/js/custom.js')}}"></script>
  <script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable({
      order: [[ 3, 'desc' ], [ 0, 'asc' ]],
      processing:true,
      serverside:true,
      responsive:true,
      dom: 'Bfrtip',
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    });

} );
  </script>
  
  </script>
  <script >
    @if (Session::has('warning'))       
    toastr.warning("{{Session::get('warning')}}", "Warning")

    @endif
  </script>

  <!-- Page Specific JS File -->
</body>
</html>
