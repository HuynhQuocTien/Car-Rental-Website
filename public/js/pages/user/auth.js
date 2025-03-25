// jQuery(".js-validation-signin").validate({
//   rules: {
//     "login-username": {
//       required: !0,
//     },
//     "login-password": {
//       required: !0,
//       minlength: 6,
//     },
//   },
//   messages: {
//     "login-username": {
//       required: "Vui lòng nhập tài khoản",
//     },
//     "login-password": {
//       required: "Vui lòng nhập mật khẩu",
//       minlength: "Mật khẩu phải lớn hơn 6 ký tự",
//     },
//   },
// });
// $(document).ready(function () {
//     $(".js-validation-signin").submit(function (e) {
//       e.preventDefault();
//       if ($(".js-validation-signin").valid()) {
//         $.ajax({
//           type: "POST",
//           url: "./checkLogin",
//           data: {
//             masinhvien: $("#login-username").val(),
//             password: $("#login-password").val(),
//           },
//           dataType: "json",
//           success: function (response) {
//             console.log(response);
//             if (response.valid == "true") {
//               location.href = "./dashboard";
//             } else {
//               Dashmix.helpers("jq-notify", {
//                 type: "danger",
//                 icon: "fa fa-times me-1",
//                 message: `${response.message}`,
//               });
//             }
//           },
//         });
//       }
//     });
//   });


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


$(".js-validation-signup").submit(function (e) {
    e.preventDefault();
    if ($(".js-validation-signup").valid()) {
        var arr ={
            fullname: $('#signup-fullname').val(),
                phone: $('#signup-phone').val(),
                email: $('#signup-email').val(),
                username: $('#signup-newUsername').val(),
                password: $('#signup-newPassword').val()
        }
        console.table(arr);
        $.ajax({
            type: "post",
            url: "http://localhost/user/addUser",
            data: {
                fullname: $('#signup-fullname').val(),
                phone: $('#signup-phone').val(),
                email: $('#signup-email').val(),
                username: $('#signup-newUsername').val(),
                password: $('#signup-newPassword').val()
            },
            dataType: "json",
            success: function (response) {
                if (response) {
                    console.log(response);
                } else {
                    Dashmix.helpers('jq-notify', { type: 'danger', icon: 'fa fa-times me-1', message: "Failed to create account" });
                }
            },
            error: function () {
                Dashmix.helpers('jq-notify', { type: 'danger', icon: 'fa fa-times me-1', message: "An error occurred. Please try again." });
            }
        });
    }
});

