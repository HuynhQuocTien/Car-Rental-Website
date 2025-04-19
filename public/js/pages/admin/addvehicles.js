Dashmix.helpersOnLoad(["js-flatpickr", "jq-datepicker"]);

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
            accept: "image/*"
          }
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
            accept: "Only image files are allowed to be uploaded."
        }
        },
        errorPlacement: function(error, element) {
          if (element.attr("name") == "upload-image[]") {
              error.insertAfter("#image-preview-container");
          } else {
              error.insertAfter(element);
          }
      }
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
                : "Inactive"
            }
          </td>
          <td class="text-center">
            <div class="btn-group">
              <button class="btn btn-sm btn-alt-secondary js-detail-vehicle" 
                      data-id="${vehicle.VehicleID}" title="Show Details">
                <i class="fa fa-rectangle-list"></i>
              </button>
              <button class="btn btn-sm btn-alt-secondary js-edit-vehicle" 
                      data-id="${vehicle.VehicleID}" title="Edit">
                <i class="fa fa-pencil-alt"></i>
              </button>
              <button class="btn btn-sm btn-alt-secondary js-delete-vehicle" 
                      data-id="${vehicle.VehicleID}" title="Delete">
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
    const files = $('#upload-image')[0].files;
    const $errorMsg = $('#upload-image\\[\\]-error');
    const $previewContainer = $('#image-preview-container');
  
    if (files.length > 0 || uploadedImages.filter(Boolean).length > 0) {
      // Có file mới hoặc đã có ảnh được lưu trong uploadedImages
      $errorMsg.hide();
      $previewContainer.removeClass('error-border');
      return true;
    } else {
      // Không có ảnh nào cả
      $errorMsg.show();
      $previewContainer.addClass('error-border');
      return false;
    }
  }
  

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
      if(!validateImages()){
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


});

const vehiclePagination = new Pagination();
vehiclePagination.option.controller = "vehicles";
vehiclePagination.option.model = "VehicleDetailModel";
vehiclePagination.option.limit = 10;
vehiclePagination.option.filter = {};
vehiclePagination.getPagination(
  vehiclePagination.option,
  vehiclePagination.valuePage.curPage
);
