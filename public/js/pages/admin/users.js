Dashmix.helpersOnLoad(["js-flatpickr", "jq-datepicker"]);

Dashmix.onLoad(() =>
  class {
    static initValidation() {
      const addAjaxValidationMethod = (name, url, field) => {
        jQuery.validator.addMethod(
          name,
          function (value, element) {
            let isValid = false;
            $.ajax({
              type: "POST",
              url: BaseUrl + url,
              data: { [field]: value, UserID: $("#userId").val() },
              async: false, // Có thể cải thiện bằng async callback sau
              dataType: "json",
              success: function (response) {
                isValid = !response.success;
              },
            });
            return isValid;
          },
          `${field} already exists`
        );
      };
      jQuery.validator.addMethod(
        "minAge",
        function (value, element, min) {
          const birthDate = new Date(value);
          const today = new Date();
          const minAgeDate = new Date(
            today.getFullYear() - min,
            today.getMonth(),
            today.getDate()
          );

          return this.optional(element) || birthDate <= minAgeDate;
        },
        "You must be at least {0} years old."
      );

      addAjaxValidationMethod(
        "checkUsername",
        "users/checkUsername",
        "Username"
      );
      addAjaxValidationMethod("checkEmail", "users/checkEmail", "Email");
      addAjaxValidationMethod(
        "checkPhoneNumber",
        "users/checkPhoneNumber",
        "PhoneNumber"
      );
      addAjaxValidationMethod(
        "checkIdentityCard",
        "users/checkIdentityCard",
        "IdentityCard"
      );

      jQuery.validator.addMethod(
        "pattern",
        function (value, element, param) {
          if (typeof param == "string") {
            param = new RegExp(param);
          }
          return this.optional(element) || param.test(value);
        },
        "Invalid format"
      );
      jQuery.validator.addMethod(
        "emailWithDot",
        function (value, element) {
          return (
            this.optional(element) ||
            /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value)
          );
        },
        "Please enter a valid email address with dots."
      );

      jQuery("#addUserForm").validate({
        rules: {
          Username: {
            required: true,
            checkUsername: true,
          },
          Email: {
            required: true,
            email: true,
            emailWithDot: true,
            checkEmail: true,
          },
          PhoneNumber: {
            required: true,
            pattern: /^0\d{9}$/,
            checkPhoneNumber: true,
          },
          IdentityCard: {
            required: true,
            pattern: /^\d{12}$/, // đúng 12 chữ số
            checkIdentityCard: true,
          },
          DateOfBirth: {
            required: true,
            date: true,
            minAge: 16, // Tối thiểu 10 tuổi
          },
        },
        messages: {
          Username: {
            required: "Please enter username",
          },
          Email: {
            required: "Please enter email",
            email: "Please enter a valid email address",
            emailWithDot: "Email must contain a dot (.)",
          },
          PhoneNumber: {
            required: "Please enter phone number",
            pattern: "Phone number must be exactly 10 digits and start with 0",
          },
          IdentityCard: {
            required: "Please enter identity card number",
            pattern: "Identity card must be exactly 12 digits",
          },
          DateOfBirth: {
            required: "Please enter date of birth",
            date: "Please enter a valid date",
            minAge: "You must be at least 16 years old",
          },
        },
      });
    }

    static init() {
      this.initValidation();
    }
  }.init()
);

const renderData = function (users) {
  let html = "";
  users.forEach((user, index) => {
    html += `<tr>
      <td class="d-none d-sm-table-cell text-center">${index + 1}</td>
      <td class="text-center">
        <img class="img-avatar img-avatar48" src="${
          user.ProfilePicture ||
          "https://res.cloudinary.com/dapudsvwl/image/upload/v1744802442/sdh1er6okrxz39xpr8vp.jpg"
        }" alt="">
      </td>
      <td class="d-none d-sm-table-cell">
        <div class="fw-semibold">${user.FullName}</div>
        <div class="text-muted small">${user.PhoneNumber}</div>
      </td>
      <td class="d-none d-sm-table-cell">
        <div class="fw-semibold">${user.IdentityCard}</div>
        <div class="text-muted small">${user.Email}</div>
      </td>
      <td class="d-none d-sm-table-cell">
        <div class="fw-semibold">${user.DateOfBirth}</div>
        <div class="text-muted small">${user.Sex == 0 ? "Male" : "Female"}</div>
      </td>
      <td class="d-none d-lg-table-cell">${user.RoleName}</td>
      <td class="d-none d-lg-table-cell">
      ${
        user.Active == 1
          ? '<span class="badge bg-success">Active</span>'
          : '<span class="badge bg-danger">InActive</span>'
      }
                </td>
      <td class="text-center">
        <div class="btn-group">
          <button class="btn btn-sm btn-alt-secondary js-view-user"
                  data-id="${user.UserID}" title="View details">
           <i class="fa fa-eye opacity-50 me-1"></i>
          </button>
          <button class="btn btn-sm btn-alt-secondary js-edit-user"
                  data-id="${user.UserID}" title="Edit">
            <i class="fa fa-pencil-alt"></i>
          </button>
          <button class="btn btn-sm btn-alt-secondary js-delete-user"
                  data-id="${user.UserID}" data-accountid="${user.AccountID}" title="Delete">
            <i class="fa fa-times"></i>
          </button>
        </div>
      </td>
    </tr>`;
  });

  $("#listUser").html(html);
  $('[data-bs-toggle="tooltip"]').tooltip();
};
const userDefaultImg =
  "https://res.cloudinary.com/dapudsvwl/image/upload/v1744802442/sdh1er6okrxz39xpr8vp.jpg";
