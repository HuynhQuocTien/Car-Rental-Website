Dashmix.onLoad(() =>
    class {
      static initValidation() {
        Dashmix.helpers("jq-validation"),

        jQuery(".js-validation-reminder").validate({
            rules: { 
                "sentOTP": { 
                required: true,
                emailWithDot: true,
            } },
            messages: {
              "sentOTP": {
                required: "Please enter email address!",
                emailWithDot: "Địa chỉ email phải đúng định dạng!",
              },
            },
          });
        jQuery("#formOtp").validate({
          rules: {
            txtOtp: {
              required: true,
              digits: true,
              minlength: 6,
              maxlength: 6,
            },
          },
          messages: {
            txtOtp: {
              required: "Vui lòng nhập mã OPT!",
              digits: "Mã OTP chỉ bao gồm chữ số!",
              minlength: "Mã OTP phải có ít nhất 6 chữ số!",
              maxlength: "Mã OTP chỉ được phép có tối đa 6 chữ số!",
            },
          },
        });
        jQuery("#changepass").validate({
          rules: {
            passwordNew: {
              required: true,
              minlength: 6,
            },
            comfirm: {
              required: true,
              equalTo: "#passwordNew",
            },
          },
          messages: {
            passwordNew: {
              required: "Vui lòng không để trống",
              minlength: "Mật khẩu ít nhất 6 ký tự",
            },
            comfirm: {
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
  
  $("#btn-reminder").click(function (e) {
    e.preventDefault();
    if ($(".js-validation-reminder").valid()) {
      let mail = $("#sentOTP").val();
      $.ajax({
        type: "post",
        url: BaseUrl + "auth/checkEmail",
        data: {
          email: mail,
        },
        dataType: 'json',
        success: function (response) {
          console.log(response);
          
          if (!response.valid) {
            showError("#sentOTP",response.message); 
          } 
          else {
            $.ajax({
              type: "post",
              url:  BaseUrl + "auth/sendOTPAuth",
              data: {
                email: mail,
              },
              success: function (response) {
                location.href = BaseUrl + `auth/otp`;
              },
            });
          }
        },
      });
    }
  });
  
  $("#otp").click(function (e) {
    e.preventDefault();
    if ($("#formOtp").valid()) {
      let otp = $("#txtOtp").val();
      $.ajax({
        type: "post",
        url: BaseUrl + "auth/checkOpt",
        data: {
          otp: otp,
        },
        success: function (response) {
          let data = response;
          console.log(response);
          if (data == 0) {
            Dashmix.helpers("jq-notify", {
              type: "danger",
              icon: "fa fa-times me-1",
              message: `Mã OPT không đúng`,
            });
          }
           else {
            location.href = BaseUrl + `auth/changePassword`;
          }
        },
      });
    }
  });
  
  $("#btnChange").click(function (e) {
    e.preventDefault();
    if ($("#changepass").valid()) {
      let passwordNew = $("#passwordNew").val();
      $.ajax({
        type: "post",
        url: BaseUrl +"auth/reset",
        data: {
          password: passwordNew,
        },
        success: function (response) {
          if (response == 1) {
            Dashmix.helpers("jq-notify", {
              type: "success",
              icon: "fa fa-times me-1",
              message: `Thay đổi mật khẩu thành công!`,
            });
            setTimeout(function () {
              location.href = BaseUrl +`auth/signin`;
            }, 3000);
          }
        },
      });
    }
  });

function showError(selector, message) {
  // Xóa thông báo lỗi cũ trước khi thêm mới
  $(selector).parent().find('.invalid-feedback').remove();
  
  // Thêm lớp is-invalid (nếu chưa có)
  $(selector).addClass("is-invalid");
  
  // Thêm thông báo lỗi mới
  $(selector).parent().append(`<div class="invalid-feedback">${message}</div>`);
}