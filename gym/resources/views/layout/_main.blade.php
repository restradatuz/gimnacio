<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Administración - {{ $page_name }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/{{ $ruta }}/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="/{{ $ruta }}/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/{{ $ruta }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    @if (isset($css_plugins) && is_array($css_plugins))
        @foreach ($css_plugins as $css_plugin)
            <link rel="stylesheet" href="/{{ $ruta }}/vendors/{{ $css_plugin }}">
        @endforeach
    @endif
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    {{-- Animate.css --}}
    <link rel="stylesheet" href="/{{ $ruta }}/css/animate.css">
    <link rel="stylesheet" href="/{{ $ruta }}/css/style.css">
    <link rel="stylesheet" href="/{{ $ruta }}/css/custom.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/images/favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.0/b-html5-1.6.0/datatables.min.css"/>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      @include('layout/_navbar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('layout/_sidebar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper animated fadeIn py-3">

            @include('contents/'.$page_content)
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/{{ $ruta }}/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/{{ $ruta }}/vendors/chart.js/Chart.min.js"></script>
    <script src="/{{ $ruta }}/vendors/moment/moment.min.js"></script>
    <script src="/{{ $ruta }}/vendors/daterangepicker/daterangepicker.js"></script>
    <script src="/{{ $ruta }}/vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/{{ $ruta }}/js/off-canvas.js"></script>
    <script src="/{{ $ruta }}/js/misc.js"></script>
    <!-- endinject -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.0/b-html5-1.6.0/datatables.min.js"></script>
    <script src="https://use.fontawesome.com/b27ae9c473.js"></script>
    <!-- Custom js for this page -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    @if (isset($js_plugins) && is_array($js_plugins))
        @foreach ($js_plugins as $js_plugin)
            <script href="/{{ $ruta }}/vendors/{{ $js_plugin }}"></script>
        @endforeach
    @endif
    @if (isset($js_page))
        <script src="/{{ $ruta }}/js/pages/{{ $js_page }}"></script>
    @endif
    <!-- End custom js for this page -->
  </body>
  <script>
</script>
</html>
