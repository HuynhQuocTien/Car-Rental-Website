        <!-- Side Overlay-->
        <aside id="side-overlay">
            <!-- Side Header -->
            <div class="content-header bg-dark">
                <div class="fw-semibold text-white">
                    Downtown Apartment
                </div>

                <!-- Close Side Overlay -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="ms-auto text-white" href="javascript:void(0)" data-toggle="layout"
                    data-action="side_overlay_close">
                    <i class="fa fa-times-circle"></i>
                </a>
                <!-- END Close Side Overlay -->
            </div>
            <!-- END Side Header -->

            <!-- Gallery -->
            <!-- Slick Slider (.js-slider class is initialized in Helpers.jqSlick()) -->
            <!-- For more info and examples you can check out http://kenwheeler.github.io/slick/ -->
            <div class="js-slider slick-nav-black slick-nav-hover slick-dotted-inner slick-dotted-white img-fluid-100"
                data-dots="true" data-arrows="true" data-autoplay="true" data-autoplay-speed="3000">
                <div>
                    <img class="img-fluid" src="assets/media/photos/photo26@2x.jpg" alt="">
                </div>
                <div>
                    <img class="img-fluid" src="assets/media/photos/photo28@2x.jpg" alt="">
                </div>
                <div>
                    <img class="img-fluid" src="assets/media/photos/photo29@2x.jpg" alt="">
                </div>
                <div>
                    <img class="img-fluid" src="assets/media/photos/photo30@2x.jpg" alt="">
                </div>
            </div>
            <!-- END Gallery -->

            <!-- Info -->
            <div class="content-side content-side-full">
                <h5 class="h2 fw-light text-center mb-2">
                    $150 <span class="fs-3 text-muted">per night</span>
                </h5>
                <div class="text-warning text-center push">
                    <i class="fa fa-fw fa-star"></i>
                    <i class="fa fa-fw fa-star"></i>
                    <i class="fa fa-fw fa-star"></i>
                    <i class="fa fa-fw fa-star"></i>
                    <i class="fa fa-fw fa-star"></i>
                    <span class="text-muted">(19)</span>
                </div>
                <div class="row text-center border-top border-bottom bg-body-light pull-x push">
                    <div class="col-6 border-bottom border-end">
                        <p class="py-3 mb-0">
                            <i class="fa fa-fw fa-bed text-muted me-1"></i> <strong>2</strong> Bedrooms
                        </p>
                    </div>
                    <div class="col-6 border-bottom">
                        <p class="py-3 mb-0">
                            <i class="fa fa-fw fa-bath text-muted me-1"></i> <strong>1</strong> Bathroom
                        </p>
                    </div>
                    <div class="col-6 border-end">
                        <p class="py-3 mb-0">
                            <i class="fa fa-fw fa-check text-success me-1"></i> Wifi
                        </p>
                    </div>
                    <div class="col-6">
                        <p class="py-3 mb-0">
                            <i class="fa fa-fw fa-check text-success me-1"></i> Breakfast
                        </p>
                    </div>
                </div>
                <p class="fs-sm fw-medium">
                    Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus
                    mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt
                    himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit
                    varius lorem sit metus mi.
                </p>
                <div class="row g-sm">
                    <div class="col-6">
                        <a class="btn btn-sm btn-primary w-100" href="javascript:void(0)">
                            Rent
                        </a>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-sm btn-alt-primary w-100" href="javascript:void(0)">
                            View More
                        </a>
                    </div>
                </div>
            </div>
            <!-- END Info -->
        </aside>
        <!-- END Side Overlay -->
        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="d-flex align-items-center">
                    <!-- Logo -->
                    <a class="fw-semibold text-white tracking-wide" href="/">
                        Ca<span class="opacity-75">rs</span>
                        <span class="fw-normal">Rantel</span>
                    </a>
                    <!-- END Logo -->

                    <!-- Open Search Section -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-alt-secondary ms-2" data-toggle="layout"
                        data-action="header_search_on">
                        <i class="fa fa-search"></i>
                    </button>
                    <!-- END Open Search Section -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="d-flex align-items-center">
                    <!-- Cart Button -->
                    <button type="button"
                        class="btn btn-alt-secondary position-relative me-3 d-flex align-items-center justify-content-center cartButton">
                        <i class="fa fa-shopping-cart cartButton"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">2</span>
                    </button>
                    <?php include "./mvc/views/user/inc/mini-cart.php" ?>
                    <!-- Login/Signup/Forgot Password Modal -->
                    <div class="d-inline-block text-center">
                        <button type="button" class="btn btn-alt-primary" data-bs-toggle="modal"
                            data-bs-target="#authModal" id="btnLogin">
                            <i class="fa fa-sign-in-alt me-1"></i> Sign In
                        </button>
                    </div>

                    <!-- Auth Modal -->
                    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="authModalLabel">Sign In</h5>
                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <!-- Login Form -->
                                    <form id="loginForm">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username"
                                                placeholder="Input Username">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password"
                                                placeholder="Input Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Sign In</button>

                                        <div class="text-end mt-2">
                                            <a href="#" id="showForgotPassword">Forgot password?</a>
                                        </div>
                                        <div class="text-center mt-3">
                                            <p class="mb-2">Or Sign in with</p>
                                            <button class="btn btn-outline-danger w-100 mb-2"><i
                                                    class="fab fa-google me-1"></i> Sign in with Google</button>
                                            <button class="btn btn-outline-dark w-100"><i
                                                    class="fab fa-github me-1"></i>
                                                Sign in with GitHub</button>
                                        </div>
                                        <div class="text-center mt-2">
                                            Not a member yet? <a href="#" id="showRegister">Sign up now</a>
                                        </div>
                                    </form>
                                    <!-- Register Form -->
                                    <form id="registerForm" class="d-none">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input type="tel" class="form-control" id="phone"
                                                placeholder="Input Phone number">
                                        </div>
                                        <div class="mb-3">
                                            <label for="newUsername" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="newUsername"
                                                placeholder="Input Username">
                                        </div>
                                        <div class="mb-3">
                                            <label for="newPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="newPassword"
                                                placeholder="Input Password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="renewPassword" class="form-label">Re-enter Password</label>
                                            <input type="password" class="form-control" id="renewPassword"
                                                placeholder="Re-enter Password">
                                        </div>
                                        <button type="submit" class="btn btn-success w-100">Sign Up</button>
                                        <div class="text-center mt-2">
                                            <a href="javascript:void(0)" id="backToLogin">Back to sign in</a>
                                        </div>
                                    </form>

                                    <!-- Forgot Password Form -->
                                    <form id="forgotPasswordForm" class="d-none">
                                        <div class="mb-3">
                                            <label for="forgotEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="forgotEmail"
                                                placeholder="Input email to receive OTP code">
                                        </div>
                                        <button type="submit" class="btn btn-warning w-100" id="sendOTP">Send OTP
                                            Code</button>
                                        <div class="text-center mt-2">
                                            <span id="resendOTP" class="text-muted">Resend OTP code after <span
                                                    id="countdown">60</span>s</span>
                                            <a href="#" id="backToLoginFromForgot">Back to sign in</a>
                                        </div>
                                    </form>

                                    <!-- OTP Confirmation Form -->
                                    <form id="otpForm" class="d-none">
                                        <div class="mb-3">
                                            <label for="otpCode" class="form-label">OTP Code</label>
                                            <input type="text" class="form-control" id="otpCode"
                                                placeholder="Enter OTP code">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100"
                                            id="comfirmOTP">Confirm</button>
                                    </form>

                                    <!-- Reset Password Form -->
                                    <form id="resetPasswordForm" class="d-none">
                                        <div class="mb-3">
                                            <label for="usernameReset" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="usernameReset" value=""
                                                disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newPasswordReset" class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="newPasswordReset"
                                                placeholder="Input new password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirmPasswordReset" class="form-label">Confirm new
                                                password</label>
                                            <input type="password" class="form-control" id="confirmPasswordReset"
                                                placeholder="Confirm new password">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Auth Modal -->

                    <!-- User Dropdown -->
                    <!-- <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-alt-secondary dropdown-toggle"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="img-avatar img-avatar32 img-avatar-thumb" src="assets/media/avatars/avatar1.jpg"
                                alt="">
                            <span class="d-none d-sm-inline ms-1">Jessica</span>
                            <span class="badge rounded-pill bg-warning ms-1">.genius</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0"
                            aria-labelledby="page-header-user-dropdown">
                            <div class="rounded-top fw-semibold text-white text-center bg-image"
                                style="background-image: url('assets/media/photos/photo13.jpg');">
                                <div class="p-3">
                                    <img class="img-avatar img-avatar-thumb" src="assets/media/avatars/avatar1.jpg"
                                        alt="">
                                </div>
                                <div class="p-3 bg-black-75">
                                    <a class="text-white fw-semibold" href="be_pages_generic_profile.html">Jessica
                                        Taylor</a>
                                    <div class="text-white-75">jesst@example.com</div>
                                </div>
                            </div>
                            <div class="p-2">
                                <a class="dropdown-item d-flex justify-content-between align-items-center"
                                    href="javascript:void(0)">
                                    Profile
                                    <i class="fa fa-fw fa-user opacity-50 ms-1"></i>
                                </a>
                                <a class="dropdown-item d-flex justify-content-between align-items-center"
                                    href="javascript:void(0)">
                                    Bookings
                                    <div>
                                        <span class="badge rounded-pill bg-primary">3</span>
                                        <i class="fa fa-fw fa-pencil-alt opacity-50 ms-1"></i>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex justify-content-between align-items-center"
                                    href="javascript:void(0)">
                                    Travel Guides
                                    <i class="fa fa-fw fa-plane opacity-50 ms-1"></i>
                                </a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item d-flex justify-content-between align-items-center"
                                    href="javascript:void(0)">
                                    Billing
                                    <div>
                                        <span class="badge rounded-pill bg-primary">1</span>
                                        <i class="fa fa-fw fa-money-bill-wave-alt opacity-50 ms-1"></i>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex justify-content-between align-items-center"
                                    href="javascript:void(0)">
                                    Settings
                                    <i class="fa fa-fw fa-cog opacity-50 ms-1"></i>
                                </a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item d-flex justify-content-between align-items-center"
                                    href="op_auth_signin.html">
                                    Sign Out
                                    <i class="fa fa-fw fa-sign-out-alt text-danger ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div> -->
                    <!-- END User Dropdown -->
                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->
            <div id="page-header-search" class="overlay-header bg-header-dark">
                <div class="content-header">
                    <form class="w-100" action="be_pages_generic_search.html" method="POST">
                        <div class="input-group">
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-primary" data-toggle="layout"
                                data-action="header_search_off">
                                <i class="fa fa-fw fa-times-circle"></i>
                            </button>
                            <input type="text" class="form-control" placeholder="Search..."
                                id="page-header-search-input" name="page-header-search-input">
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Header Search -->

            <!-- Header Loader -->
            <div id="page-header-loader" class="overlay-header bg-header-dark">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-2x fa-sun fa-spin text-primary"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>