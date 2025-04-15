
const renderData = function (vehicles) {
    let html = "";
    vehicles.forEach((vehicle) => {
      html += `<tr>
          <td>${vehicle.VehicleID}</td>
          <td>
            <div class="fw-semibold">${vehicle.Name}</div>
            <div class="text-muted small">${vehicle.Year} - ${vehicle.Color}</div>
          </td>
          <td>
            <div class="fw-semibold">${vehicle.LicensePlate}</div>
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
            <div class="fw-semibold">
              ${
                vehicle.Active == 1
                  ? '<span class="badge bg-success">Available</span>'
                  : '<span class="badge bg-danger">Unavailable</span>'
              }
            </div>
            <div class="text-muted small">${vehicle.Active == 1 ? "Yes" : "No"}</div>
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
  
    $("#list-vehicle").html(html);
    $('[data-bs-toggle="tooltip"]').tooltip();
  };
  
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
// Initialize pagination for vehicles
const vehiclePagination = new Pagination();
vehiclePagination.option.controller = "vehicles";
vehiclePagination.option.model = "VehicleDetailModel";
vehiclePagination.option.limit = 2;
vehiclePagination.option.filter = {};
vehiclePagination.getPagination(
  vehiclePagination.option,
  vehiclePagination.valuePage.curPage
);