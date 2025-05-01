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
              data: { [field]: value, CustomerID: $("#customerId").val() },
              async: false,
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
        "You must be at least {16} years old."
      );

      addAjaxValidationMethod(
        "checkPhoneNumber",
        "customers/checkPhoneNumber",
        "PhoneNumber"
      );
      addAjaxValidationMethod(
        "checkIdentityCard",
        "customers/checkIdentityCard",
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

      jQuery("#addCustomerForm").validate({
        rules: {
          Username: {
            required: true,
          },
          Email: {
            required: true,
          },
          Password: {
            required: true,
          },
          FullName: {
            required: true,
          },
          PhoneNumber: {
            required: true,
            pattern: /^0\d{9}$/,
            checkPhoneNumber: true,
          },
          IdentityCard: {
            required: true,
            pattern: /^\d{12}$/,
            checkIdentityCard: true,
          },
          DateOfBirth: {
            required: true,
            date: true,
            minAge: 16,
          },
        },
        messages: {
          Username: {
            required: "Please enter Username",
          },
          Email: {
            required: "Please enter Email",
          },
          Password: {
            required: "Please enter Password",
          },
          FullName: {
            required: "Please enter full name",
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

const renderData = function (customers) {
  let html = "";
  customers.forEach((customer, index) => {
    html += `<tr>
      <td class="d-none d-sm-table-cell text-center">${index + 1}</td>
      <td class="text-center">
        <img class="img-avatar img-avatar48" src="${
          customer.ProfilePicture ||
          "https://res.cloudinary.com/dapudsvwl/image/upload/v1744802442/sdh1er6okrxz39xpr8vp.jpg"
        }" alt="">
      </td>
      <td class="d-none d-sm-table-cell">
        <div class="fw-semibold">${customer.FullName}</div>
        <div class="text-muted small">${customer.Email || "N/A"}</div>
      </td>
      <td class="d-none d-sm-table-cell">
        <div class="fw-semibold">${customer.PhoneNumber}</div>
      </td>
      <td class="d-none d-sm-table-cell">
        <div class="fw-semibold">${customer.IdentityCard}</div>
      </td>
      <td class="d-none d-sm-table-cell">
        <div class="fw-semibold">${customer.DateOfBirth}</div>
        <div class="text-muted small">${
          customer.Sex == 0 ? "Male" : "Female"
        }</div>
      </td>
      <td class="d-none d-lg-table-cell">
        <span class="badge bg-primary">${
          customer.TotalOrdered || 0
        } orders</span>
      </td>
      <td class="d-none d-lg-table-cell">
      ${
        customer.Active == 1
          ? '<span class="badge bg-success">Active</span>'
          : '<span class="badge bg-danger">InActive</span>'
      }
      </td>
      <td class="text-center">
        <div class="btn-group">
          <button class="btn btn-sm btn-alt-secondary js-view-customer"
                  data-id="${customer.CustomerID}" title="View details">
           <i class="fa fa-eye me-1"></i>
          </button>
          <button class="btn btn-sm btn-alt-secondary js-edit-customer"
                  data-id="${customer.CustomerID}"
                  title="Edit">
            <i class="fa fa-pencil-alt"></i>
          </button>
          <button class="btn btn-sm btn-alt-secondary js-delete-customer"
                  data-id="${customer.CustomerID}" data-accountid="${
      customer.AccountID
    }" title="Delete">
            <i class="fa fa-times"></i>
          </button>
        </div>
      </td>
    </tr>`;
  });

  $("#listCustomer").html(html);
  $('[data-bs-toggle="tooltip"]').tooltip();
};

const customerDefaultImg =
  "https://res.cloudinary.com/dapudsvwl/image/upload/v1744802442/sdh1er6okrxz39xpr8vp.jpg";

// Handle ID card image previews
$("#idcard-before-preview, #btn-add-idcard-before").on("click", function () {
  $("#IDCardBefore").click();
});

$("#idcard-after-preview, #btn-add-idcard-after").on("click", function () {
  $("#IDCardAfter").click();
});

$("#IDCardBefore").on("change", function (event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      $("#idcard-before-preview").attr("src", e.target.result);
      $("#btn-add-idcard-before").hide();
      $("#btn-remove-idcard-before").show();
    };
    reader.readAsDataURL(file);
  }
});

$("#IDCardAfter").on("change", function (event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      $("#idcard-after-preview").attr("src", e.target.result);
      $("#btn-add-idcard-after").hide();
      $("#btn-remove-idcard-after").show();
    };
    reader.readAsDataURL(file);
  }
});

$("#btn-remove-idcard-before").on("click", function () {
  $("#idcard-before-preview").attr("src", "");
  $("#IDCardBefore").val("");
  $("#btn-add-idcard-before").show();
  $("#btn-remove-idcard-before").hide();
});

$("#btn-remove-idcard-after").on("click", function () {
  $("#idcard-after-preview").attr("src", "");
  $("#IDCardAfter").val("");
  $("#btn-add-idcard-after").show();
  $("#btn-remove-idcard-after").hide();
});

// Handle Add button
$("#btn-add").on("click", function (e) {
  $("#customerId").val("0").prop("disabled", false);
  $("#accountId").val("0").prop("disabled", false);
  $("#FullName").val("").prop("disabled", false);
  $("#PhoneNumber").val("").prop("disabled", false);
  $("#IdentityCard").val("").prop("disabled", false);
  $("#DateOfBirth").val("").prop("disabled", false);
  $("#Email").val("").prop("disabled", false);
  $("input[name='Sex']").prop("disabled", false);
  $("#Active").prop("checked", true).prop("disabled", false);
  $("#addCustomerForm")[0].reset();
  $("#idcard-before-preview").attr("src", "");
  $("#idcard-after-preview").attr("src", "");
  $("#IDCardBefore").val("");
  $("#IDCardAfter").val("");
  $("#btn-add-idcard-before").show();
  $("#btn-remove-idcard-before").hide();
  $("#btn-add-idcard-after").show();
  $("#btn-remove-idcard-after").hide();
  $("#btn-add-customer").show();
  $("#btn-edit-customer").hide();
  $(".title-add").show();
  $(".title-update").hide();
  $(".title-view").hide();
  $("#modal-customer").modal("show");
});

// Handle Save button
$("#btn-add-customer").on("click", function (e) {
  e.preventDefault();
  if ($("#addCustomerForm").valid()) {
    let formData = new FormData();
    formData.append("FullName", $("#FullName").val());
    formData.append("PhoneNumber", $("#PhoneNumber").val());
    formData.append("IdentityCard", $("#IdentityCard").val());
    formData.append("DateOfBirth", $("#DateOfBirth").val());
    formData.append("Sex", $("input[name='Sex']:checked").val());
    formData.append(
      "CustomerActive",
      $("#CustomerActive").is(":checked") ? 1 : 0
    );
    formData.append("Email", $("#Email").val());
    formData.append("Username", $("#Username").val());
    formData.append("Password", $("#Password").val());
    formData.append(
      "AccountActive",
      $("#AccountActive").is(":checked") ? 1 : 0
    );

    // Handle file uploads
    const idCardBeforeFile = $("#IDCardBefore")[0].files[0];
    const idCardAfterFile = $("#IDCardAfter")[0].files[0];
    const profilePictureFile = $("#ProfilePicture")[0].files[0];

    if (idCardBeforeFile) formData.append("IDCardBefore", idCardBeforeFile);
    if (idCardAfterFile) formData.append("IDCardAfter", idCardAfterFile);
    if (profilePictureFile)
      formData.append("ProfilePicture", profilePictureFile);
    $.ajax({
      type: "POST",
      url: BaseUrl + "customers/add",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $("#modal-customer").modal("hide");
          Dashmix.helpers("jq-notify", {
            type: "success",
            icon: "fa fa-check me-1",
            message: "Customer added successfully!",
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
            message: response.message || "Add Customer failed!",
          });
        }
      },
      error: function () {
        Dashmix.helpers("jq-notify", {
          type: "danger",
          icon: "fa fa-times me-1",
          message: "Error occurred while adding customer",
        });
      },
    });
  }
});

