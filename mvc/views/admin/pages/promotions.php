<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full py-2">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"><?php echo $data['Title'] ?></h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Management</li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $data['Title'] ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="modal fade" id="addPromotionModal" tabindex="-1" aria-labelledby="addPromotionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPromotionModalLabel">Add New Promotion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPromationForm" class="js-validation-add" onsubmit="return false;">
                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label" for="val-name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-name" name="name"
                        placeholder="Enter name promotion..">
                    </div>
                    <!-- Code -->
                        <div class="mb-3" id="codeDiv">
                            <label class="form-label" for="code">Code<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="code" name="code" disabled
                            placeholder="Enter code..">
                        </div>    
                    <!-- Discount Type -->
                    <div class="mb-3">
                        <label for="discountType" class="form-label">Discount Type <span
                                class="text-danger">*</span></label>
                        <select class="form-select" id="discountType" name="discountType" required>
                            <option value="NULL">Select Discount Type</option>
                            <option value="0">Percentage (%)</option>
                            <option value="1">Cash ($)</option>
                        </select>
                    </div>
                    <!-- Discount Value -->
                    <div class="mb-3">
                        <label for="discountValue" class="form-label">Discount Value<span
                                class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control" id="discountValue" name="discountValue"
                            required placeholder="e.g. 10 or 10000">
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="applyToSpecificVehicle"
                                name="applyToSpecificVehicle">
                            <label class="form-check-label" for="applyToSpecificVehicle">
                                Apply to Specific Vehicle
                            </label>
                        </div>
                    </div>
                    <!-- Vehicle Dropdown -->
                    <div class="mb-3 d-none" id="vehicleDropdownContainer">
                        <label for="vehicleId" class="form-label">Vehicle <span class="text-danger">*</span></label>
                        <select class="form-select" id="vehicleId" name="vehicleId">
                            <option value="">Select Vehicle</option>
                            <?php foreach ($data['Vehicles'] as $vehicle): ?>
                                <option value="<?php echo $vehicle['VehicleID'] ?>">
                                    <?php echo "( " .$vehicle['VehicleID']. " ) ". $vehicle['MakeName'] ." " .$vehicle['ModelName']  ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Start Date -->
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                    </div>
                    <!-- End Date -->
                    <div class="mb-3">
                        <label for="endDate" class="form-label">End Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="endDate" name="endDate" required>
                    </div>
                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                            placeholder="Enter promotion details"></textarea>
                    </div>
                    <!-- Status -->
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <label for="status" class="form-check-label">Status</label>
                            <input class="form-check-input" type="checkbox" id="status" name="status" checked>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="addPromotionBtn">Save</button>
                <button type="button" class="btn btn-primary" id="updatePromotionBtn" data-id="">Update</button>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">List Models</h3>
            <div class="block-options">
                <button class="btn btn-hero btn-primary btn-add" data-bs-toggle="modal"
                    data-bs-target="#addPromotionModal">
                    <i class="fa-regular fa-plus"></i> Add
                </button>
            </div>
        </div>
        <!-- <div class="block block-rounded pb-2">
            <div class="block-content bg-body-light">
            <form action="#" id="search-form" onsubmit="return false;">
                <div class="row mb-4">
                    <div class="input-group justify-content-center">
                        <div class="col-md-6 d-flex gap-3">
                            <input type="text" class="form-control form-control-alt" id="search-input"
                                name="search-input" placeholder="Tìm kiếm...">
                        </div>
                    </div>
                </div>
            </form>
        </div> -->
        <div class="block-content pb-4">
            <table class="table table-bordered table-striped table-vcenter" id="model-table">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Vehicle</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Value</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Date Start</th>
                        <th class="text-center">Date End</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="list-promotions">
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