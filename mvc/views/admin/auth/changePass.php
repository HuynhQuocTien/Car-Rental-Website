<div id="page-container">

  <!-- Main Container -->
  <main id="main-container">
    <!-- Page Content -->
    <div class="bg-image" style="background-image: url('../../public/media/photos/photo19@2x.jpg');">
      <div class="row g-0 justify-content-center bg-primary-dark-op">
        <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
          <!-- Forgot Password Block -->
          <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
            <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
              <!-- Header -->
              <div class="mb-2 text-center">
                <a class="link-fx fw-bold fs-1" href="/admin">
                  <span class="text-dark">Dash</span><span class="text-primary">mix</span>
                </a>
                <p class="text-uppercase fw-bold fs-sm text-muted">Reset Password</p>
              </div>
              <!-- END Header -->

              <!-- Forgot Password Form -->
              <form class="js-validation-forgot">
                <div class="mb-4">
                  <div class="input-group input-group-lg">
                    <input type="email" class="form-control" id="reset-email" name="reset-email" placeholder="Enter your email address">
                    <span class="input-group-text">
                      <i class="fa fa-envelope"></i>
                    </span>
                  </div>
                </div>
                <div class="text-center mb-4">
                  <button type="submit" class="btn btn-hero btn-primary">
                    <i class="fa fa-fw fa-paper-plane opacity-50 me-1"></i> Send Reset Link
                  </button>
                </div>
              </form>
              <!-- END Forgot Password Form -->

              <div class="text-center">
                <p>Remembered your password? <a href="/admin/auth/signin">Sign In</a></p>
              </div>
            </div>
          </div>
          <!-- END Forgot Password Block -->
        </div>
      </div>
    </div>
    <!-- END Page Content -->
  </main>
  <!-- END Main Container -->
</div>
