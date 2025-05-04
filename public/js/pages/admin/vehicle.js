function calculateDiscountPercentage(originalPrice, discountedPrice) {
  if (
    originalPrice <= 0 ||
    discountedPrice < 0 ||
    discountedPrice > originalPrice
  ) {
    throw new Error("Invalid price values");
  }
  const discountPercentage =
    ((originalPrice - discountedPrice) / originalPrice) * 100;

  // Làm tròn tới 2 chữ số thập phân
  const roundedDiscount = Math.round(discountPercentage * 100) / 100;

  // Nếu phần thập phân là 0, trả về số nguyên
  return roundedDiscount % 1 === 0
    ? roundedDiscount.toFixed(0)
    : roundedDiscount.toFixed(2);
}

Dashmix.helpersOnLoad(["js-flatpickr", "jq-datepicker"]);

Dashmix.onLoad(() =>
  class {
    static initValidation() {
      Dashmix.helpers("jq-validation"),
        jQuery("#addVehicleForm").validate({
          rules: {
            makeID: { required: !0 },
            vehicleTypeID: { required: !0 },
            modelID: { required: !0 },
            seats: { required: !0 },
            dailyPrice: { required: !0, min: 0 },
            hourlyPrice: { required: !0, min: 0 },
          },
          messages: {
            makeID: { required: "Please select a make" },
            vehicleTypeID: { required: "Please select a vehicle type" },
            modelID: { required: "Please select a model" },
            seats: { required: "Please select number of seats" },
            dailyPrice: {
              required: "Please enter daily price",
              min: "Price must be positive",
            },
            hourlyPrice: {
              required: "Please enter hourly price",
              min: "Price must be positive",
            },
          },
        });
    }

    static init() {
      this.initValidation();
    }
  }.init()
);

// Function to calculate discounted prices
function calculateDiscountedPrices() {
  const dailyPrice = parseFloat($("#dailyPrice").val()) || 0;
  const weeklyDiscount = parseFloat($("#weeklyDiscount").val()) || 0;
  const monthlyDiscount = parseFloat($("#monthlyDiscount").val()) || 0;

  // Calculate weekly price (7 days with discount)
  const weeklyPrice = dailyPrice * 7 * (1 - weeklyDiscount / 100);
  $("#weeklyPrice").val(weeklyPrice.toFixed(2));

  // Calculate monthly price (30 days with discount)
  const monthlyPrice = dailyPrice * 30 * (1 - monthlyDiscount / 100);
  $("#monthlyPrice").val(monthlyPrice.toFixed(2));
}

// Function to render vehicle data in table
const renderData = function (vehicles) {
  let html = "";
  console.log(vehicles);
  if(vehicles.length === 0) {
    $("#list-vehicle").html('<tr><td colspan="10" class="text-center">No data available</td></tr>');
    return;
  }
  vehicles.forEach((vehicle) => {
    html += `<tr>            
            <td>${vehicle.VehicleID}</td>
            <td>
              <div class="fw-semibold">${vehicle.MakeName}</div>
              <div class="text-muted small">${vehicle.ModelName}</div>
            </td>
            <td>
              <div class="fw-semibold">${vehicle.NameType}</div>
              <div class="text-muted small">${vehicle.Seats}</div>
            </td>
            <td>
              <div class="fw-semibold">${vehicle.HourlyPrice}</div>
              <div class="text-muted small">${vehicle.DailyPrice}</div>
            </td>
            <td>
              <div class="fw-semibold">${vehicle.MonthlyPrice}</div>
              <div class="text-muted small">${vehicle.WeeklyPrice}</div>
            </td>
            <td>${vehicle.Quantity}</td>
            <td>
                ${
                  vehicle.Active == 1
                    ? '<span class="badge bg-success">Available</span>'
                    : '<span class="badge bg-danger">Unavailable</span>'
                }             </td>
            <td class="text-center">
                <div class="btn-group">
                    <a class="btn btn-sm btn-alt-secondary js-detail-vehicle"  href="${BaseUrl}vehicles/addvehicles&id=${vehicle.VehicleID}"
                            data-id="${vehicle.VehicleID}"
                            title="Show Details">
                        <i class="fa fa-rectangle-list"></i>
                    </a>
                    <button class="btn btn-sm btn-alt-secondary js-edit-vehicle" 
                            data-id="${vehicle.VehicleID}"
                            title="Edit">
                        <i class="fa fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-sm btn-alt-secondary js-delete-vehicle" 
                            data-id="${vehicle.VehicleID}"
                            title="Delete">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </td>
        </tr>`;
  });

  $("#list-vehicle").html(html);
  $('[data-bs-toggle="tooltip"]').tooltip();
};

