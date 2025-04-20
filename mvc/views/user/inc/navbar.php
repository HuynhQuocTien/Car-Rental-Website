<?php
// Lấy đường dẫn hiện tại
$currentUrl = $_SERVER['REQUEST_URI'];
// Hàm kiểm tra active
function getActiveNav($url, $pattern) {
    return strpos($url, $pattern) !== false ? 'active' : '';
}
?>
<!-- Top Navigation -->

<div class="bg-body-extra-light">
    <div class="content py-3">
        <ul class="nav nav-pills justify-content-center justify-content-md-start">
            <li class="nav-item me-1">
                <a class="nav-link <?php echo getActiveNav($currentUrl, '/user/home') || $currentUrl == '/' ? 'active' : ''; ?>"
                    href="/user/home">
                    <i class="fa fa-building fa-fw"></i> <span class="d-none d-md-inline ms-1">Home</span>
                </a>
            </li>
            <li class="nav-item me-1">
                <a class="nav-link <?php echo getActiveNav($currentUrl, '/user/vehicles') ? 'active' : ''; ?>"
                    href="/user/vehicles">
                    <i class="fa fa-car fa-fw"></i> <span class="d-none d-md-inline ms-1">Vehicles</span>
                </a>
            </li>
            <li class="nav-item me-1">
                <a class="nav-link <?php echo getActiveNav($currentUrl, '/user/blog') ? 'active' : ''; ?>"
                    href="/user/blog">
                    <i class="fa-solid fa-blog"></i><span class="d-none d-md-inline ms-1">Blog</span>
                </a>
            </li>
            <li class="nav-item me-1">
                <a class="nav-link <?php echo getActiveNav($currentUrl, '/user/about') ? 'active' : ''; ?>"
                    href="/user/about">
                    <i class="fa fa-question-circle"></i><span class="d-none d-md-inline ms-1">About</span>
                </a>
            </li>
            <!-- <li class="nav-item ms-md-auto">
                <a class="nav-link" href="db_booking.html">
                    <i class="fa fa-star text-warning fa-fw"></i> <span class="d-none d-md-inline ms-1">Special
                        Offers</span>
                </a>
            </li> -->
        </ul>
    </div>
</div>
<!-- END Top Navigation -->