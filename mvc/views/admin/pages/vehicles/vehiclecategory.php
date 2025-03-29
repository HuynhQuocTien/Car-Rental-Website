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

<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">List Vehicle Types</h3>
            <div class="block-options">
                <button class="btn btn-hero btn-primary" data-bs-toggle="modal" data-bs-target="#addVehicleTypeModal">
                    <i class="fa-regular fa-plus"></i> Add
                </button>
            </div>
        </div>
        <div class="block-content pb-4">
            <table class="table table-bordered table-striped table-vcenter" id="vehicleType-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Type Name</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['VehicleTypes'] as $type): ?>
                    <tr>
                        <td><?php echo $type['VehicleTypesID']; ?></td>
                        <td><?php echo $type['NameType']; ?></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-alt-secondary js-edit" 
                                        data-id="<?php echo $type['VehicleTypesID']; ?>"
                                        data-name="<?php echo $type['NameType']; ?>"
                                        title="Edit">
                                    <i class="fa fa-pencil-alt"></i>
                                </button>
                                <button class="btn btn-sm btn-alt-secondary js-delete" 
                                        data-id="<?php echo $type['VehicleTypesID']; ?>"
                                        title="Delete">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Vehicle Type Modal -->
<div class="modal fade" id="addVehicleTypeModal" tabindex="-1" aria-labelledby="addVehicleTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVehicleTypeModalLabel">Add New Vehicle Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addVehicleTypeForm">
                    <div class="mb-3">
                        <label for="vehicleTypeName" class="form-label">Type Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="vehicleTypeName" name="NameType" required 
                               placeholder="e.g. Luxury, Mid-range, Economy">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveVehicleTypeBtn">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Vehicle Type Modal -->
<div class="modal fade" id="editVehicleTypeModal" tabindex="-1" aria-labelledby="editVehicleTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVehicleTypeModalLabel">Edit Vehicle Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editVehicleTypeForm">
                    <input type="hidden" id="editVehicleTypeId" name="VehicleTypesID">
                    <div class="mb-3">
                        <label for="editVehicleTypeName" class="form-label">Type Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="editVehicleTypeName" name="NameType" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="updateVehicleTypeBtn">Update</button>
            </div>
        </div>
    </div>
</div>