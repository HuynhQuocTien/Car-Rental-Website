<!-- Side Overlay-->
<aside id="side-overlay">
    <!-- Side Header -->
    <div class="content-header bg-dark">
        <div class="fw-semibold text-white">
            Downtown Apartment
        </div>

        <!-- Close Side Overlay -->
        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
        <a class="ms-auto text-white" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
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
            <img class="img-fluid" src="" alt="">
        </div>
        <div>
            <img class="img-fluid" src="" alt="">
        </div>
        <div>
            <img class="img-fluid" src="" alt="">
        </div>
        <div>
            <img class="img-fluid" src="" alt="">
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
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">2</span>
            </button>
            <?php include "./mvc/views/user/inc/mini-cart.php" ?>
            <!-- Login/Signup/Forgot Password Modal -->
             <?php
             if(!isset($_COOKIE['token'])){
               echo '<div class="d-inline-block text-center">
                <button type="button" class="btn btn-alt-primary" data-bs-toggle="modal" data-bs-target="#authModal"
                    id="btnLogin">
                    <i class="fa fa-sign-in-alt me-1"></i> Sign In
                </button>
                </div>';
             }
            ?>

            <!-- Auth Modal -->
            <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="authModalLabel">Sign In</h5>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <!-- Login Form -->
                            <form id="loginForm" class="js-validation-signin" onsubmit="return false; ">
                                <div class="mb-3">
                                    <label for="login-username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="login-username" name="login-username"
                                        placeholder="Input Username">
                                </div>
                                <div class="mb-3">
                                    <label for="login-password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="login-password"
                                        name="login-password" placeholder="Input Password">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Sign In</button>

                                <div class="text-end mt-2">
                                    <a href="javascript:void(0)" id="showForgotPassword">Forgot password?</a>
                                </div>
                                <div class="text-center mt-3">
                                    <p class="mb-2">Or Sign in with</p>
                                    <button class="btn btn-outline-danger w-100 mb-2"><i class="fab fa-google me-1"></i>
                                        Sign in with Google</button>
                                    <button class="btn btn-outline-dark w-100"><i class="fab fa-github me-1"></i>
                                        Sign in with GitHub</button>
                                </div>
                                <div class="text-center mt-2">
                                    Not a member yet? <a href="javascript:void(0)" id="showRegister">Sign up
                                        now</a>
                                </div>
                            </form>
                            <!-- Register Form -->
                            <form id="registerForm" class="js-validation-signup d-none" onsubmit="return false; ">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Full name</label>
                                    <input type="text" class="form-control" id="signup-fullname"
                                        placeholder="Input Full name" name="signup-fullname" value="tienm ver2">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="signup-phone"
                                        placeholder="Input Phone number" name="signup-phone" value="0912345678">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="signup-email" placeholder="Input Email"
                                        name="signup-email" value="123213@gmail.com">
                                </div>
                                <div class="mb-3">
                                    <label for="signup-newUsername" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="signup-newUsername"
                                        placeholder="Input Username" name="signup-newUsername" value="555">
                                </div>
                                <div class="mb-3">
                                    <label for="signup-newPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="signup-newPassword"
                                        placeholder="Input Password" name="signup-newPassword" value="123456">
                                </div>
                                <div class="mb-3">
                                    <label for="renewPassword" class="form-label">Re-enter Password</label>
                                    <input type="password" class="form-control" id="signup-renewPassword"
                                        placeholder="Re-enter Password" name="signup-renewPassword" value="123456">
                                </div>
                                <button type="submit" class="btn btn-success w-100">Sign Up</button>
                                <div class="text-center mt-2">
                                    <a href="javascript:void(0)" id="backToLogin">Back to sign in</a>
                                </div>
                            </form>

                            <!-- Forgot Password Form -->
                            <form id="forgotPasswordForm" class="js-validation-forgot d-none" onsubmit="return false; ">
                                <div class="mb-3">
                                    <label for="forgotEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="forgotEmail"
                                        value="kacamhon123@gmail.com" placeholder="Input email to receive OTP code"
                                        name="forgotEmail">

                                </div>
                                <button type="submit" class="btn btn-warning w-100" id="sendOTP">Send OTP
                                    Code</button>
                                <div class="text-center mt-2">
                                    <a href="javascript:void(0)" id="backToLoginFromForgot">Back to sign in</a>
                                </div>
                            </form>

                            <!-- OTP Confirmation Form -->
                            <form id="otpForm" class="d-none" onsubmit="return false; ">
                                <div class="mb-3">
                                    <input type="text" name="saveEmail" id="saveEmail" hidden>
                                    <label for="otpCode" class="form-label">OTP Code</label>
                                    <input type="text" class="form-control" id="otpCode" name="otpCode"
                                        placeholder="Enter OTP code">
                                </div>
                                <button type="submit" class="btn btn-primary w-100" id="comfirmOTP">Confirm</button>
                                <div class="text-center mt-2">
                                    <span id="resendOTP" class="text-muted">Resend OTP code after <span
                                            id="countdown">60</span>s</span>
                                    <a href="javascript:void(0)" id="backToLoginFromForgot">Back to sign in</a>
                                </div>
                            </form>

                            <!-- Reset Password Form -->
                            <form id="resetPasswordForm" class="d-none" onsubmit="return false; ">
                                <div class="mb-3">
                                    <label for="usernameReset" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="usernameReset" value="" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="newPasswordReset" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="newPasswordReset"
                                        name="newPasswordReset" placeholder="Input new password">
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPasswordReset" class="form-label">Confirm new
                                        password</label>
                                    <input type="password" class="form-control" id="confirmPasswordReset"
                                        name="confirmPasswordReset" placeholder="Confirm new password">
                                </div>
                                <button type="submit" class="btn btn-primary w-100" id="btnReset">Reset
                                    Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Auth Modal -->

            <!-- User Dropdown -->
             <?php
             if(isset($_COOKIE['token'])){
                $avatar = empty($_SESSION["ProfilePicture"]) 
        ? "https://res.cloudinary.com/dapudsvwl/image/upload/v1744802442/sdh1er6okrxz39xpr8vp.jpg" 
        : $_SESSION["ProfilePicture"];

               echo '<div class="dropdown d-inline-block">
                <button type="button" class="btn btn-alt-secondary dropdown-toggle" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="img-avatar img-avatar32 img-avatar-thumb" src="'. $avatar .'" alt="">
                    <span class="d-none d-sm-inline ms-1">'.$_SESSION['FullName'].'</span>
                    <span class="badge rounded-pill bg-warning ms-1">.genius</span>
                </button>                
                <input type="hidden" id="UserID" value="'.$_SESSION['UserID'].'" hidden>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0"
                    aria-labelledby="page-header-user-dropdown">
                    <div class="rounded-top fw-semibold text-white text-center bg-image"
                        style="background-image: url(\''. $avatar .'\');">
                        <div class="p-3">
                            <img class="img-avatar img-avatar-thumb" src="'.$avatar.'" alt="">
                        </div>
                        <div class="p-3 bg-black-75">
                            <a class="text-white fw-semibold" href="">'. $_SESSION['FullName'] .'</a>
                            <div class="text-white-75">'.$_SESSION['Email'].'</div>
                        </div>
                    </div>
                    <div class="p-2">
                        <a class="dropdown-item d-flex justify-content-between align-items-center"
                            href="profile">
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
                           href="' . BASE_URL . '/user/auth/logout">
                           Sign Out
                           <i class="fa fa-fw fa-sign-out-alt text-danger ms-1"></i>
                        </a>
                    </div>
                </div>
                </div>';
             }
             ?>
            <!-- END User Dropdown -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header bg-header-dark">
        <div class="content-header">
            <form class="w-100" onsubmit="return false;" id="search-form">
                <div class="input-group">
                    <button type="button" class="btn btn-primary" data-toggle="layout" data-action="header_search_off">
                        <i class="fa fa-fw fa-times-circle"></i>
                    </button>
                    <input type="text" class="form-control" placeholder="Search..." id="search-input"
                        name="search-input" data-id="page-header-search-input">
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
<!-- END Header -->
<script>
    // 🔍 Hàm lấy cookie theo tên (jQuery style)
    // function getCookie(name) {
    //     const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    //     return match ? match[2] : null;
    // }

    // $(document).ready(function () {
    //     const token = getCookie("token");

    //     // Sự kiện click nút giỏ hàng
    //     $(".cartButton").on("click", function (e) {
    //         e.stopPropagation();
    //         if (token) {
    //             $("#miniCart").css("transform", "translateX(0)");
    //         } else {
    //             const $loginForm = $("#loginForm");
    //             const $modal = $loginForm.closest(".modal");
    //             if ($modal.length) {
    //                 $modal.modal("show");
    //             } else {
    //                 console.error("Không tìm thấy modal chứa form đăng nhập!");
    //             }
    //         }
    //     });

    //     // Sự kiện đóng giỏ hàng
    //     $("#closeCart, #closeCartBottom").on("click", function () {
    //         $("#miniCart").css("transform", "translateX(100%)");
    //     });
    //     // Đóng giỏ hàng nếu click ngoài vùng miniCart
    //     $(document).on("click", function (e) {
    //         if (!$(e.target).closest("#miniCart, .cartButton").length) {
    //             $("#miniCart").css("transform", "translateX(100%)");
    //         }
    //     });
    // });

</script>
