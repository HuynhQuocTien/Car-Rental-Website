<!-- Hero -->
<div class="bg-body-light ">
    <div class="content content-full py-2">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Vehicles</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Management</li>
                    <li class="breadcrumb-item active" aria-current="page">Vehicle</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
<!-- Add Vehicle Modal -->
<div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVehicleModalLabel">Add Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addVehicleForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="makeID" class="form-label">Make</label>
                            <select class="form-select" id="makeID" name="makeID" required style="width: 100%;">
                                <option value="">Select Make</option>
                                <?php foreach ($data['Makes'] as $c) {
                                    echo '<option value="' . htmlspecialchars($c['MakeID']) . '">' . htmlspecialchars($c['MakeName']) . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-md-6">

                            <label for="vehicleTypeID" class="form-label">Vehicle Type</label>
                            <select class="form-select" id="vehicleTypeID" name="vehicleTypeID" required
                                style="width: 100%;">
                                <option value="">Select Vehicle Type</option>
                                <?php foreach ($data['VehicleTypes'] as $c) {
                                    echo '<option value="' . htmlspecialchars($c['VehicleTypesID']) . '">' . htmlspecialchars($c['NameType']) . '</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="modelID" class="form-label">Model</label>
                        <select class="form-select" id="modelID" name="modelID" required style="width: 100%;">
                            <option value="">Select Model</option>
                            <?php foreach ($data['Models'] as $c) {
                                echo '<option value="' . htmlspecialchars($c['ModelID']) . '">' . htmlspecialchars($c['ModelName']) . '</option>';
                            } ?>
                        </select>

                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="hourlyPrice" class="form-label">Hourly Price</label>
                            <input type="number" step="0.01" class="form-control" id="hourlyPrice" name="hourlyPrice"
                                min="0">
                        </div>
                        <div class="col-md-6">
                            <label for="dailyPrice" class="form-label">Daily Price</label>
                            <input type="number" step="0.01" class="form-control" id="dailyPrice" name="dailyPrice"
                                min="0" oninput="calculateDiscountedPrices()">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="weeklyPrice" class="form-label">Weekly Price</label>
                            <input type="text" class="form-control" id="weeklyPrice" name="weeklyPrice" style="cursor: not-allowed;
    background-color: #f8f9fa;" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="weeklyDiscount" class="form-label">Weekly Discount (%)</label>
                            <input type="number" step="0.01" class="form-control" id="weeklyDiscount"
                                name="weeklyDiscount" min="0" oninput="calculateDiscountedPrices()">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="monthlyPrice" class="form-label">Monthly Price</label>
                            <input type="text" class="form-control" id="monthlyPrice" name="monthlyPrice" style="cursor: not-allowed;
    background-color: #f8f9fa;" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="monthlyDiscount" class="form-label">Monthly Discount (%)</label>
                            <input type="number" step="0.01" class="form-control" id="monthlyDiscount"
                                name="monthlyDiscount" min="0" oninput="calculateDiscountedPrices()">
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-6">
                            <label for="seats" class="form-label">Seats</label>
                            <select class="form-select" id="seats" name="seats" required style="width: 100%;">
                                <option value="">Select Seats</option>
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
                        <div class="col-md-6">
                            <label for="promotionID" class="form-label">Promotion ID</label>
                            <select class="form-select" id="promotionID" name="promotionID" required
                                style="width: 100%;">
                                <option value="0" selected>0 - No Promotion </option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="d-flex align-items-center justify-content-sm-center gap-4 my-2">
                        <label for="active" class="form-label">Active</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="active" checked>
                            <label class="form-check-label" for="active"></label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-add-vehicle" id="saveVehicleBtn">Save</button>
                <button type="button" class="btn btn-primary" id="updateVehicleBtn" data-id="">Update</button>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">List <?php echo $data['Title'] ?></h3>
            <div class="block-options">
                <button class="btn btn-hero btn-primary btn-add" data-bs-toggle="modal" data-function="4" data-permission="1"
                    data-bs-target="#addVehicleModal">
                    <i class="fa-regular fa-plus"></i> Add
                </button>
            </div>
            <!-- <div class="block-options ">
                <button class="btn btn-hero btn-primary btn-import">
                    <i class="fa fa-download"></i> Import
                </button>
            </div>
            <div class="block-options ">
                <button class="btn btn-hero btn-primary btn-export">
                    <i class="fa fa-upload"></i> Export
                </button>
            </div> -->
        </div>
        <div class="block-content">
            <!-- <form action="" id="search-form">
                <div class="mb-1">
                    <input type="text" class="form-control form-control-alt" id="search-input" name="search-input"
                        placeholder="Search all vehicles..">
                </div>
            </form> -->

            <div class="row filters_listing_1">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" class="drop">Makes</a>
                        <div class="dropdown-menu">
                            <div class="filter_type">
                                <ul>
                                    <?php foreach ($data['Makes'] as $c) {
                                        echo '                                        
                                        <li>
                                            <label class="container_check">
                                                ' . $c['MakeName'] . '
                                                <input type="checkbox" name="makes" value="' . $c['MakeID'] . '">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>';
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /dropdown -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" class="drop">Models</a>
                        <div class="dropdown-menu">
                            <div class="filter_type">
                                <ul>
                                    <li>
                                        <label class="container_check">
                                            All Models
                                            <input type="checkbox" name="models" value="0">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <?php foreach ($data['Models'] as $c) {
                                        echo '                                        
                                        <li>
                                            <label class="container_check">
                                                ' . $c['ModelName'] . '
                                                <input type="checkbox" name="models" value="' . $c['ModelID'] . '">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>';
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /dropdown -->
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" class="drop">Seats</a>
                        <div class="dropdown-menu">
                            <div class="filter_type">
                                <ul>
                                    <li>
                                        <label class="container_check">
                                            All Seats
                                            <input type="checkbox" name="seats" value="0">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            2 Seats
                                            <input type="checkbox" name="seats" value="2">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            4 Seats
                                            <input type="checkbox" name="seats" value="4">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            7 Seats
                                            <input type="checkbox" name="seats" value="7">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            9 Seats
                                            <input type="checkbox" name="seats" value="9">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            16 Seats
                                            <input type="checkbox" name="seats" value="16">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            24 Seats
                                            <input type="checkbox" name="seats" value="24">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            32 Seats
                                            <input type="checkbox" name="seats" value="32">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            35 Seats
                                            <input type="checkbox" name="seats" value="35">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            40 Seats
                                            <input type="checkbox" name="seats" value="40">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            45 Seats
                                            <input type="checkbox" name="seats" value="45">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /dropdown -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <!-- /dropdown -->
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" class="drop">Type</a>
                        <div class="dropdown-menu">
                            <div class="filter_type">
                                <ul>
                                    <li>
                                        <label class="container_check">
                                            All Vehicle Types
                                            <input type="checkbox" name="vehicle_types" value="0">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <?php foreach ($data['VehicleTypes'] as $c) {
                                        echo '                                        
                                        <li>
                                            <label class="container_check">
                                                ' . $c['NameType'] . '
                                                <input type="checkbox" name="vehicle_types" value="' . $c['VehicleTypesID'] . '">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>';
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="block-content pb-3 pt-0">
            <table class="table align-middle" id="vehicle-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>
                            <div class="fw-semibold">Make</div>
                            <div class="text-muted small">Model</div>
                        </th>
                        <th>
                            <div class="fw-semibold">VehicleType</div>
                            <div class="text-muted small">Seats</div>
                        </th>
                        <th>
                            <div class="fw-semibold">Hourly Price Default</div>
                            <div class="text-muted small">Daily Price Default</div>
                        </th>
                        <th>
                            <div class="fw-semibold">Monthly Price Default</div>
                            <div class="text-muted small">Weekly Price Default</div>
                        </th>
                        <th>Quantity (Total)</th>
                        <th>Active</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="list-vehicle">

                </tbody>
            </table>
        </div>
        <div class="block block-rounded pb-2 bg-body-light">
            <div class="block-content bg-body-light">
                <?php require "./mvc/views/admin/inc/pagination.php" ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterGroups = ['makes', 'models', 'seats', 'vehicle_types'];

        filterGroups.forEach(groupName => {
            const checkboxes = document.querySelectorAll(`input[type="checkbox"][name="${groupName}"]`);

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    if (this.checked) {
                        checkboxes.forEach(cb => {
                            if (cb !== this) cb.checked = false;
                        });
                    }
                });
            });
        });
    });
</script>