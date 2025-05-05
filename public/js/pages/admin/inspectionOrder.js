const renderData = function (data) {
  let html = "";

  if (!data || data.length === 0) {
    $("#list-inspection").html(
      '<tr><td colspan="10" class="text-center">No data available</td></tr>'
    );
    return;
  }

  data.forEach((item) => {
    const isDetailClickable = item.Status === "1";
    const isEditDeleteClickable = item.Status === "2";

    const detailButton = isDetailClickable
      ? `<button type="button" class="btn btn-sm btn-alt-secondary js-detail-vehicle"
            data-id="${item.OrderDetailID}" data-bs-toggle="tooltip"
            aria-label="Detail" data-bs-original-title="Chi tiết">
            <i class="fa fa-rectangle-list"></i>
        </button>`
      : `<button type="button" class="btn btn-sm btn-alt-secondary" disabled
            aria-label="Detail" data-bs-original-title="Không thể thao tác">
            <i class="fa fa-rectangle-list text-muted"></i>
        </button>`;

    const updateButton = isEditDeleteClickable
      ? `<button type="button" class="btn btn-sm btn-alt-success js-update-inspection"
            data-id="${item.OrderDetailID}" data-bs-toggle="tooltip"
            aria-label="Update" data-bs-original-title="Cập nhật">
            <i class="fa fa-pen"></i>
        </button>`
      : `<button type="button" class="btn btn-sm btn-alt-success" disabled
            aria-label="Update" data-bs-original-title="Chỉ cập nhật khi trạng thái = 2">
            <i class="fa fa-pen text-muted"></i>
        </button>`;

    const deleteButton = isEditDeleteClickable
      ? `<button type="button" class="btn btn-sm btn-alt-danger js-delete-inspection"
            data-id="${item.OrderDetailID}" data-bs-toggle="tooltip"
            aria-label="Delete" data-bs-original-title="Xóa">
            <i class="fa fa-trash"></i>
        </button>`
      : `<button type="button" class="btn btn-sm btn-alt-danger" disabled
            aria-label="Delete" data-bs-original-title="Chỉ xóa khi trạng thái = 2">
            <i class="fa fa-trash text-muted"></i>
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
          ${detailButton}
          ${updateButton}
          ${deleteButton}
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

  const $form = $("#inspectionForm");
  const currentUserID = $("#userID").val();
  $form[0].reset();
  $("#userID").val(currentUserID);
  $("#rentalOrderDetailID").val(orderDetailID);

  // 👉 Lấy ngày và giờ hiện tại
  const now = new Date();
  const today = now.toISOString().split("T")[0]; // định dạng YYYY-MM-DD
  const currentTime = now.toTimeString().slice(0, 5); // định dạng HH:MM

  // 👉 Gán vào input
  $("#inspectionDate").val(today);
  $("#inspectionTime").val(currentTime);

  const modal = new bootstrap.Modal(document.getElementById("inspectionModal"));
  modal.show();
});

$(document).on("click", ".js-update-inspection", function () {
  const orderDetailID = $(this).data("id"); // Lấy orderDetailID từ data-id của nút

  console.log("orderDetailID:", orderDetailID);

  // Reset toàn bộ form trước khi đổ dữ liệu mới
  const $form = $("#inspectionForm1");
  $form[0].reset(); // Reset toàn bộ form
  $("#userID1").val(""); // Reset dropdown
  $("#rentalOrderDetailID1").val(orderDetailID); // Gán ID cho trường ẩn

  // Cập nhật URL API
  const url = BaseUrl + "inspections/getins&orderDetailID=" + orderDetailID;

  // Gửi request GET đến API
  $.ajax({
    url: url, // Sử dụng URL đã thay đổi
    type: "GET", // Dùng GET để lấy dữ liệu
    dataType: "json",
    success: function (response) {
      console.log(response);

      if (response && response.success) {
        const inspection = response.data;

        // Đổ dữ liệu vào form nếu có
        $("#rentalOrderDetailID1").val(inspection.RentalOrderDetailID);
        $("#userID1").val(inspection.UserID);
        $("#inspectionDate1").val(inspection.InspectionDate);
        $("#inspectionTime1").val(inspection.InspectionTime);
        $("#totalFineAmount1").val(inspection.TotalFineAmount);

        // Hiển thị modal
        const modal = new bootstrap.Modal(
          document.getElementById("inspectionModal1")
        );
        modal.show();
      } else {
        alert("Không tìm thấy thông tin cần cập nhật.");
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error:", status, error);
      console.log("Response Text:", xhr.responseText);
      alert("Lỗi khi tải dữ liệu: " + error);
    },
  });
});

// Xử lý submit form Inspection1
$(document).on("submit", "#inspectionForm1", function (e) {
  e.preventDefault();

  const formData = $(this).serialize(); // Lấy toàn bộ dữ liệu form dưới dạng query string
  console.log("Dữ liệu gửi đi:", formData);

  $.ajax({
    url: BaseUrl + "inspections/updateInspectionForOrderDetail", // Đường dẫn xử lý trên server
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
        const modal = bootstrap.Modal.getInstance(
          document.getElementById("inspectionModal")
        );
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
    },
  });
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
        const modal = bootstrap.Modal.getInstance(
          document.getElementById("inspectionModal")
        );
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
    },
  });
});

// Lắng nghe sự kiện click trên nút xóa
$(document).on("click", ".js-delete-inspection", function () {
  const orderDetailID = $(this).data("id"); // Lấy orderDetailID từ data-id của nút

  // Xác nhận xóa
  if (confirm("Bạn có chắc chắn muốn xóa kiểm tra này?")) {
    const url = BaseUrl + "inspections/delete&orderDetailID=" + orderDetailID; // Tạo URL POST

    // Gửi request DELETE tới API
    $.ajax({
      url: url,
      type: "POST",
      dataType: "json",
      success: function (response) {
        if (response.success) {
          inspecOrderPagination.getPagination(
            inspecOrderPagination.option,
            inspecOrderPagination.valuePage.curPage
          );
          alert("Xóa thông tin kiểm tra thành công.");
          // Cập nhật lại giao diện sau khi xóa thành công (ví dụ: xóa dòng trong bảng)
          $(`#inspection-row-${orderDetailID}`).remove(); // Giả sử bạn có id cho dòng bảng
        } else {
          alert("Không thể xóa thông tin kiểm tra. Vui lòng thử lại.");
        }
      },
      error: function (xhr, status, error) {
        console.error("Lỗi khi gửi yêu cầu xóa:", status, error);
        alert("Đã xảy ra lỗi khi xóa. Vui lòng thử lại sau.");
      },
    });
  }
});

// ✅ Lọc dữ liệu
$("#color, #vehicleType, #make, #model").change(function () {
  const filterData = {
    color: $("#color").val(),
    type: $("#vehicleType").val(),
    make: $("#make").val(),
    model: $("#model").val(),
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