// Handle Add Vehicle button
$(".btn-add").on("click", function (e) {
  // Reset form
  $("#addVehicleForm")[0].reset();
  $("#weeklyPrice").val("");
  $("#monthlyPrice").val("");

  // Update modal title and buttons
  $("#saveVehicleBtn").show();
  $("#updateVehicleBtn").hide();
  $("#addVehicleModalLabel").text("Add New Vehicle");

  // Show modal
  $("#addVehicleModal").modal("show");
});

// Handle Save Vehicle button
$("#saveVehicleBtn").on("click", function (e) {
  e.preventDefault();

  if ($("#addVehicleForm").valid()) {
    const formData = {
      makeID: $("#makeID").val(),
      modelID: $("#modelID").val(),
      vehicleTypeID: $("#vehicleTypeID").val(),
      seats: $("#seats").val(),
      hourlyPrice: $("#hourlyPrice").val(),
      dailyPrice: $("#dailyPrice").val(),
      weeklyPrice: $("#weeklyPrice").val(),
      monthlyPrice: $("#monthlyPrice").val(),
      promotionID: $("#promotionID").val() || 0,
      active: $("#active").is(":checked") ? 1 : 0,
    };

    $.ajax({
      type: "post",
      url: BaseUrl + "vehicles/add",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $("#addVehicleModal").modal("hide");
          Dashmix.helpers("jq-notify", {
            type: "success",
            icon: "fa fa-check me-1",
            message: "Vehicle added successfully!",
            z_index: 9999,
          });
          vehiclePagination.getPagination(
            vehiclePagination.option,
            vehiclePagination.valuePage.curPage
          );
        } else {
          Dashmix.helpers("jq-notify", {
            type: "danger",
            icon: "fa fa-times me-1",
            message: response.message || "Add vehicle failed!",
          });
        }
      },
      error: function () {
        Dashmix.helpers("jq-notify", {
          type: "danger",
          icon: "fa fa-times me-1",
          message: "Error occurred while adding vehicle",
        });
      },
    });
  }
});

// Handle Edit Vehicle button
$(document).on("click", ".js-edit-vehicle", function () {
  let vehicleID = $(this).data("id");
  $.ajax({
    type: "post",
    url: BaseUrl + "vehicles/getVehicle",
    data: { id: vehicleID },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response.success) {
        const vehicle = response.data;
        // Fill form with vehicle data
        $("#makeID").val(vehicle.MakeID);
        $("#modelID").val(vehicle.ModelID);
        $("#vehicleTypeID").val(vehicle.VehicleTypesID);
        $("#seats").val(vehicle.Seats);
        $("#hourlyPrice").val(vehicle.HourlyPrice);
        $("#dailyPrice").val(vehicle.DailyPrice);
        $("#weeklyPrice").val(vehicle.WeeklyPrice);
        $("#monthlyPrice").val(vehicle.MonthlyPrice);
        $("#weeklyDiscount").val(
          calculateDiscountPercentage(
            vehicle.DailyPrice,
            vehicle.WeeklyPrice / 7
          ) || 0
        );
        $("#monthlyDiscount").val(
          calculateDiscountPercentage(
            vehicle.DailyPrice,
            vehicle.MonthlyPrice / 30
          ) || 0
        );
        $("#promotionID").val(vehicle.PromotionID || 0);
        $("#active").prop("checked", vehicle.Active == 1);
      }
    },
    error: function () {
      Dashmix.helpers("jq-notify", {
        type: "danger",
        icon: "fa fa-times me-1",
        message: "Error occurred while adding vehicle",
      });
    },
  });
  // Fill form with vehicle data
  // $("#makeID").val($(this).data("makeid"));
  // $("#modelID").val($(this).data("modelid"));
  // $("#vehicleTypeID").val($(this).data("vehicletypeid"));
  // $("#seats").val($(this).data("seats"));
  // $("#hourlyPrice").val($(this).data("hourlyprice"));
  // $("#dailyPrice").val($(this).data("dailyprice"));
  // $("#weeklyPrice").val($(this).data("weeklyprice"));
  // $("#monthlyPrice").val($(this).data("monthlyprice"));
  // $("#weeklyDiscount").val($(this).data("weeklydiscount"));
  // $("#monthlyDiscount").val($(this).data("monthlydiscount"));
  // $("#promotionID").val($(this).data("promotionid"));
  // $("#description").val($(this).data("description"));
  // $("#active").prop("checked", $(this).data("active") == 1);
  // $("#feature").prop("checked", $(this).data("feature") == 1);

  // Store vehicle ID in update button
  $("#updateVehicleBtn").attr("data-id", $(this).data("id"));

  // Update modal title and buttons
  $("#addVehicleModalLabel").text("Update Vehicle");
  $("#saveVehicleBtn").hide();
  $("#updateVehicleBtn").show();

  // Show modal
  $("#addVehicleModal").modal("show");
});

