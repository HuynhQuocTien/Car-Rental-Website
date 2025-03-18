<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('../public/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Choose Your Car</h1>
          </div>
        </div>
      </div>
    </section>
		

		<section class="ftco-section bg-light">
    	<div class="container">
			<!-- Search bar -->
			<div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <input type="text" class="form-control" placeholder="Search for cars...">
            </div>
        </div>
    		<div class="row">
				 <!-- Sidebar for filtering -->
				 <div class="col-md-3">
                <div class="sidebar p-3 bg-white rounded" style="height: 100%;">
                    <h5 class="mb-3">Filter by</h5>
                    
                    <!-- Price filter -->
                    <div class="mb-3">
                        <h6>Price</h6>
                        <div class="d-flex justify-content-between">
                            <span id="price-min">$0</span>
                            <span id="price-max">$1000</span>
                        </div>
                        <input type="range" class="form-control-range" min="0" max="1000" step="10" id="price-range" oninput="updatePrice()">
                        <div class="mt-2">
                            <input type="radio" name="priceType" value="day" checked> Per Day
                            <input type="radio" name="priceType" value="month" class="ml-2"> Per Month
                        </div>
                    </div>

                    <!-- Car Brand filter -->
                    <div class="mb-3">
                        <h6>Car Brand</h6>
                        <select class="form-control">
                            <option value="">All Brands</option>
                            <option value="toyota">Toyota</option>
                            <option value="honda">Honda</option>
                            <option value="bmw">BMW</option>
                            <option value="mercedes">Mercedes</option>
                        </select>
                    </div>

                    <!-- Car Type filter -->
                    <div class="mb-3">
                        <h6>Car Type</h6>
                        <select class="form-control">
                            <option value="">All Types</option>
                            <option value="sedan">Sedan</option>
                            <option value="suv">SUV</option>
                            <option value="truck">Truck</option>
                        </select>
                    </div>

                    <!-- Seats filter -->
                    <div class="mb-3">
                        <h6>Seats</h6>
                        <select class="form-control">
                            <option value="">Any</option>
                            <option value="2">2 Seats</option>
                            <option value="4">4 Seats</option>
                            <option value="7">7 Seats</option>
                        </select>
                    </div>

                    <!-- Rental Conditions filter -->
                    <div class="mb-3">
                        <h6>Rental Conditions</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="deposit" id="condition-deposit">
                            <label class="form-check-label" for="condition-deposit">Requires Deposit</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="18plus" id="condition-18plus">
                            <label class="form-check-label" for="condition-18plus">18+ Age Required</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="b2" id="condition-b2">
                            <label class="form-check-label" for="condition-b2">Requires B2 License</label>
                        </div>
                    </div>

                    <!-- Car Condition filter -->
                    <div class="mb-3">
                        <h6>Car Condition</h6>
                        <select class="form-control">
                            <option value="">All Conditions</option>
                            <option value="new">New</option>
                            <option value="used">Used</option>
                            <option value="good">Good Condition</option>
                        </select>
                    </div>
                </div>
            </div>

<!-- Car listings -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <div class="car-wrap rounded ftco-animate" style="transform: scale(0.9);">
                            <div class="img rounded d-flex align-items-end" style="background-image: url(../public/images/car-1.jpg); height: 180px;"></div>
                            <div class="text">
                                <h2 class="mb-0" style="font-size: 1rem;"><a href="car-single.html">Mercedes Grand Sedan</a></h2>
                                <div class="d-flex mb-2">
                                    <span class="cat" style="font-size: 0.8rem;">Cheverolet</span>
                                    <p class="price ml-auto" style="font-size: 0.8rem;">$500 <span>/day</span></p>
                                </div>
                                <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-1 mr-1" style="font-size: 0.8rem;">Book now</a> <a href="./detailcar" class="btn btn-secondary py-1 ml-1" style="font-size: 0.8rem;">Details</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="row mt-5">
                    <div class="col text-center">
                        <div class="block-27">
                            <ul>
                                <li><a href="#">&lt;</a></li>
                                <li class="active"><span>1</span></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">&gt;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
   			</div>
    		</div>
    	</div>
    </section>

	<script>
function updatePrice() {
    const priceRange = document.getElementById('price-range');
    const minPrice = document.getElementById('price-min');
    const maxPrice = document.getElementById('price-max');
    minPrice.textContent = `$0`;
    maxPrice.textContent = `$${priceRange.value}`;
}
</script>