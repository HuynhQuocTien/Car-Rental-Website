(function () {
  function formatCurrencyVN(amount) {
    return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " VNĐ";
  }

  function loadData(payload) {
    fetch(BaseUrl + "dashboard/test", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload),
    })
      .then((response) => response.json())
      .then((data) => {
        let totalPayment = 0;
        let countRetalCar = 0;
        data.payMentResult.forEach(function (value) {
          const number = Number.parseInt(value.Amount);
          totalPayment += number;
          countRetalCar++;
        });
        // console.log(formatCurrencyVN(total));
        let countActiveCar = 0;
        // data.vehicleDetailModel.forEach(function (value) {
        //   countActiveCar++;
        // });
        console.log();
        data.vehicleDetailModel.forEach(function(val){
          if(val.Active === "1"){
            countActiveCar++;
          }
        })

        document.querySelector(".total_earn").textContent = formatCurrencyVN(totalPayment);
        document.querySelector(".total_rental").textContent = countRetalCar;
        document.querySelector(".active_car").textContent = countActiveCar;
      })
      .catch((error) => {
        console.error("Có lỗi:", error);
      });
  }

  loadData({ timeRange: "this_week" });

  document.querySelectorAll(".dropdown-item").forEach((item) => {
    if (!item.hasAttribute("data-event-attached")) {
      // Nếu chưa gán event
      item.setAttribute("data-event-attached", "true"); // Đánh dấu đã gán
      item.addEventListener("click", function () {
        const timeRange = this.getAttribute("data-range");
        const payload = { timeRange };
        loadData(payload);
      });
    }
  });
})();
