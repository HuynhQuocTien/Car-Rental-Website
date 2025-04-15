<!-- Page Content -->
<div class="content">
    <!-- Vehicle Details List -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h2 class="block-header"><?php echo $data['Vehicle']['MakeName'] . " - " . $data['Vehicle']['ModelName'] . " ( " . $data['Vehicle']['NameType'] . ")"?> </h2>
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
                        <th>
                            <div class="fw-semibold">Color</div>
                            <div class="text-muted small">Year</div>
                        </th>
                        <th>
                            <div class="fw-semibold">License Plate</div>
                            <div class="text-muted small">Mileage (km)</div>
                        </th>
                        <th>

                        </th>
                        <th>
                            <div class="fw-semibold">Hourly Price</div>
                            <div class="text-muted small">Daily Price</div>
                        </th>
                        <th>
                            <div class="fw-semibold">Monthly Price</div>
                            <div class="text-muted small">Weekly Price</div>
                        </th>
                        <th>
                            Status
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="vehicle-details-list">                
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
                        <h3 class="block-header">Add Vehicle Detail</h3>
                    </div>
                    <div class="block-content">
                        <div class="mb-4">
                            <label class="form-label" for="vehicle-name">Vehicle Name</label>
                            <input type="text" class="form-control" id="vehicle-name" name="vehicle-name"
                                value="<?= $data['Vehicle']['MakeName'] . "- " . $data['Vehicle']['ModelName'] . " ( " . $data['Vehicle']['NameType'] . ")" ?>"
                                disabled>
                        </div>
                        <!-- Hourly Price -->
                        <div class="mb-4">
                            <label class="form-label">Hourly Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="default-hourly-price"
                                    name="default-hourly-price" placeholder="Default" disabled value="<?= $data['Vehicle']['HourlyPrice'] ?>">
                                <span class="input-group-text">-</span>
                                <input type="number" class="form-control" id="discount-hourly" name="discount-hourly"
                                    placeholder="Discount (%)" min="0" max="100">
                                <span class="input-group-text">=</span>
                                <input type="number" class="form-control" id="final-hourly-price" name="hourly-price"
                                    placeholder="Final Price" readonly>
                            </div>
                        </div>

                        <!-- Lặp lại tương tự cho Daily, Weekly, Monthly -->
                        <div class="mb-4">
                            <label class="form-label">Daily Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="default-daily-price"
                                    name="default-daily-price" disabled value="<?= $data['Vehicle']['DailyPrice'] ?>">
                                <span class="input-group-text">-</span>
                                <input type="number" class="form-control" id="discount-daily" name="discount-daily"
                                    placeholder="Discount (%)" min="0" max="100">
                                <span class="input-group-text">=</span>
                                <input type="number" class="form-control" id="final-daily-price" name="daily-price"
                                    readonly>
                            </div>
                        </div>

                        <!-- Weekly -->
                        <div class="mb-4">
                            <label class="form-label">Weekly Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="default-weekly-price"
                                    name="default-weekly-price" disabled value="<?= $data['Vehicle']['WeeklyPrice'] ?>">
                                <span class="input-group-text">-</span>
                                <input type="number" class="form-control" id="discount-weekly" name="discount-weekly"
                                    placeholder="Discount (%)" min="0" max="100">
                                <span class="input-group-text">=</span>
                                <input type="number" class="form-control" id="final-weekly-price" name="weekly-price"
                                    readonly>
                            </div>
                        </div>

                        <!-- Monthly -->
                        <div class="mb-4">
                            <label class="form-label">Monthly Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="default-monthly-price" value="<?= $data['Vehicle']['MonthlyPrice'] ?>"
                                    name="default-monthly-price" disabled>
                                <span class="input-group-text">-</span>
                                <input type="number" class="form-control" id="discount-monthly" name="discount-monthly"
                                    placeholder="Discount (%)" min="0" max="100">
                                <span class="input-group-text">=</span>
                                <input type="number" class="form-control" id="final-monthly-price" name="monthly-price"
                                    readonly>
                            </div>
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
                            <label class="form-label" for="fuel-consumption">Fuel Consumption (L/100km)</label>
                            <input type="text" class="form-control" id="fuel-consumption" name="fuel-consumption">
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="transmission">Transmission</label>
                            <select class="form-select" id="transmission" name="transmission">
                                <option value="">Select transmission</option>
                                <option value="Automatic">Automatic</option>
                                <option value="Manual">Manual</option>
                                <option value="Semi-Automatic">Semi-Automatic</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="fuel-type">Fuel Type</label>
                            <select class="form-select" id="fuel-type" name="fuel-type">
                                <option value="">Select fuel type</option>
                                <option value="Gasoline">Gasoline</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Electric">Electric</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="year">Year</label>
                            <input type="number" class="form-control" id="year" name="year" min="1900"
                                max="<?= date('Y') + 1 ?>">
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <label class="form-label">Active?</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is-active" name="is-active" checked>
                                <label class="form-check-label" for="is-active"></label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <label class="form-label">Status?</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is-status" name="is-status" checked>
                                <label class="form-check-label" for="is-status"></label>
                            </div>
                        </div>


                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary btn-hero" id="btn-save-vehicle">Save
                                Vehicle
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
                            <label class="form-label" for="license-plate">License Plate Number</label>
                            <input type="text" class="form-control" id="license-plate" name="license-plate">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="color-id">Color</label>
                            <select class="js-select2 form-select" id="color-id" name="color-id" style="width: 100%;"
                                data-container="#modal-image" data-placeholder="Choose one..">
                                <option value="">Select color</option>
                                <?php foreach ($data['Colors'] as $color): ?>
                                    <option value="<?= $color['ColorID'] ?>"><?= $color['ColorName'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="mileage">Mileage (km)</label>
                            <input type="number" class="form-control" id="mileage" name="mileage" step="0.1">
                        </div>
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

    .upload-box,
    .preview-item {
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

    .add-btn,
    .delete-btn {
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
    .default-checkbox-container {
    display: flex;
    align-items: center;
    margin-left: 15px;
    position: relative;
}

.default-checkbox {
    width: 16px;
    height: 16px;
    cursor: pointer;
    margin-right: 8px;
}

.default-label {
    font-size: 13px;
    color: #555;
    cursor: pointer;
    user-select: none;
}

/* Style khi checkbox được chọn */
.preview-item.checked-as-default {
    border-color: #4CAF50;
    background-color: #f8fff8;
    box-shadow: 0 0 0 1px #4CAF50;
}

/* Hiệu ứng hover cho item */
.preview-item:hover {
    background-color: #f5f5f5;
}

/* Transition mượt mà */
.preview-item,
.upload-box,
.action-buttons button {
    transition: all 0.2s ease-in-out;
}

/* Style cho button khi hover */
.add-btn:hover {
    background: #3e8e41;
    transform: translateY(-1px);
}

.delete-btn:hover {
    background: #d32f2f;
    transform: translateY(-1px);
}

/* Responsive cho mobile */
@media (max-width: 576px) {
    .preview-item {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .image-info {
        width: 100%;
        margin-bottom: 10px;
    }
    
    .action-buttons {
        width: 100%;
        justify-content: flex-end;
    }
    
    .default-checkbox-container {
        margin-left: 0;
        margin-top: 10px;
    }
}

/* Animation khi thêm ảnh mới */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.preview-item {
    animation: fadeIn 0.3s ease-out;
}

/* Style cho placeholder khi không có ảnh */
.empty-placeholder {
    color: #888;
    font-size: 14px;
    text-align: center;
    padding: 20px;
}

/* Custom scrollbar cho container nếu cần */
.upload-image-container::-webkit-scrollbar {
    width: 8px;
}

.upload-image-container::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.upload-image-container::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

.upload-image-container::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
</style>