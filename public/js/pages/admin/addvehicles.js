Dashmix.helpersOnLoad(["js-flatpickr", "jq-datepicker"]);
$("#btn-update-vehicle").hide();

Dashmix.onLoad(() =>
  class {
    static initValidation() {
      Dashmix.helpers("jq-validation");

      jQuery("#vehicle-form").validate({
        rules: {
          "discount-hourly": { required: true },
          "discount-daily": { required: true },
          "discount-weekly": { required: true },
          "discount-monthly": { required: true },
          "hourly-price": { required: true, min: 0 },
          "daily-price": { required: true, min: 0 },
          "weekly-price": { required: true, min: 0 },
          "monthly-price": { required: true, min: 0 },
          "fuel-consumption": { required: true },
          transmission: { required: true },
          "fuel-type": { required: true },
          year: { required: true, min: 1900 },
          "license-plate": { required: true },
          "color-id": { required: true },
          mileage: { required: true, min: 0 },
          "upload-image[]": {
            required: true,
            accept: "image/*",
          },
        },
        messages: {
          "discount-hourly": { required: "Please enter hourly discount" },
          "hourly-price": {
            required: "Please enter final hourly price",
            min: "Price must be non-negative",
          },
          "daily-price": {
            required: "Please enter final daily price",
            min: "Price must be non-negative",
          },
          "weekly-price": {
            required: "Please enter final weekly price",
            min: "Price must be non-negative",
          },
          "monthly-price": {
            required: "Please enter final monthly price",
            min: "Price must be non-negative",
          },
          "fuel-consumption": { required: "Please enter fuel consumption" },
          transmission: { required: "Please select transmission type" },
          "fuel-type": { required: "Please select fuel type" },
          year: { required: "Please enter year", min: "Year is invalid" },
          "license-plate": { required: "Please enter license plate" },
          "color-id": { required: "Please choose a color" },
          mileage: {
            required: "Please enter mileage",
            min: "Mileage must be non-negative",
          },
          "upload-image[]": {
            required: "Please select at least one image",
            accept: "Only image files are allowed to be uploaded.",
          },
        },
        errorPlacement: function (error, element) {
          if (element.attr("name") == "upload-image[]") {
            error.insertAfter("#image-preview-container");
          } else {
            error.insertAfter(element);
          }
        },
      });
    }

    static init() {
      this.initValidation();
    }
  }.init()
);

const renderData = function (vehicles) {
  let html = "";
  vehicles.forEach((vehicle) => {
    html += `<tr>
          <td>${vehicle.VehicleDetailID}</td>
          <td>
            <div class="fw-semibold">${vehicle.ColorName}</div>
            <div class="text-muted small">${vehicle.Year}</div>
          </td>
          <td>
            <div class="fw-semibold">${formatLicense(
              vehicle.LicensePlateNumber
            )}</div>
            <div class="text-muted small">${vehicle.Mileage} km</div>
          </td>
          <td></td>
          <td>
            <div class="fw-semibold">${vehicle.HourlyPrice}</div>
            <div class="text-muted small">${vehicle.DailyPrice}</div>
          </td>
          <td>
            <div class="fw-semibold">${vehicle.MonthlyPrice}</div>
            <div class="text-muted small">${vehicle.WeeklyPrice}</div>
          </td>
          <td>
            ${
              vehicle.Active == 1
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-danger">InActive</span>'
            }
          </td>
          <td class="text-center col-action">
            <div class="btn-group">
              <button class="btn btn-sm btn-alt-secondary js-detail-vehicle" data-function="4" data-permission="4"
                      data-id="${vehicle.VehicleDetailID}" title="Show Details">
                <i class="fa fa-eye me-1"></i> 
              </button>
              <button class="btn btn-sm btn-alt-secondary js-edit-vehicle" data-function="4" data-permission="2"
                      data-id="${vehicle.VehicleDetailID}" title="Edit">
                <i class="fa fa-pencil-alt"></i>
              </button>
              <button class="btn btn-sm btn-alt-secondary js-delete-vehicle" data-function="4" data-permission="3"
                      data-id="${vehicle.VehicleDetailID}" title="Delete">
                <i class="fa fa-times"></i>
              </button>
            </div>
          </td>
        </tr>`;
  });

  $("#vehicle-details-list").html(html);
  $('[data-bs-toggle="tooltip"]').tooltip();
};

function formatLicense(plate) {
  // Kiểm tra ký tự thứ 4 là chữ hay số
  if (plate.length == 8) {
    // Nếu là chữ → tách sau 3 ký tự
    return plate.replace(/^(.{3})(.+)/, "$1-$2");
  } else {
    // Nếu là số → tách sau 4 ký tự
    return plate.replace(/^(.{4})(.+)/, "$1-$2");
  }
}

