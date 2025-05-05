const renderData = function (data) {
  let html = "";

  if (!data || data.length === 0) {
    $("#list-inspection").html(
      '<tr><td colspan="10" class="text-center">No data available</td></tr>'
    );
    return;
  }

  data.forEach((item) => {
    const isClickable = item.Status === "1";
    const button = isClickable
      ? `<button type="button" class="btn btn-sm btn-alt-secondary js-detail-vehicle"
            data-id="${item.OrderDetailID}" data-bs-toggle="tooltip"
            aria-label="Detail" data-bs-original-title="Detail">
            <i class="fa fa-rectangle-list"></i>
        </button>`
      : `<button type="button" class="btn btn-sm btn-alt-secondary" disabled
            aria-label="Detail" data-bs-original-title="Không thể thao tác">
            <i class="fa fa-rectangle-list text-muted"></i>
        </button>`;

    html += `<tr>
      <td class="text-center">${item.OrderDetailID}</td>
      <td class="text-center">${item.ReturnDate}</td>
      <td class="text-center">${item.ActualReturnDate}</td>
      <td class="text-center">${item.ColorName}</td>
      <td class="text-center">${item.NameType}</td>
      <td class="text-center">${item.Year}</td>
      <td class="text-center">${item.MakeName}</td>
      <td class="text-center">${item.ModelName}</td>
      <td class="text-center">${item.Status}</td>
      <td class="text-center">
        <div class="btn-group">
          ${button}
        </div>
      </td>
    </tr>`;
  });

  $("#list-inspectionOrder").html(html);
  $('[data-bs-toggle="tooltip"]').tooltip();
};


// Khi bấm vào nút Detail => hiển thị modal có sẵn và gán ID
$(document).on("click", ".js-detail-vehicle", function () {
  const orderDetailID = $(this).data("id");

  // Reset toàn bộ form
  const $form = $("#inspectionForm");
  $form[0].reset(); // reset các input về mặc định
  $("#userID").val(""); // đảm bảo select về mặc định
  $("#rentalOrderDetailID").val(orderDetailID); // gán ID mới

  // Hiển thị modal
  const modal = new bootstrap.Modal(document.getElementById("inspectionModal"));
  modal.show();
});

// Xử lý submit form Inspection
$(document).on("submit", "#inspectionForm", function (e) {
  e.preventDefault();

  const formData = $(this).serialize(); // Lấy toàn bộ dữ liệu form dưới dạng query string
  console.log("Dữ liệu gửi đi:", formData);

  $.ajax({
    url: BaseUrl + "inspections/addInspectionForOrderDetail", // Đường dẫn xử lý trên server
    type: "POST",
    data: formData, // Gửi toàn bộ dữ liệu form
    dataType: "json",
    success: function (response) {
      if (response.success) {
        inspecOrderPagination.getPagination(
          inspecOrderPagination.option,
          inspecOrderPagination.valuePage.curPage
        );
        Dashmix.helpers("jq-notify", {
          type: "success",
          icon: "fa fa-check me-1",
          message: "Lưu thông tin kiểm tra thành công",
        });

        // Đóng modal nếu thành công
        const modal = bootstrap.Modal.getInstance(document.getElementById("inspectionModal"));
        if (modal) modal.hide();
      } else {
        Dashmix.helpers("jq-notify", {
          type: "danger",
          icon: "fa fa-times me-1",
          message: response.message || "Lưu không thành công",
        });
      }
    },
    error: function () {
      Dashmix.helpers("jq-notify", {
        type: "danger",
        icon: "fa fa-times me-1",
        message: "Đã xảy ra lỗi khi gửi dữ liệu",
      });
    }
  });
});



// ✅ Lọc dữ liệu
$("#color, #vehicleType, #make, #model").change(function () {
  const filterData = {
    color: $("#color").val(),
    type: $("#vehicleType").val(),
    make: $("#make").val(),
    model: $("#model").val()
  };

  inspecOrderPagination.option.filter = filterData;
  inspecOrderPagination.getPagination(
    inspecOrderPagination.option,
    inspecOrderPagination.valuePage.curPage
  );
});

// ✅ Sắp xếp
$("#sort, #sortDirection").change(function () {
  const sort = $("#sort").val();
  const sortDirection = $("#sortDirection").val();

  if (sort && sortDirection) {
    inspecOrderPagination.option.filter.sort = { sort, sortDirection };
    inspecOrderPagination.getPagination(
      inspecOrderPagination.option,
      inspecOrderPagination.valuePage.curPage
    );
  }
});

// ✅ Phân trang
const inspecOrderPagination = new Pagination();
inspecOrderPagination.option.controller = "inspections";
inspecOrderPagination.option.model = "InspectionOrderModel";
inspecOrderPagination.option.limit = 10;
inspecOrderPagination.option.filter = {};
inspecOrderPagination.getPagination(
  inspecOrderPagination.option,
  inspecOrderPagination.valuePage.curPage
);
