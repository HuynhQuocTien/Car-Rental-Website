Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);

Dashmix.onLoad((() => class {
  static initValidation() {
    Dashmix.helpers("jq-validation"), jQuery("#addPromationForm").validate({
      rules: {
        "name":{
          required: !0
        },
        code:{
          required: !0
        },
        "discountType": {
          required: !0
        },
        "discountValue": {
          required: !0,
          min: 0.01
        },
        "vehicleId": {
          required: function() {
            return $("#applyToSpecificVehicle").is(":checked");
          }
        },
        "startDate": {
          required: !0,
          date: !0
        },
        "endDate": {
          required: !0,
          date: !0,
          greaterThanStart: !0
        }
      },
      messages: {
        "name":{
          required: "Please enter name promotion",

        },
        code:{
          required: "Please enter code",

        },
        "discountType": {
          required: "Please select discount type",
        },
        "discountValue": {
          required: "Please enter discount value",
          min: "Discount value must be greater than 0"
        },
        "vehicleId": {
          required: "Please select a vehicle"
        },
        "startDate": {
          required: "Please select start date"
        },
        "endDate": {
          required: "Please select end date",
          greaterThanStart: "End date must be after start date"
        }
      }
    });
    
    // Custom validation method for end date
    jQuery.validator.addMethod("greaterThanStart", function(value, element) {
      const startDate = new Date($("#startDate").val());
      const endDate = new Date(value);
      return this.optional(element) || endDate > startDate;
    }, "End date must be after start date");
  }
  
  static init() {
    this.initValidation();
  }
}.init()));
const renderData = function(promotions) {
  let html = "";
  promotions.forEach((promo) => {
    const discount = promo.DiscountType === "0" ? "%" : "$";
    const discountType = promo.DiscountType === "0" ? `<span class="badge bg-warning">Percent</span>` : '<span class="badge bg-success">Cash</span>';
    const vehicleName = promo.VehicleID ? `<span class="badge bg-danger">${promo.VehicleID}</span>` : '<span class="badge bg-info">All</span>';
    const statusBadge = promo.Status === "1" ? 
      '<span class="badge bg-success">Active</span>' : 
      '<span class="badge bg-danger">Inactive</span>';
    html += `<tr>
      <td>${promo.PromotionID}</td>
      <td>${promo.PromotionName}</td>
      <td>${vehicleName}</td>
      <td>${discountType}</td>
      <td>${promo.DiscountValue} <b>${discount}</b></td>
      <td>${promo.CreateAt}</td>
      <td>${promo.StartDate}</td>
      <td>${promo.EndDate}</td>
      <td>${statusBadge}</td>
      <td class="text-center">
        <div class="btn-group">
          <button class="btn btn-sm btn-alt-secondary js-detail"  data-function="15" data-permission="4"
                  data-id="${promo.PromotionID}"
                  data-name="${promo.PromotionName}"
                  data-code="${promo.PromotionCode}"
                  data-discounttype="${promo.DiscountType}"
                  data-discountvalue="${promo.DiscountValue}"
                  data-vehicleid="${promo.VehicleID || ''}"
                  data-startdate="${promo.StartDate}"
                  data-enddate="${promo.EndDate}"
                  data-description="${promo.Description || ''}"
                  data-status="${promo.Status}"
                  title="Show Details">
            <i class="fa fa-eye me-1"></i>
          </button>
          <button class="btn btn-sm btn-alt-secondary js-edit"  data-function="15" data-permission="2"
                  data-id="${promo.PromotionID}"
                  data-name="${promo.PromotionName}"
                  data-code="${promo.PromotionCode}"
                  data-discounttype="${promo.DiscountType}"
                  data-discountvalue="${promo.DiscountValue}"
                  data-vehicleid="${promo.VehicleID || ''}"
                  data-startdate="${promo.StartDate}"
                  data-enddate="${promo.EndDate}"
                  data-description="${promo.Description || ''}"
                  data-status="${promo.Status}"
                  title="Edit">
            <i class="fa fa-pencil-alt"></i>
          </button>
          <button class="btn btn-sm btn-alt-secondary js-delete" data-function="15" data-permission="3"
                  data-id="${promo.PromotionID}"
                  title="Delete">
            <i class="fa fa-times"></i>
          </button>
        </div>
      </td>
    </tr>`;
  });
  
  $("#list-promotions").html(html);
  $('[data-bs-toggle="tooltip"]').tooltip();
};