// Handle Update Vehicle button
$("#updateVehicleBtn").on("click", function (e) {
  e.preventDefault();
  let vehicleID = $(this).data("id");
  if ($("#addVehicleForm").valid()) {
    const formData = {
      vehicleID: $(this).attr("data-id"),
      makeID: $("#makeID").val(),
      modelID: $("#modelID").val(),
      vehicleTypeID: $("#vehicleTypeID").val(),
      seats: $("#seats").val(),
      hourlyPrice: $("#hourlyPrice").val(),
      dailyPrice: $("#dailyPrice").val(),
      weeklyPrice: $("#weeklyPrice").val(),
      monthlyPrice: $("#monthlyPrice").val(),
      weeklyDiscount: $("#weeklyDiscount").val() || 0,
      monthlyDiscount: $("#monthlyDiscount").val() || 0,
      promotionID: $("#promotionID").val(),
      active: $("#active").is(":checked") ? 1 : 0,
    };

    $.ajax({
      type: "post",
      url: BaseUrl + "vehicles/update",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          $("#addVehicleModal").modal("hide");
          Dashmix.helpers("jq-notify", {
            type: "success",
            icon: "fa fa-check me-1",
            message: "Vehicle updated successfully!",
            z_index: 9999,
          });
          vehiclePagination.getPagination(
            vehiclePagination.option,
            vehiclePagination.valuePage.curPage
          );
        } else {
          Dashmix.helpers("jq-notify", {
            type: "danger",
            icon: "fa fa-times me-1",
            message: response.message || "Update vehicle failed!",
          });
        }
      },
      error: function () {
        Dashmix.helpers("jq-notify", {
          type: "danger",
          icon: "fa fa-times me-1",
          message: "Error occurred while updating vehicle",
        });
      },
    });
  }
});

// Handle Delete Vehicle button
$(document).on("click", ".js-delete-vehicle", function () {
  const id = $(this).data("id");

  Swal.fire({
    title: 'Confirm Delete',
    text: 'Are you sure you want to delete data?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, Delete',
    cancelButtonText: 'Cancel',
    reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
      type: "post",
      url: BaseUrl + "vehicles/delete",
      data: { id: id },
      dataType: "json",
      success: function (response) {
        if (response) {
          Dashmix.helpers("jq-notify", {
            type: "success",
            icon: "fa fa-check me-1",
            message: "Vehicle deleted successfully!",
            z_index: 9999,
          });
          vehiclePagination.getPagination(
            vehiclePagination.option,
            vehiclePagination.valuePage.curPage
          );
        } else {
          Dashmix.helpers("jq-notify", {
            type: "danger",
            icon: "fa fa-times me-1",
            message: response.message || "Delete vehicle failed!",
          });
        }
      },
      error: function () {
        Dashmix.helpers("jq-notify", {
          type: "danger",
          icon: "fa fa-times me-1",
          message: "Error occurred while deleting vehicle",
        });
      },
    });
  }
});
});
// Lấy dữ liệu "Makes" được chọn
$("input[name='makes']").change(function () {
  let selectedMakes = []; 

  // Lấy tất cả các checkbox "Makes" đã được chọn
  $("input[name='makes']:checked").each(function () {
      selectedMakes.push($(this).val());
  });

  // Kiểm tra nếu không có giá trị được chọn
  if (selectedMakes.length === 0) {
      delete vehiclePagination.option.filter.makeID; // Xóa filter nếu không có giá trị
  } else {
      vehiclePagination.option.filter.makeID = selectedMakes; // Gán giá trị được chọn vào filter
  }

  // Gọi hàm cập nhật phân trang
  vehiclePagination.getPagination(
      vehiclePagination.option,
      vehiclePagination.valuePage.curPage
  );
});

// Lấy dữ liệu "Models" được chọn
$("input[name='models']").change(function () {
  let selectedModels = [];

  // Lấy tất cả các checkbox "Models" đã được chọn
  $("input[name='models']:checked").each(function () {
      selectedModels.push($(this).val());
  });

  // Kiểm tra nếu không có giá trị được chọn
  if (selectedModels.length === 0) {
      delete vehiclePagination.option.filter.modelID; // Xóa filter nếu không có giá trị
  } else {
      vehiclePagination.option.filter.modelID = selectedModels; // Gán giá trị được chọn vào filter
  }

  // Gọi hàm cập nhật phân trang
  vehiclePagination.getPagination(
      vehiclePagination.option,
      vehiclePagination.valuePage.curPage
  );
});

