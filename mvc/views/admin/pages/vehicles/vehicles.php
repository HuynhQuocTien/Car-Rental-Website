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
<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">List <?php echo $data['Title'] ?></h3>
            <div class="block-options">
                <a class="btn btn-hero btn-primary" href="<?php echo BASE_URL; ?>/admin/vehicles/addvehicles">
                    <i class="fa-regular fa-plus"></i> Add
                </a>
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
        <div class="block-content">
            <div class="mb-1">
                <input type="text" class="form-control form-control-alt" id="vehicle-query" name="vehicle-query"
                    placeholder="Search all vehicles..">
            </div>
            <div class="row filters_listing_1">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" class="drop">Makes</a>
                        <div class="dropdown-menu">
                            <div class="filter_type">
                                <ul>
                                    <?php foreach ($data['Makes'] as $c){
                                        echo '                                        
                                        <li>
                                            <label class="container_check">
                                                '.$c['MakeName'].'
                                                <input type="checkbox" name="makes" value="'.$c['MakeID'].'">
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
                                    <?php foreach ($data['Models'] as $c){
                                        echo '                                        
                                        <li>
                                            <label class="container_check">
                                                '.$c['ModelName'].'
                                                <input type="checkbox" name="models" value="'.$c['ModelID'].'">
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
                        <a href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" class="drop">Colors</a>
                        <div class="dropdown-menu">
                            <div class="filter_type">
                                <ul>
                                    <li>
                                        <label class="container_check">
                                            All Colors
                                            <input type="checkbox" name="colors" value="0">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <?php foreach ($data['Colors'] as $c){
                                        echo '                                        
                                        <li>
                                            <label class="container_check">
                                                '.$c['ColorName'].'
                                                <input type="checkbox" name="colors" value="'.$c['ColorID'].'">
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
                    <!-- <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" class="drop">Vehicle Type</a>
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
                    </div> -->
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
                                    <?php foreach ($data['VehicleTypes'] as $c){
                                        echo '                                        
                                        <li>
                                            <label class="container_check">
                                                '.$c['NameType'].'
                                                <input type="checkbox" name="vehicle_types" value="'.$c['VehicleTypesID'].'">
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
                        <th>Name</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Color</th>
                        <th>VehicleType</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Car A</td>
                        <td>Toyota</td>
                        <td>Camry</td>
                        <td>Red</td>
                        <td>Sedan</td>
                        <td>Available</td>
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
                    <tr>
                        <td>2</td>
                        <td>Car B</td>
                        <td>Honda</td>
                        <td>Civic</td>
                        <td>Blue</td>
                        <td>Sedan</td>
                        <td>Rented</td>
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
                    <tr>
                        <td>3</td>
                        <td>Car C</td>
                        <td>Ford</td>
                        <td>Focus</td>
                        <td>White</td>
                        <td>Hatchback</td>
                        <td>In Service</td>
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
                </tbody>
            </table>

        </div>
    </div>
</div>