function generatePromoCode() {
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  let promoCode = ''; 

  // Tạo 6 ký tự ngẫu nhiên từ dãy ký tự
  for (let i = 0; i < 6; i++) {
    const randomIndex = Math.floor(Math.random() * characters.length);
    promoCode += characters[randomIndex];
  }

  // Lấy ngày, tháng, năm hiện tại
  const today = new Date();
  const day = String(today.getDate()).padStart(2, '0');  // Lấy ngày và định dạng 2 chữ số
  const month = String(today.getMonth() + 1).padStart(2, '0');  // Lấy tháng (tháng bắt đầu từ 0)
  const year = today.getFullYear();  // Lấy năm

  // Kết hợp ngày tháng năm vào mã khuyến mãi
  promoCode += `${day}${month}${year}`;

  return promoCode;
}
// Toggle vehicle dropdown based on checkbox
$("#applyToSpecificVehicle").on("change", function() {
  if ($(this).is(":checked")) {
    $("#vehicleDropdownContainer").removeClass("d-none");
    $("#vehicleId").attr("required", true);
  } else {
    $("#vehicleDropdownContainer").addClass("d-none");
    $("#vehicleId").removeAttr("required").val("");
  }
});

function resetPromotionForm() {
  $("#addPromationForm")[0].reset();
  $("#addPromationForm input, #addPromationForm select, #addPromationForm textarea").prop("readonly", false).prop("disabled", false);
  $("#applyToSpecificVehicle").prop("checked", false).trigger("change");
}

$(".btn-add").off('submit').on("click", function (e) {
  resetPromotionForm();
  $('#codeDiv').prop("hidden", true).prop("disabled", true);
  $("#code").val(generatePromoCode());
  $("#promotionIdContainer").addClass("d-none"); // Hide ID field
  $("#addPromotionModalLabel").text("Add New Promotion");
  $("#addPromotionModal").modal("show");
  $("#addPromotionBtn").show();
  $("#updatePromotionBtn").hide();
});


// Save promotion
$("#addPromotionBtn").on("click", function(e) {
  e.preventDefault();
  
  if ($("#addPromationForm").valid()) {
    const formData = {
      name: $("#val-name").val(),
      code: $("#code").val(),
      discountType: $("#discountType").val(),
      discountValue: $("#discountValue").val(),
      vehicleId: $("#applyToSpecificVehicle").is(":checked") ? $("#vehicleId").val() : null,
      startDate: $("#startDate").val(),
      endDate: $("#endDate").val(),
      description: $("#description").val(),
      status: $("#status").is(":checked") ? 1 : 0
    };
    
    $.ajax({
      type: "post",
      url: BaseUrl + "promotions/add",
      data: formData,
      dataType: "json",
      success: function(response) {
        if (response.success) {
          $("#addPromotionModal").modal("hide");
          Dashmix.helpers('jq-notify', { 
            type: 'success', 
            icon: 'fa fa-check me-1', 
            message: 'Promotion added successfully!',
            z_index: 9999
          });
          promotionPagination.getPagination(promotionPagination.option, promotionPagination.valuePage.curPage);
        } else {
          Dashmix.helpers('jq-notify', { 
            type: 'danger', 
            icon: 'fa fa-times me-1', 
            message: response.message || 'Add promotion failed!'
          });
        }
      },
      error: function() {
        Dashmix.helpers('jq-notify', { 
          type: 'danger', 
          icon: 'fa fa-times me-1', 
          message: 'An error occurred while adding promotion'
        });
      }
    });
  }
});

// Edit promotion
$(document).on("click", ".js-edit", function() {
  const promotionId = $(this).data("id");
  $('#codeDiv').prop("hidden", false).prop("disabled", true);
  $("#code").val($(this).data("code"));
  $("#promotionId").val(promotionId);
  $("#val-name").val($(this).data("name")).prop("disabled", false);
  $("#discountType").val($(this).data("discounttype")).prop("disabled", false);
  $("#discountValue").val($(this).data("discountvalue")).prop("disabled", false);
  
  const vehicleId = $(this).data("vehicleid");
  if (vehicleId) {
    $("#applyToSpecificVehicle").prop("checked", true).prop("disabled", false);
    $("#vehicleDropdownContainer").removeClass("d-none");
    $("#vehicleId").val(vehicleId).prop("disabled", false);
  } else {
    $("#applyToSpecificVehicle").prop("checked", false);
    $("#vehicleDropdownContainer").addClass("d-none");
    $("#vehicleId").val("");
  }
  
  $("#startDate").val($(this).data("startdate")).prop("readonly", false);
  $("#endDate").val($(this).data("enddate")).prop("disabled", false);
  $("#description").val($(this).data("description")).prop("disabled", false);
  $("#status").val($(this).data("status")).prop("disabled", false);
  
  $("#promotionIdContainer").removeClass("d-none");
  $("#addPromotionModalLabel").text("Update Promotion");
  
  $("#addPromotionBtn").hide();
  $("#updatePromotionBtn").show().attr("data-id", promotionId);
  
  $("#addPromotionModal").modal("show");
});
$(document).on("click", ".js-detail", function() {
  const promotionId = $(this).data("id");
  $("#codeDiv").prop("hidden", false).prop("disabled", true);
  $("#code").val($(this).data("code"));
  $("#promotionId").val(promotionId);
  $("#val-name").val($(this).data("name")).prop("disabled", true);
  $("#discountType").val($(this).data("discounttype")).prop("disabled", true);
  $("#discountValue").val($(this).data("discountvalue")).prop("disabled", true);
  
  const vehicleId = $(this).data("vehicleid");
  if (vehicleId) {
    $("#applyToSpecificVehicle").prop("checked", true).prop("disabled", true);
    $("#vehicleDropdownContainer").removeClass("d-none");
    $("#vehicleId").val(vehicleId).prop("disabled", true);
  } else {
    $("#applyToSpecificVehicle").prop("checked", true).prop("disabled", true);
    $("#vehicleDropdownContainer").addClass("d-none");
    $("#vehicleId").val("");
  }
  
  $("#startDate").val($(this).data("startdate")).prop("disabled", true);
  $("#endDate").val($(this).data("enddate")).prop("disabled", true);
  $("#description").val($(this).data("description")).prop("disabled", true);
  $("#status").val($(this).data("status")).prop("disabled", true);
  
  $("#promotionIdContainer").removeClass("d-none");
  $("#addPromotionModalLabel").text("Update Promotion");
  
  $("#addPromotionBtn").hide();
  $("#updatePromotionBtn").hide();
  
  $("#addPromotionModal").modal("show");
});

