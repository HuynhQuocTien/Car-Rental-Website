(function () {
  let topCar = [];
  let currentTimeRange = "this_week"; // Biến lưu trữ timeRange hiện tại
  let myChart1 = null;
  let myChart2 = null;

  async function renderChart(topCar) {
    const promise = topCar.map(({ VehicleDetailID }) =>
      fetchVehicleData(VehicleDetailID)
    );
    const data = await Promise.all(promise);
  
    // Lấy context của biểu đồ
    var ctx1 = document.getElementById("myChart").getContext("2d");
  
    // Kiểm tra và huỷ bỏ biểu đồ cũ nếu có
    if (myChart1) {
      myChart1.destroy(); // Huỷ biểu đồ cũ trước khi tạo mới
    }
  
    // Dữ liệu mẫu cho biểu đồ
    const totalMoneyCar = topCar.map((obj) => obj.RentalRate);
  
  
    // Dữ liệu cho biểu đồ
    var topCarChartData = {
      labels: data.map((obj) => obj.vehicle.ModelName), // Lấy tên model từ topCar để làm labels
      datasets: [
        {
          label: "Top Car Rental",
          data: totalMoneyCar, // Số lượng xe tương ứng
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
          ],
          borderWidth: 1,
        },
      ],
    };
  
    // Cấu hình biểu đồ
    var config1 = {
      type: "bar", // Loại biểu đồ là bar (cột)
      data: topCarChartData,
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true, // Bắt đầu từ 0 trên trục Y
          },
        },
      },
    };
  
    // Tạo biểu đồ
    if (myChart1) {
      myChart1.destroy(); // Đảm bảo destroy nếu có trước khi tạo lại
    }
    myChart1 = new Chart(ctx1, config1); // Tạo mới biểu đồ
  }

  async function renderSecondChart(thucnhan, chuanhan) {
    var ctx = document.getElementById("myChart2").getContext("2d");

    // Kiểm tra và huỷ bỏ biểu đồ cũ nếu có
    if (myChart2) {
      myChart2.destroy(); // Huỷ biểu đồ cũ trước khi tạo mới
    }

    // Dữ liệu cho biểu đồ
    var topCarChartData = {
      labels: ["Is Pay", "Is not Pay"],
      datasets: [
        {
          label: "Top Car Rental",
          data: [thucnhan, chuanhan], // Dữ liệu tổng số tiền thuê xe
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
          ],
          borderWidth: 1,
        },
      ],
    };

    // Cấu hình biểu đồ
    var config = {
      type: "pie", // Loại biểu đồ là pie (hình tròn)
      data: topCarChartData,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: "top",
          },
          tooltip: {
            callbacks: {
              label: function (tooltipItem) {
                // Hiển thị tổng tiền kèm theo phần trăm
                const label = tooltipItem.label || "";
                const value = tooltipItem.raw || 0;
                const total = tooltipItem.dataset.data.reduce(
                  (acc, val) => acc + val,
                  0
                );
                const percentage = ((value / total) * 100).toFixed(2);
                return `${label}: $${value} (${percentage}%)`;
              },
            },
          },
        },
      },
    };

    // Tạo biểu đồ mới và lưu vào biến myChart2
    myChart2 = new Chart(ctx, config);
  }

  // Format tiền VND
  function formatCurrencyUSD(amount) {
    return "$" + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  // API fetch functions
  async function fetchPostDetails(postID) {
    const res = await fetch(
      `${BaseUrl}dashboard/vehicleDetail&VehicleDetailID=${postID}`
    );
    return res.json();
  }

  async function fetchVehicle(vehicleID) {
    const res = await fetch(
      `${BaseUrl}dashboard/vehicle&VehicleID=${vehicleID}`
    );
    return res.json();
  }

  async function fetchVehicleColor(colorID) {
    const res = await fetch(`${BaseUrl}dashboard/color&ColorID=${colorID}`);
    return res.json();
  }

  async function fetchVehicleData(vehicleDetailID) {
    const vehicleDetail = await fetchPostDetails(vehicleDetailID);
    const vehicle = await fetchVehicle(vehicleDetail.VehicleID);
    const color = await fetchVehicleColor(vehicleDetail.ColorID);
    return { vehicleDetail, vehicle, color };
  }

  async function renderChart(topCar) {
    const promise = topCar.map(({ VehicleDetailID }) =>
      fetchVehicleData(VehicleDetailID)
    );
    const data = await Promise.all(promise);

    // Lấy context của biểu đồ
    var ctx1 = document.getElementById("myChart").getContext("2d");

    // Dữ liệu mẫu cho biểu đồ
    const totalMoneyCar = topCar.map((obj) => obj.RentalRate);


    // Dữ liệu cho biểu đồ
    var topCarChartData = {
      labels: data.map((obj) => obj.vehicle.ModelName), // Lấy tên model từ topCar để làm labels
      datasets: [
        {
          label: "Top Car Rental",
          data: totalMoneyCar, // Số lượng xe tương ứng
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
          ],
          borderWidth: 1,
        },
      ],
    };

    // Cấu hình biểu đồ
    var config1 = {
      type: "bar", // Loại biểu đồ là bar (cột)
      data: topCarChartData,
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true, // Bắt đầu từ 0 trên trục Y
          },
        },
      },
    };

    // Tạo biểu đồ
    var myChart1 = new Chart(ctx1, config1);
  }

  async function renderTopVehicles(sortField = "total", sortOrder = "desc") {
    const table = document.querySelector(".vehicles_table");
    table.innerHTML = ""; // Clear the table before inserting new data

    // Sắp xếp theo field và order
    const sortedTopCar = [...topCar].sort((a, b) => {
      if (sortField === "count") {
        return sortOrder === "asc" ? a.count - b.count : b.count - a.count;
      } else if (sortField === "total") {
        return sortOrder === "asc"
          ? a.RentalRate - b.RentalRate
          : b.RentalRate - a.RentalRate;
      }
    });

    const vehicleDataPromises = sortedTopCar.map(({ VehicleDetailID }) =>
      fetchVehicleData(VehicleDetailID)
    );
    const results = await Promise.all(vehicleDataPromises);

    results.forEach(({ vehicle, vehicleDetail, color }, index) => {
      const newRowHTML = `
        <tr>
          <td><span class="fw-semibold">${vehicle.ModelName}</span></td>
          <td class="text-center text-nowrap fw-medium"><span class="fs-sm text-muted">${
            color.ColorName
          }</span></td>
          <td><span class="fw-semibold text-primary">${
            vehicleDetail.Year
          }</span></td>
          <td class="text-center text-nowrap fw-medium text-success">${formatCurrencyUSD(
            sortedTopCar[index].RentalRate
          )}</td>
          <td class="text-center text-nowrap fw-medium"><a href="javascript:void(0)">${
            vehicle.Quantity
          }</a></td>
          <td class="text-center text-nowrap fw-medium"><a href="javascript:void(0)">${
            vehicle.MakeName
          }</a></td>
          <td class="text-center text-nowrap fw-medium"><a href="javascript:void(0)">${
            vehicle.NameType
          }</a></td>
        </tr>
      `;
      table.insertAdjacentHTML("beforeend", newRowHTML);
    });
  }

  function updateTimeButton(timeRange) {
    const button = document.querySelector(".btn.btn-sm.btn-alt-primary.px-3");
    if (!button) return;
    let text = "";

    switch (timeRange) {
      case "this_week":
        text = "This Week ";
        break;
      case "previous_week":
        text = "Previous Week ";
        break;
      case "this_month":
        text = "This Month ";
        break;
      case "previous_month":
        text = "Previous Month ";
        break;
      default:
        text = "This Week "; // Giá trị mặc định khi không có timeRange
        break;
    }

    button.childNodes[0].textContent = text;
  }

  // Hàm chính: Load và render data
  async function loadData(payload) {
    try {
      // Kiểm tra xem có timeRange không, nếu không có thì gán mặc định
      if (!payload.timeRange) {
        payload.timeRange = currentTimeRange; // Dùng lại timeRange trước đó nếu không có mới
      }

      const response = await fetch(`${BaseUrl}dashboard/test`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload),
      });
      const data = await response.json();

      // Kiểm tra xem data.payMentResult có hợp lệ không
      if (!data.payMentResult || !Array.isArray(data.payMentResult)) {
        console.error(
          "Dữ liệu paymentResult không hợp lệ:",
          data.payMentResult
        );
        return; // Dừng lại nếu dữ liệu không hợp lệ
      }

      // Tính toán các thống kê
      let totalPayment = 0;
      let countRentalCar = 0;
      let countCompleteOrders = 0;
      data.payMentResult.forEach(({ Amount, Status }) => {
        const number = parseInt(Amount, 10);
        if (!isNaN(number)) {
          if (Status === "1") {
            totalPayment += number;
            countCompleteOrders++;
          }
          countRentalCar++;
        } else {
          console.error("Số tiền không hợp lệ:", Amount);
        }
      });

      let countActiveCar = data.vehicleDetailResult.filter(
        (v) => v.Active === "1"
      ).length;
      let countRegistered = data.accountResult.length;

      // Gom nhóm xe top
      topCar = Object.values(
        data.rentalOrderDetailResult.reduce(
          (acc, { VehicleDetailID, RentalRate }) => {
            if (!acc[VehicleDetailID]) {
              acc[VehicleDetailID] = {
                VehicleDetailID,
                RentalRate: 0,
                count: 0,
              };
            }
            acc[VehicleDetailID].count++;
            acc[VehicleDetailID].RentalRate += parseInt(RentalRate, 10);
            return acc;
          },
          {}
        )
      );

      // Update UI
      updateTimeButton(payload.timeRange);
      document.querySelector(".total_earn").textContent =
        formatCurrencyUSD(totalPayment);
      document.querySelector(".total_rental").textContent = countRentalCar;
      document.querySelector(".active_car").textContent = countActiveCar;
      document.querySelector(".registered_users").textContent = countRegistered;
      document.querySelector(".complete_orders").textContent =
        countCompleteOrders;

      // Render bảng xe
      

      let thucnhan = 0;
      let chuanhan = 0;
      data.payMentResult.forEach(function ({ Status, Amount }) {
        if (Status === "1") {
          thucnhan += Number.parseInt(Amount);
        } else {
          chuanhan = Number.parseInt(Amount);
        }
      });

      await renderSecondChart(thucnhan, chuanhan);
      await renderTopVehicles();
      await renderChart(topCar);
    } catch (error) {
      console.error("Có lỗi:", error);
    }
  }

  // Setup sự kiện cho các item chọn thời gian
  function setupDropdownEvent() {
    document.querySelectorAll(".dropdown-item").forEach((item) => {
      if (!item.hasAttribute("data-event-attached")) {
        item.setAttribute("data-event-attached", "true");
        item.addEventListener("click", function () {
          const timeRange = this.getAttribute("data-range");
          currentTimeRange = timeRange; // Lưu lại timeRange hiện tại
          loadData({ timeRange }); // Gọi lại loadData với timeRange mới
        });
      }
    });
  }

  // Setup sự kiện cho các item sort
  function setupSortEvent() {
    document.querySelectorAll(".sort_list").forEach(function (element) {
      element.addEventListener("click", function () {
        const sortInfo = this.getAttribute("data-sort"); // Ví dụ: "count desc"
        const [sortField, sortOrder] = sortInfo.split(" ");

        // Gọi lại renderTopVehicles với thông tin sắp xếp mới
        renderTopVehicles(sortField, sortOrder);
      });
    });
  }

  // Bắt đầu chương trình
  loadData({ timeRange: "this_week" }); // Gọi với timeRange mặc định
  setupDropdownEvent();
  setupSortEvent(); // Gọi hàm setupSortEvent để thêm sự kiện cho các item sắp xếp
})();
