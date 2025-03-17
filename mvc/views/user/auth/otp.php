<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form">
                <span class="login100-form-title p-b-48">
                    <i class="zmdi zmdi-font"></i>
                </span>

                <span class="login100-form-title p-b-48">
                    VERIFY OTP
                </span>

                <!-- OTP Input Fields -->
                <div class="otp-container">
                    <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 1)" />
                    <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 2)" />
                    <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 3)" />
                    <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 4)" />
                    <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 5)" />
                    <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this, 6)" />
                </div>

                <!-- Submit Button -->
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="button" onclick="verifyOTP()">
                            Verify OTP
                        </button>
                    </div>
                </div>

                <!-- Resend OTP Link -->
                <div class="text-center p-t-20">
                    <span class="txt1">
                        Didn't receive the OTP?
                    </span>

                    <a class="txt2" href="javascript:void(0)" onclick="resendOTP()">
                        Resend OTP
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="dropDownSelect1"></div>