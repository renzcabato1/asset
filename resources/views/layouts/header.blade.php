<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
  <link rel="shortcut icon" href="{{asset('images/icon.png')}}">
  <!-- Template CSS -->
  
  <link rel="stylesheet" href="{{asset('assets/bundles/select2/dist/css/select2.min.css')}}"> 
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  
  <style>
    .zoom:hover {
      transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .pointer {cursor: pointer;}
    
    /* Firefox */
    input[type=number] {
        -moz-appearance:textfield;
    }
    .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url("{{ asset('/images/3.gif')}}") 50% 50% no-repeat rgb(249,249,249) ;
        opacity: .8;
        background-size:120px 120px;
    }
    @media (min-width: 768px) {
        .modal-xl {
            width: 100%;
            max-width:1700px;
        }
    }
    #employees-table_filter
    {
      text-align: right;
    }
    #employees-table_filter label
    {
      text-align: left;
    }
    #transaction-table_filter
    {
      text-align: right;
    }
    #transaction-table_filter label
    {
      text-align: left;
    }
    #accountability-table_filter
    {
      text-align: right;
    }
    #accountability-table_filter label
    {
      text-align: left;
    }
</style>
</head>

<body>
  <div id = "myDiv" class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i data-feather="align-justify"></i></a>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="{{'images/no_image.png'}}" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello {{auth()->user()->name}}</div>
              <a href="profile.html" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
              </a> <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                Activities
              </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}"  onclick="logout(); show();" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
              <form id="logout-form"  action="{{ route('logout') }}"  method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="{{asset('images/icon.png')}}" class="header-logo" /> <span
                class="logo-name">AIMS</span>
            </a>
          </div>
            <ul class="sidebar-menu">
              <li class="menu-header">Transactions</li>
              <li class="dropdown  @if($header == "Dashboard") active @endif">
                <a href="{{ url('/') }}" class="nav-link" onclick='show();'><i data-feather="monitor"></i><span>Dashboard</span></a>
              </li>
              <li class="dropdown  @if($header == "Requests") active @endif">
                <a href="{{ url('/requests') }}" class="nav-link" onclick='show();'><i data-feather="file-plus"></i><span>Requests</span></a>
              </li>
              <li class="dropdown  @if($header == "Available Assets") active @endif">
                <a href="{{ url('/available-assets') }}" class="nav-link" onclick='show();'><i data-feather="check-square"></i><span>Available Assets</span></a>
              </li>
              <li class="dropdown  @if($header == "For Repairs") active @endif">
                <a href="{{ url('/for-repair') }}" class="nav-link" onclick='show();'><i data-feather="settings"></i><span>For Repair</span></a>
              </li>
              {{-- <li class="dropdown  @if($header == "Deployed Assets") active @endif">
                <a href="{{ url('/deployed-assets') }}" class="nav-link" onclick='show();'><i data-feather="share-2"></i><span>Deployed Assets</span></a>
              </li> --}}
              <li class="dropdown  @if($header == "Accountabilities") active @endif">
                <a href="{{ url('/accountabilities') }}" class="nav-link" onclick='show();'><i data-feather="user-check"></i><span>Accountabilities</span></a>
              </li>
              <li class="dropdown  @if($header == "Transactions") active @endif">
                <a href="{{ url('/transactions') }}" class="nav-link" onclick='show();'><i data-feather="file-text"></i><span>Transactions</span></a>
              </li> 
              <li class="menu-header">Settings</li>
              <li class="dropdown @if($header == "Category") active @endif">
                <a href="{{ url('/category') }}" class="nav-link" onclick='show();'><i data-feather="list"></i><span>Categories</span></a>
              </li>
              <li class="dropdown @if($header == "Employees") active @endif">
                <a href="{{ url('/employees') }}" class="nav-link" onclick='show();'><i data-feather="users"></i><span>Employees</span></a>
              </li>
              <li class="dropdown @if($header == "Assets") active @endif">
                <a href="{{ url('/assets-inventory') }}" class="nav-link" onclick='show();'><i data-feather="hard-drive"></i><span>Assets</span></a>
              </li>
            </ul>
        </aside>
      </div>
      <!-- Main Content -->
      @yield('content')
      <footer class="main-footer">
        <div class="footer-left">
            
        </div>
        <div class="footer-right">
            <small>Copyright &copy; {{date('Y')}}</small> Obanana Corporation
        </div>
      </footer> 
    </div>
  </div>
  <script type='text/javascript'>
    function show()
    {
        document.getElementById("myDiv").style.display="block";
    }
    function logout()
    {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    }
</script>
  <!-- General JS Scripts -->
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <!-- JS Libraies -->
  {{-- <script src="{{ asset('assets/bundles/apexcharts/apexcharts.min.js') }}"></script> --}}
  <!-- Page Specific JS File -->
  {{-- <script src="{{ asset('assets/js/page/index.js') }}"></script> --}}
  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('assets/js/custom.js') }}"></script>

  <script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
  <!-- JS Libraies -->
  <script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js.js') }}"></script> --}}
  <script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>

  <script src="{{ asset('assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/sweetalert.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/datatables.js') }}"></script>


  <script>
    $(".deactivate-category").click(function () {
      var id = $(this).parent("td").data('id');
      swal({
        title: 'Are you sure you want to deactivate this?',
        // text: 'Once deleted, you will not be able to recover this imaginary file!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                dataType: 'json',
                type:'POST',
                url:  'deactivate-category',
                data:{id:id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            }).done(function(data){
                console.log(data);
                swal('Category has been deactivated.', {  
                  icon: 'success',
                });
            });
          
          } 
        });
    });
    $(".activate-category").click(function () {
      var id = $(this).parent("td").data('id');
      swal({
        title: 'Are you sure you want to activate this?',
        // text: 'Once deleted, you will not be able to recover this imaginary file!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                dataType: 'json',
                type:'POST',
                url:  'activate-category',
                data:{id:id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            }).done(function(data){
                console.log(data);
                swal('Category has been activated.', {  
                  icon: 'success',
                });
            });
          
          } 
        });
    });
  
  </script>
  @include('sweetalert::alert')
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>