// Xử lý khi nhấn vào ảnh hoặc nút "+"
$("#profile-preview, #btn-add-picture").on("click", function () {
  $("#val-profile-picture").click(); // Kích hoạt hộp thoại chọn tệp
});

// Xử lý khi người dùng chọn tệp
$("#val-profile-picture").on("change", function (event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      $("#profile-preview").attr("src", e.target.result); // Hiển thị hình ảnh
      $("#btn-add-picture").hide(); // Ẩn nút "+"
      $("#btn-remove-picture").show(); // Hiển thị nút "x"
    };
    reader.readAsDataURL(file); // Đọc file dưới dạng DataURL
  }
});

// Xử lý khi nhấn nút "x"
$("#btn-remove-picture").on("click", function () {
  $("#profile-preview").attr("src", userDefaultImg); // Reset ảnh về mặc định
  $("#val-profile-picture").val(""); // Xóa giá trị của input file
  $("#btn-add-picture").show(); // Hiển thị lại nút "+"
  $("#btn-remove-picture").hide(); // Ẩn nút "x"
});

// Xử lý nút Add
$("#btn-add").on("click", function (e) {
  $("#userId").val("0");
  $("#val-fullname").val("");
  $("#val-phone").val("");
  $("#val-identity").val("");
  $("#val-role").val("");
  $("#val-birthday").val("");
  $("#val-email").val("");
  $("#val-password").val("");
  $("#val-username").val("");
  $("#val-profile-picture").val("");
  $("#addUserForm")[0].reset();
  $("#profile-preview").attr("src", userDefaultImg); 
  $("#val-profile-picture").val("");
  $("#btn-add-picture").show(); 
  $("#btn-remove-picture").hide();
  $("#btn-add-user").show();
  $("#btn-edit-user").hide();
  $(".title-add").show();
  $(".title-update").hide();
  $("#addModelForm").modal("show");
});

// Xử lý nút Save
$("#btn-add-user").on("click", function (e) {
  e.preventDefault();

  if ($("#addUserForm").valid()) {
    let formData = new FormData();
    formData.append("FullName", $("#val-fullname").val());
    formData.append("PhoneNumber", $("#val-phone").val());
    formData.append("IdentityCard", $("#val-identity").val());
    formData.append("RoleID", $("#val-role").val());
    formData.append("DateOfBirth", $("#val-birthday").val());
    formData.append("Sex", $("input[name='Sex']:checked").val());
    formData.append("Active", $("#user_active").is(":checked") ? 1 : 0);
    formData.append("Email", $("#val-email").val());
    formData.append("Password", $("#val-password").val());
    formData.append("Username", $("#val-username").val());

    // Xử lý file upload
    const profilePictureFile = $("#val-profile-picture")[0].files[0];
    if (profilePictureFile) {
      formData.append("ProfilePicture", profilePictureFile);
    }

    $.ajax({
      type: "POST",
      url: BaseUrl + "users/addUser",
      data: formData,
      processData: false, // Không xử lý dữ liệu
      contentType: false, // Đặt Content-Type là false để jQuery không thêm tiêu đề mặc định
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $("#addModelForm").modal("hide");
          Dashmix.helpers("jq-notify", {
            type: "success",
            icon: "fa fa-check me-1",
            message: "User added successfully!",
            z_index: 9999,
          });
          mainPagePagination.getPagination(
            mainPagePagination.option,
            mainPagePagination.valuePage.curPage
          );
        } else {
          Dashmix.helpers("jq-notify", {
            type: "danger",
            icon: "fa fa-times me-1",
            message: response.message || "Add User failed!",
          });
        }
      },
      error: function () {
        Dashmix.helpers("jq-notify", {
          type: "danger",
          icon: "fa fa-times me-1",
          message: "Error occurred while adding user",
        });
      },
    });
  }
});
// Xử lý nút Edit show modal
$(document).on("click", ".js-edit-user", function () {
  let id = $(this).data("id");
  console.log(id);
  $("#addUserForm")[0].reset();

  $("#userId").val(id);

  $(".title-add").hide();
  $(".title-update").show();
  $("#btn-add-user").hide();
  $("#btn-edit-user").show();
  $.ajax({
    type: "POST",
    url: BaseUrl + `users/get`,
    data: {
      UserID: id,
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        const user = response.data;
        $("#accountId").val(user.AccountID);
        $("#val-fullname").val(user.FullName);
        $("#val-phone").val(user.PhoneNumber);
        $("#val-identity").val(user.IdentityCard);
        $("#val-role").val(user.RoleID);
        $("#val-birthday").val(user.DateOfBirth);
        $("input[name='Sex'][value='" + user.Sex + "']").prop("checked", true);
        $("#user_active").prop("checked", user.Active == 1);
        $("#val-email").val(user.Email);
        $("#val-username").val(user.Username);
        $("#val-password").val("**********");
        $("#val-repassword").val("**********");
        $("#val-password").attr("readonly", true);
        $("#val-repassword").attr("readonly", true);
        $("#val-password").attr("disabled", true);
        $("#val-repassword").attr("disabled", true);
        $("#profile-preview").attr("src", user.ProfilePicture ?? userDefaultImg).show();

        $("#btn-add-user").hide();
        $("#btn-edit-user").show();

        $("#addModelForm").modal("show");
      }
    },
    error: function () {
      Dashmix.helpers("jq-notify", {
        type: "danger",
        icon: "fa fa-times me-1",
        message: "Error occurred while fetching user details",
      });
    },
  });
});