// Update promotion
$("#updatePromotionBtn").on("click", function(e) {
  e.preventDefault();
  const promotionId = $(this).data("id");
  
  if ($("#addPromationForm").valid()) {
    const formData = {
      promotionID: promotionId,
      name: $("#val-name").val(),
      code: $("#code").val(),
      discountType: $("#discountType").val(),
      discountValue: $("#discountValue").val(),
      vehicleId: $("#applyToSpecificVehicle").is(":checked") ? $("#vehicleId").val() : null,
      startDate: $("#startDate").val(),
      endDate: $("#endDate").val(),
      description: $("#description").val(),
      status: $("#status").is(":checked") ? 1 : 0
    };
    
    $.ajax({
      type: "post",
      url: BaseUrl + "promotions/update",
      data: formData,
      dataType: "json",
      success: function(response) {
        if (response.success) {
          $("#addPromotionModal").modal("hide");
          Dashmix.helpers('jq-notify', { 
            type: 'success', 
            icon: 'fa fa-check me-1', 
            message: 'Promotion updated successfully!',
            z_index: 9999
          });
          promotionPagination.getPagination(promotionPagination.option, promotionPagination.valuePage.curPage);
        } else {
          Dashmix.helpers('jq-notify', { 
            type: 'danger', 
            icon: 'fa fa-times me-1', 
            message: response.message || 'Update promotion failed!'
          });
        }
      },
      error: function() {
        Dashmix.helpers('jq-notify', { 
          type: 'danger', 
          icon: 'fa fa-times me-1', 
          message: 'An error occurred while updating promotion'
        });
      }
    });
  }
});



$(document).on("click", ".js-delete", function() {
  const promotionId = $(this).data("id");
  
  // Show confirmation dialog
  Swal.fire({
    title: 'Confirm Delete',
    text: 'Are you sure you want to delete this promotion?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Delete',
    cancelButtonText: 'Cancel',
    confirmButtonColor: '#d33', // Red color for Delete button
    cancelButtonColor: '#bbb', // Gray color for Cancel button
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      // Perform the AJAX request when confirmed
      $.ajax({
        type: "POST",
        url: BaseUrl + "promotions/delete",
        data: { promotionId: promotionId },
        dataType: "json",
        success: function(response) {
          if (response.success) {
            // Show success notification using SweetAlert2
            Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: 'Promotion deleted successfully!',
              timer: 1500,
              showConfirmButton: false
            });
            // Refresh pagination or any other logic you need
            promotionPagination.getPagination(promotionPagination.option, promotionPagination.valuePage.curPage);
          } else {
            // Show error notification
            Swal.fire({
              icon: 'error',
              title: 'Failed!',
              text: response.message || 'Delete promotion failed!',
              timer: 1500,
              showConfirmButton: false
            });
          }
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: 'An error occurred while deleting promotion',
            timer: 1500,
            showConfirmButton: false
          });
        }
      });
    }
  });
});
// Initialize pagination
const promotionPagination = new Pagination();
promotionPagination.option.controller = "promotions";
promotionPagination.option.model = "PromotionModel";
promotionPagination.option.limit = 10;
promotionPagination.option.filter = {};
promotionPagination.getPagination(promotionPagination.option, promotionPagination.valuePage.curPage);