function updateSaveImageInput() {
  const imageNames = [];

  $(".preview-list .preview-item").each(function () {
    const name = $(this).find(".image-name").text();
    if (name) {
      imageNames.push(name);
    }
  });

  $("#saveImage").val(imageNames.join(","));
}
$(document).ready(function () {
  function validateImages() {
    const files = $("#upload-image")[0].files;
    const $errorMsg = $("#upload-image\\[\\]-error");
    const $previewContainer = $("#image-preview-container");

    if (files.length > 0 || uploadedImages.filter(Boolean).length > 0) {
      // Có file mới hoặc đã có ảnh được lưu trong uploadedImages
      $errorMsg.hide();
      $previewContainer.removeClass("error-border");
      return true;
    } else {
      // Không có ảnh nào cả
      $errorMsg.show();
      $previewContainer.addClass("error-border");
      return false;
    }
  }
  $(".btn-add").on("click", function (e) {
    e.preventDefault();
    //Xử lí khi bấm nút Add cho tôi
    $("html, body").animate(
      {
        scrollTop: $("#title-add").offset().top,
      },
      500
    );
    // Điền giá cả
    $("#discount-hourly").val(0);

    $("#discount-daily").val(0);

    $("#discount-weekly").val(0);

    $("#discount-monthly").val(0);

    // Điền thông tin khác
    $("#fuel-consumption").val("");
    $("#transmission").val("");
    $("#fuel-type").val("");
    $("#year").val("");
    $("#license-plate").val("");
    $("#color-id").val("").trigger("change");
    $("#mileage").val("");
    $("#is-active").prop("checked", 1);
    $("#feature").prop("checked", 0);
    $("#js-ckeditor").val("");
    $("#btn-save-vehicle").show();
    $("#btn-save-vehicle").prop("disabled", false);
    $("#btn-update-vehicle").hide();
    resetImagePreview();
  });

  $("#reset-button").on("click", function (e) {
    e.preventDefault();

    // Hiển thị hộp thoại xác nhận bằng SweetAlert2
    Swal.fire({
      title: "Confirm Reset",
      text: "Are you sure you want to reset the images and data?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, Reset",
      cancelButtonText: "Cancel",
      reverseButtons: true,
    }).then((result) => {
      if (result.isConfirmed) {
        // Thực hiện reset nếu người dùng xác nhận
        $("#discount-hourly").val(0);
        $("#discount-daily").val(0);
        $("#discount-weekly").val(0);
        $("#discount-monthly").val(0);
        $("#fuel-consumption").val("");
        $("#transmission").val("");
        $("#fuel-type").val("");
        $("#year").val("");
        $("#license-plate").val("");
        $("#color-id").val("").trigger("change");
        $("#mileage").val("");
        $("#is-active").prop("checked", 1);
        $("#feature").prop("checked", 0);
        $("#js-ckeditor").val("");
        $("#btn-save-vehicle").show();
        $("#btn-save-vehicle").prop("disabled", false);
        $("#btn-update-vehicle").hide();
        resetImagePreview();
      }
    });
  });



  $("#btn-save-vehicle").on("click", function (e) {
    e.preventDefault();

    let formData = new FormData();
    formData.append("vehicle-id", $("#vehicle-id").val());
    formData.append("hourly-price", $("#final-hourly-price").val());
    formData.append("daily-price", $("#final-daily-price").val());
    formData.append("weekly-price", $("#final-weekly-price").val());
    formData.append("monthly-price", $("#final-monthly-price").val());
    formData.append("description", $("#js-ckeditor").val());
    formData.append("fuel-consumption", $("#fuel-consumption").val());
    formData.append("transmission", $("#transmission").val());
    formData.append("fuel-type", $("#fuel-type").val());
    formData.append("year", $("#year").val());
    formData.append("license-plate", $("#license-plate").val());
    formData.append("color-id", $("#color-id").val());
    formData.append("mileage", $("#mileage").val());
    formData.append("feature", $("#feature").is(":checked") ? 1 : 0);
    formData.append("is-active", $("#is-active").is(":checked") ? 1 : 0);

    const primaryIndex = $('input[name="default-image"]:checked')
      .closest(".preview-item")
      .data("file-index");

    uploadedImages.forEach((file, i) => {
      if (file) {
        formData.append("upload-image[]", file);
        formData.append("is-primary[]", i === primaryIndex ? 1 : 0);
      }
    });
    // AJAX call
    if ($("#vehicle-form").valid()) {
      if (!validateImages()) {
        Dashmix.helpers("jq-notify", {
          type: "danger",
          icon: "fa fa-times me-1",
          message: "Please select at least one image",
        });
        return;
      }
      console.log($("#license-plate").val());
      $.ajax({
        type: "post",
        url: BaseUrl + "vehicles/checkLicensePlate",
        data: {
          licensePlate: $("#license-plate").val(),
          excludeId: null,
        },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            $.ajax({
              type: "post",
              url: BaseUrl + "vehicles/addDetail",
              data: formData,
              processData: false,
              contentType: false,
              dataType: "json",
              success: function (response) {
                if (response.success) {
                  Dashmix.helpers("jq-notify", {
                    type: "success",
                    icon: "fa fa-check me-1",
                    message: "Added successfully!",
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
                    message: response.message || "vehicle detail failed!",
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
          } else {
            Dashmix.helpers("jq-notify", {
              type: "danger",
              icon: "fa fa-times me-1",
              message: response.message || "License plate already exists",
            });
            $("#license-plate").focus();
          }
        },
      });
    }
  });

  function calculateFinalPrice(
    defaultSelector,
    discountSelector,
    finalSelector
  ) {
    $(discountSelector).on("input", function () {
      const base = parseFloat($(defaultSelector).val()) || 0;
      const discount = parseFloat($(discountSelector).val()) || 0;

      let final = base - (base * discount) / 100;
      final = final < 0 ? 0 : final;

      $(finalSelector).val(final.toFixed(2));
    });
  }

  // Gọi hàm cho từng loại giá
  calculateFinalPrice(
    "#default-hourly-price",
    "#discount-hourly",
    "#final-hourly-price"
  );
  calculateFinalPrice(
    "#default-daily-price",
    "#discount-daily",
    "#final-daily-price"
  );
  calculateFinalPrice(
    "#default-weekly-price",
    "#discount-weekly",
    "#final-weekly-price"
  );
  calculateFinalPrice(
    "#default-monthly-price",
    "#discount-monthly",
    "#final-monthly-price"
  );

  const $uploadInput = $("#upload-image");
  const $previewContainer = $("#image-preview-container");
  const $initialUpload = $("#initial-upload");
  const $setBtn = $(".block-options");
  const uploadedImages = []; // Lưu toàn bộ file đã upload

  if ($previewContainer.children(".preview-list").length === 0) {
    $previewContainer.append($("<div>").addClass("preview-list"));
  }

  const $globalAddBtn = $(
    '<button type="button" class="btn btn-alt-primary btn-sm btn-hero">'
  )
    .addClass("global-add-btn")
    .html('<i class="fas fa-plus"></i> Add image')
    .on("click", function () {
      $uploadInput.click();
    })
    .hide();

  $setBtn.append($globalAddBtn);

  $uploadInput.on("change", function (e) {
    const files = e.target.files;
    validateImages();
    if (files.length > 0) {
      $initialUpload.hide();
      $globalAddBtn.show();
      const $previewList = $previewContainer.find(".preview-list");

      $.each(files, function (i, file) {
        if (!file.type.match("image.*")) return;

        const reader = new FileReader();

        reader.onload = function (event) {
          const indexInArray = uploadedImages.length;
          uploadedImages.push(file);

          const $previewItem = $("<div>")
            .addClass("preview-item")
            .data("file-index", indexInArray);

          const $imageInfo = $("<div>").addClass("image-info");
          const $imgPreview = $("<img>")
            .addClass("image-preview")
            .attr("src", event.target.result);
          const $imageName = $('<div style="display: none">')
            .addClass("image-name")
            .text(file.name);
          $imageInfo.append($imgPreview, $imageName);

          const $defaultCheckbox = $("<input>")
            .attr("type", "radio")
            .attr("name", "default-image")
            .addClass("default-checkbox")
            .on("change", function () {
              if ($(this).is(":checked")) {
                $previewList
                  .find(".preview-item")
                  .removeClass("default-selected");
                $previewItem.addClass("default-selected");
              }
            });

          const $defaultLabel = $("<label>")
            .addClass("default-label")
            .text("Primary Image")
            .prepend($defaultCheckbox);

          const $deleteBtn = $("<button>")
            .addClass("delete-btn")
            .html('<i class="fas fa-times"></i> Delete')
            .on("click", function () {
              if ($previewItem.find(".default-checkbox").is(":checked")) {
                $previewList
                  .find(".preview-item:first-child .default-checkbox")
                  .prop("checked", true)
                  .trigger("change");
              }

              const delIndex = $previewItem.data("file-index");
              uploadedImages[delIndex] = null;

              $previewItem.remove();

              if ($previewList.children().length === 0) {
                $initialUpload.show();
                $globalAddBtn.hide();
              }
            });

          const $actionButtons = $("<div>")
            .addClass("action-buttons")
            .append($deleteBtn, $defaultLabel);
          $previewItem.append($imageInfo, $actionButtons);
          $previewList.append($previewItem);

          if ($previewList.children().length === 1) {
            $previewItem
              .find(".default-checkbox")
              .prop("checked", true)
              .trigger("change");
          }
        };

        reader.readAsDataURL(file);
      });

      $uploadInput.val("");
    }
  });

  $initialUpload.on("click", function (e) {
    e.preventDefault();
    $uploadInput.click();
  });

  $(document).on("click", ".js-detail-vehicle, .js-edit-vehicle", function (e) {
    e.preventDefault();
    const vehicleId = $(this).data("id");
    console.log(vehicleId);
    $("#vehicle-id").val(vehicleId);
    const isEditMode = $(this).hasClass("js-edit-vehicle");
    $("html, body").animate(
      {
        scrollTop: $("#title-add").offset().top,
      },
      500
    );
    // Reset form và ẩn các nút không cần thiết
    $("#vehicle-form")[0].reset();
    $("#btn-save-vehicle").hide();
    $("#btn-update-vehicle").hide();
    $("#initial-upload").show();
    $(".global-add-btn").hide();
    $(".preview-list").empty();

    // Gọi AJAX để lấy dữ liệu xe
    $.ajax({
      url: BaseUrl + "vehicles/getVehicleDetail",
      type: "POST",
      data: { id: vehicleId },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          populateForm(response.data, isEditMode);

          // Load ảnh của xe
          $.ajax({
            url: BaseUrl + "vehicles/getImages",
            type: "POST",
            data: { id: vehicleId },
            dataType: "json",
            success: function (res) {
              if (res.success) {
                displayImages(res.data, isEditMode);
              }
            },
          });

          // Hiển thị nút phù hợp
          if (isEditMode) {
            $("#btn-update-vehicle").show();
            $("#btn-save-vehicle").hide();
          } else {
            $("#btn-save-vehicle").show();
            $("#btn-update-vehicle").hide();
          }
        } else {
          Dashmix.helpers("jq-notify", {
            type: "danger",
            icon: "fa fa-times me-1",
            message: response.message || "Failed to load vehicle details",
          });
        }
      },
      error: function () {
        Dashmix.helpers("jq-notify", {
          type: "danger",
          icon: "fa fa-times me-1",
          message: "Error loading vehicle details",
        });
      },
    });
  });

  // Hàm điền dữ liệu vào form
  function populateForm(data, isEditMode) {
    // Điền thông tin cơ bản
    $("#vehicle-id").val(data.VehicleID);
    $("#vehicle-name").val(
      `${data.MakeName} - ${data.ModelName} (${data.NameType})`
    );

    // Điền giá cả
    $("#default-hourly-price").val(data.HourlyPrice);
    $("#discount-hourly").val(data.HourlyDiscount || 0);
    $("#final-hourly-price").val(data.HourlyPrice);

    $("#default-daily-price").val(data.DailyPrice);
    $("#discount-daily").val(data.DailyDiscount || 0);
    $("#final-daily-price").val(data.DailyPrice);

    $("#default-weekly-price").val(data.WeeklyPrice);
    $("#discount-weekly").val(data.WeeklyDiscount || 0);
    $("#final-weekly-price").val(data.WeeklyPrice);

    $("#default-monthly-price").val(data.MonthlyPrice);
    $("#discount-monthly").val(data.MonthlyDiscount || 0);
    $("#final-monthly-price").val(data.MonthlyPrice);

    // Điền thông tin khác
    $("#fuel-consumption").val(data.FuelConsumption);
    $("#transmission").val(data.Transmission);
    $("#fuel-type").val(data.FuelType);
    $("#year").val(data.Year);
    $("#license-plate").val(data.LicensePlateNumber);
    $("#color-id").val(data.ColorID).trigger("change");
    $("#mileage").val(data.Mileage);
    $("#is-active").prop("checked", data.Active == 1);
    $("#feature").prop("checked", data.Feature == 1);

    // Điền mô tả
    if (typeof CKEDITOR !== "undefined" && CKEDITOR.instances["js-ckeditor"]) {
      CKEDITOR.instances["js-ckeditor"].setData(data.Description || "");
    } else {
      $("#js-ckeditor").val(data.Description || "");
    }

    // Thiết lập chế độ form
    setFormMode(isEditMode);
  }

  // Xử lý khi click nút Save
  $("#btn-save-vehicle").on("click", function (e) {
    e.preventDefault();
    submitForm("add");
  });

  // Xử lý khi click nút Update
  // $("#btn-update-vehicle").on("click", function (e) {
  //   e.preventDefault();
  //   submitForm("update");
  // });

  // Hàm submit form chung
  function submitForm(action) {
    if (!$("#vehicle-form").valid()) return;

    const formData = new FormData();
    const vehicleId = $("#vehicle-id").val();

    // Thêm dữ liệu chung
    formData.append("action", action);
    formData.append("vehicle-id", vehicleId);
    formData.append("hourly_price", $("#final-hourly-price").val());
    formData.append("hourly_discount", $("#discount-hourly").val());
    formData.append("daily_price", $("#final-daily-price").val());
    formData.append("daily_discount", $("#discount-daily").val());
    formData.append("weekly_price", $("#final-weekly-price").val());
    formData.append("weekly_discount", $("#discount-weekly").val());
    formData.append("monthly_price", $("#final-monthly-price").val());
    formData.append("monthly_discount", $("#discount-monthly").val());
    formData.append("description", $("#js-ckeditor").val());
    formData.append("fuel_consumption", $("#fuel-consumption").val());
    formData.append("transmission", $("#transmission").val());
    formData.append("fuel_type", $("#fuel-type").val());
    formData.append("year", $("#year").val());
    formData.append("license_plate", $("#license-plate").val());
    formData.append("color_id", $("#color-id").val());
    formData.append("mileage", $("#mileage").val());
    formData.append("feature", $("#feature").is(":checked") ? 1 : 0);
    formData.append("is_active", $("#is-active").is(":checked") ? 1 : 0);

    // Thêm ảnh mới
    const files = $("#upload-image")[0].files;
    for (let i = 0; i < files.length; i++) {
      formData.append("new_images[]", files[i]);
    }

    // Thêm ảnh chính
    const primaryIndex = $('input[name="default-image"]:checked')
      .closest(".preview-item")
      .data("file-index");
    formData.append("primary_image_index", primaryIndex);

    // Xác định endpoint dựa trên action
    const endpoint = action === "add" ? "" : "updateDetail";

    $.ajax({
      url: BaseUrl + "vehicles/updateDetail",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          Dashmix.helpers("jq-notify", {
            type: "success",
            icon: "fa fa-check me-1",
            message:
              "Vehicle " +
              (action === "add" ? "added" : "updated") +
              " successfully!",
          });

          // Cập nhật lại danh sách
          vehiclePagination.getPagination(
            vehiclePagination.option,
            vehiclePagination.valuePage.curPage
          );

          // Đóng modal nếu có
          $("#vehicle-modal").modal("hide");
        } else {
          Dashmix.helpers("jq-notify", {
            type: "danger",
            icon: "fa fa-times me-1",
            message: response.message || "Operation failed",
          });
        }
      },
      error: function () {
        Dashmix.helpers("jq-notify", {
          type: "danger",
          icon: "fa fa-times me-1",
          message: "Error occurred",
        });
      },
    });
  }

  // Hàm hiển thị ảnh
  function displayImages(images, isEditMode) {
    const $previewList = $("#image-preview-container .preview-list");
    $previewList.empty();

    if (images.length === 0) {
      $("#initial-upload").show();
      $(".global-add-btn").hide();
    } else {
      $("#initial-upload").hide();
      $(".global-add-btn").show();

      images.forEach((image, index) => {
        const $previewItem = $("<div>")
          .addClass("preview-item")
          .data("file-index", index);

        const $imageInfo = $("<div>").addClass("image-info");
        const $imgPreview = $("<img>")
          .addClass("image-preview")
          .attr("src", image.ImageURL);
        const $imageName = $('<div style="display: none">')
          .addClass("image-name")
          .text(image.name ?? "");
        $imageInfo.append($imgPreview, $imageName);

        // Thêm checkbox chọn ảnh chính
        const $defaultCheckbox = $("<input>")
          .attr("type", "radio")
          .attr("name", "default-image")
          .addClass("default-checkbox")
          .prop("checked", image.IsPrimary == 1)
          .on("change", function () {
            if ($(this).is(":checked")) {
              $previewList
                .find(".preview-item")
                .removeClass("default-selected");
              $previewItem.addClass("default-selected");
            }
          });

        const $defaultLabel = $("<label>")
          .addClass("default-label")
          .text("Primary Image")
          .prepend($defaultCheckbox);

        // Thêm nút xóa (chỉ hiển thị trong chế độ chỉnh sửa)
        const $deleteBtn = $("<button>")
          .addClass("delete-btn")
          .html('<i class="fas fa-times"></i> Delete')
          .on("click", function () {
            if (confirm("Are you sure you want to delete this image?")) {
              deleteImage(image.ImageID, $previewItem);
            }
          });

        const $actionButtons = $("<div>")
          .addClass("action-buttons")
          .append(isEditMode ? $deleteBtn : "", $defaultLabel);

        $previewItem.append($imageInfo, $actionButtons);
        $previewList.append($previewItem);

        if (image.IsPrimary == 1) {
          $previewItem.addClass("default-selected");
        }
      });
    }
  }

  // Hàm xóa ảnh
  function deleteImage(imageId, $previewItem) {
    $.ajax({
      url: BaseUrl + "vehicles/deleteImage",
      type: "POST",
      data: { image_id: imageId },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          
          $previewItem.remove();

          if (
            $("#image-preview-container .preview-list").children().length === 0
          ) {
            $("#initial-upload").show();
            $(".global-add-btn").hide();
          }

          Dashmix.helpers("jq-notify", {
            type: "success",
            icon: "fa fa-check me-1",
            message: "Image deleted successfully",
          });
        } else {
          Dashmix.helpers("jq-notify", {
            type: "danger",
            icon: "fa fa-times me-1",
            message: response.message || "Failed to delete image",
          });
        }
      },
    });
  }

  // Hàm reset giao diện về trạng thái ban đầu
  function resetImagePreview() {
    const $previewList = $("#image-preview-container .preview-list");

    // Xóa toàn bộ nội dung trong danh sách preview
    $previewList.empty();

    // Hiển thị hộp tải lên ban đầu
    $("#initial-upload").show();

    // Ẩn nút thêm ảnh toàn cục
    $(".global-add-btn").hide();

    // Xóa giá trị lưu ảnh (nếu có)
    $("#saveImage").val("");

    // Reset input file (nếu cần)
    $("#upload-image").val("");
  }

  // Hàm thiết lập chế độ form (xem/ chỉnh sửa)
  function setFormMode(isEditMode) {
    // Đặt tiêu đề modal
    const title = isEditMode ? "Edit Vehicle" : "Vehicle Details";
    $("#title-add").text(title);

    // Kích hoạt/vô hiệu hóa các trường nhập liệu
    const $formFields = $("#vehicle-form")
      .find("input, select, textarea, button,radio")
      .not(
        '[type="hidden"], #vehicle-name,#default-hourly-price,#final-hourly-price,#default-daily-price,#final-daily-price,#default-weekly-price,#final-weekly-price,#default-monthly-price,#final-monthly-price, #reset-button'
      );
    $formFields.prop("disabled", !isEditMode);

    // Ẩn/hiện nút lưu
    $("#btn-save-vehicle").toggle(isEditMode);

    // Ẩn/hiện nút upload và xóa ảnh
    $(".global-add-btn").toggle(isEditMode);
    $(".delete-btn").toggle(isEditMode);

    // CKEditor (nếu có)
    if (typeof CKEDITOR !== "undefined" && CKEDITOR.instances["js-ckeditor"]) {
      CKEDITOR.instances["js-ckeditor"].setReadOnly(!isEditMode);
    }
  }

  // // Xử lý khi submit form
  // $("#btn-update-vehicle").on("click", function (e) {
  //   e.preventDefault();

  //   // Validate form
  //   if (!$(this).valid()) return;

  //   // Tạo FormData
  //   const formData = new FormData();
  //   formData.append("vehicle_id", $("#vehicle-id").val());
  //   formData.append("hourly_price", $("#final-hourly-price").val());
  //   formData.append("hourly_discount", $("#discount-hourly").val());
  //   formData.append("daily_price", $("#final-daily-price").val());
  //   formData.append("daily_discount", $("#discount-daily").val());
  //   formData.append("weekly_price", $("#final-weekly-price").val());
  //   formData.append("weekly_discount", $("#discount-weekly").val());
  //   formData.append("monthly_price", $("#final-monthly-price").val());
  //   formData.append("monthly_discount", $("#discount-monthly").val());
  //   formData.append("description", $("#js-ckeditor").val());
  //   formData.append("fuel_consumption", $("#fuel-consumption").val());
  //   formData.append("transmission", $("#transmission").val());
  //   formData.append("fuel_type", $("#fuel-type").val());
  //   formData.append("year", $("#year").val());
  //   formData.append("license_plate", $("#license-plate").val());
  //   formData.append("color_id", $("#color-id").val());
  //   formData.append("mileage", $("#mileage").val());
  //   formData.append("feature", $("#feature").is(":checked") ? 1 : 0);
  //   formData.append("is_active", $("#is-active").is(":checked") ? 1 : 0);

  //   // Thêm ảnh mới (nếu có)
  //   const files = $("#upload-image")[0].files;
  //   for (let i = 0; i < files.length; i++) {
  //     formData.append("new_images[]", files[i]);
  //   }

  //   // Thêm ảnh chính
  //   const primaryIndex = $('input[name="default-image"]:checked')
  //     .closest(".preview-item")
  //     .data("file-index");
  //   formData.append("primary_image_index", primaryIndex);

  //   // Gửi AJAX
  //   $.ajax({
  //     url: BaseUrl + "vehicles/updateDetail",
  //     type: "POST",
  //     data: formData,
  //     processData: false,
  //     contentType: false,
  //     dataType: "json",
  //     success: function (response) {
  //       if (response.success) {
  //         Dashmix.helpers("jq-notify", {
  //           type: "success",
  //           icon: "fa fa-check me-1",
  //           message: "Vehicle updated successfully!",
  //         });

  //         // Cập nhật lại danh sách xe
  //         vehiclePagination.getPagination(
  //           vehiclePagination.option,
  //           vehiclePagination.valuePage.curPage
  //         );

  //         // Đóng modal
  //         $("#vehicle-modal").modal("hide");
  //       } else {
  //         Dashmix.helpers("jq-notify", {
  //           type: "danger",
  //           icon: "fa fa-times me-1",
  //           message: response.message || "Failed to update vehicle",
  //         });
  //       }
  //     },
  //     error: function () {
  //       Dashmix.helpers("jq-notify", {
  //         type: "danger",
  //         icon: "fa fa-times me-1",
  //         message: "Error occurred while updating vehicle",
  //       });
  //     },
  //   });
  // });

  $("#btn-update-vehicle").on("click", function (e) {
    e.preventDefault();
  
    // Validate form
    if (!$(this).valid()) return;
  
    const formData = new FormData();
    formData.append("vehicle_id", $("#vehicle-id").val());
    formData.append("hourly_price", $("#final-hourly-price").val());
    formData.append("hourly_discount", $("#discount-hourly").val());
    formData.append("daily_price", $("#final-daily-price").val());
    formData.append("daily_discount", $("#discount-daily").val());
    formData.append("weekly_price", $("#final-weekly-price").val());
    formData.append("weekly_discount", $("#discount-weekly").val());
    formData.append("monthly_price", $("#final-monthly-price").val());
    formData.append("monthly_discount", $("#discount-monthly").val());
    formData.append("description", $("#js-ckeditor").val());
    formData.append("fuel_consumption", $("#fuel-consumption").val());
    formData.append("transmission", $("#transmission").val());
    formData.append("fuel_type", $("#fuel-type").val());
    formData.append("year", $("#year").val());
    formData.append("license_plate", $("#license-plate").val());
    formData.append("color_id", $("#color-id").val());
    formData.append("mileage", $("#mileage").val());
    formData.append("feature", $("#feature").is(":checked") ? 1 : 0);
    formData.append("is_active", $("#is-active").is(":checked") ? 1 : 0);
  
    // Ảnh cần xóa
    $(".preview-item.to-delete").each(function () {
      const imageId = $(this).data("image-id");
      formData.append("delete_images[]", imageId);
    });
  
    const primaryIndex = $('input[name="default-image"]:checked')
      .closest(".preview-item")
      .data("file-index");

    uploadedImages.forEach((file, i) => {
      if (file) {
        formData.append("upload-image[]", file);
        formData.append("is-primary[]", i === primaryIndex ? 1 : 0);
      }
    });
  
    $.ajax({
      url: BaseUrl + "vehicles/updateDetail",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          Dashmix.helpers("jq-notify", {
            type: "success",
            icon: "fa fa-check me-1",
            message: "Vehicle updated successfully!",
          });
          $("html, body").animate(
            {
              scrollTop: $(".block-header").offset().top,
            },
            500
          );
  
          vehiclePagination.getPagination(
            vehiclePagination.option,
            vehiclePagination.valuePage.curPage
          );
          $("#vehicle-modal").modal("hide");
        } else {
          Dashmix.helpers("jq-notify", {
            type: "danger",
            icon: "fa fa-times me-1",
            message: response.message || "Failed to update vehicle",
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
  });
  

  $(document).on("click", ".js-delete-vehicle", function (e) {
    e.preventDefault();
    const vehicleDTId = $(this).data("id");

    // Hiển thị hộp thoại xác nhận bằng SweetAlert2
    Swal.fire({
      title: "Confirm Delete",
      text: "Are you sure you want to delete this vehicle?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, Delete",
      cancelButtonText: "Cancel",
      reverseButtons: true,
    }).then((result) => {
      if (result.isConfirmed) {
        // Thực hiện xóa nếu người dùng xác nhận
        $.ajax({
          url: BaseUrl + "vehicles/deleteDetail",
          type: "POST",
          data: { id: vehicleDTId },
          dataType: "json",
          success: function (response) {
            if (response.success) {
              Dashmix.helpers("jq-notify", {
                type: "success",
                icon: "fa fa-check me-1",
                message: "Vehicle deleted successfully!",
              });
              vehiclePagination.getPagination(
                vehiclePagination.option,
                vehiclePagination.valuePage.curPage
              );
            } else {
              Dashmix.helpers("jq-notify", {
                type: "danger",
                icon: "fa fa-times me-1",
                message:
                  response.message ||
                  "Failed to delete vehicle. Please try again.",
              });
            }
          },
          error: function () {
            Dashmix.helpers("jq-notify", {
              type: "danger",
              icon: "fa fa-times me-1",
              message: "Error occurred while deleting vehicle.",
            });
          },
        });
      }
    });
  });
});
$("#rentalDateFrom, #rentalDateTo")
  .datepicker({
    format: "mm/dd/yyyy",
    autoclose: true,
    todayHighlight: true,
  })
  .on("changeDate", function () {
    const fromDate = $("#rentalDateFrom").val();
    const toDate = $("#rentalDateTo").val();

    if (fromDate && toDate) {
      vehiclePagination.option.filter.rentalDate = {
        from: fromDate,
        to: toDate,
      };
      vehiclePagination.getPagination(
        vehiclePagination.option,
        vehiclePagination.valuePage.curPage
      );
    }
  });
  $("#color").change(function () {
    const color = $(this).val();
  
    if (!color) {
      delete vehiclePagination.option.filter.color;
    } else {
      vehiclePagination.option.filter.color = +color;
    }
  
    vehiclePagination.getPagination(
      vehiclePagination.option,
      vehiclePagination.valuePage.curPage
    );
  });
  $("#vehicleType").change(function () {
    const vehicleType = $(this).val();
  
    if (!vehicleType) {
      delete vehiclePagination.option.filter.vehicleType;
    } else {
      vehiclePagination.option.filter.vehicleType = +vehicleType;
    }
  
    vehiclePagination.getPagination(
      vehiclePagination.option,
      vehiclePagination.valuePage.curPage
    );
  });
  $("#licensePlate").change(function () {
    const licensePlate = $(this).val();
  
    if (!licensePlate) {
      delete vehiclePagination.option.filter.licensePlate;
    } else {
      vehiclePagination.option.filter.licensePlate = +licensePlate;
    }
  
    vehiclePagination.getPagination(
      vehiclePagination.option,
      vehiclePagination.valuePage.curPage
    );
  });
  $("#vehicle-seats").change(function () {
    const seats = $(this).val();
  
    if (!seats) {
      delete vehiclePagination.option.filter.seats;
    } else {
      vehiclePagination.option.filter.seats = +seats;
    }
  
    vehiclePagination.getPagination(
      vehiclePagination.option,
      vehiclePagination.valuePage.curPage
    );
  });
  // $("#sort").change(function () {
  //   const field = $(this).val();
  
  //   // Đảm bảo `vehiclePagination.option.sort` được khởi tạo
  //   if (!vehiclePagination.option.sort) {
  //     vehiclePagination.option.sort = {};
  //   }
  
  //   vehiclePagination.option.sort.field = field || null;
  
  //   vehiclePagination.getPagination(
  //     vehiclePagination.option,
  //     vehiclePagination.valuePage.curPage
  //   );
  // });
  // $("#sortDirection").change(function () {
  //   const direction = $(this).val();
  
  //   // Đảm bảo `vehiclePagination.option.sort` được khởi tạo
  //   if (!vehiclePagination.option.sort) {
  //     vehiclePagination.option.sort = {};
  //   }
  
  //   vehiclePagination.option.sort.direction = direction || null;
  
  //   vehiclePagination.getPagination(
  //     vehiclePagination.option,
  //     vehiclePagination.valuePage.curPage
  //   );
  // });

  $("#sort, #sortDirection").change(function () {
    const sort = $("#sort").val();
    const sortDirection = $("#sortDirection").val();
    // console.log(sort, sortDirection);
    // console.log(sort && sortDirection);
    if (sort && sortDirection) {
      vehiclePagination.option.filter.sort = {
        sort: sort,
        sortDirection: sortDirection,
      };
      vehiclePagination.getPagination(
        vehiclePagination.option,
        vehiclePagination.valuePage.curPage
      );
    }
  });
  
  
  

// $("#sortDirection").change(function () {
//   const direction = $(this).val();
//   vehiclePagination.option.sort.direction = direction || null;

//   vehiclePagination.getPagination(
//     vehiclePagination.option,
//     vehiclePagination.valuePage.curPage
//   );
// });

const vehiclePagination = new Pagination();
vehiclePagination.option.controller = "vehicles";
vehiclePagination.option.model = "VehicleDetailModel";
vehiclePagination.option.limit = 10;
vehiclePagination.option.filter = {};
vehiclePagination.getPagination(
  vehiclePagination.option,
  vehiclePagination.valuePage.curPage
);
