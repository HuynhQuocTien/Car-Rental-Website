            <!-- Search -->
            <!-- <div class="content">
                <div class="text-center py-3">
                    <h1 class="h3 fw-bold mb-2">Where are you going next?</h1>
                    <h2 class="h5 fw-normal text-muted">Explore over 168 destinations with the best deals online!</h2>
                </div>
                <form action="db_booking.html" method="POST" onsubmit="return false;">
                    <div class="mb-4">
                        <input type="text" class="form-control form-control-lg py-3 text-center"
                            id="dm-booking-destination" name="dm-booking-destination"
                            placeholder="Where do you want to go?">
                    </div>
                    <div class="row items-push">
                        <div class="col-md-6">
                            <div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1"
                                data-autoclose="true" data-today-highlight="true">
                                <input type="text" class="form-control" id="dm-booking-checkin"
                                    name="dm-booking-checkin" placeholder="Check in" data-week-start="1"
                                    data-autoclose="true" data-today-highlight="true">
                                <span class="input-group-text fw-semibold">
                                    <i class="fa fa-fw fa-arrow-right"></i>
                                </span>
                                <input type="text" class="form-control" id="dm-booking-checkout"
                                    name="dm-booking-checkout" placeholder="Check out" data-week-start="1"
                                    data-autoclose="true" data-today-highlight="true">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" id="example-hosting-vps" name="example-hosting-vps">
                                <option value="0">People..</option>
                                <option value="1">On my own</option>
                                <option value="2">2 People</option>
                                <option value="3">3 People</option>
                                <option value="4">4 People</option>
                                <option value="5">5 People</option>
                                <option value="6">6 People</option>
                                <option value="7">7 People</option>
                                <option value="8">8 People</option>
                                <option value="9">9 People</option>
                                <option value="10">10+ People</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary w-100">Search</button>
                        </div>
                    </div>
                </form>
            </div> -->
            <!-- END Search -->
            <!-- Page Content -->
            <div class="row g-0 flex-md-grow-1">
                <div class="col-lg-5 col-xl-3">
                    <div class="content">
                        <!-- Search Travel -->
                        <form class="push" method="POST" onsubmit="return false;">
                            <div class="mb-4">
                                <div class="input-daterange input-group input-group-lg" data-date-format="mm/dd/yyyy"
                                    data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                    <input type="text" class="form-control border-end-0 py-3 fs-base"
                                        id="db-travel-from" name="db-travel-from" placeholder="Arriving.."
                                        data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                    <span
                                        class="input-group-text bg-body-extra-light border-start-0 border-end-0 fw-semibold">
                                        <i class="fa fa-fw fa-angle-double-right fs-base text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 py-3 fs-base"
                                        id="db-travel-to" name="db-travel-to" placeholder="Leaving.."
                                        data-week-start="1" data-autoclose="true" data-today-highlight="true">
                                </div>
                            </div>
                        </form>
                        <!-- END Search Travel -->

                        <!-- Side Content -->
                        <div id="side-content" class="d-none d-lg-block push">
                            <!-- Vehicle Type -->
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">
                                        <i class="fa fa-fw fa-car opacity-25 me-1"></i> Vehicle Type
                                    </h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                            data-action="content_toggle"></button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="row g-sm items-push mb-4">
                                        <div class="col-12">
                                            <div class="form-check form-block">
                                                <input type="radio" class="form-check-input" id="vehicle-type-sedan"
                                                    name="vehicle-type">
                                                <label class="form-check-label" for="vehicle-type-sedan">
                                                    <span class="d-block text-center">
                                                        <span class="d-block">
                                                            Sedan
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check form-block">
                                                <input type="radio" class="form-check-input" id="vehicle-type-suv"
                                                    name="vehicle-type">
                                                <label class="form-check-label" for="vehicle-type-suv">
                                                    <span class="d-block text-center">
                                                        SUV
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check form-block">
                                                <input type="radio" class="form-check-input" id="vehicle-type-truck"
                                                    name="vehicle-type">
                                                <label class="form-check-label" for="vehicle-type-truck">
                                                    <span class="d-block text-center">
                                                        Truck
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Vehicle Type -->

                            <!-- Price Range -->
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">
                                        <i class="fa fa-fw fa-dollar-sign opacity-25 me-1"></i> Price Range
                                    </h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                            data-action="content_toggle"></button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="mb-4">
                                        <input type="text" class="js-rangeslider" id="db-travel-price"
                                            name="db-travel-price" data-type="double" data-min="0" data-max="1000"
                                            data-from="0" data-to="1000" data-prefix="$">
                                    </div>
                                </div>
                            </div>
                            <!-- END Price Range -->

                            <!-- Vehicle Make -->
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">
                                        <i class="fa fa-fw fa-industry opacity-25 me-1"></i> Vehicle Make
                                    </h3>
                                </div>
                                <div class="block-content pb-3">
                                    <select class="form-control" id="vehicle-make" name="vehicle-make">
                                        <option value="" selected disabled>Select a make</option>
                                        <option value="Toyota">Toyota</option>
                                        <option value="Ford">Ford</option>
                                        <option value="Honda">Honda</option>
                                        <option value="Chevrolet">Chevrolet</option>
                                        <option value="Nissan">Nissan</option>
                                        <option value="BMW">BMW</option>
                                        <option value="Mercedes">Mercedes</option>
                                    </select>
                                </div>
                            </div>
                            <!-- END Vehicle Make -->

                            <!-- Vehicle Model -->
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">
                                        <i class="fa fa-fw fa-car-side opacity-25 me-1"></i> Vehicle Model
                                    </h3>
                                </div>
                                <div class="block-content pb-3">
                                    <select class="form-control" id="vehicle-model" name="vehicle-model">
                                        <option value="" selected disabled>Select a model</option>
                                        <option value="Camry">Camry</option>
                                        <option value="Corolla">Corolla</option>
                                        <option value="Civic">Civic</option>
                                        <option value="Accord">Accord</option>
                                        <option value="F-150">F-150</option>
                                        <option value="Silverado">Silverado</option>
                                        <option value="X5">X5</option>
                                        <option value="C-Class">C-Class</option>
                                    </select>
                                </div>
                            </div>
                            <!-- END Vehicle Model -->
                            <!-- Seat Selection -->
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">
                                        <i class="fa fa-fw fa-chair opacity-25 me-1"></i> Seats
                                    </h3>
                                </div>
                                <div class="block-content">
                                    <select class="form-control" id="vehicle-seats" name="vehicle-seats">
                                        <option value="" selected disabled>Select number of seats</option>
                                        <option value="2">2 Seats</option>
                                        <option value="4">4 Seats</option>
                                        <option value="5">5 Seats</option>
                                        <option value="7">7 Seats</option>
                                        <option value="9+">9+ Seats</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Fuel Type -->
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">
                                        <i class="fa fa-fw fa-gas-pump opacity-25 me-1"></i> Fuel Type
                                    </h3>
                                </div>
                                <div class="block-content">
                                    <select class="form-control" id="vehicle-fuel" name="vehicle-fuel">
                                        <option value="" selected disabled>Select fuel type</option>
                                        <option value="Gasoline">Gasoline</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Electric">Electric</option>
                                        <option value="Hybrid">Hybrid</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Transmission -->
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">
                                        <i class="fa fa-fw fa-cogs opacity-25 me-1"></i> Transmission
                                    </h3>
                                </div>
                                <div class="block-content">
                                    <select class="form-control" id="vehicle-transmission" name="vehicle-transmission">
                                        <option value="" selected disabled>Select transmission</option>
                                        <option value="Manual">Manual</option>
                                        <option value="Automatic">Automatic</option>
                                        <option value="CVT">CVT (Continuously Variable)</option>
                                        <option value="Dual-clutch">Dual-clutch</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- END Side Content -->
                    </div>
                </div>
                <div class="col-lg-7 col-xl-9 bg-body-dark">
                    <!-- Main Content -->
                    <div class="content">
                        <div class="row">
                            <?php 
                        for($i=0;$i<6;$i++){
                            echo '                            <div class="col-md-6 col-xl-4">
                                <!-- Vehicle -->
                                <div class="block block-rounded">
                                    <div class="block-content p-0 overflow-hidden">
                                        <a class="img-link img-fluid-100" data-toggle="layout"
                                            data-action="side_overlay_open" href="javascript:void(0)">
                                            <img class="img-fluid rounded-top" src="../public/media/vehicles/car-1.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="block-content">
                                        <h4 class="h6 mb-2">C 200 Avantgarde Plus</h4>
                                        <h5 class="h2 fw-light push">
                                            $380 <span class="fs-3 text-muted">per day</span>
                                        </h5>
                                    </div>
                                    <div class="block-content p-0">
                                        <div class="row text-center m-0 border-top border-bottom bg-body-light">
                                            <div class="col-6 border-end">
                                                <p class="py-3 mb-0">
                                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.914 23.3289C10.9148 23.3284 10.9156 23.3279 10.9163 23.3274C10.9155 23.3279 10.9148 23.3284 10.914 23.3289ZM10.914 23.3289C10.914 23.3289 10.914 23.3289 10.914 23.3289L11.3128 23.9114M10.914 23.3289L11.3128 23.9114M11.3128 23.9114L10.9807 23.2882L20.6697 23.9458C20.6682 23.9484 20.6656 23.9496 20.6631 23.9479C20.655 23.9424 20.6343 23.9284 20.6014 23.9074C20.6014 23.9073 20.6014 23.9073 20.6013 23.9073C20.5141 23.8516 20.3413 23.7468 20.0921 23.6208C20.0919 23.6207 20.0918 23.6206 20.0917 23.6206C19.3397 23.2404 17.8926 22.6674 16.0003 22.6674C14.1715 22.6674 12.7584 23.2026 11.9869 23.5817L11.9929 23.5929M11.3128 23.9114L11.331 23.9456C11.3324 23.9483 11.3352 23.9495 11.3377 23.9478C11.3444 23.9432 11.3592 23.9332 11.3821 23.9184L11.9929 23.5929L11.9929 23.5929M11.9929 23.5929C11.9909 23.5892 11.9889 23.5855 11.9868 23.5818C11.6767 23.7342 11.4702 23.8614 11.3821 23.9184L11.9929 23.5929ZM10.6691 24.2983L10.6691 24.2983C10.7406 24.4324 10.8728 24.5792 11.0793 24.6538C11.3072 24.7361 11.5609 24.7039 11.7614 24.5667L11.7614 24.5667C11.7978 24.5418 13.4597 23.4174 16.0003 23.4174C18.5426 23.4174 20.205 24.5432 20.2393 24.5667L20.2393 24.5667C20.4389 24.7034 20.6938 24.7372 20.9245 24.6528C21.1293 24.5779 21.2557 24.4338 21.3233 24.3136L22.4886 22.2427L24.3242 23.0447L21.6934 28.584H9.99882L7.65051 23.0635L9.57427 22.2435L10.6691 24.2983ZM24.4348 22.8117L24.4345 22.8124L24.4348 22.8117Z" stroke="#a2a6a4" stroke-width="1.5"></path><path d="M12.75 4.66675C12.75 3.97639 13.3096 3.41675 14 3.41675H18C18.6904 3.41675 19.25 3.97639 19.25 4.66675V7.00008C19.25 7.13815 19.1381 7.25008 19 7.25008H13C12.8619 7.25008 12.75 7.13815 12.75 7.00008V4.66675Z" stroke="#a2a6a4" stroke-width="1.5"></path><path d="M9.33398 22.6668L9.90564 11.2336C9.95887 10.1692 10.8374 9.3335 11.9031 9.3335H20.0982C21.1639 9.3335 22.0424 10.1692 22.0957 11.2336L22.6673 22.6668" stroke="#a2a6a4" stroke-width="1.5"></path><path d="M14.667 7.35815V9.8901" stroke="#a2a6a4" stroke-width="1.5"></path><path d="M17.334 7.35815V9.8901" stroke="#a2a6a4" stroke-width="1.5"></path></svg> 
                                                    <strong>4</strong>
                                                    Seats
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="py-3 mb-0">
                                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M24.3337 27.2499H7.66699C7.52892 27.2499 7.41699 27.138 7.41699 26.9999V12.4599C7.41699 12.3869 7.44888 12.3175 7.5043 12.27L14.652 6.14344L14.1639 5.574L14.652 6.14344C14.6973 6.1046 14.755 6.08325 14.8147 6.08325H24.3337C24.4717 6.08325 24.5837 6.19518 24.5837 6.33325V26.9999C24.5837 27.138 24.4717 27.2499 24.3337 27.2499Z" stroke="#a2a6a4" stroke-width="1.5" stroke-linecap="round"></path><path d="M12.0001 5.33325L7.42285 9.46712" stroke="#a2a6a4" stroke-width="1.5" stroke-linecap="round"></path><path d="M17.888 19.5212L16.7708 15.93C16.5378 15.1812 15.4785 15.1798 15.2436 15.928L14.1172 19.5164C13.7178 20.7889 14.6682 22.0833 16.0019 22.0833C17.3335 22.0833 18.2836 20.7927 17.888 19.5212Z" stroke="#a2a6a4" stroke-width="1.5" stroke-linecap="round"></path><path d="M23.2503 3.66675V5.66675C23.2503 5.80482 23.1384 5.91675 23.0003 5.91675H14.667C14.5827 5.91675 14.5365 5.8916 14.5072 5.86702C14.4721 5.83755 14.44 5.78953 14.4245 5.72738C14.4089 5.66524 14.4147 5.60775 14.4318 5.56523C14.4461 5.52975 14.4749 5.48584 14.5493 5.44616L18.2993 3.44616C18.3356 3.42685 18.376 3.41675 18.417 3.41675H23.0003C23.1384 3.41675 23.2503 3.52868 23.2503 3.66675Z" stroke="#a2a6a4" stroke-width="1.5" stroke-linecap="round"></path></svg>    
                                                    <strong>RON 95</strong>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-content block-content-full">
                                        <div class="row">
                                            <div class="col-6">
                                                <a class="btn btn-sm btn-primary w-100" href="javascript:void(0)">
                                                    Rent
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a class="btn btn-sm btn-alt-primary w-100" data-toggle="layout" data-action="side_overlay_open" href="javascript:void(0)">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-12">
                                                <a class="btn btn-sm btn-outline-primary w-100" href="javascript:void(0)">
                                                    Add to Cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Vehicle -->
                            </div>';
                        }  
                        ?>
                        </div>
                    </div>
                    <!-- END Main Content -->
                    <div class="pagination">
                        <a href="#">&laquo;</a>
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#">&raquo;</a>
                    </div>
                </div>
            </div>
            <!-- END Page Content -->