Dashmix.onLoad(() =>
    class {
      static initValidation() {
        Dashmix.helpers("jq-validation"),
          jQuery(".js-validation-reminder").validate({
            rules: { "forgotEmail": { required: !0, emailWithDot: !0 } },
            messages: {
              "forgotEmail": {
                required: "Vui lòng nhập địa chỉ email !",
                emailWithDot: "Địa chỉ email phải đúng định dạng!",
              },
            },
          });
        jQuery("#otpForm").validate({
          rules: {
            otpCode: {
              required: true,
              digits: true,
              minlength: 6,
              maxlength: 6,
            },
          },
          messages: {
            otpCode: {
              required: "Vui lòng nhập mã OTP!",
              digits: "Mã OTP chỉ bao gồm chữ số!",
              minlength: "Mã OTP phải có ít nhất 6 chữ số!",
              maxlength: "Mã OTP chỉ được phép có tối đa 6 chữ số!",
            },
          },
        });
        jQuery("#resetPasswordForm").validate({
          rules: {
            newPasswordReset: {
              required: true,
              minlength: 6,
            },
            confirmPasswordReset: {
              required: true,
              equalTo: "#newPasswordReset",
            },
          },
          messages: {
            newPasswordReset: {
              required: "Vui lòng không để trống",
              minlength: "Mật khẩu ít nhất 6 ký tự",
            },
            confirmPasswordReset: {
              required: "Vui lòng không để trống",
              equalTo: "Mật khẩu không trùng khớp",
            },
          },
        });
      }
      static init() {
        this.initValidation();
      }
    }.init()
  );
  
  $("#sendOTP").off('submit').click(function (e) {
    e.preventDefault();
    if ($(".js-validation-forgot").valid()) {
      let mail = $("#forgotEmail").val();
      $.ajax({
        type: "post",
        url: BaseUrl + "auth/checkEmail",
        data: {
          email: mail,
        },
        success: function (response) {
          let data = JSON.parse(response);
          if (!data) {
            showError("#forgotEmail", "Email does not exist!");
          } else {
            $.ajax({
              type: "post",
              url: BaseUrl + "auth/sendOTPAuth",
              data: {
                email: mail,
              },
              success: function (response) {
                Dashmix.helpers("jq-notify", {
                  type: "success",
                  icon: "fa fa-times me-1",
                  message: `OTP code sent successfully!`,
                  z_index: 9999
                });
                $("#saveEmail").val(mail);
                $("#otpForm").removeClass("d-none");
                $("#forgotPasswordForm").addClass("d-none");
              },
            });
          }
        },
      });
    }
  });
  
  $("#comfirmOTP").click(function (e) {
    e.preventDefault();
    if ($("#otpForm").valid()) {
      let otp = $("#otpCode").val();
      $.ajax({
        type: "post",
        url:  BaseUrl +  "auth/checkOTP",
        data: {
          otp: otp,
        },
        success: function (response) {
          let data = response;
          console.log(response);
          if (data == 0) {
            showError("#otpCode", "OTP code is incorrect!");
          } else {
            $("#usernameReset").val($("#saveEmail").val());
            $("#resetPasswordForm").removeClass("d-none");
            $("#otpForm").addClass("d-none");
          }
        },
      });
    }
  });
  
  $("#btnReset").click(function (e) {
    e.preventDefault();
    if ($("#resetPasswordForm").valid()) {
      let passwordNew = $("#newPasswordReset").val();
      $.ajax({
        type: "post",
        url: BaseUrl + "auth/changePassword",
        data: {
          password: passwordNew,
        },
        success: function (response) {
          if (response == 1) {
            Dashmix.helpers("jq-notify", {
                type: "success",
                icon: "fa fa-times me-1",
                message: `Thay đổi mật khẩu thành công!`,
                z_index: 9999
            });
            setTimeout(function () {
              location.href = `/`;
            }, 3000);
          }
        },
      });
    }
  });

  // Hàm hiển thị lỗi tại input
function showError(selector, message) {
    $(selector).addClass("is-invalid");
    $(selector).after(`<div class="invalid-feedback">${message}</div>`);
}
