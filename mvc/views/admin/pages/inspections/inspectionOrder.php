<!-- Page Content -->
<div class="content">
    <!-- Vehicle Details List -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h2 class="block-header">
              Inspect Order (ID: <?php echo $data["OrderID"]?>)
            </h2>
        </div>
        <div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Filter Vehicles</h3>
    </div>
    <div class="block-content">
        <form id="filter-form" action="your_server_endpoint_here" method="GET">
            <div class="row g-3">
                
                <!-- Color -->
                <div class="col-md-6 col-lg-3">
                    <label for="color" class="form-label">Color</label>
                    <select class="form-select" id="color" name="filter[color]">
                        <option value="">All</option>
                        <?php foreach ($data['Colors'] as $color): ?>
                            <option value="<?= $color['ColorID'] ?>"><?= $color['ColorName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Vehicle Type -->
                <div class="col-md-6 col-lg-3">
                    <label for="vehicleType" class="form-label">Vehicle Type</label>
                    <select class="form-select" id="vehicleType" name="filter[vehicleType]">
                        <option value="">All</option>
                        <?php foreach ($data['VehicleTypes'] as $item): ?>
                            <option value="<?= $item['VehicleTypesID'] ?>"><?= $item['NameType'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Make -->
                <div class="col-md-6 col-lg-3">
                    <label for="make" class="form-label">Make</label>
                    <select class="form-select" id="make" name="filter[make]">
                        <option value="">All</option>
                        <?php foreach ($data['Makes'] as $item): ?>
                            <option value="<?= $item['MakeID'] ?>"><?= $item['MakeName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Model -->
                <div class="col-md-6 col-lg-3">
                    <label for="model" class="form-label">Model</label>
                    <select class="form-select" id="model" name="filter[model]">
                        <option value="">All</option>
                        <?php foreach ($data['Models'] as $item): ?>
                            <option value="<?= $item['ModelID'] ?>"><?= $item['ModelName'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

             

                <!-- OrderDetailID
                ColorName
                NameType
                MakeName
                ModelName
                Status -->
                <!-- Sorting Options -->
                <div class="col-md-6 col-lg-3">
                    <label for="sort" class="form-label">Sort By</label>
                    <select class="form-select" id="sort" name="sort[field]">
                        <option value="">None</option>
                        <option value="OrderDetailID">ID</option>
                        <option value="ColorName">Color</option>
                        <option value="NameType">Type</option>
                        <option value="MakeName">Make</option>
                        <option value="ModelName">Model</option>
                    </select>
                </div>

                <div class="col-md-6 col-lg-3">
                    <label for="sortDirection" class="form-label">Sort Direction</label>
                    <select class="form-select" id="sortDirection" name="sort[direction]">
                        <option value="ASC">Ascending</option>
                        <option value="DESC">Descending</option>
                    </select>
                </div>

            </div>
        </form>
    </div>
</div>


        <div class="block-content">
            <table class="table align-middle">
            <thead class="text-center">
                <tr>
                    <th class="fw-semibold">ID</th>
                    <th class="fw-semibold">Return Date</th>
                    <th class="fw-semibold">Actual Return Date</th>
                    <th class="fw-semibold">Color</th>
                    <th class="fw-semibold">Type</th>
                    <th class="fw-semibold">Year</th>
                    <th class="fw-semibold">Make</th>
                    <th class="fw-semibold">Model</th>
                    <th class="fw-semibold">Status</th>
                    <th class="fw-semibold col-header-action">Action</th>
                </tr>
            </thead>



                <tbody id="list-inspectionOrder">
                </tbody>
            </table>
        </div>
        <div class="block-content bg-body-light">
            <?php require "./mvc/views/admin/inc/pagination.php" ?>
        </div>
    </div>

    <!-- Add Vehicle Detail Form -->
    <!-- Modal Inspection -->
<div class="modal fade" id="inspectionModal" tabindex="-1" aria-labelledby="inspectionModalLabel">
  <div class="modal-dialog">
    <form id="inspectionForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="inspectionModalLabel">Thêm thông tin kiểm tra</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>

        <div class="modal-body">
            <input type="hidden" name="RentalOrderDetailID" id="rentalOrderDetailID">

            <div class="mb-3">
                <label for="userID" class="form-label">Người kiểm tra</label>
                <input type="text" class="form-control" name="UserID" id="userID" value="<?= $data['Acc'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="inspectionDate" class="form-label">Ngày kiểm tra</label>
                <input type="date" class="form-control" name="InspectionDate" id="inspectionDate" required readonly>
            </div>

            <div class="mb-3">
                <label for="inspectionTime" class="form-label">Giờ kiểm tra</label>
                <input type="time" class="form-control" name="InspectionTime" id="inspectionTime" required readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Danh sách lỗi phạt</label>
                <select class="form-select" name="TotalFineAmount" id="damageType" required>
                    <option value="">-- Chọn lỗi phạt --</option>
                    <?php foreach ($data["DamageTypes"] as $damageType): ?>
                        <option value="<?= $damageType['FineAmount']; ?>"><?= $damageType['DamageName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
      </div>
    </form>
   
  </div>
</div>

<div class="modal fade" id="inspectionModal1" tabindex="-1" aria-labelledby="inspectionModalLabel">
  <div class="modal-dialog">
  <form id="inspectionForm1">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="inspectionModalLabel1">Thêm thông tin kiểm tra</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="RentalOrderDetailID1" id="rentalOrderDetailID1">

            <div class="mb-3">
            <div class="mb-3">
                <label for="userID1" class="form-label">Người kiểm tra</label>
                <input type="text" class="form-control" name="UserID1" id="userID1" value="<?= $data['Acc']; ?>" readonly>
            </div>
            </div>

            <div class="mb-3">
                <label for="inspectionDate1" class="form-label">Ngày kiểm tra</label>
                <input type="date" class="form-control" name="InspectionDate1" id="inspectionDate1" required readonly>
            </div>

            <div class="mb-3">
                <label for="inspectionTime1" class="form-label">Giờ kiểm tra</label>
                <input type="time" class="form-control" name="InspectionTime1" id="inspectionTime1" required readonly>
            </div>


            <div class="mb-3">
                <label for="damageType" class="form-label">Danh sách lỗi phạt</label>
                <select class="form-select" name="TotalFineAmount1" id="damageType" required>
                    <option value="">-- Chọn lỗi phạt --</option>
                    <?php foreach ($data["DamageTypes"] as $damageType): ?>
                        <option value="<?= $damageType['FineAmount']; ?>"><?= $damageType['DamageName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
      </div>
    </form>
  </div>
</div>

   

</div>
<!-- END Page Content -->
<style>
    .upload-image-container {
        border: 1px dashed #ddd;
        border-radius: 8px;
        padding: 15px;
        background: #f9f9f9;
        margin: 1rem;
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
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
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