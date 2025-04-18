<div id="page-container">

  <!-- Main Container -->
  <main id="main-container">
    <!-- Page Content -->
    <div class="bg-image" style="background-image: url('assets/media/photos/photo19@2x.jpg');">
      <div class="row g-0 justify-content-center bg-primary-dark-op">
        <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
          <!-- Two Factor Block -->
          <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
            <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-body-extra-light">
              <!-- Header -->
              <div class="mb-2 text-center">
                <a class="link-fx fw-bold fs-1" href="index.html">
                  <span class="text-dark">Dash</span><span class="text-primary">mix</span>
                </a>
                <p class="text-uppercase fw-bold fs-sm text-muted">Two Factor Authentication</p>
                <p class="text-muted fs-sm">
                  Please confirm your account by entering the authorization code sent to your mobile number *******9552.
                </p>
              </div>
              <!-- END Header -->

              <!-- Two Factor Form -->
              <form id="formOtp" class="text-center">
                <div class="mb-4">
                  <div class="input-group input-group-lg">
                    <input type="text" class="form-control" id="txtOtp" name="txtOtp"
                      placeholder="Enter confirmation code">
                  </div>
                </div>
                <div>
                  <button type="submit" class="btn btn-lg btn-hero btn-primary mb-4" id="otp">
                    <i class="fa fa-fw fa-lock-open opacity-50 me-1"></i> Submit
                  </button>
                </div>
                <p class="fs-sm text-muted mb-0">
                  Haven't received it? <a href="javascript:void(0)">Resend a new code</a>
                </p>
              </form>
              <!-- END Two Factor Form -->
              <div class="text-center">
                <p>Remembered your password? <a href="/admin/auth/signin">Sign In</a></p>
              </div>
            </div>
          </div>
          <!-- END Two Factor Block -->
        </div>
      </div>
    </div>
    <!-- END Page Content -->
  </main>
  <!-- END Main Container -->
</div>