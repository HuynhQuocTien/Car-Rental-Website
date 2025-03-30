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

<!-- Add Vehicle Type Modal -->
<div class="modal fade" id="addVehicleTypeModal" tabindex="-1" aria-labelledby="addVehicleTypeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVehicleTypeModalLabel">Add New Vehicle Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addVehicleTypeForm">
                    <div class="mb-3 d-none" id="vehicleTypeIdContainer">
                        <label for="vehicleTypeId" class="form-label">ID</label>
                        <input type="text" class="form-control" id="vehicleTypeId" style="cursor: not-allowed;
    background-color: #f8f9fa;" name="vehicleTypeId" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="vehicleTypeName" class="form-label">Type Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="vehicleTypeName" name="NameType" required
                            placeholder="e.g. Luxury, Mid-range, Economy">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveVehicleTypeBtn">Save</button>
                <button type="button" class="btn btn-primary" id="updateVehicleTypeBtn" data-id="">Update</button>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded pb-2 bg-body-dark">
        <div class="block-content bg-body-dark">
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
        </div>
    </div>
    <div class="block block-rounded pb-2">
        <div class="block-header block-header-default">
            <h3 class="block-title">List Vehicle Types</h3>
            <div class="block-options">
                <button class="btn btn-hero btn-primary btn-add" data-bs-toggle="modal"
                    data-bs-target="#addVehicleTypeModal">
                    <i class="fa-regular fa-plus"></i> Add
                </button>
            </div>
            <div class="block-options ">
                <button class="btn btn-hero btn-primary btn-import">
                <i class="fa fa-download"></i> Import
                </button>
            </div>
            <div class="block-options ">
                <button class="btn btn-hero btn-primary btn-export" >
                    <i class="fa fa-upload"></i> Export
                </button>
            </div>
        </div>
        <!-- <div class="block-content bg-body-light">
            <form action="#" id="search-form" onsubmit="return false;">
                <div class="row mb-4">
                    <div class="input-group justify-content-center">
                        <div class="col-md-6 d-flex gap-3">
                            <input type="text" class="form-control form-control-alt" id="search-input"
                                name="search-input" placeholder="Tìm kiếm người dùng...">
                        </div>
                    </div>
                </div>
            </form>
        </div> -->
        <div class="block-content pb-4">
            <table class="table table-bordered table-striped table-vcenter" id="vehicleType-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Type Name</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="list-types">

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