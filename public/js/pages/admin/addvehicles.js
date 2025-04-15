
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
            <div class="fw-semibold">${formatLicense(vehicle.	LicensePlateNumber)}</div>
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
            ${vehicle.Active == 1 ? '<span class="badge bg-success">Active</span>' : "Inactive"}
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
    if (plate.length >= 4 && isNaN(plate.charAt(3))) {
        // Nếu là chữ → tách sau 3 ký tự
        return plate.replace(/^(.{3})(.+)/, '$1-$2');
    } else {
        // Nếu là số → tách sau 4 ký tự
        return plate.replace(/^(.{4})(.+)/, '$1-$2');
    }
}
  
$(document).ready(function () {
    function calculateFinalPrice(defaultSelector, discountSelector, finalSelector) {
        $(discountSelector).on('input', function () {
            const base = parseFloat($(defaultSelector).val()) || 0;
            const discount = parseFloat($(discountSelector).val()) || 0;

            let final = base - (base * discount / 100);
            final = final < 0 ? 0 : final;

            $(finalSelector).val(final.toFixed(2));
        });
    }

    // Gọi hàm cho từng loại giá
    calculateFinalPrice('#default-hourly-price', '#discount-hourly', '#final-hourly-price');
    calculateFinalPrice('#default-daily-price', '#discount-daily', '#final-daily-price');
    calculateFinalPrice('#default-weekly-price', '#discount-weekly', '#final-weekly-price');
    calculateFinalPrice('#default-monthly-price', '#discount-monthly', '#final-monthly-price');
});
// $(document).ready(function() {
//   const $uploadInput = $('#upload-image');
//   const $previewContainer = $('#image-preview-container');
//   const $initialUpload = $('#initial-upload');
  
//   // Tạo container preview list nếu chưa có
//   if ($previewContainer.children('.preview-list').length === 0) {
//       $previewContainer.append($('<div>').addClass('preview-list'));
//   }
  
//   $uploadInput.on('change', function(e) {
//       const files = e.target.files;
      
//       if (files.length > 0) {
//           $initialUpload.hide();
//           const $previewList = $previewContainer.find('.preview-list');
          
//           $.each(files, function(i, file) {
//               if (!file.type.match('image.*')) return;
              
//               const reader = new FileReader();
              
//               reader.onload = function(event) {
//                   const $previewItem = $('<div>').addClass('preview-item');
                  
//                   // Tạo preview và thông tin ảnh
//                   const $imageInfo = $('<div>').addClass('image-info');
//                   const $imgPreview = $('<img>').addClass('image-preview')
//                       .attr('src', event.target.result);
//                   const $imageName = $('<div>').addClass('image-name')
//                       .text(file.name);
                  
//                   $imageInfo.append($imgPreview, $imageName);
                  
//                   // Tạo nút action
//                   const $actionButtons = $('<div>').addClass('action-buttons');
                  
//                   // Nút thêm ảnh
//                   const $addBtn = $('<button>')
//                       .addClass('add-btn')
//                       .html('<i class="fas fa-plus"></i> Add image')
//                       .on('click', function() {
//                           $uploadInput.click();
//                       });
                  
//                   // Nút xóa ảnh
//                   const $deleteBtn = $('<button>')
//                       .addClass('delete-btn')
//                       .html('<i class="fas fa-times"></i> Delete')
//                       .on('click', function() {
//                           $previewItem.remove();
//                           if ($previewList.children().length === 0) {
//                               $initialUpload.show();
//                           }
//                       });
                  
//                   $actionButtons.append($addBtn, $deleteBtn);
//                   $previewItem.append($imageInfo, $actionButtons);
//                   $previewList.append($previewItem);
//               };
              
//               reader.readAsDataURL(file);
//           });
          
//           // Reset input
//           $uploadInput.val('');
//       }
//   });
  
//   // Click to initial upload box
//   $initialUpload.on('click', function(e) {
//     e.preventDefault();
//     $uploadInput.click();
//   });
// });

// Initialize pagination for vehicles
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
                  
                  // Tạo checkbox chọn ảnh mặc định
                  const $defaultCheckbox = $('<input>')
                      .attr('type', 'radio')
                      .attr('name', 'default-image')
                      .addClass('default-checkbox')
                      .on('change', function() {
                          if ($(this).is(':checked')) {
                              // Thêm class highlight cho ảnh được chọn
                              $previewList.find('.preview-item').removeClass('default-selected');
                              $previewItem.addClass('default-selected');
                          }
                      });
                  
                  const $defaultLabel = $('<label>')
                      .addClass('default-label')
                      .text('Primary Image')
                      .prepend($defaultCheckbox);
                  
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
                          // Nếu xóa ảnh đang được chọn làm mặc định
                          if ($previewItem.find('.default-checkbox').is(':checked')) {
                              // Tự động chọn ảnh đầu tiên làm mặc định
                              $previewList.find('.preview-item:first-child .default-checkbox').prop('checked', true).trigger('change');
                          }
                          $previewItem.remove();
                          if ($previewList.children().length === 0) {
                              $initialUpload.show();
                          }
                      });
                  
                  $actionButtons.append($addBtn, $deleteBtn, $defaultLabel);
                  $previewItem.append($imageInfo, $actionButtons);
                  $previewList.append($previewItem);
                  
                  // Tự động chọn ảnh đầu tiên làm mặc định
                  if ($previewList.children().length === 1) {
                      $previewItem.find('.default-checkbox').prop('checked', true).trigger('change');
                  }
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
const vehiclePagination = new Pagination();
vehiclePagination.option.controller = "vehicles";
vehiclePagination.option.model = "VehicleDetailModel";
vehiclePagination.option.limit = 10;
vehiclePagination.option.filter = {};
vehiclePagination.getPagination(
  vehiclePagination.option,
  vehiclePagination.valuePage.curPage
);