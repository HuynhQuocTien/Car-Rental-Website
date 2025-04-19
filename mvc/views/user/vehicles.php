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
                        <input type="text" class="form-control border-end-0 py-3 fs-base" id="db-travel-from"
                            name="db-travel-from" placeholder="Arriving.." data-week-start="1" data-autoclose="true"
                            data-today-highlight="true">
                        <span class="input-group-text bg-body-extra-light border-start-0 border-end-0 fw-semibold">
                            <i class="fa fa-fw fa-angle-double-right fs-base text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 py-3 fs-base" id="db-travel-to"
                            name="db-travel-to" placeholder="Leaving.." data-week-start="1" data-autoclose="true"
                            data-today-highlight="true">
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
                            <div class="col-6">
                                <div class="form-check form-block">
                                    <input type="radio" class="form-check-input" id="vehicle-type-0" name="vehicle-type"
                                        value="0" checked>
                                    <label class="form-check-label" for="vehicle-type-0">
                                        <span class="d-block text-center">
                                            All
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <?php foreach ($data['VehicleTypes'] as $vehicleType): ?>
                                <div class="col-6">
                                    <div class="form-check form-block">
                                        <input type="radio" class="form-check-input"
                                            id="vehicle-type-<?= $vehicleType['VehicleTypesID'] ?>" name="vehicle-type"
                                            value="<?= $vehicleType['VehicleTypesID'] ?>">
                                        <label class="form-check-label"
                                            for="vehicle-type-<?= $vehicleType['VehicleTypesID'] ?>">
                                            <span class="d-block text-center">
                                                <?= $vehicleType['NameType'] ?>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- END Vehicle Type -->

                <!-- Price Range -->
                <div class="block block-rounded pb-3">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-dollar-sign opacity-25 me-1"></i> Price Range
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="content_toggle"></button>
                        </div>
                    </div>
                    <div class="block-content ">
                        <div class="mb-4">
                            <input type="text" class="js-rangeslider" id="db-travel-price" name="db-travel-price"
                                data-type="double" data-min="0" data-max="1000" data-from="0" data-to="1000"
                                data-prefix="$">
                        </div>
                    </div>
                </div>
                <!-- END Price Range -->
                <!-- Seat Selection -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-chair opacity-25 me-1"></i> Seats
                        </h3>
                    </div>
                    <div class="block-content pb-3">
                        <select class="form-control" id="vehicle-seats" name="vehicle-seats">
                            <option value="" selected>Select number of seats</option>
                            <option value="2">2</option>
                            <option value="4">4</option>
                            <option value="9">9</option>
                            <option value="16">16</option>
                            <option value="24">24</option>
                            <option value="32">32</option>
                            <option value="35">35</option>
                            <option value="40">40</option>
                            <option value="45">45</option>
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
                    <div class="block-content pb-3">
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
                    <div class="block-content pb-3">
                        <select class="form-control" id="vehicle-transmission" name="vehicle-transmission">
                            <option value="" selected>Select transmission</option>
                            <option value="Manual">Manual</option>
                            <option value="Automatic">Automatic</option>
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
            <div class="row" id="list-vehicles">

            </div>
        </div>
        <!-- END Main Content -->
        <div class="block-content bg-body-light">
            <?php require "./mvc/views/user/inc/pagination.php" ?>
        </div>
    </div>
</div>
<!-- END Page Content -->