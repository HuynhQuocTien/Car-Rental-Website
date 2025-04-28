Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);

const renderData = function (orders) {
    console.log("detail: ");
    console.log(orders);
    index = 0;
    if (orders.length === 0) {
        $("#list-orderapproval").html('<tr><td colspan="10" class="text-center">No data available</td></tr>');
        return;
    }
    let html = "";
    orders.forEach((order) => {
      html += `<tr>
        <td>${++index}</td>
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
            <a href="javascript:void(0);"
              class="btn btn-sm btn-alt-success js-bs-tooltip-enabled js-confirm-order"
              data-bs-toggle="tooltip" aria-label="Confirm Order" data-bs-original-title="Confirm Order"  data-id="${order.OrderID}">
              <i class="fa fa-check"></i>
            </a>
          </div>
        </td>
      </tr>`;
    });
  
    $("#list-orderapproval").html(html);
    $('[data-bs-toggle="tooltip"]').tooltip();

    // add event listener for confirm order buttons
    confirmOrderEvents();
};

const mainPagePagination = new Pagination();
mainPagePagination.option.controller = "rentalorders";
mainPagePagination.option.model = "OrderApprovalModel";
mainPagePagination.option.limit = 10;
mainPagePagination.option.filter = {};
mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);

// Event listener
// Hàm xác nhận đơn hàng
async function confirmOrder(orderId) {
  try {
    // Gửi request bất đồng bộ tới controller
    // tra ve promise 
    const response = await fetch('approval/confirmOrder', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id: orderId })
    });

    // Đọc dữ liệu trả về dưới dạng JSON
    const data = await response.json();

    // Kiểm tra kết quả và hiển thị thông báo
    if (data.success) {
      Swal.fire('Thành công', data.message, 'success');
      mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
    } else {
      Swal.fire('Lỗi', data.message, 'error');
    }
  } catch (error) {
    console.log('Error:', error);
    Swal.fire('Lỗi', 'Không thể xác nhận đơn hàng.', 'error');
  }
}

const confirmOrderEvents = function () {
  document.querySelectorAll('.js-confirm-order').forEach(function (button) {
    button.addEventListener('click', function () {
      let orderId = this.getAttribute('data-id');
      console.log("Attach confirm events"); 
      Swal.fire({
        title: 'Xác nhận đơn hàng',
        text: 'Bạn có chắc chắn muốn xác nhận đơn hàng ID: ' + orderId + ' không?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Hủy'
      }).then((result) => {
        if (result.isConfirmed) {
          confirmOrder(orderId);
        }
      });
    });
  });
};