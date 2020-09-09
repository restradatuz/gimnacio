<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administración - Iniciar Sesión</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="images/favicon.ico" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo" style="display: flex; justify-content: center">
                  <!--<img class="img-fluid" src="/images/logo.png">-->
                </div>
                <h3 class="text-center">GYM <br/> Acceso Administración</h3>
                <form action="{{route('authenti')}}" method="POST" class="pt-3">
                {{ csrf_field() }}
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg @error('login') border-danger @enderror" id="email" name="email" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                  <input type="password" class="form-control form-control-lg @error('login') border-danger @enderror" id="password" name="password" placeholder="Password" required>
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Iniciar Sesión</button>
                    @foreach ($errors->all() as $e)
                        <p class="text-danger text-center mt-1">{{ $e }}</p>
                    @endforeach
                  </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>
