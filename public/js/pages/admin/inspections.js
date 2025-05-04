const renderData = function (data) {
  console.log(data);

  let html = "";

  if (!data || data.length === 0) {
    $("#list-vehicle").html(
      '<tr><td colspan="8" class="text-center">No data available</td></tr>'
    );
    return;
  }

  data.forEach((item, index) => {
    html += `<tr>
        <td>${item.OrderID}</td>
        <td>${item.MakeName}</td>
        <td>${item.ModelName}</td>
        <td>${item.ColorName}</td>
        <td>${item.NameType}</td>
        <td>$${item.DailyPrice}</td>
        <td>${item.Status}</td>
        <td class="text-center">
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                    data-bs-toggle="tooltip" aria-label="Detail" data-bs-original-title="Detail">
                    <i class="fa fa-eye"></i>
                </button>
                <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                    data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                    <i class="fa fa-pencil-alt"></i>
                </button>
                <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                    data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </td>
    </tr>`;
  });

  $("#list-inspection").html(html);

  // Kích hoạt tooltip Bootstrap
  $('[data-bs-toggle="tooltip"]').tooltip();
};

// Xử lý sự thay đổi trong dropdown
$("#vehicle-types, #colors, #make, #prices").change(function () {
  // console.log("Helo1");

  const filterData = {};

  const vehicleTypes = $("#vehicle-types").val();
  const vehicleColors = $("#colors").val();
  const vehicleBrands = $("#make").val();
  const vehiclePrices = $("#prices").val();

  if (vehicleTypes) filterData.vehicleTypeID = vehicleTypes;
  if (vehicleColors) filterData.colorID = vehicleColors;
  if (vehicleBrands) filterData.makeID = vehicleBrands;
  if (vehiclePrices) filterData.priceRange = vehiclePrices;

  inspectionPagination.option.filter = filterData;

  inspectionPagination.getPagination(
    inspectionPagination.option,
    inspectionPagination.valuePage.curPage
  );
});

const inspectionPagination = new Pagination(null, null, null);
inspectionPagination.option.controller = "inspections";
inspectionPagination.option.model = "InspectionModel";
inspectionPagination.option.limit = 10;
inspectionPagination.option.filter = {};
inspectionPagination.getPagination(
  inspectionPagination.option,
  inspectionPagination.valuePage.curPage
);
