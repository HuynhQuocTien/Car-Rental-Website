Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);

const renderData = function (orders) {
    console.log(orders);
    if (orders.length === 0) {
        $("#list-rentalOrders").html('<tr><td colspan="8" class="text-center">No data available</td></tr>');
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
        <td>${order.Status == 1 ? "Chưa trả xe" : "Đã trả xe"}</td>
        <td>
          <div class="btn-group">
            <a href="rentalorders/detail&id=${order.OrderID}" 
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
const mainPagePagination = new Pagination();
mainPagePagination.option.controller = "rentalorders";
mainPagePagination.option.model = "RentalOrderModel";
mainPagePagination.option.limit = 10;
mainPagePagination.option.filter = {};
mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);