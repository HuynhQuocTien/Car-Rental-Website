(function () {
  function formatCurrencyVN(amount) {
    return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g,",") + "VNĐ";
  }

  function loadData(payload) {
    fetch(BaseUrl + "dashboard/test", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload),
    })
      .then((response) => response.json())
      .then((data) => {
        let total = 0;
        data.result.forEach(function (value) {
          const number = Number.parseInt(value.Amount);
          total += number;
          // console.log(value.Amount);
        });
        console.log(formatCurrencyVN(total));
        document.querySelector(".total_earn").textContent =
          formatCurrencyVN(total);
      })
      .catch((error) => {
        console.error("Có lỗi:", error);
      });
  }

  loadData({timeRange: "this_week"});

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
