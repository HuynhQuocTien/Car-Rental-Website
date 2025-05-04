$(document).ready(function () {
    const $cartButtons = $(".cartButton");
    const $miniCart = $("#miniCart");
    const $closeCart = $("#closeCart");
    const $closeCartBottom = $("#closeCartBottom");

    if ($cartButtons.length > 0) {
        const $cartButton = $cartButtons.eq(0);

        $cartButton.on("click", function (event) {
            if(!checkLogin()) return; // Kiểm tra đăng nhập trước khi mở giỏ hàng
            const userID = $('#UserID').val();
            let carts = JSON.parse(localStorage.getItem(`carts_undefined`)) || [];
            if (userID && carts.length > 0) {
                mergeCartWhenLogin(userID);
            }
            carts = getCartItems(userID);
            let html = "";
            const cartItemsCount = carts.length;
            if (cartItemsCount > 0) {
                $("#numberCart").text(cartItemsCount).fadeIn(); // Hiển thị số lượng và fade in
            } else {
                $("#numberCart").fadeOut(); // Ẩn nếu giỏ hàng rỗng
                html += '<li class="list-group-item"><div class="text-center">Giỏ hàng trống</div></li>';
            }
            
            $.each(carts, function (index, cart) {
                console.log(getVehicleDetail(cart.vehicleDetailId));
                html += `<li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-start py-2 border-bottom position-relative gap-3">
                        <div class="form-check flex-shrink-0">
                            <input class="form-check-input js-checked" type="checkbox" value="" data-id="${cart.id}" id="selectCartItem-${cart.id}">
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-inline-block">
                                <strong>Xe ô tô 4 chỗ</strong><br>
                                <small class="text-muted">
                                    Màu: Đỏ • Số tự động • Xăng • 5 chỗ<br>
                                    Năm: 2021 • Biển số: 51A-123.45<br>
                                    Ngày nhận: ${cart.pickupDate}<br>
                                    Ngày trả: ${cart.returnDate}
                                </small>
                            </div>
                        </div>
                        <div class="text-end flex-shrink-0 ms-3" style="min-width: 90px;">
                            <span class="badge bg-primary rounded-pill mb-1">${cart.quantity}x</span><br>
                            <small class="text-muted">Giá: ${cart.price}$/${cart.rentalOption}</small>
                        </div>
                        <button type="button" class="ms-2 btn btn-sm btn-light">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </li>`;
            });

            $("#cart-item").html(html);
            event.stopPropagation();
            $miniCart.css("transform", "translateX(0)");
        });

        const closeMiniCart = function () {
            $miniCart.css("transform", "translateX(100%)");
        };

        $closeCart.on("click", closeMiniCart);
        $closeCartBottom.on("click", closeMiniCart);

        // Đóng khi click bên ngoài cart
        $(document).on("click", function (event) {
            if (!$miniCart.is(event.target) && $miniCart.has(event.target).length === 0 && !$cartButton.is(event.target) && $cartButton.has(event.target).length === 0) {
                closeMiniCart();
            }
        });

    } else {
        console.error("Không tìm thấy nút 'cartButton'!");
    }

    // Lấy thông tin giỏ hàng từ localStorage
    function getCartItems(id) {
        const cartKey = `carts_${id}`;
        return JSON.parse(localStorage.getItem(cartKey)) || [];
    }

    async function getDetailVehicleById(id) {
        try {
            const response = await fetch(`/vehicle/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id })
            });
            if (!response.ok) {
                throw new Error(`Error: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error("Error fetching vehicle details:", error);
        }
    }

    // Checkbox trong cart
    $("#cart-item").on("click", ".js-checked", function () {
        const id = $(this).data("id");
        const isChecked = $(this).is(":checked");
        console.log(`Checkbox với ID ${id} đang ${isChecked ? "được chọn" : "bỏ chọn"}`);
    });

    $("#checkoutBtn").on("click", async function () {
        const selectedItems = $("#cart-item .js-checked:checked").map(function () {
            return $(this).data("id");
        }).get();
        if (selectedItems.length > 0) {
            const userID = $('#UserID').val();
            const carts = JSON.parse(localStorage.getItem(`carts_${userID}`)) || [];
            const selectedCartItems = carts.filter(item => selectedItems.includes(item.id));
            await saveToSession(selectedCartItems);
            window.location.href = BaseUrl + "checkout";
        } else {
            Swal.fire({
                title: "Chưa chọn xe",
                text: "Vui lòng chọn ít nhất một xe để thanh toán.",
                icon: "warning",
                confirmButtonText: "OK"
            });
        }
    });
});
async function getVehicleDetail($id) {
    try {
        const response = await fetch(`${BaseUrl}vehicles/getVehicleDetail`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: $id })
        });
        if (!response.ok) {
            throw new Error(`Error: ${response.status}`);
        }
        return await response.json();
    } catch (error) {
        console.error("Error fetching vehicle details:", error);
    }
}
async function saveToSession($data) {
    sessionStorage.setItem('checkoutCart', JSON.stringify($data));
} 
function checkout(selectedItems) {
    let html = ``;
    selectedItems.forEach(cart => {
        html += `<tr>
                    <td class="ps-0">
                      <a class="fw-semibold" href="javascript:void(0)">Vehicle id ${cart.vehicleDetailId}</a>
                      <div class="fs-sm text-muted">Bluetooth headset</div>
                    </td>
                    <td class="pe-0 fw-medium text-end">$129</td>
                  </tr>`;
    });
    $("#carts").html(html);
}

function mergeCartWhenLogin(userID) {
    const undefinedCart = JSON.parse(localStorage.getItem('carts_undefined')) || [];
    const userCart = JSON.parse(localStorage.getItem(`carts_${userID}`)) || [];

    // Merge hai giỏ
    const mergedCart = [...userCart, ...undefinedCart];

    // Lưu vào carts_userID
    localStorage.setItem(`carts_${userID}`, JSON.stringify(mergedCart));

    // Xóa carts_undefined sau khi merge
    localStorage.removeItem('carts_undefined');
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
      return true;
    }
  }