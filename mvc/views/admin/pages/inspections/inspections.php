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
                <a class="btn btn-hero btn-primary" asp-action="Create">
                    <i class="fa-regular fa-plus"></i> Add
                </a>
            </div>
        </div>

        <div class="block-content">
            <div class="mb-1">
                <input type="text" class="form-control form-control-alt" id="vehicle-query" name="vehicle-query"
                    placeholder="Search all vehicles..">
            </div>
            <div class="row filters_listing_1">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" class="drop">Types</a>
                        <div class="dropdown-menu">
                            <div class="filter_type">
                                <ul>
                                    <li>
                                    <?php foreach ($data["Categories"] as $cat): ?>
                                        <label class="container_check">
                                            <?= htmlspecialchars($cat["NameType"]) ?>
                                            <input type="checkbox" name="categories[]" value="<?= htmlspecialchars($cat["NameType"]) ?>">
                                            <span class="checkmark"></span>
                                        </label>
                                    <?php endforeach; ?>
                                        <!-- <label class="container_check">
                                            Hạng sang
                                            <input type="checkbox" name="categories" value="HangSang">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container_check">
                                            Phổ thông
                                            <input type="checkbox" name="categories" value="PhoThong">
                                            <span class="checkmark"></span>
                                        </label> -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /dropdown -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" class="drop">Color</a>
                        <div class="dropdown-menu">
                            <div class="filter_type">
                                <ul>
                                    <li>
                                    <?php foreach ($data["Colors"] as $color): ?>
                                        <label class="container_check">
                                            <?= htmlspecialchars($color["ColorName"]) ?>
                                            <input type="checkbox" name="colors[]" value="<?= htmlspecialchars($color["ColorName"]) ?>">
                                            <span class="checkmark"></span>
                                        </label>
                                    <?php endforeach; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /dropdown -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" class="drop">Brand</a>
                        <div class="dropdown-menu">
                            <div class="filter_type">
                                <ul>
                                    <li>
                                        <?php foreach ($data["Makes"] as $make): ?>
                                            <label class="container_check">
                                                <?= htmlspecialchars($make["MakeName"]) ?>
                                                <input type="checkbox" name="make[]" value="<?= htmlspecialchars($make["MakeName"]) ?>">
                                                <span class="checkmark"></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /dropdown -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" class="drop">Price</a>
                        <div class="dropdown-menu">
                            <div class="filter_type">
                                <ul>
                                    <li>
                                        <label class="container_check">
                                            $0 — $50
                                            <input type="checkbox" name="prices" value="0:50">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            $50 — $100
                                            <input type="checkbox" name="prices" value="50:100">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            $100 — $150
                                            <input type="checkbox" name="prices" value="100:150">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="container_check">
                                            $150 — $200
                                            <input type="checkbox" name="prices" value="150:200">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /dropdown -->
                </div>
    </div>

    </div>
        <div class="block-content pb-3 pt-0">
            <form id="vehicle-form" method="POST" action="your-action-url">
                <table class="table align-middle" id="vehicle-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <!-- <th>Name</th> -->
                            <th>Make</th>
                            <th>Model</th>
                            <th>Color</th>
                            <th>VehicleType</th>
                            <th>Day Price</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 1;
                        foreach ($data["Inspection"] as $item) {
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <!-- Tạo tên Car A, B, C... nếu muốn -->
                            <!-- <td>Car <?= chr(64 + $i) ?></td>  -->
                            <td><?= htmlspecialchars($item["MakeName"]) ?></td>
                            <td><?= htmlspecialchars($item["ModelName"]) ?></td>
                            <td><?= htmlspecialchars($item["ColorName"]) ?></td>
                            <td><?= htmlspecialchars($item["NameType"]) ?></td>
                            <td>$<?= htmlspecialchars($item["DailyPrice"]) ?></td>
                            <td>
                                <?= $item["Status"] == 1 ? "Available" : "Unavailable" ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                        data-bs-toggle="tooltip" aria-label="Detail" data-bs-original-title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                        data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                        data-bs-toggle="tooltip" aria-label="Delete" data-bs-original-title="Delete">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
                
                <!-- Thêm một nút submit cho form -->
                <!-- <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div> -->
            </form>
        </div>

    </div>
</div>