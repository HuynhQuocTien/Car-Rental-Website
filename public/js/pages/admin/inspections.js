const renderData = function (data) {
  console.log(data);

  let html = "";

  if (!data || data.length === 0) {
    $("#list-inspection").html(
      '<tr><td colspan="10" class="text-center">No data available</td></tr>'
    );
    return;
  }

  
  data.forEach((item, index) => {
    html += `<tr>
    <td class="text-center ">${item.OrderID}</td>
    <td class="text-center ">${item.CustomerID ?? ''}</td>
    <td class="text-center ">${item.UserID ?? ''}</td>
    <td class="text-center ">${item.OrderDate ?? ''}</td>
    <td class="text-center ">${item.RentalDate ?? ''}</td>
    <td class="text-center ">$${item.TotalAmount ?? '0.00'}</td>
    <td class="text-center ">${item.Address ?? ''}</td>
    <td class="text-center ">${item.PromotionID ?? 'None'}</td>
    <td class="text-center ">${item.Status}</td>
    <td class="text-center ">${item.PaymentID ?? ''}</td>
    <td class="text-center col-action ">
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                data-bs-toggle="tooltip" aria-label="Detail" data-bs-original-title="Detail">
                <a class="btn btn-sm btn-alt-secondary js-detail-vehicle"  href="${BaseUrl}inspections/inspectionOrder&id=${item.OrderID}"
                
                            data-function="10" data-permission="1"
                            data-function="10" data-permission="4"
                            data-id="${item.OrderID}"
                            title="Show Details">
                        <i class="fa fa-rectangle-list"></i>
                </a>
            </button>
            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-function="10" data-permission="2"
                data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                <i class="fa fa-pencil-alt"></i>
            </button>
            <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-function="10" data-permission="3"
                data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </td>
    </tr>`;
  });

  $("#list-inspection").html(html);

  $('[data-bs-toggle="tooltip"]').tooltip();
};

$("#prices").change(function () {

  const filterData = {};

  const TotalAmountRange = $("#prices").val();

  if (TotalAmountRange) filterData.totalAmountRange = TotalAmountRange;

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