// Handle Edit button show modal
$(document).on("click", ".js-edit-customer", function () {
  let id = $(this).data("id");
  $("#addCustomerForm")[0].reset();
  $("#view-customer-div").hide();
  $("#edit-customer-div").show();
  $("#customerId").val(id);

  $(".title-add").hide();
  $(".title-update").show();
  $(".title-view").hide();
  $("#btn-add-customer").hide();
  $("#btn-edit-customer").show();

  $.ajax({
    type: "POST",
    url: BaseUrl + `customers/get`,
    data: {
      CustomerID: id,
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        const customer = response.data;

        $("#btn-edit-customer").attr({
        "data-id": customer.CustomerID,
          "data-AccountID": customer.AccountID,
          "data-TotalOrdered": customer.TotalOrdered,
          "data-TotalFine": customer.TotalFine,
          "data-TotalAmount": customer.TotalAmount,
        });
        $("#FullName").val(customer.FullName).prop("disabled", false);
        $("#PhoneNumber").val(customer.PhoneNumber).prop("disabled", false);
        $("#IdentityCard").val(customer.IdentityCard).prop("disabled", false);
        $("#DateOfBirth").val(customer.DateOfBirth).prop("disabled", false);
        $("input[name='Sex'][value='" + customer.Sex + "']").prop(
          "checked",
          true
        );
        $("input[name='Sex']").prop("disabled", false);
        $("#CustomerActive")
          .prop("checked", customer.Active == 1)
          .prop("disabled", false);
        $("#AccountActive")
          .prop("checked", customer.Active == 1)
          .prop("disabled", false);
        $("#Email")
          .val(customer.Email || "")
          .prop("disabled", false);
        $("#Password").val("*********").prop("disabled", true);
        $("#Username").val(customer.Username).prop("disabled", false);

        $("#idcard-before-preview").prop("disabled", false);
        $("#idcard-after-preview").prop("disabled", false);
        // Handle ID card images
        if (customer.IDCardBefore) {
          $("#idcard-before-preview").attr("src", customer.IDCardBefore);
          $("#btn-add-idcard-before").hide();
          $("#btn-remove-idcard-before").show();
        }
        if (customer.IDCardAfter) {
          $("#idcard-after-preview").attr("src", customer.IDCardAfter);
          $("#btn-add-idcard-after").hide();
          $("#btn-remove-idcard-after").show();
        }

        $("#modal-customer").modal("show");
      }
    },
    error: function () {
      Dashmix.helpers("jq-notify", {
        type: "danger",
        icon: "fa fa-times me-1",
        message: "Error occurred while fetching customer details",
      });
    },
  });
});

