<!-- Hero Section -->
<section class="hero bg-dark text-white py-5 position-relative d-flex align-items-center justify-content-center text-center" style="background: url('../public/media/photos/hero.png') no-repeat center center/cover; height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h1 class="display-4 mb-4">Thuê xe cao cấp, trải nghiệm đẳng cấp</h1>
                <p class="lead mb-4">Với đội ngũ chuyên nghiệp và dịch vụ hàng đầu, chúng tôi mang đến cho bạn trải nghiệm thuê xe tuyệt vời nhất.</p>
                <a href="#cta" class="btn btn-primary btn-lg">Trải nghiệm ngay</a>
            </div>
        </div>
    </div>
    <!-- Animated Background -->
    <div class="hero-animation"></div>
</section>


<!-- Features Section -->
<section class="features py-5">
    <div class="container">
        <h2 class="text-center mb-5">Tại sao chọn chúng tôi?</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="feature-icon mb-3">
                    <i class="fas fa-car fa-3x text-primary"></i>
                </div>
                <h4>Đa dạng loại xe</h4>
                <p>Chúng tôi cung cấp nhiều loại xe từ bình dân đến cao cấp, phù hợp với mọi nhu cầu.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="feature-icon mb-3">
                    <i class="fas fa-shield-alt fa-3x text-primary"></i>
                </div>
                <h4>An toàn tuyệt đối</h4>
                <p>Xe được kiểm tra kỹ lưỡng, đảm bảo an toàn cho mọi hành trình.</p>
            </div>
            <div class="col-md-4 text-center">
                <div class="feature-icon mb-3">
                    <i class="fas fa-headset fa-3x text-primary"></i>
                </div>
                <h4>Hỗ trợ 24/7</h4>
                <p>Đội ngũ hỗ trợ luôn sẵn sàng giúp đỡ bạn mọi lúc, mọi nơi.</p>
            </div>
        </div>
    </div>
</section>

<!-- Car Showcase Section -->
<section class="car-showcase bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Khám phá các dòng xe của chúng tôi</h2>
        <div class="row">
        <?php foreach($data['FeatureVehicles'] as $vehicle): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="https://res.cloudinary.com/dapudsvwl/image/upload/v1745000059/dvgjjnwwutuqdrqnpatz.jpg" class="card-img-top" alt="<?= $vehicle['MakeName']. ' ' .$vehicle['ModelName'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $vehicle['MakeName']. ' ' .$vehicle['ModelName'] . ' ' . $vehicle['Year'] ?></h5>
                        <p class="card-text">Price per day: <?= $vehicle['DailyPrice'] ?> $/Day</p>
                        <p class="card-text">Seat Number: <?= $vehicle['Seats'] ?></p>
                        <p class="card-text">Type: <?= $vehicle['NameType'] ?></p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-primary">View Detail</a>
                    </div>
                </div>    
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials py-5">
    <div class="container">
        <h2 class="text-center mb-5">Khách hàng nói gì về chúng tôi?</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <p class="card-text">"Dịch vụ tuyệt vời, xe đẹp và giá cả hợp lý. Tôi sẽ quay lại!"</p>
                        <p class="text-muted">- Nguyễn Văn A</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <p class="card-text">"Nhân viên rất thân thiện và chuyên nghiệp. Cảm ơn các bạn!"</p>
                        <p class="text-muted">- Trần Thị B</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <p class="card-text">"Xe mới, sạch sẽ và rất thoải mái. Tôi rất hài lòng!"</p>
                        <p class="text-muted">- Lê Văn C</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section id="cta" class="cta bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <h2 class="mb-4">Sẵn sàng để trải nghiệm?</h2>
                <p class="lead mb-4">Đặt xe ngay hôm nay để nhận ưu đãi đặc biệt!</p>
                <a href="#" class="btn btn-light btn-lg">Đặt xe ngay</a>
            </div>
        </div>
    </div>
</section>