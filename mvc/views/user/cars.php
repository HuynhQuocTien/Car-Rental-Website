            <!-- Search -->
            <div class="content">
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
            </div>
            <!-- END Search -->
            <!-- Page Content -->
            <div class="row g-0 flex-md-grow-1">
                <div class="col-lg-5 col-xl-3">
                    <div class="content">
                        <!-- Logo -->
                        <div class="text-center d-lg-none push">
                            <a class="link-fx fs-lg text-dark fw-semibold" href="index.html">
                                <span class="text-muted">x</span>Travel
                            </a>
                        </div>
                        <!-- END Logo -->

                        <!-- Toggle Side Content -->
                        <div class="row g-sm d-lg-none push">
                            <div class="col-6">
                                <!-- Toggle Sidebar -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                                <button type="button" class="btn w-100 btn-primary" data-toggle="layout"
                                    data-action="sidebar_toggle">
                                    <i class="fa fa-bars opacity-50 me-1"></i> Menu
                                </button>
                            </div>
                            <div class="col-6">
                                <!-- Class Toggle, functionality initialized in Helpers.dmToggleClass() -->
                                <button type="button" class="btn w-100 btn-alt-primary" data-toggle="class-toggle"
                                    data-target="#side-content" data-class="d-none">
                                    <i class="fa fa-flask me-1"></i> Filters
                                </button>
                            </div>
                        </div>
                        <!-- END Toggle Side Content -->

                        <!-- Search Travel -->
                        <form class="push" action="db_travel.html" method="POST" onsubmit="return false;">
                            <div class="mb-2">
                                <input type="text" class="form-control form-control-lg py-3 fs-base text-center"
                                    id="db-travel-location" name="db-travel-location"
                                    placeholder="Where are you going?">
                            </div>
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
                            <!-- House Type -->
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">
                                        <i class="fa fa-fw fa-home opacity-25 me-1"></i> House Type
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
                                                <input type="radio" class="form-check-input"
                                                    id="db-travel-house-type-entire" name="db-travel-house-type">
                                                <label class="form-check-label" for="db-travel-house-type-entire">
                                                    <span class="d-block text-center">
                                                        <span class="d-block">
                                                            Entire Place
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check form-block">
                                                <input type="radio" class="form-check-input"
                                                    id="db-travel-house-type-private" name="db-travel-house-type">
                                                <label class="form-check-label" for="db-travel-house-type-private">
                                                    <span class="d-block text-center">
                                                        Private Room
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check form-block">
                                                <input type="radio" class="form-check-input"
                                                    id="db-travel-house-type-shared" name="db-travel-house-type">
                                                <label class="form-check-label" for="db-travel-house-type-shared">
                                                    <span class="d-block text-center">
                                                        Shared Room
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END House Type -->

                            <!-- Trip -->
                            <div class="block block-rounded block-mode-hidden">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">
                                        <i class="fa fa-fw fa-plane opacity-25 me-1"></i> Trip
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
                                                <input type="radio" class="form-check-input" id="db-travel-trip-work"
                                                    name="db-travel-trip">
                                                <label class="form-check-label" for="db-travel-trip-work">
                                                    <span class="d-block text-center">
                                                        Work
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check form-block">
                                                <input type="radio" class="form-check-input" id="db-travel-trip-leisure"
                                                    name="db-travel-trip">
                                                <label class="form-check-label" for="db-travel-trip-leisure">
                                                    <span class="d-block text-center">
                                                        Leisure
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Trip -->

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

                            <!-- Amenities -->
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">
                                        <i class="fa fa-fw fa-box-open opacity-25 me-1"></i> Amenities
                                    </h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                            data-action="content_toggle"></button>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="row g-sm items-push mb-4">
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="db-travel-amenities-kitchen" name="db-travel-amenities-kitchen">
                                                <label class="form-check-label"
                                                    for="db-travel-amenities-kitchen">Kitchen</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="db-travel-amenities-shampoo" name="db-travel-amenities-shampoo">
                                                <label class="form-check-label"
                                                    for="db-travel-amenities-shampoo">Shampoo</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="db-travel-amenities-heating" name="db-travel-amenities-heating">
                                                <label class="form-check-label"
                                                    for="db-travel-amenities-heating">Heating</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="db-travel-amenities-airconditioning"
                                                    name="db-travel-amenities-airconditioning">
                                                <label class="form-check-label"
                                                    for="db-travel-amenities-airconditioning">Air conditioning</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="db-travel-amenities-washer" name="db-travel-amenities-washer">
                                                <label class="form-check-label"
                                                    for="db-travel-amenities-washer">Washer</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="db-travel-amenities-dryer" name="db-travel-amenities-dryer">
                                                <label class="form-check-label"
                                                    for="db-travel-amenities-dryer">Dryer</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="db-travel-amenities-wifi" name="db-travel-amenities-wifi">
                                                <label class="form-check-label"
                                                    for="db-travel-amenities-wifi">Wifi</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="db-travel-amenities-breakfast"
                                                    name="db-travel-amenities-breakfast">
                                                <label class="form-check-label"
                                                    for="db-travel-amenities-breakfast">Breakfast</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Amenities -->
                        </div>
                        <!-- END Side Content -->
                    </div>
                </div>
                <div class="col-lg-7 col-xl-9 bg-body-dark">
                    <!-- Main Content -->
                    <div class="content">
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <!-- House -->
                                <div class="block block-rounded">
                                    <div class="block-content p-0 overflow-hidden">
                                        <a class="img-link img-fluid-100" data-toggle="layout"
                                            data-action="side_overlay_open" href="javascript:void(0)">
                                            <img class="img-fluid rounded-top" src="assets/media/photos/photo27.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="block-content">
                                        <h4 class="h6 mb-2">Luxury House</h4>
                                        <h5 class="h2 fw-light push">
                                            $380 <span class="fs-3 text-muted">per night</span>
                                        </h5>
                                    </div>
                                    <div class="block-content p-0">
                                        <div class="row text-center m-0 border-top border-bottom bg-body-light">
                                            <div class="col-6 border-end">
                                                <p class="py-3 mb-0">
                                                    <i class="fa fa-fw fa-bed text-muted me-1"></i> <strong>4</strong>
                                                    Bedrooms
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="py-3 mb-0">
                                                    <i class="fa fa-fw fa-bath text-muted me-1"></i> <strong>2</strong>
                                                    Bathrooms
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
                                                <a class="btn btn-sm btn-alt-primary w-100" data-toggle="layout"
                                                    data-action="side_overlay_open" href="javascript:void(0)">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END House -->
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <!-- House -->
                                <div class="block block-rounded">
                                    <div class="block-content p-0 overflow-hidden">
                                        <a class="img-link img-fluid-100" data-toggle="layout"
                                            data-action="side_overlay_open" href="javascript:void(0)">
                                            <img class="img-fluid rounded-top" src="assets/media/photos/photo28.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="block-content">
                                        <h4 class="h6 mb-2">Renovated Apartment</h4>
                                        <h5 class="h2 fw-light push">
                                            $75 <span class="fs-3 text-muted">per night</span>
                                        </h5>
                                    </div>
                                    <div class="block-content p-0">
                                        <div class="row text-center m-0 border-top border-bottom bg-body-light">
                                            <div class="col-6 border-end">
                                                <p class="py-3 mb-0">
                                                    <i class="fa fa-fw fa-bed text-muted me-1"></i> <strong>2</strong>
                                                    Bedrooms
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="py-3 mb-0">
                                                    <i class="fa fa-fw fa-bath text-muted me-1"></i> <strong>1</strong>
                                                    Bathroom
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
                                                <a class="btn btn-sm btn-alt-primary w-100" data-toggle="layout"
                                                    data-action="side_overlay_open" href="javascript:void(0)">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END House -->
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <!-- House -->
                                <div class="block block-rounded">
                                    <div class="block-content p-0 overflow-hidden">
                                        <a class="img-link img-fluid-100" data-toggle="layout"
                                            data-action="side_overlay_open" href="javascript:void(0)">
                                            <img class="img-fluid rounded-top" src="assets/media/photos/photo29.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="block-content">
                                        <h4 class="h6 mb-2">Best Tiny Apartment</h4>
                                        <h5 class="h2 fw-light push">
                                            $90 <span class="fs-3 text-muted">per night</span>
                                        </h5>
                                    </div>
                                    <div class="block-content p-0">
                                        <div class="row text-center m-0 border-top border-bottom bg-body-light">
                                            <div class="col-6 border-end">
                                                <p class="py-3 mb-0">
                                                    <i class="fa fa-fw fa-bed text-muted me-1"></i> <strong>1</strong>
                                                    Bedroom
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="py-3 mb-0">
                                                    <i class="fa fa-fw fa-bath text-muted me-1"></i> <strong>1</strong>
                                                    Bathroom
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
                                                <a class="btn btn-sm btn-alt-primary w-100" data-toggle="layout"
                                                    data-action="side_overlay_open" href="javascript:void(0)">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END House -->
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <!-- House -->
                                <div class="block block-rounded">
                                    <div class="block-content p-0 overflow-hidden">
                                        <a class="img-link img-fluid-100" data-toggle="layout"
                                            data-action="side_overlay_open" href="javascript:void(0)">
                                            <img class="img-fluid rounded-top" src="assets/media/photos/photo30.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="block-content">
                                        <h4 class="h6 mb-2">Cottage</h4>
                                        <h5 class="h2 fw-light push">
                                            $120 <span class="fs-3 text-muted">per night</span>
                                        </h5>
                                    </div>
                                    <div class="block-content p-0">
                                        <div class="row text-center m-0 border-top border-bottom bg-body-light">
                                            <div class="col-6 border-end">
                                                <p class="py-3 mb-0">
                                                    <i class="fa fa-fw fa-bed text-muted me-1"></i> <strong>5</strong>
                                                    Bedrooms
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="py-3 mb-0">
                                                    <i class="fa fa-fw fa-bath text-muted me-1"></i> <strong>3</strong>
                                                    Bathrooms
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
                                                <a class="btn btn-sm btn-alt-primary w-100" data-toggle="layout"
                                                    data-action="side_overlay_open" href="javascript:void(0)">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END House -->
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <!-- House -->
                                <div class="block block-rounded">
                                    <div class="block-content p-0 overflow-hidden">
                                        <a class="img-link img-fluid-100" data-toggle="layout"
                                            data-action="side_overlay_open" href="javascript:void(0)">
                                            <img class="img-fluid rounded-top" src="assets/media/photos/photo13.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="block-content">
                                        <h4 class="h6 mb-2">Downtown Apartment</h4>
                                        <h5 class="h2 fw-light push">
                                            $35 <span class="fs-3 text-muted">per night</span>
                                        </h5>
                                    </div>
                                    <div class="block-content p-0">
                                        <div class="row text-center m-0 border-top border-bottom bg-body-light">
                                            <div class="col-6 border-end">
                                                <p class="py-3 mb-0">
                                                    <i class="fa fa-fw fa-bed text-muted me-1"></i> <strong>2</strong>
                                                    Bedrooms
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="py-3 mb-0">
                                                    <i class="fa fa-fw fa-bath text-muted me-1"></i> <strong>1</strong>
                                                    Bathroom
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
                                                <a class="btn btn-sm btn-alt-primary w-100" data-toggle="layout"
                                                    data-action="side_overlay_open" href="javascript:void(0)">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END House -->
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <!-- House -->
                                <div class="block block-rounded">
                                    <div class="block-content p-0 overflow-hidden">
                                        <a class="img-link img-fluid-100" data-toggle="layout"
                                            data-action="side_overlay_open" href="javascript:void(0)">
                                            <img class="img-fluid rounded-top" src="assets/media/photos/photo26.jpg"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="block-content">
                                        <h4 class="h6 mb-2">Downtown Apartment</h4>
                                        <h5 class="h2 fw-light push">
                                            $150 <span class="fs-3 text-muted">per night</span>
                                        </h5>
                                    </div>
                                    <div class="block-content p-0">
                                        <div class="row text-center m-0 border-top border-bottom bg-body-light">
                                            <div class="col-6 border-end">
                                                <p class="py-3 mb-0">
                                                    <i class="fa fa-fw fa-bed text-muted me-1"></i> <strong>2</strong>
                                                    Bedrooms
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="py-3 mb-0">
                                                    <i class="fa fa-fw fa-bath text-muted me-1"></i> <strong>1</strong>
                                                    Bathroom
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
                                                <a class="btn btn-sm btn-alt-primary w-100" data-toggle="layout"
                                                    data-action="side_overlay_open" href="javascript:void(0)">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END House -->
                            </div>
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