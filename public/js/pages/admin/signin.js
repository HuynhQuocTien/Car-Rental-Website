Dashmix.onLoad(() =>
    class {
      static initValidation() {
        Dashmix.helpers("jq-validation"),
          jQuery(".js-validation-signin").validate({
            rules: {
              "login-username": {
                required: !0
              },
              "login-password": {
                required: !0,
                minlength: 5,
              },
            },
            messages: {
              "login-username": {
                required: "Vui lòng nhập tài khoản",
              },
              "login-password": {
                required: "Vui lòng nhập mã mật khẩu",
                minlength: "Mật khẩu phải lớn hơn 5 ký tự",
              },
            },
          });
      }
      static init() {
        this.initValidation();
      }
    }.init()
  );
  
  $(".js-validation-signin").submit(function (e) {
    e.preventDefault();
    if ($(".js-validation-signin").valid()) {
      $.ajax({
        type: "POST",
        url: BaseUrl + "auth/checkLogin",
        data: {
          username: $("#login-username").val(),
          password: $("#login-password").val(),
        },
        dataType: "json",
        success: function (response) {
          console.log(response);
          if (response.valid == "true") {
            Dashmix.helpers("jq-notify", {
                type: "success",
                icon: "fa fa-times me-1",
                message: `${response.message}`,
                z_index: 9999,
              });
          } else {
            Dashmix.helpers("jq-notify", {
              type: "danger",
              icon: "fa fa-times me-1",
              message: `${response.message}`,
              z_index: 9999,
            });
          }
        },
      });
    }
  });
  