<!DOCTYPE html>
<html lang="en">


<!-- errors-503.html  21 Nov 2019 04:05:02 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- General CSS Files -->
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
  <link rel="shortcut icon" href="{{asset('images/icon.png')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('assets/bundles/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{asset('assets/bundles/select2/dist/css/select2.min.css')}}"> 
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <style>
       .zoom:hover {
      transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
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
  </style>
</head>

<body>
    <div id = "myDiv" class="loader"></div>
  {{-- <div class="loader"></div> --}}
    @yield('content')
    @include('sweetalert::alert')
   <!-- General JS Scripts -->
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script src="{{ asset('assets/bundles/summernote/summernote-bs4.js') }}"></script>

  <script src="{{ asset('assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
  <!-- JS Libraies -->
  {{-- <script src="{{ asset('assets/bundles/apexcharts/apexcharts.min.js') }}"></script> --}}
  <!-- Page Specific JS File -->
  {{-- <script src="{{ asset('assets/js/page/index.js') }}"></script> --}}
  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  
  <script>
      function show()
      {
          document.getElementById("myDiv").style.display="block";
      }
  </script>
    
 </body>
 
 
 <!-- errors-503.html  21 Nov 2019 04:05:02 GMT -->
 </html>