// Handle View button
$(document).on("click", ".js-view-customer", function () {
  let id = $(this).data("id");
  $("#addCustomerForm")[0].reset();
  $("#view-customer-div").hide();
  $("#edit-customer-div").show();
  $("#customerId").val(id);

  $(".title-add").hide();
  $(".title-update").hide();
  $(".title-view").show();
  $("#btn-add-customer").hide();
  $("#btn-edit-customer").show();

  $.ajax({
    type: "POST",
    url: BaseUrl + `customers/get`,
    data: {
      CustomerID: id,
    },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        const customer = response.data;
        $("#FullName").val(customer.FullName).prop("disabled", true);
        $("#PhoneNumber").val(customer.PhoneNumber).prop("disabled", true);
        $("#IdentityCard").val(customer.IdentityCard).prop("disabled", true);
        $("#DateOfBirth").val(customer.DateOfBirth).prop("disabled", true);
        $("input[name='Sex'][value='" + customer.Sex + "']")
          .prop("checked", true)
          .prop("disabled", false);
        $("input[name='Sex']").prop("disabled", true);
        $("#CustomerActive")
          .prop("checked", customer.Active == 1)
          .prop("disabled", true);
        $("#AccountActive")
          .prop("checked", customer.Active == 1)
          .prop("disabled", true);
        $("#Email")
          .val(customer.Email || "")
          .prop("disabled", true);
        $("#Password").val("*********").prop("disabled", true);
        $("#Username").val(customer.Username).prop("disabled", true);
        $("#idcard-before-preview").prop("disabled", true);
        $("#idcard-after-preview").prop("disabled", true);
        // Handle ID card images
        if (customer.IDCardBefore) {
          $("#idcard-before-preview").attr("src", customer.IDCardBefore);
          $("#btn-add-idcard-before").hide();
          $("#btn-remove-idcard-before").show();
        }
        if (customer.IDCardAfter) {
          $("#idcard-after-preview").attr("src", customer.IDCardAfter);
          $("#btn-add-idcard-after").hide();
          $("#btn-remove-idcard-after").show();
        }

        $("#modal-customer").modal("show");
      }
    },
    error: function () {
      Dashmix.helpers("jq-notify", {
        type: "danger",
        icon: "fa fa-times me-1",
        message: "Error occurred while fetching customer details",
      });
    },
  });
});

