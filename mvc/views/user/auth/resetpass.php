<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 reset-password-form"> <!-- Thêm class reset-password-form -->
            <form class="login100-form validate-form">
                <span class="login100-form-title p-b-48">
                    Reset Password
                </span>

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="text" name="user-info" id="user-info" value="user@example.com" readonly>
                    <span class="focus-input100"></span>
                </div>

                <!-- New Password Field -->
                <div class="wrap-input100 validate-input" data-validate="Enter new password">
                    <span class="btn-show-pass">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                    <input class="input100" type="password" name="new-password" id="new-password">
                    <span class="focus-input100" data-placeholder="New Password"></span>
                </div>

                <!-- Confirm New Password Field -->
                <div class="wrap-input100 validate-input" data-validate="Confirm new password">
                    <span class="btn-show-pass">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                    <input class="input100" type="password" name="confirm-password" id="confirm-password">
                    <span class="focus-input100" data-placeholder="Confirm New Password"></span>
                </div>

                <!-- Submit Button -->
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="button" onclick="resetPassword()">
                            Reset Password
                        </button>
                    </div>
                </div>

                <!-- Link to Login Page -->
                <div class="text-center p-t-20">
                    <span class="txt1">
                        Remember your password?
                    </span>

                    <a class="txt2" href="./signin">
                        Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>