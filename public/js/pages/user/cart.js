$(document).ready(function () {
    const $cartButtons = $(".cartButton");
    const $miniCart = $("#miniCart");
    const $closeCart = $("#closeCart");
    const $closeCartBottom = $("#closeCartBottom");

    if ($cartButtons.length > 0) {
        const $cartButton = $cartButtons.eq(0);

        $cartButton.on("click", function (event) {
            console.log(getCartItems());
            const userID = $('#UserID').val()
            console.log("user Id : " + userID);

            const carts = getCartItems();
            console.log(carts);
            let html = "";
            $.each(carts, function (index, cart) {
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
                        <button type="button" class="ml btn btn-sm btn-light">
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
    function getCartItems() {
        const cartKey = `carts`;
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
});
