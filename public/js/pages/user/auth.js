$(document).ready(function () {
    // Function to toggle form visibility
    function toggleForm(showFormId) {
        $('#loginForm, #registerForm, #forgotPasswordForm, #otpForm, #resetPasswordForm').addClass('d-none');
        $(showFormId).removeClass('d-none');
    }

    // Function to dynamically load scripts
    function loadScript(formType) {
        // Remove any existing signin.js or signup.js scripts before adding a new one
        $('script[src*="signin.js"], script[src*="signup.js"]').remove();

        var scriptSrc = formType === 'login' 
            ? '../public/js/pages/user/signin.js' 
            : '../public/js/pages/user/signup.js';

        console.log("Loading script:", scriptSrc);

        var script = $('<script>', {
            type: 'text/javascript',
            src: scriptSrc
        });

        $('head').append(script);
    }

    // When modal is shown for the first time, load signin.js by default
    $('#authModal').on('shown.bs.modal', function () {
        loadScript('login');
    });

    // Sign In button
    $('#btnLogin').on('click', function () {
        toggleForm('#loginForm');
        loadScript('login');
    });

    // Sign Up button
    $('#showRegister').on('click', function () {
        toggleForm('#registerForm');
        loadScript('register');
    });

    // Forgot Password button
    $('#showForgotPassword').on('click', function () {
        toggleForm('#forgotPasswordForm');
    });

    // Send OTP button
    $('#sendOTP').on('click', function () {
        toggleForm('#otpForm');
    });

    // Confirm OTP button
    $('#confirmOTP').on('click', function () {
        toggleForm('#resetPasswordForm');
    });

    // Back to Login from various pages
    $('#backToLogin, #backToLoginFromForgot').on('click', function () {
        toggleForm('#loginForm');
        loadScript('login');
    });
});
