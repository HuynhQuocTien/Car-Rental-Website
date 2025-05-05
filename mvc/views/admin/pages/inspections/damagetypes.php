<!-- Hero -->
<div class="bg-body-light ">
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

<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">List <?php echo $data['Title'] ?></h3>
            <div class="block-options">
                <button type="button" class="btn btn-hero btn-primary me-2 btn-add" data-bs-toggle="modal"
                    data-bs-target="#addModelForm">
                    Add
                </button>
            </div>
        </div>
        <div class="block-content pb-4">
            <table class="table table-bordered table-striped table-vcenter" id="damage-types-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Damage Name</th>
                        <th>Fine Amount</th>
                        <th>Vehicle Type</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="list-damageTypes">
                    <!-- Data will be populated here -->
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

<!-- Modal Add/Edit/View Damage Type -->
<div class="modal fade" id="addModelForm" tabindex="-1" role="dialog" aria-labelledby="addModelForm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header block-header block-header-default">
                <h3 class="block-title title-add">Add Damage Type</h3>
                <h3 class="block-title title-update">Update Damage Type</h3>
                <h3 class="block-title title-view">View Damage Type</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content" style="max-height: 650px; overflow-y: auto">
                <form novalidate="novalidate" onsubmit="return false;" class="js-validation" id="damageTypeForm">
                    <input type="hidden" id="DamageTypeID" name="DamageTypeID">
                    <div class="mb-4">
                        <div class="mb-3">
                            <label class="form-label" for="DamageName">Damage Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="DamageName" name="DamageName"
                                placeholder="Enter damage name..">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="FineAmount">Fine Amount <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" class="form-control" id="FineAmount" name="FineAmount"
                                    placeholder="Enter fine amount..">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="VehicleTypeID">Vehicle Type <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" id="VehicleTypeID" name="VehicleTypeID" required>
                                <option value="">Select Vehicle Type</option>
                                <?php foreach ($data["VehicleTypes"] as $item): ?>
                                    <option value="<?= $item["VehicleTypesID"] ?>">
                                        <?= $item["NameType"] ?> (ID: <?= $item["VehicleTypesID"] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer block-content block-content-full text-end bg-body">
                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-sm btn-primary" id="saveBtn">
                    Save
                </button>
                <button type="button" class="btn btn-sm btn-primary" id="updateBtn">
                    Update
                </button>
            </div>
        </div>
    </div>
</div>