// Handle Update button
$("#btn-edit-customer").on("click", function (e) {
  e.preventDefault();
    let id = $(this).data("id");
  let accountID = $('#btn-edit-customer').data('accountid');
  let totalOrdered = $('#btn-edit-customer').data('totalordered');
  let totalFine = $('#btn-edit-customer').data('totalfine');
  let totalAmount = $('#btn-edit-customer').data('totalamount');
  if ($("#addCustomerForm").valid()) {
    let formData = new FormData();
    formData.append("CustomerID", id);
    formData.append("AccountID", accountID);
    formData.append("TotalOrdered", totalOrdered);
    formData.append("TotalFine", totalFine);
    formData.append("TotalAmount", totalAmount);
    formData.append("FullName", $("#FullName").val());
    formData.append("PhoneNumber", $("#PhoneNumber").val());
    formData.append("IdentityCard", $("#IdentityCard").val());
    formData.append("DateOfBirth", $("#DateOfBirth").val());
    formData.append("Sex", $("input[name='Sex']:checked").val());
    formData.append(
      "CustomerActive",
      $("#CustomerActive").is(":checked") ? 1 : 0
    );
    formData.append("Email", $("#Email").val());
    formData.append("Username", $("#Username").val());
    formData.append("Password", $("#Password").val());
    formData.append(
      "AccountActive",
      $("#AccountActive").is(":checked") ? 1 : 0
    );

    // Handle file uploads
    const idCardBeforeFile = $("#IDCardBefore")[0].files[0];
    const idCardAfterFile = $("#IDCardAfter")[0].files[0];
    const profilePictureFile = $("#ProfilePicture")[0].files[0];

    if (idCardBeforeFile) formData.append("IDCardBefore", idCardBeforeFile);
    if (idCardAfterFile) formData.append("IDCardAfter", idCardAfterFile);
    if (profilePictureFile)
      formData.append("ProfilePicture", profilePictureFile);

    $.ajax({
      type: "POST",
      url: BaseUrl + "customers/update",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $("#modal-customer").modal("hide");
          Dashmix.helpers("jq-notify", {
            type: "success",
            icon: "fa fa-check me-1",
            message: "Customer updated successfully!",
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
            message: response.message || "Update Customer failed!",
          });
        }
      },
      error: function () {
        Dashmix.helpers("jq-notify", {
          type: "danger",
          icon: "fa fa-times me-1",
          message: "Error occurred while updating customer",
        });
      },
    });
  }
});

$(document).on("click", ".js-delete-customer", function () {
  const id = $(this).data("id");
  const accountId = $(this).data("accountid");
  
  Swal.fire({
    title: "Are you sure you want to delete this customer?",
    text: "This action cannot be undone!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Delete",
    cancelButtonText: "Cancel"
  }).then((result) => {
    if (result.isConfirmed) {
    $.ajax({
      type: "POST",
      url: BaseUrl + "customers/delete",
      data: {
      CustomerID: id,
      AccountID: accountId,
      },
      dataType: "json",
      success: function (response) {
      if (response.success) {
        Swal.fire("Deleted!", "The customer has been successfully deleted.", "success");
        mainPagePagination.getPagination(
        mainPagePagination.option,
        mainPagePagination.valuePage.curPage
        );
      } else {
        Swal.fire("Failed!", response.message || "Failed to delete the customer!", "error");
      }
      },
      error: function () {
      Swal.fire("Error!", "An error occurred while deleting the customer.", "error");
      }
    });
    }
  });
  });
  

// Initialize pagination
const mainPagePagination = new Pagination();
mainPagePagination.option.controller = "customers";
mainPagePagination.option.model = "CustomerModel";
mainPagePagination.option.limit = 10;
mainPagePagination.option.filter = {};
mainPagePagination.getPagination(
  mainPagePagination.option,
  mainPagePagination.valuePage.curPage
);