// Xử lý nút Update
$("#btn-edit-user").on("click", function (e) {
  e.preventDefault();

  if ($("#addUserForm").valid()) {
    let formData = new FormData();
    formData.append("UserID", $("#userId").val());
    formData.append("AccountID", $("#accountId").val());
    formData.append("FullName", $("#val-fullname").val());
    formData.append("PhoneNumber", $("#val-phone").val());
    formData.append("IdentityCard", $("#val-identity").val());
    formData.append("RoleID", $("#val-role").val());
    formData.append("DateOfBirth", $("#val-birthday").val());
    formData.append("Sex", $("input[name='Sex']:checked").val());
    formData.append("Active", $("#user_active").is(":checked") ? 1 : 0);
    formData.append("Email", $("#val-email").val());
    formData.append("Password", $("#val-password").val());
    formData.append("Username", $("#val-username").val());

    // Xử lý file upload hoặc sử dụng hình ảnh mặc định
    const profilePictureFile = $("#val-profile-picture")[0].files[0];
    if (profilePictureFile) {
      formData.append("ProfilePicture", profilePictureFile);
    } else {
      formData.append("ProfilePicture", userDefaultImg);
    }

    $.ajax({
      type: "POST",
      url: BaseUrl + "users/updateUser",
      data: formData,
      processData: false, // Không xử lý dữ liệu
      contentType: false, // Đặt Content-Type là false để jQuery không thêm tiêu đề mặc định
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $("#addModelForm").modal("hide");
          Dashmix.helpers("jq-notify", {
            type: "success",
            icon: "fa fa-check me-1",
            message: "User updated successfully!",
            z_index: 9999,
          });
          mainPagePagination.getPagination(
            mainPagePagination.option,
            mainPagePagination.valuePage.curPage
          );
        } else {
          Dashmix.helpers("jq-notify", {
            type: "danger",
            icon: "fa fa-times me-1",
            message: response.message || "Update User failed!",
          });
        }
      },
      error: function () {
        Dashmix.helpers("jq-notify", {
          type: "danger",
          icon: "fa fa-times me-1",
          message: "Error occurred while updating user",
        });
      },
    });
  }
});

// Xử lý nút Delete
$(document).on("click", ".js-delete-user", function () {
  const id = $(this).data("id");

  if (confirm("Are you sure you want to delete this user?")) {
    $.ajax({
      type: "POST",
      url: BaseUrl + "users/deleteUser",
      data: { 
        UserID: id,
        AccountID: $(this).data("accountid"),
      },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          Dashmix.helpers("jq-notify", {
            type: "success",
            icon: "fa fa-check me-1",
            message: "User deleted successfully!",
            z_index: 9999,
          });
          mainPagePagination.getPagination(
            mainPagePagination.option,
            mainPagePagination.valuePage.curPage
          );
        } else {
          Dashmix.helpers("jq-notify", {
            type: "danger",
            icon: "fa fa-times me-1",
            message: response.message || "Delete User failed!",
          });
        }
      },
      error: function () {
        Dashmix.helpers("jq-notify", {
          type: "danger",
          icon: "fa fa-times me-1",
          message: "Error occurred while deleting user",
        });
      },
    });
  }
});

const mainPagePagination = new Pagination();
mainPagePagination.option.controller = "users";
mainPagePagination.option.model = "UserModel";
mainPagePagination.option.limit = 10;
mainPagePagination.option.filter = {};
mainPagePagination.getPagination(
  mainPagePagination.option,
  mainPagePagination.valuePage.curPage
);
