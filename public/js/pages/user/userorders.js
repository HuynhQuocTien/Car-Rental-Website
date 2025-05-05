Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);

const renderData = function (orders) {
    console.log(orders);
    if (orders.length === 0) {
        $("#userOrders").html('<tr><td colspan="9" class="text-center">No data available</td></tr>');
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
        <td>
          <div class="btn-group">
            <a href="userorders/detail?id=${order.OrderID}" 
              class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
              data-bs-toggle="tooltip" aria-label="Detail" data-bs-original-title="Detail">
              <i class="fa fa-eye"></i>
            </a>
          </div>
        </td>
      </tr>`;
    });
  
    $("#userOrders").html(html);
    $('[data-bs-toggle="tooltip"]').tooltip();
};


const ordersPagination = new Pagination();
ordersPagination.option.controller = "userorders";
ordersPagination.option.model = "UserOrderModel";
ordersPagination.option.limit = 10;
ordersPagination.option.filter = {};
ordersPagination.getPagination(ordersPagination.option, ordersPagination.valuePage.curPage);


let id =$('#UserID').val();
console.log("id" ,id);
ordersPagination.option.filter.id = +id;
ordersPagination.getPagination(
    ordersPagination.option,
    ordersPagination.valuePage.curPage
);