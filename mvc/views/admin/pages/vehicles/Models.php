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
<div class="modal fade" id="addModelModal" tabindex="-1" aria-labelledby="addModelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModelModalLabel">Add New Model</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addModelForm">
                    <!-- Hidden ID for editing mode -->
                    <div class="mb-3 d-none" id="modelIdContainer">
                        <label for="modelId" class="form-label">ID</label>
                        <input type="text" class="form-control" id="modelId" name="modelId" readonly
                            style="cursor: not-allowed; background-color: #f8f9fa;">
                    </div>
                    <!-- Model Name -->
                    <div class="mb-3">
                        <label for="modelName" class="form-label">Model Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="modelName" name="modelName" required
                            placeholder="e.g. Camry, Civic, Fortuner">
                    </div>
                    <!-- Make Selection -->
                    <div class="mb-3">
                        <label for="makeId" class="form-label">Make <span class="text-danger">*</span></label>
                        <select class="form-select" id="makeId" name="makeId" required>
                            <option value="">Select Make</option>
                            <?php foreach ($data['Makes'] as $make) : ?>
                                <option value="<?php echo $make['MakeID'] ?>"><?php echo $make['MakeName'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Vehicle Type -->
                    <div class="mb-3">
                        <label for="vehicleType" class="form-label">Vehicle Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="vehicleType" name="vehicleType">
                            <option value="">Select Type</option>
                            <?php foreach ($data['VehicleTypes'] as $type) : ?>
                                <option value="<?php echo $type['VehicleTypesID'] ?>"><?php echo $type['NameType'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveModelBtn">Save</button>
                <button type="button" class="btn btn-primary" id="updateModelBtn" data-id="">Update</button>
            </div>
        </div>
    </div>
</div>


<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">List Models</h3>
            <div class="block-options">
                <button class="btn btn-hero btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addModelModal" data-function="8" data-permission="1">
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
                        <th style="width: 5%;">ID</th>
                        <th style="width: 30%;">Name</th>
                        <th style="width: 25%;">Make</th>
                        <th style="width: 20%;">Vehicle Type</th>
                        <th class="text-center col-header-action" style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody id="list-model">
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
