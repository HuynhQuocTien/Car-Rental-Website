let order = { 
  customerId: $('#UserID').val(),
  userId: null, // Assuming UserID is the same as customerId
  orderDate: getCurrentDateTimeVN(), // Placeholder for order date
  rentalDate: getCurrentDateTimeVN(), // Placeholder for rental date
  totalPrice: 0, // Tổng giá trị đơn hàng
  address: "",
  promotionId: 0,
  status: 0,
  paymentId: null, // Placeholder for payment ID
  orderDetails: [],
  payment: {
    paymentDate: getCurrentDateTimeVN(),
    paymentMethod: null,
    amount: 0, // Payment amount
    status: 0 // Payment status (0: Unpaid, 1: Paid)
  }
};
$(document).ready(function () {
  if (!sessionStorage.getItem('checkoutCart')) {
    window.location.href = `${BaseUrl}home`; // Redirect to cart page if no items
  }
  $('#payment-cash').on('click', function () {
    order.payment.paymentMethod = 0; // Cash payment method
    console.log("order.payment.paymentMethod: ",  order.payment.paymentMethod);
  });
  $('#payment-bank').on('click', function () {
    order.payment.paymentMethod = 1; // VNPAY payment method
    console.log("order.payment.paymentMethod: ",  order.payment.paymentMethod);
  });
  $('#btnCompleteOrder').on('click', async function () { // Fixed missing '#' for button ID and added 'async'
    if (!checkBeforeSubmit()) return; // Check before submitting the order
    order.address = `${$('#checkout-street').val().trim()}, ${$('#checkout-city').val().trim()}`;
    console.log("Order details:", order);
    if(!checkLogin()) return; 
    try {
      const response = await fetch(`${BaseUrl}rentalorders/create`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          order: order,
        })
      });

      if (!response.ok) {
        const errorText = await response.text();
        console.error(`Response Error: ${response.status} - ${response.statusText}`, errorText);
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const responseData = await response.json();
      console.log("API Response:", responseData);
      if (responseData.success === false) {
        Swal.fire({ title: "Error", text: responseData.message || "Failed to create order", icon: "error" });
      } else {
        if(order.payment.paymentMethod === 1) {
          await vnPay(responseData.orderID, order.totalPrice); // Call vnPay function with customerId and totalPrice
        }
        Swal.fire({ 
          title: "Success", 
          text: `Order created successfully. Order ID: ${responseData.orderID}`, 
          icon: "success" 
          
        });
        sessionStorage.removeItem('checkoutCart'); // Clear cart after successful order
        deleteItemFromCart(order.customerId); // Remove items from local storage cart
        // window.location.href = `${BaseUrl}user/`; // Redirect to user's orders page
        // window.location.href = `${BaseUrl}user/orders`; // Redirect to user's orders page  
      }
    } catch (error) {
      Swal.fire({ title: "Error", text: "An error occurred while creating the order", icon: "error" });
      // console.error("Error creating order:", error);
    }
  });

  $('#paymentMethodButtons button').on('click', function () {
    const selectedMethod = $(this).data('method');
    order.payment.paymentMethod = selectedMethod;
  
    // Update UI to reflect selected payment method
    $('#paymentMethodButtons button').removeClass('active');
    $(this).addClass('active');
  
    console.log(`Payment method selected: ${selectedMethod}`);
  });

  $('#applyPromotion').on('click', async function () {
    const promotionCode = $('#promotionCode').val().trim();
    if (!promotionCode) {
      Swal.fire({ title: "Error", text: "Please enter a promotion code", icon: "error" });
      return;
    }
  
    try {
      const response = await fetch(`${BaseUrl}promotions/validate`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ promotionCode }),
      });
  
      if (!response.ok) {
        const errorText = await response.text();
        console.error(`Response Error: ${response.status} - ${response.statusText}`, errorText);
        throw new Error(`HTTP error! status: ${response.status}`);
      }
  
      const responseData = await response.json();
      if (responseData.success === false) {
        Swal.fire({ title: "Error", text: responseData.message || "Invalid promotion code", icon: "error" });
      } else {
        const promotion = responseData.data;
        order.promotionId = promotion.PromotionID;
  
        let discount = 0;
        if (promotion.DiscountType === 0) {
          discount = (order.totalPrice * promotion.DiscountValue) / 100;
        } else if (promotion.DiscountType === 1) {
          discount = promotion.DiscountValue;
        }
  
        order.totalPrice -= discount;
        order.payment.amount = order.totalPrice;
  
        $('#discountAmount').text(`-${discount.toFixed(1)}$`);
        $('#finalTotal').text(`${order.totalPrice.toFixed(1)}$`);
  
        Swal.fire({ title: "Success", text: "Promotion applied successfully", icon: "success" });
      }
    } catch (error) {
      Swal.fire({ title: "Error", text: "An error occurred while applying the promotion", icon: "error" });
      console.error("Error applying promotion:", error);
    }
  });
});
function deleteItemFromCart(userId){
  const carts = JSON.parse(localStorage.getItem(`carts_${userId}`)) || [];
  const updatedCarts = carts.filter(item => 
    !order.orderDetails.some(detail => detail.VehicleDetailID === item.vehicleDetailId)
  );
  console.log("updateCart: ", updatedCarts);
  localStorage.setItem(`carts_${userId}`, JSON.stringify(updatedCarts));
} 

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
    order.customerId = userId; // Set userId from session storage
    return userId;
  }
}
async function loadPage() {
  const checkoutCart = JSON.parse(sessionStorage.getItem('checkoutCart'));
  let tableBody = document.querySelectorAll('#carts tbody')[0]; 
  let tableBody2 = document.querySelectorAll('#carts tbody')[1];
  let html = '';
  console.log("checkoutCart: ", checkoutCart);
  totalPrice = 0; // Khởi tạo biến totalPrice
  for (const item of checkoutCart) {
      order.orderDetails.push({
        OrderID: null, // Hoặc set sau khi tạo đơn hàng chính
        VehicleDetailID: parseInt(item.vehicleDetailId, 10),
        RentalRate: parseFloat(item.price),          
        RentalType: parseInt(getDate(item.rentalOption), 10),   
        ReturnDate: item.returnDate,      
        ActualReturnDate: null,           
        DamagePenalty: 0,                 
        UserID: null,       
        Notes: "",                        
        Active: 0,
        Status: 0
      });
    const vehicle = await getVehicleById(item.vehicleDetailId); // Giả sử bạn muốn lấy ID từ item
    totalPrice += item.price * item.quantity; // Cộng dồn giá trị vào totalPrice
    html += `
      <tr>
        <td class="ps-0">
          <a class="fw-semibold" href="${BaseUrl}vehicles/viewDetail&id=">
            ${vehicle.MakeName} ${vehicle.ModelName} (${vehicle.Seats} seats)
          </a>
          <div class="fs-sm text-muted">Color: ${vehicle.ColorName}</div>
          <div class="fs-sm text-muted">Quantity: ${item.quantity} ${item.rentalOption}</div>
          <div class="fs-sm text-muted">Price: ${item.price}$</div>
          <div class="fs-sm text-muted">Pickup date: ${item.pickupDate}</div>
        </td>
        <td class="pe-0 fw-medium text-end">${item.price*item.quantity}$</td>
      </tr>`;
  }
  html2 = `<tr>
                  <td class="ps-0 fw-medium">Subtotal</td>
                  <td class="pe-0 fw-medium text-end">${totalPrice.toFixed(1)}</td>
                </tr>
                <tr>
                <td class="ps-0 fw-medium">Vat (10%)</td>
                  <td class="pe-0 fw-medium text-end">${( totalPrice / 10).toFixed(1)}</td>
                </tr>
                <tr>
                  <td class="ps-0 fw-medium">Total</td>
                  <td class="pe-0 fw-bold text-end">${(totalPrice + totalPrice / 10).toFixed(1)}</td>
                </tr>`;
  tableBody2.innerHTML = html2;
  tableBody.innerHTML = html;
  order.totalPrice = totalPrice + totalPrice / 10;
  order.payment.amount = order.totalPrice;
}
loadPage(); // Gọi hàm để tải trang khi tài liệu đã sẵn sàng

