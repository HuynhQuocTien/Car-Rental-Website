Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);

const renderData = function (orderdetails) {
  if (orderdetails.length === 0) {
      $("#rentalorderdetails").html('<tr><td colspan="11" class="text-center">No data available</td></tr>');
      return;
  }
  let html = "";
  index = 0;
  orderdetails.forEach((detail) => {
    console.log(detail);
    console.log(detail.VehicleDetailID);
    html += `<tr>
      <td>${++index}</td>
      <td>${detail.VehicleDetailID}</td>
      <td>${detail.MakeName} ${detail.ModelName} ${detail.NameType}</td>
      <td>${detail.ColorName}</td>
      <td>${detail.LicensePlateNumber}</td>
      <td>${detail.RentalType}</td>
      <td>${detail.ReturnDate}</td>
      <td>${detail.ActualReturnDate}</td>
      <td>${detail.DamagePenalty}</td>
      <td>${detail.RentalRate}</td>
      <td>${detail.Status == 1 ? "Đã trả" : "Chưa trả"}</td>
    </tr>`;
  });

  $("#rentalorderdetails").html(html);
  $('[data-bs-toggle="tooltip"]').tooltip();
};

const OrderID = getOrderIDFromURL();

const mainPagePagination = new Pagination();
mainPagePagination.option.controller = "rentalorders";
mainPagePagination.option.model = "OrderDetailModel";
mainPagePagination.option.limit = 10;
mainPagePagination.option.filter = {id: OrderID};
mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);

function getOrderIDFromURL() {
  const params = new URLSearchParams(window.location.search);
  console.log(params);
  return params.get('id'); // lấy giá trị ?id=2
}