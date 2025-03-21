<!-- Mini Cart Sidebar -->
<div id="miniCart" class="position-fixed top-0 end-0 h-100 bg-light shadow-lg p-3" style="z-index: 9999; width: 300px; transform: translateX(100%); transition: transform 0.4s ease;">
    <h5 class="mb-4">🛒 Giỏ hàng của bạn</h5>
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Sản phẩm 1
            <span class="badge bg-primary rounded-pill">1x</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Sản phẩm 2
            <span class="badge bg-primary rounded-pill">1x</span>
        </li>
    </ul>
    <div class="mt-3">
        <strong>Tổng cộng: 500.000đ</strong>
    </div>
    <button class="btn btn-primary w-100 mt-3">Thanh toán</button>
    <button class="btn btn-outline-danger w-100 mt-2" id="closeCart">Đóng</button>
</div>
<!-- END Mini Cart Sidebar -->
   <!-- Script điều khiển -->
<script>
    // const cartButton = document.getElementById("cartButton");
    // const miniCart = document.getElementById("miniCart");
    // const closeCart = document.getElementById("closeCart");

    // cartButton.addEventListener("click", () => {
    //     miniCart.style.transform = "translateX(0)";
    // });

    // closeCart.addEventListener("click", () => {
    //     miniCart.style.transform = "translateX(100%)";
    // });

    // // Đóng khi click ngoài cart
    // document.addEventListener("click", (event) => {
    //     if (!miniCart.contains(event.target) && event.target !== cartButton) {
    //         miniCart.style.transform = "translateX(100%)";
    //     }
    // });
    const cartButtons = document.getElementsByClassName("cartButton");
const miniCart = document.getElementById("miniCart");
const closeCart = document.getElementById("closeCart");

// Kiểm tra xem nút có tồn tại không
if (cartButtons.length > 0) {
    const cartButton = cartButtons[0]; // Lấy nút đầu tiên

    // Sự kiện mở giỏ hàng, chấp nhận cả nút và icon bên trong
    cartButton.addEventListener("click", (event) => {
        event.stopPropagation(); // Ngăn chặn nổi bọt sự kiện
        miniCart.style.transform = "translateX(0)";
    });

    closeCart.addEventListener("click", () => {
        miniCart.style.transform = "translateX(100%)";
    });

    // Đóng giỏ hàng khi click ngoài khu vực giỏ
    document.addEventListener("click", (event) => {
        if (!miniCart.contains(event.target) && !cartButton.contains(event.target)) {
            miniCart.style.transform = "translateX(100%)";
        }
    });
} else {
    console.error("Không tìm thấy nút 'cartButton' nào!");
};

</script>