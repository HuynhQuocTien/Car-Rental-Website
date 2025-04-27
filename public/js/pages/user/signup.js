$(document).ready(function () {
    $(".js-validation-signin").submit(function (e) {
      e.preventDefault();
      if ($(".js-validation-signin").valid()) {
        $.ajax({
          type: "POST",
          url: "./checkLogin",
          data: {
            masinhvien: $("#login-username").val(),
            password: $("#login-password").val(),
          },
          dataType: "json",
          success: function (response) {
            console.log(response);
            if (response.valid == "true") {
                setTimeout(function () {
                    location.reload();
                  }, 500);
            } else {
              Dashmix.helpers("jq-notify", {
                type: "danger",
                icon: "fa fa-times me-1",
                message: `${response.message}`,
              });
            }
          },
        });
      }
    });
  });

// $(document).ready(function () {
//     // Khi mở modal, xóa dữ liệu các form
//     $('#authModal').on('shown.bs.modal', function () {
//         clearFormInputs('#loginForm');
//         clearFormInputs('#registerForm');
//         clearFormInputs('#forgotPasswordForm');
//         clearFormInputs('#otpForm');
//         clearFormInputs('#resetPasswordForm');
//         clearValidationErrors();
//     });

//     // Hàm để xóa dữ liệu các thẻ input trong form
//     function clearFormInputs(formSelector) {
//         $(formSelector).find('input').val('');
//         $(formSelector).find('.is-invalid').removeClass('is-invalid');
//         $(formSelector).find('.invalid-feedback').hide();
//     }

//     // Hàm xóa lỗi validation
//     function clearValidationErrors() {
//         $('.form-control').removeClass('is-invalid');
//         $('.invalid-feedback').hide();
//     }

//     // Khi chuyển từ form login sang form register
//     $('#showRegister').on('click', function () {
//         $('#loginForm').addClass('d-none');
//         $('#registerForm').removeClass('d-none');
//         clearFormInputs('#loginForm');
//         clearValidationErrors();
//     });

//     // Khi chuyển từ form register sang form login
//     $('#backToLogin').on('click', function () {
//         $('#registerForm').addClass('d-none');
//         $('#loginForm').removeClass('d-none');
//         clearFormInputs('#registerForm');
//         clearValidationErrors();
//     });

//     // Khi chuyển từ form forgot password sang form login
//     $('#backToLoginFromForgot').on('click', function () {
//         $('#forgotPasswordForm').addClass('d-none');
//         $('#loginForm').removeClass('d-none');
//         clearFormInputs('#forgotPasswordForm');
//         clearValidationErrors();
//     });

//     // Khi chuyển từ form forgot password sang form OTP
//     $('#sendOTP').on('click', function () {
//         clearFormInputs('#forgotPasswordForm');
//         clearValidationErrors();
//     });

//     // Khi chuyển từ form OTP sang form reset password
//     $('#comfirmOTP').on('click', function () {
//         $('#otpForm').addClass('d-none');
//         $('#resetPasswordForm').removeClass('d-none');
//         clearFormInputs('#otpForm');
//         clearValidationErrors();
//     });

//     // Kiểm tra mật khẩu trong form đăng ký (Xử lý khi re-enter password)
//     $('#signup-renewPassword').on('input', function () {
//         var password = $('#signup-newPassword').val();
//         var confirmPassword = $(this).val();

//         if (password !== confirmPassword) {
//             $(this).addClass('is-invalid');
//             $('#signup-renewPassword-error').show();
//         } else {
//             $(this).removeClass('is-invalid');
//             $('#signup-renewPassword-error').hide();
//         }
//     });

//     // Khi reset password, sẽ xóa dữ liệu và lỗi
//     $('#resetPasswordForm').on('submit', function () {
//         clearFormInputs('#resetPasswordForm');
//         clearValidationErrors();
//     });
// });


Dashmix.onLoad((() => class {
    static initValidation() {
        Dashmix.helpers("jq-validation");
        jQuery(".js-validation-signup").validate({
            rules: {
                "signup-fullname": {
                    required: true,
                    minlength: 3
                },
                "signup-phone": {
                    required: true,
                    minlength: 5,
                    digits: true
                },
                "signup-email": {
                    required: true,
                    email: true
                },
                "signup-newUsername": {
                    required: true,
                    minlength: 3
                },
                "signup-newPassword": {
                    required: true,
                    minlength: 5
                },
                "signup-renewPassword": {
                    required: true,
                    equalTo: "#signup-newPassword"
                }
            },
            messages: {
                "signup-fullname": "Please enter your full name (at least 3 characters)",
                "signup-phone": "Please enter a valid phone number",
                "signup-email": "Please enter a valid email address",
                "signup-newUsername": "Please enter a username (at least 3 characters)",
                "signup-newPassword": "Your password must be at least 5 characters long",
                "signup-renewPassword": "Passwords do not match"
            }
        });
    }

    static init() {
        this.initValidation();
    }
}.init()));


$(".js-validation-signup").off('submit').submit(function (e) {
    e.preventDefault();
    if ($(".js-validation-signup").valid()) {
        $.ajax({
            type: "POST",
            url: BaseUrl + "auth/addCustomer",
            data: {
                fullname: $('#signup-fullname').val(),
                phone: $('#signup-phone').val(),
                email: $('#signup-email').val(),
                username: $('#signup-newUsername').val(),
                password: $('#signup-newPassword').val()
            },
            success: function (response) {
                $(".form-control").removeClass("is-invalid");
                $(".invalid-feedback").remove();
                console.log(response);
                if (response.success) {
                    Dashmix.helpers('jq-notify', { type: 'success', icon: 'fa fa-check me-1', message: "Account created successfully",z_index: 9999 });
                    console.log(BaseUrl + "auth/addCustomer");
                    setTimeout(function () {
                        location.reload();
                      }, 500);
                } else {
                    response.error_fields['username'].length != 0 ? showError("#signup-newUsername", response.error_fields['username']) : null;
                    response.error_fields['email'].length != 0 ? showError("#signup-email", response.error_fields['email']) : null;
                    response.error_fields['phone'].length != 0 ? showError("#signup-phone", response.error_fields['phone']) : null;
                }
            },
            error: function () {
                Dashmix.helpers('jq-notify', { type: 'danger', icon: 'fa fa-times me-1', message: "An error occurred. Please try again.",z_index: 9999 });
            }
        });
    }
});

// Hàm hiển thị lỗi tại input
function showError(selector, message) {
    $(selector).addClass("is-invalid");
    $(selector).after(`<div class="invalid-feedback">${message}</div>`);
}

