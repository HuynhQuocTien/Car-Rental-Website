<link rel="stylesheet" href="../public/css/cart.css">
<?php
// Lấy đường dẫn hiện tại
$currentUrl = $_SERVER['REQUEST_URI'];
// Hàm kiểm tra active
function getActiveNav($url, $pattern) {
    return strpos($url, $pattern) !== false ? 'active' : '';
}
?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="./home">Car<span>Book</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item <?php echo getActiveNav($currentUrl, '/user/home') || $currentUrl == '/' ? 'active' : ''; ?>">
                    <a href="/user/home" class="nav-link">Home</a>
                </li>
                <li class="nav-item <?php echo getActiveNav($currentUrl, '/user/cars') ? 'active' : ''; ?>">
                    <a href="/user/cars" class="nav-link">Cars</a>
                </li>
                <li class="nav-item <?php echo getActiveNav($currentUrl, '/user/blog') ? 'active' : ''; ?>">
                    <a href="/user/blog" class="nav-link">Blog</a>
                </li>
                <li class="nav-item <?php echo getActiveNav($currentUrl, '/user/contact') ? 'active' : ''; ?>">
                    <a href="/user/contact" class="nav-link">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                
                <!-- Nút Love (giống giỏ hàng) -->
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" id="love-button">
                        <i class="fas fa-heart fa-xs"></i>
                        <span class="love-count">3</span>
                    </a>
                </li>
                
                <!-- Nút Giỏ hàng -->
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" id="cart-button">
                        <i class="fas fa-shopping-cart fa-xs"></i>
                        <span class="cart-count">2</span>
                    </a>
                </li>
                <li class="nav-item"><a href="/user/auth/signin" class="nav-link">Login</a></li>
            </ul>


        </div>
    </div>
	<script src="../public/js/cart.js" defer></script>
</nav>

<!-- Overlay -->
<div class="overlay" id="overlay"></div>

<!-- Mini Cart -->
 <?php include "./mvc/views/user/inc/mini-cart.php" ?>
 <!-- END nav -->