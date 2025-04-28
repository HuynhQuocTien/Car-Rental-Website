$(document).ready(function () {
    // Cache DOM elements
    const $authModal = $('#authModal');
    const $forms = $('#loginForm, #registerForm, #forgotPasswordForm, #otpForm, #resetPasswordForm');
    const $scriptContainer = $('head');
    const $specialInputs = $('#usernameReset, #saveEmail'); // Các input cần xử lý đặc biệt
    const scriptMap = {
        'login': BASE_URL + '/public/js/pages/user/signin.js',
        'register': BASE_URL + '/public/js/pages/user/signup.js',
        'otp': BASE_URL + '/public/js/pages/user/sendOTP.js'
    };

    // Function to reset all input fields in a form (except hidden and special inputs)
    function resetFormInputs(formId) {
        $(formId).find('input:not([type="hidden"]):not(#usernameReset):not(#saveEmail), textarea, select').val('');
    }

    // Function to clear special inputs (usernameReset and saveEmail)
    function clearSpecialInputs() {
        $specialInputs.val('');
    }

    // Function to toggle form visibility and reset inputs
    function toggleForm(showFormId) {
        // Reset all forms first (except special inputs)
        $forms.each(function() {
            resetFormInputs('#' + this.id);
        });
        
        // Hide all forms and show the requested one
        $forms.addClass('d-none');
        $(showFormId).removeClass('d-none');
    }

    // Function to load script dynamically
    function loadScript(formType) {
        // Remove previous scripts
        $('script[src*="user/"]').remove();
        
        const scriptSrc = scriptMap[formType];
        if (scriptSrc) {
            $scriptContainer.append($('<script>', {
                type: 'text/javascript',
                src: scriptSrc
            }));
        }
    }

    // Event handlers
    function bindEvents() {
        // Modal shown event
        $authModal.on('shown.bs.modal', function () {
            toggleForm('#loginForm');
            loadScript('login');
        });

        // Modal hidden event - reset everything when closed
        $authModal.on('hidden.bs.modal', function () {
            toggleForm('#loginForm');
            clearSpecialInputs(); // Xóa cả special inputs khi đóng modal
        });

        // Button events
        $('#btnLogin').on('click', function () {
            toggleForm('#loginForm');
            loadScript('login');
            clearSpecialInputs(); // Xóa special inputs khi chuyển về form đăng nhập
        });

        $('#showRegister').on('click', function () {
            toggleForm('#registerForm');
            loadScript('register');
        });

        $('#showForgotPassword').on('click', function () {
            toggleForm('#forgotPasswordForm');
            loadScript('otp');
        });

        $('#confirmOTP').on('click', function () {
            loadScript('otp');
            // KHÔNG xóa special inputs khi confirm OTP
        });

        $('#backToLogin, #backToLoginFromForgot').on('click', function () {
            toggleForm('#loginForm');
            loadScript('login');
            clearSpecialInputs(); // Xóa special inputs khi quay lại form đăng nhập
        });
    }

    // Initialize
    bindEvents();
});