async function getVehicleById(id) {
  if (!id) {
    console.error("Vehicle ID is required");
    return;
  }

  try {
    const response = await fetch(`${BaseUrl}vehicles/getVehicleDetail`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: new URLSearchParams({ id }),
    });

    if (!response.ok) {
      throw new Error(`Error fetching vehicle details: ${response.statusText}`);
    }

    const data = await response.json();

    if (data.success) {
      console.log("Vehicle details fetched successfully:", data.data);
      return data.data;
    } else {
      console.log("Error:", data.message);
    }
  } catch (error) {
    console.log('Error fetching vehicle details:', error);
  }
}
function getCurrentDateTimeVN() {
  const now = new Date();
  const vnTime = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Ho_Chi_Minh' }));

  const year = vnTime.getFullYear();
  const month = String(vnTime.getMonth() + 1).padStart(2, '0');
  const day = String(vnTime.getDate()).padStart(2, '0');
  const hours = String(vnTime.getHours()).padStart(2, '0');
  const minutes = String(vnTime.getMinutes()).padStart(2, '0');
  const seconds = String(vnTime.getSeconds()).padStart(2, '0');

  return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}

function getDate(date){
  switch(date){
    case "day": return 1;
    case "week": return 2;
    case "month": return 3;
    case "year": return 4;
    default: return "unknown date"; 
  }
}

async function vnPay(orderId, amount) {
  const response = await fetch(`${BaseUrl}payments/createVnpayPayment`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      orderId: orderId,
      amount: amount
    })
  });

  if (!response.ok) {
    const errorText = await response.text();
    console.error(`Response Error: ${response.status} - ${response.statusText}`, errorText);
    throw new Error(`HTTP error! status: ${response.status}`);
  }

  const responseData = await response.json();
  console.log("API Response:", responseData);

  if (responseData.success === false) {
    Swal.fire({ title: "Error", text: responseData.message || "Failed to create order", icon: "error" });
  } else {
    window.location.href = responseData.redirectUrl; // Redirect to VNPAY payment page
  }
}

function checkBeforeSubmit() {
  const address = $('#checkout-street').val().trim();
  const city = $('#checkout-city').val().trim();
  const paymentMethod = order.payment.paymentMethod;
  if (!address || !city) {
    Swal.fire({ title: "Error", text: "Please enter your address and city", icon: "error" });
    return false;
  }
  if (paymentMethod === null) {
    Swal.fire({ title: "Error", text: "Please select a payment method", icon: "error" });
    return false;
  }
  return true;
}