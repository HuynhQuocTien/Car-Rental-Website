<section class="hero-wrap hero-wrap-2" style="background: #f8f9fa;">
	<div class="container">
		<div class="row no-gutters slider-text align-items-end justify-content-start">
			<div class="col-md-9 pb-5">
				<h1 class="mb-3 bread"><?= $data['Vehicle']['MakeName'] ?> <?= $data['Vehicle']['ModelName'] ?></h1>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<!-- Main Image & Basic Info -->
			<div class="col-md-6">
				<div class="main-image mb-4"
					style="background-image: url(https://res.cloudinary.com/dapudsvwl/image/upload/v1745000059/dvgjjnwwutuqdrqnpatz.jpg); height: 400px; background-size: cover; background-position: center;">
				</div>

				<div class="specifications mb-5">
					<h4 class="mb-4">Thông số kỹ thuật</h4>
					<div class="row">
						<div class="col-6 mb-3">
							<div class="spec-item">
								<i class="flaticon-dashboard mr-2"></i>
								<span>Mileage: <strong><?= $data['Vehicle']['Mileage'] ?> km</strong></span>
							</div>
						</div>
						<div class="col-6 mb-3">
							<div class="spec-item">
								<i class="flaticon-pistons mr-2"></i>
								<span>Transmission: <strong><?= $data['Vehicle']['Transmission'] ?></strong></span>
							</div>
						</div>
						<div class="col-6 mb-3">
							<div class="spec-item">
								<i class="flaticon-car-seat mr-2"></i>
								<span>Seats: <strong><?= $data['Vehicle']['Seats'] ?></strong></span>
							</div>
						</div>
						<div class="col-6 mb-3">
							<div class="spec-item">
								<i class="flaticon-diesel mr-2"></i>
								<span>Fuel: <strong><?= $data['Vehicle']['FuelType'] ?></strong></span>
							</div>
						</div>
						<div class="col-6 mb-3">
							<div class="spec-item">
								<i class="flaticon-color-palette mr-2"></i>
								<span>Color: <strong><?= $data['Vehicle']['ColorName'] ?></strong></span>
							</div>
						</div>
						<div class="col-6 mb-3">
							<div class="spec-item">
								<i class="flaticon-car mr-2"></i>
								<span>Type: <strong><?= $data['Vehicle']['NameType'] ?></strong></span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Booking & Details -->
			<div class="col-md-6">
				<div class="product-detail pl-md-5">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<h2 class="mb-0"><?= $data['Vehicle']['Year'] ?> <?= $data['Vehicle']['MakeName'] ?>
							<?= $data['Vehicle']['ModelName'] ?>
						</h2>
						<span class="badge badge-success">Available</span>
					</div>

					<!-- Phần hiển thị giá chính -->
					<div class="price-section mb-4">
						<h3 class="price">$<span id="main-price"><?= $data['Vehicle']['DailyPrice'] ?></span> <small
								id="price-unit">/day</small></h3>
					</div>

					<!-- Size/Options Selection -->
					<div class="size-selection mb-4">
						<h5>Rental Options</h5>
						<div class="btn-group btn-group-toggle" data-toggle="buttons">
							<label class="btn btn-outline-primary ">
							<input type="radio" name="options" id="hourly" value="hour"> Hourly
							</label>
							<label class="btn btn-outline-primary active">
								<input type="radio" name="options" id="daily" checked value="day"> Daily
							</label>
							<label class="btn btn-outline-primary">
								<input type="radio" name="options" id="weekly" value="week"> Weekly
							</label>
							<label class="btn btn-outline-primary">
								<input type="radio" name="options" id="monthly" value="month"> Monthly
							</label>
						</div>
					</div>

					<!-- Booking Form -->
					<div class="booking-form mb-5">
						<form id="booking-form">
							<input type="text" id="id-save" hidden value="<?= $data['id'] ?>">
							<input type="text" id="hourly-price" hidden value="<?= $data['Vehicle']['HourlyPrice'] ?>">
							<input type="text" id="daily-price" hidden value="<?= $data['Vehicle']['DailyPrice'] ?>">
							<input type="text" id="weekly-price" hidden value="<?= $data['Vehicle']['WeeklyPrice'] ?>">
							<input type="text" id="monthly-price" hidden value="<?= $data['Vehicle']['MonthlyPrice'] ?>">
							<div class="form-group mb-3">
								<label for="rental-quantity">How many <span id="duration-label">days</span>?</label>
								<input type="number" id="rental-quantity" class="form-control" min="1" value="1"
									required>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Pickup Date</label>
										<input type="date" class="form-control" id="pickup-date" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Return Date</label>
										<input type="date" class="form-control" id="return-date" readonly>
									</div>
								</div>
							</div>

							<!-- Nút kiểm tra -->
							<div class="form-group m-2">
								<button type="button" id="check-availability" class="btn btn-info btn-block py-3">Check
									Availability</button>
							</div>

							<!-- Nút ẩn/hiện khi có xe -->
							<div class="form-group available-actions d-none m-2">
								<button type="submit" class="btn btn-primary btn-block py-3">Book Now</button>
								<button type="button" class="btn btn-outline-secondary btn-block py-3">Add to
									Cart</button>
							</div>



							<!-- Thông báo -->
							<div class="form-group">
								<small id="availability-message" class="text-danger"></small>
							</div>
						</form>
					</div>


					<!-- Product Code & Description -->
					<div class="product-meta mb-4">
						<p><strong>Mã số:</strong> <?= $data['Vehicle']['VehicleDetailID'] ?></p>
						<p><strong>License Plate:</strong> <?= $data['Vehicle']['LicensePlateNumber'] ?></p>
					</div>

					<!-- Features -->
					<div class="features mb-5">
						<h5>Ưu điểm nổi bật</h5>
						<ul class="feature-list">
							<li><i class="ion-ios-checkmark-circle mr-2"></i> Comfortable seating for
								<?= $data['Vehicle']['Seats'] ?> adults
							</li>
							<li><i class="ion-ios-checkmark-circle mr-2"></i> Smooth
								<?= $data['Vehicle']['Transmission'] ?> transmission
							</li>
							<li><i class="ion-ios-checkmark-circle mr-2"></i> Fuel efficient:
								<?= $data['Vehicle']['FuelConsumption'] ?> L/100km
							</li>
							<li><i class="ion-ios-checkmark-circle mr-2"></i> Modern safety features</li>
							<li><i class="ion-ios-checkmark-circle mr-2"></i> Spacious trunk for luggage</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- Rental Pricing Table Section -->
			<div class="rental-pricing mt-5">
				<h4 class="mb-4">BẢNG GIÁ THUÊ XE</h4>

				<div class="table-responsive">
					<table class="table table-bordered text-center">
						<thead class="thead-light">
							<tr>
								<th>LOẠI THUÊ</th>
								<th>GIÁ</th>
								<th>KHU VỰC ÁP DỤNG</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><strong>Theo giờ</strong></td>
								<td>$<?= $data['Vehicle']['HourlyPrice'] ?>/giờ</td>
								<td>Nội thành</td>
							</tr>
							<tr>
								<td><strong>Theo ngày</strong></td>
								<td>$<?= $data['Vehicle']['DailyPrice'] ?>/ngày</td>
								<td>Nội thành quốc</td>
							</tr>
							<tr>
								<td><strong>Theo tuần</strong></td>
								<td>$<?= $data['Vehicle']['WeeklyPrice'] ?>/tuần</td>
								<td>Toàn quốc</td>
							</tr>
							<tr>
								<td><strong>Theo tháng</strong></td>
								<td>$<?= $data['Vehicle']['MonthlyPrice'] ?>/tháng</td>
								<td>Toàn quốc</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="notes mt-3">
					<p><small><i class="fas fa-info-circle mr-2"></i> <strong>Lưu ý:</strong> Giá trên chưa bao gồm VAT.
							Phí vượt km: $0.5/km sau 100km/ngày.</small></p>
				</div>
			</div>
		</div>

		<!-- Product Description -->
		<div class="row mt-5">
			<div class="col-md-12">
				<div class="product-description">
					<h4 class="mb-4">Mô tả chi tiết</h4>
					<p><?= $data['Vehicle']['Description'] ? nl2br(htmlspecialchars($data['Vehicle']['Description'])) : 'Không có description' ?>
					</p>

					<div class="row mt-4">
						<div class="col-md-6">
							<h5>Technical Details</h5>
							<ul>
								<li>Make: <?= $data['Vehicle']['MakeName'] ?></li>
								<li>Model: <?= $data['Vehicle']['ModelName'] ?></li>
								<li>Year: <?= $data['Vehicle']['Year'] ?></li>
								<li>Vehicle Type: <?= $data['Vehicle']['NameType'] ?></li>
							</ul>
						</div>
						<div class="col-md-6">
							<h5>Performance</h5>
							<ul>
								<li>Transmission: <?= $data['Vehicle']['Transmission'] ?></li>
								<li>Fuel Type: <?= $data['Vehicle']['FuelType'] ?></li>
								<li>Fuel Consumption: <?= $data['Vehicle']['FuelConsumption'] ?> L/100km</li>
								<li>Mileage: <?= $data['Vehicle']['Mileage'] ?> km</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

		</div>

		<!-- Image Gallery -->
		<div class="row mt-5">
			<div class="col-md-12">
				<h4 class="mb-4">Hình ảnh</h4>
				<div class="row">
					<?php foreach ($data['VehicleImages'] as $image): ?>
						<div class="col-md-3 mb-4">
							<div class="gallery-item"
								style="background-image: url(https://res.cloudinary.com/dapudsvwl/image/upload/v1745000059/dvgjjnwwutuqdrqnpatz.jpg); height: 200px; background-size: cover; background-position: center;">
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

	</div>
</section>

<style>
	.hero-wrap {
		padding: 3em 0;
		background: #f8f9fa !important;
	}

	.product-detail {
		background: white;
		padding: 2em;
		border-radius: 8px;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
	}

	.price-section .price {
		font-size: 2rem;
		color: #007bff;
		font-weight: bold;
	}

	.spec-item {
		display: flex;
		align-items: center;
		padding: 0.5em;
		border-radius: 4px;
		background: #f8f9fa;
	}

	.feature-list {
		list-style: none;
		padding-left: 0;
	}

	.feature-list li {
		padding: 0.5em 0;
	}

	.gallery-item {
		border-radius: 8px;
		overflow: hidden;
		transition: transform 0.3s;
	}

	.gallery-item:hover {
		transform: scale(1.03);
	}

	.btn-group-toggle .btn {
		border-radius: 4px !important;
		margin-right: 5px;
		margin-bottom: 5px;
	}
</style>