// Lấy dữ liệu "Seats" được chọn
$("input[name='seats']").change(function () {
  let selectedSeats = []; // Mảng chứa các giá trị được chọn

  // Lấy tất cả các checkbox "Seats" đã được chọn
  $("input[name='seats']:checked").each(function () {
      selectedSeats.push($(this).val());
  });

  // Kiểm tra nếu không có giá trị được chọn
  if (selectedSeats.length === 0) {
      delete vehiclePagination.option.filter.seats; // Xóa filter nếu không có giá trị
  } else {
      vehiclePagination.option.filter.seats = selectedSeats; // Gán giá trị được chọn vào filter
  }

  // Gọi hàm cập nhật phân trang
  vehiclePagination.getPagination(
      vehiclePagination.option,
      vehiclePagination.valuePage.curPage
  );
});

// Lấy dữ liệu "Vehicle Types" được chọn
$("input[name='vehicle_types']").change(function () {
  let selectedTypes = []; // Mảng chứa các giá trị được chọn

  // Lấy tất cả các checkbox "Vehicle Types" đã được chọn
  $("input[name='vehicle_types']:checked").each(function () {
      selectedTypes.push($(this).val());
  });

  // Kiểm tra nếu không có giá trị được chọn
  if (selectedTypes.length === 0) {
      delete vehiclePagination.option.filter.vehicleTypeID; // Xóa filter nếu không có giá trị
  } else {
      vehiclePagination.option.filter.vehicleTypeID = selectedTypes; // Gán giá trị được chọn vào filter
  }

  // Gọi hàm cập nhật phân trang
  vehiclePagination.getPagination(
      vehiclePagination.option,
      vehiclePagination.valuePage.curPage
  );
});



// Initialize pagination for vehicles
const vehiclePagination = new Pagination();
vehiclePagination.option.controller = "vehicles";
vehiclePagination.option.model = "VehicleModel";
vehiclePagination.option.limit = 10;
vehiclePagination.option.filter = {};
vehiclePagination.getPagination(
vehiclePagination.option,
vehiclePagination.valuePage.curPage
);

// Event listeners for price calculations
$("#dailyPrice, #weeklyDiscount, #monthlyDiscount").on(
  "input",
  calculateDiscountedPrices
);

//add
$(document).ready(function() {
  const $uploadInput = $('#upload-image');
  const $previewContainer = $('#image-preview-container');
  const $initialUpload = $('#initial-upload');
  
  // Tạo container preview list nếu chưa có
  if ($previewContainer.children('.preview-list').length === 0) {
      $previewContainer.append($('<div>').addClass('preview-list'));
  }
  
  $uploadInput.on('change', function(e) {
      const files = e.target.files;
      if (files.length > 0) {
          $initialUpload.hide();
          const $previewList = $previewContainer.find('.preview-list');
          
          $.each(files, function(i, file) {
              if (!file.type.match('image.*')) return;
              
              const reader = new FileReader();
              
              reader.onload = function(event) {
                  const $previewItem = $('<div>').addClass('preview-item');
                  
                  // Tạo preview và thông tin ảnh
                  const $imageInfo = $('<div>').addClass('image-info');
                  const $imgPreview = $('<img>').addClass('image-preview')
                      .attr('src', event.target.result);
                  const $imageName = $('<div>').addClass('image-name')
                      .text(file.name);
                  
                  $imageInfo.append($imgPreview, $imageName);
                  
                  // Tạo nút action
                  const $actionButtons = $('<div>').addClass('action-buttons');
                  
                  // Nút thêm ảnh
                  const $addBtn = $('<button>')
                      .addClass('add-btn')
                      .html('<i class="fas fa-plus"></i> Add image')
                      .on('click', function() {
                          $uploadInput.click();
                      });
                  
                  // Nút xóa ảnh
                  const $deleteBtn = $('<button>')
                      .addClass('delete-btn')
                      .html('<i class="fas fa-times"></i> Delete')
                      .on('click', function() {
                          $previewItem.remove();
                          if ($previewList.children().length === 0) {
                              $initialUpload.show();
                          }
                      });
                  
                  $actionButtons.append($addBtn, $deleteBtn);
                  $previewItem.append($imageInfo, $actionButtons);
                  $previewList.append($previewItem);
              };
              
              reader.readAsDataURL(file);
          });
          
          // Reset input
          $uploadInput.val('');
      }
  });
  
  // Click to initial upload box
  $initialUpload.on('click', function(e) {
    e.preventDefault();
    $uploadInput.click();
  });
});