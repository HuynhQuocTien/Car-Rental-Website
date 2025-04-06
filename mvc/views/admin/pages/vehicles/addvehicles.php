<?php
echo $_SESSION['add_vehicle_id'];
?>

<!-- Page Content -->
<div class="content">
    <!-- Vehicle Details List -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Vehicle Details List</h3>
        </div>

        <div class="block-content">
            <div class="mb-1">
                <input type="text" class="form-control form-control-alt" id="vehicle-query" name="vehicle-query"
                    placeholder="Search all vehicles..">
            </div>
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>License Plate</th>
                        <th>Color</th>
                        <th>Mileage (km)</th>
                        <th>Year</th>
                        <th>Transmission</th>
                        <th>Fuel Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="vehicle-details-list">
                    <!-- Dữ liệu sẽ được load bằng JavaScript -->
                    <tr>
                        <td colspan="9" class="text-center">No vehicle details found</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="block-content bg-body-light">
            <?php require "./mvc/views/admin/inc/pagination.php" ?>
        </div>
    </div>

    <!-- Add Vehicle Detail Form -->
    <form id="vehicle-form" method="POST" onsubmit="return false;">
        <div class="row">
            <div class="col-8">
                <!-- Basic Info -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Add Vehicle Detail</h3>
                    </div>
                    <div class="block-content">
                        <div class="mb-4">
                            <label class="form-label" for="vehicle-name">Vehicle Name</label>
                            <input type="text" class="form-control" id="vehicle-name" name="vehicle-name"
                                value="<?= $data['Vehicle']['MakeName'] . "- " . $data['Vehicle']['ModelName'] . " ( " . $data['Vehicle']['NameType'] . ")" ?>"
                                disabled>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label" for="license-plate">License Plate Number</label>
                                <input type="text" class="form-control" id="license-plate" name="license-plate">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="color-id">Color</label>
                                <select class="form-select" id="color-id" name="color-id">
                                    <option value="">Select color</option>
                                    <?php foreach ($data['Colors'] as $color): ?>
                                        <option value="<?= $color['ColorID'] ?>"><?= $color['ColorName'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label" for="mileage">Mileage (km)</label>
                                <input type="number" class="form-control" id="mileage" name="mileage" step="0.1">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="year">Year</label>
                                <input type="number" class="form-control" id="year" name="year" min="1900"
                                    max="<?= date('Y') + 1 ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="1">Available</option>
                                    <option value="0">Rented</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label" for="transmission">Transmission</label>
                                <select class="form-select" id="transmission" name="transmission">
                                    <option value="">Select transmission</option>
                                    <option value="Automatic">Automatic</option>
                                    <option value="Manual">Manual</option>
                                    <option value="Semi-Automatic">Semi-Automatic</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fuel-type">Fuel Type</label>
                                <select class="form-select" id="fuel-type" name="fuel-type">
                                    <option value="">Select fuel type</option>
                                    <option value="Gasoline">Gasoline</option>
                                    <option value="Diesel">Diesel</option>
                                    <option value="Electric">Electric</option>
                                    <option value="Hybrid">Hybrid</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="fuel-consumption">Fuel Consumption (L/100km)</label>
                            <input type="text" class="form-control" id="fuel-consumption" name="fuel-consumption">
                        </div>

                        <div class="mb-4">
                            <label for="vehicle-description" class="form-label">Description</label>
                            <textarea id="js-ckeditor" name="vehicle-description" class="form-control" rows="5"
                                placeholder="Enter description..."></textarea>
                        </div>
                    </div>
                </div>
                <!-- END Basic Info -->

                <!-- Images Section -->
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Images</h3>
                        <div class="block-options">
                            <button type="button" class="btn btn-alt-primary btn-sm btn-hero" data-bs-toggle="modal"
                                data-bs-target="#modal-image"><i class="fa-regular fa-plus"></i> Add</button>
                        </div>
                    </div>
                    <div class="block-content block-content-full images-container" style="display: none">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Size</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="image-color">

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Image-->
                <!-- Image -->
                <div class="block block-rounded table-image-container" style="display: none">
                    <div class="block-content block-content-full">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Images</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody id="table-image">
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Image-->
            </div>

            <div class="col-4">
                <!-- Pricing & Meta Data -->
                <div class="block block-rounded">
                    <div class="block-content">
                        <div class="mb-4">
                            <label class="form-label" for="vehicle-price">Price ($)</label>
                            <input type="number" class="form-control" id="vehicle-price" name="vehicle-price">
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="vehicle-price-sale">Sale Price ($)</label>
                            <input type="number" class="form-control" id="vehicle-price-sale" name="vehicle-price-sale">
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <label class="form-label">Is featured?</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is-featured" name="is-featured">
                                <label class="form-check-label" for="is-featured"></label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="vehicle-slug">Slug</label>
                            <input type="text" class="form-control" id="vehicle-slug" name="vehicle-slug">
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="vehicle-label">Label</label>
                            <select class="form-select" id="vehicle-label" name="vehicle-label">
                                <option value="0">No label</option>
                                <option value="1">New</option>
                                <option value="2">Hot</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="brand-id">Brand</label>
                            <select class="form-select" id="brand-id" name="brand-id">
                                <option value="">Select brand</option>
                                @foreach (var brand in ViewBag.Brands)
                                {
                                <option value="@brand.Id">@brand.Name</option>
                                }
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="category-id">Category</label>
                            <select class="form-select" id="category-id" name="category-id">
                                <option value="">Select category</option>
                                @foreach (var category in ViewBag.Categories)
                                {
                                <option value="@category.Id">@category.Name</option>
                                }
                            </select>
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary btn-hero" id="btn-save-vehicle">Save Vehicle
                                Detail</button>
                        </div>
                    </div>
                </div>
                <!-- END Pricing & Meta Data -->
            </div>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal" id="modal-image" tabindex="-1" role="dialog" aria-labelledby="modal-image" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header block-header block-header-default">
                <h3 class="block-title">Image</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body block block-rounded block-transparent mb-0">
                <div class="block-content">
                    <form id="form-image" onsubmit="return false;">
                        <div class="mb-4">
                            <label class="form-label" for="color-id">Color</label>
                            <select class="js-select2 form-select" id="color-id" name="color-id" style="width: 100%;"
                                data-container="#modal-image" data-placeholder="Choose one..">
                                <option></option>
                                @foreach (var color in ViewBag.Colors)
                                {
                                <option value="@color.Id">@color.Name</option>
                                }
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="size-id">Size</label>
                            <select class="js-select2 form-select" id="size-id" name="size-id" style="width: 100%;"
                                data-placeholder="Choose many.." data-container="#modal-image" multiple>
                                <option></option>
                                @foreach (var size in ViewBag.Sizes)
                                {
                                <option value="@size.Id">@size.Name</option>
                                }
                            </select>
                        </div>
                        <!-- <div class="mb-4">
                            <label class="form-label" for="upload-image">Images</label>
                            <div class="upload-image-container">
                                <input type="file" id="upload-image" name="upload-image" class="upload-image-input" hidden multiple />
                                <div class="no-image">
                                    <p>Select files to upload</p>
                                </div>
                                <div class="has-image">
                                </div>
                            </div>
                        </div> -->
                        <div class="mb-4">
                            <label class="form-label">Images</label>
                            <div class="upload-image-container">
                                <input type="file" id="upload-image" name="upload-image[]" class="upload-image-input"
                                    hidden accept="image/*" multiple />
                                <div id="image-preview-container">
                                    <!-- Initial upload box -->
                                    <div class="upload-box" id="initial-upload">
                                        <label for="upload-image" class="upload-label">
                                            <i class="fas fa-plus"></i>
                                            <span>Add first image</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer block-content block-content-full text-end bg-body">
                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn-add-image" class="btn btn-sm btn-primary">Save</button>
                <button type="button" id="btn-update-image" class="btn btn-sm btn-primary" data-bs-dismiss="modal"
                    data-index="0" style="display: none">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
<style>
   .upload-image-container {
        border: 2px dashed #ddd;
        border-radius: 8px;
        padding: 15px;
        background: #f9f9f9;
    }
    
    .preview-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .upload-box, .preview-item {
        width: 100%;
        min-height: 60px;
        border-radius: 8px;
        position: relative;
    }
    
    .upload-box {
        border: 2px dashed #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        padding: 15px;
    }
    
    .upload-box:hover {
        border-color: #999;
        background: #f0f0f0;
    }
    
    .upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #666;
        cursor: pointer;
        text-align: center;
    }
    
    .upload-label i {
        font-size: 24px;
        margin-bottom: 8px;
    }
    
    .preview-item {
        border: 1px solid #eee;
        background: #fff;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .image-info {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-grow: 1;
    }
    
    .image-preview {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
    }
    
    .image-name {
        font-size: 14px;
        word-break: break-all;
    }
    
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    
    .add-btn, .delete-btn {
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .add-btn {
        background: #4CAF50;
        color: white;
        border: none;
    }
    
    .delete-btn {
        background: #f44336;
        color: white;
        border: none;
    }
</style>