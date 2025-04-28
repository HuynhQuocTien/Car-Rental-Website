<!-- Mini Cart Sidebar -->
<div id="miniCart" class="position-fixed top-0 end-0 bg-white border-start shadow-lg d-flex flex-column p-4"
    style="z-index: 1050; width: 40%; height: 100vh; transform: translateX(100%); transition: transform 0.3s ease-in-out;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">🛒 Giỏ hàng</h5>
        <button class="btn btn-sm btn-light" id="closeCart">
            <i class="fa fa-times"></i>
        </button>
    </div>

    <ul id="cart-item" class="list-group flex-grow-1 overflow-auto">
        <!-- <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-start py-2 border-bottom position-relative gap-3">
                <div class="flex-grow-1">
                    <div class="d-inline-block">
                        <strong>Xe ô tô 4 chỗ</strong><br>
                        <small class="text-muted">
                            Màu: Đỏ • Số tự động • Xăng • 5 chỗ<br>
                            Năm: 2021 • Biển số: 51A-123.45
                        </small>
                    </div>
                </div>
                
                <div class="text-end flex-shrink-0 ms-3" style="min-width: 90px;">
                    <span class="badge bg-primary rounded-pill mb-1">2x</span><br>
                    <small class="text-muted">Giá: 800.000đ/ngày</small>
                </div>
                <button type="button" class="ml btn btn-sm btn-light">
                    <i class="fa fa-times"></i>
                </button>
                
            </div>
        </li> -->
    </ul>

    <div class="mt-4">
        <div class="mb-3 fs-5 text-end">
            <strong>Tổng: 1.000đ</strong>
        </div>
        <button class="btn btn-primary w-100 mb-2">Thanh toán</button>
        <button class="btn btn-outline-secondary w-100" id="closeCartBottom">Đóng</button>
    </div>
</div>
<!-- END Mini Cart Sidebar -->

<!-- END Mini Cart Sidebar -->
<!-- Script điều khiển -->