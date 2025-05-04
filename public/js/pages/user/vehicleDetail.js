$(document).ready(function () {
  $.ajax();
  // === Toggle nút active khi chọn loại thuê ===
  $(".btn-group-toggle .btn").click(function () {
    $(".btn-group-toggle .btn").removeClass("active");
    $(this).addClass("active");
  });

  $('.btn-group-toggle input[type="radio"]').change(function () {
    $(".btn-group-toggle .btn").removeClass("active");
    $(this).closest(".btn").addClass("active");
    updatePrice();
    updateDurationLabel();
    calculateReturnDate();
  });

  // === Cập nhật giá khi chọn loại thuê ===
  function updatePrice() {
    let price = 0;
    let unit = "";
    switch ($('.btn-group-toggle input[type="radio"]:checked').attr("id")) {
      case "hourly":
        price = parseFloat($("#hourly-price").val());
        unit = "hour";
        break;
      case "daily":
        price = parseFloat($("#daily-price").val());
        unit = "day";
        break;
      case "weekly":
        price = parseFloat($("#weekly-price").val());
        unit = "week";
        break;
      case "monthly":
        price = parseFloat($("#monthly-price").val());
        unit = "month";
        break;
    }

    $("#main-price").text(price);
    $("#price-unit").text("/" + unit);
  }

  // === Cập nhật nhãn số lượng (days, weeks, etc) ===
  function updateDurationLabel() {
    const type = $('.btn-group-toggle input[type="radio"]:checked').val();
    let label = type;
    if (type === "hour") label = "hours";
    else if (type === "day") label = "days";
    else if (type === "week") label = "weeks";
    else if (type === "month") label = "months";
    $("#duration-label").text(label);
  }

  // === Tính ngày trả xe tự động ===
  function calculateReturnDate() {
    const pickupVal = $("#pickup-date").val();
    const quantity = parseInt($("#rental-quantity").val()) || 1;
    const option = $('.btn-group-toggle input[type="radio"]:checked').val();

    if (!pickupVal) return;

    const pickupDate = new Date(pickupVal);
    const returnDate = new Date(pickupDate);

    switch (option) {
      case "hour":
        returnDate.setHours(returnDate.getHours() + quantity);
        break;
      case "day":
        returnDate.setDate(returnDate.getDate() + quantity);
        break;
      case "week":
        returnDate.setDate(returnDate.getDate() + quantity * 7);
        break;
      case "month":
        returnDate.setMonth(returnDate.getMonth() + quantity);
        break;
    }

    // Format lại YYYY-MM-DD cho input date
    const formatted = returnDate.toISOString().split("T")[0];
    $("#return-date").val(formatted);
  }

  // === Khi chọn số lượng hoặc ngày lấy thì tính lại ngày trả ===
  $("#rental-quantity, #pickup-date").on("change input", function () {
    calculateReturnDate();
  });

  // === Kiểm tra tình trạng có sẵn xe ===
  $("#check-availability").click(function () {
    const pickup = $("#pickup-date").val();
    const ret = $("#return-date").val();

    if (!pickup || !ret) {
      $("#availability-message")
        .text("Please select both dates.")
        .removeClass("text-success")
        .addClass("text-danger");
      return;
    }

    // const vehicleDetailId = <?= $data['Vehicle']['VehicleDetailID'] ?>;

    // Gọi AJAX để kiểm tra với backend ở đây nếu cần
    // Giả lập thành công:
    $(".available-actions").removeClass("d-none");
    $("#availability-message")
      .removeClass("text-danger")
      .addClass("text-success")
      .text("Available!");
  });

  // === Khởi tạo lần đầu ===
  updatePrice();
  updateDurationLabel();
  calculateReturnDate();

  // ADD TO CART
  $('#addToCartBtn').click(function () {
    if(!checkLogin()) {
      return; // Nếu chưa đăng nhập thì không thực hiện thêm vào giỏ hàng
    }
    console.log('Add to cart button clicked!');
    // Lấy thông tin từ form
    const vehicleId = parseInt(document.getElementById('id-save').value);
    const quantity = parseInt(document.getElementById('rental-quantity').value);
    const rentalOption = document.querySelector('input[name="options"]:checked').value; // hour, day, week, month
    const pickupDate = document.getElementById('pickup-date').value;
    const returnDate = document.getElementById('return-date').value;
  
    // Lấy giá theo loại thuê
    let price = 0;
    if (rentalOption === 'hour') {
      price = parseFloat(document.getElementById('hourly-price').value);
    } else if (rentalOption === 'day') {
      price = parseFloat(document.getElementById('daily-price').value);
    } else if (rentalOption === 'week') {
      price = parseFloat(document.getElementById('weekly-price').value);
    } else if (rentalOption === 'month') {
      price = parseFloat(document.getElementById('monthly-price').value);
    }

    
    userID = $('#UserID').val();

    let carts = JSON.parse(localStorage.getItem(`carts_${userID}`)) || [];

    const cartItem = {
        id: carts.length + 1,
        vehicleDetailId: vehicleId,
        quantity: quantity,
        rentalOption: rentalOption,
        pickupDate: pickupDate,
        returnDate: returnDate,
        price: price
    };
    console.log(cartItem);
    // Lưu vào localStorage
    
    const cartKey = `carts_${userID}`;
    let cart = JSON.parse(localStorage.getItem(cartKey)) || [];
  
    // Kiểm tra nếu xe đã có trong giỏ thì update
    const existingItemIndex = cart.findIndex(item => item.vehicleDetailId === vehicleId && item.rentalOption === rentalOption && item.pickupDate === pickupDate);
    if (existingItemIndex > -1) {
        cart[existingItemIndex].quantity += quantity;
        const existingReturnDate = new Date(cart[existingItemIndex].returnDate);
        const additionalQuantity = quantity;
        const rentalOption = cart[existingItemIndex].rentalOption;
        switch (rentalOption) {
          case "hour":
            existingReturnDate.setHours(existingReturnDate.getHours() + additionalQuantity);
            break;
          case "day":
            existingReturnDate.setDate(existingReturnDate.getDate() + additionalQuantity);
            break;
          case "week":
            existingReturnDate.setDate(existingReturnDate.getDate() + additionalQuantity * 7);
            break;
          case "month":
            existingReturnDate.setMonth(existingReturnDate.getMonth() + additionalQuantity);
            break;
        }

        cart[existingItemIndex].returnDate = existingReturnDate.toISOString().split("T")[0];
    } else {
        cart.push(cartItem);
    }
  
    localStorage.setItem(cartKey, JSON.stringify(cart));
  
    $('body').css('overflow', 'hidden'); 
    Swal.fire({
        title: 'Thành công',
        text: 'Xe đã được thêm vào giỏ hàng!',
        icon: 'success',
        position: 'center', // Đảm bảo thông báo xuất hiện giữa màn hình
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        $('body').css('overflow', 'auto'); // Cho phép cuộn lại sau khi thông báo xuất hiện
    });
  });
});

function checkLogin() {
  const userId = $('#UserID').val();
  if (!userId) {
    Swal.fire({
      title: "Login Required",
      text: "Please log in to continue.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Login",
      cancelButtonText: "Cancel"
    }).then((result) => {
      if (result.isConfirmed) {
        $('#btnLogin').click(); // Trigger login button click
      }
    });
  } else {
    return true;
  }
}
