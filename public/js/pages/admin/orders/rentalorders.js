Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);

const renderData = function (orders) {
    console.log(orders);
    if (orders.length === 0) {
        $("#list-rentalOrders").html('<tr><td colspan="9" class="text-center">No data available</td></tr>');
        return;
    }
    let html = "";
    orders.forEach((order) => {
      html += `<tr>
        <td>${order.OrderID}</td>
        <td>${order.FullName}</td>
        <td>
          ${order.PaymentMethod == 0 ? "Cash" : order.PaymentMethod == 1 ? "Banking" : "Unknown"}
        </td>
        <td>${order.OrderDate}</td>
        <td>${order.RentalDate}</td>
        <td>${order.TotalAmount}</td>
        <td>${order.Address}</td>
        <td>${order.UserID == null ? "Chưa xác nhận" : order.Status == 0 ? "Chưa trả xe" : "Đã trả xe"}</td>
        <td class="text-center col-action">
          <div class="btn-group">
            <a href="rentalorders/detail?id=${order.OrderID}" data-function="9" data-permission="4"
              class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
              data-bs-toggle="tooltip" aria-label="Detail" data-bs-original-title="Detail">
              <i class="fa fa-eye"></i>
            </a>
          </div>
        </td>
      </tr>`;
    });
  
    $("#list-rentalOrders").html(html);
    $('[data-bs-toggle="tooltip"]').tooltip();
};


const ordersPagination = new Pagination();
ordersPagination.option.controller = "rentalorders";
ordersPagination.option.model = "RentalOrderModel";
ordersPagination.option.limit = 10;
ordersPagination.option.filter = {};
ordersPagination.getPagination(ordersPagination.option, ordersPagination.valuePage.curPage);

$("#order-query-id").on("input", function () {
  const id = $(this).val();

  if (!id) {
    delete ordersPagination.option.filter.id;
  } else {
    ordersPagination.option.filter.id = +id;
  }

  ordersPagination.getPagination(
    ordersPagination.option,
    ordersPagination.valuePage.curPage
  );
});

$("#order-query-address").on("input", function () {
  const address = $(this).val();

  if (!address) {
    delete ordersPagination.option.filter.address;
  } else {
    ordersPagination.option.filter.address = +address;
  }

  ordersPagination.getPagination(
    ordersPagination.option,
    ordersPagination.valuePage.curPage
  );
});

$("#order-start-time, #order-end-time")
  .datepicker({
    format: "mm/dd/yyyy",
    autoclose: true,
    todayHighlight: true,
  })
  .on("changeDate", function () {
    const fromDate = $("#order-start-time").val();
    const toDate = $("#order-end-time").val();

    if (fromDate && toDate) {
     ordersPagination.option.filter.orderDate = {
        from: fromDate,
        to: toDate,
      };
     ordersPagination.getPagination(
       ordersPagination.option,
       ordersPagination.valuePage.curPage
      );
    }
});