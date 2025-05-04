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
            <!-- <form id="search-inspection-form" class="mb-1 action="javascript:void(0);">
                <input type="text" class="form-control form-control-alt" id="vehicle-query" name="vehicle-query"
                    placeholder="Search all vehicles..">
            </form> -->

            
        <div class="row filters_listing_1">

         

            <!-- Price -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <label for="prices" class="form-label">Price</label>
                <select class="form-select" id="prices" name="filter[prices][]">
                    <option value="">All</option>
                    <option value="0:100">$0 — $100</option>
                    <option value="100:200">$100 — $200</option>
                    <option value="200:500">$200 — $500</option>
                    <option value="500:1000">$500 — $1000</option>
                    <option value="1000:1500">$1000 — $1500</option>
                </select>
            </div>

        </div>


    </div>
        <div class="block-content pb-3 pt-0">
            <form id="vehicle-form" method="POST" action="your-action-url">
                <table class="table align-middle" id="vehicle-table">
                    <thead>
                        <tr>
                            <!-- <th>Name</th> -->
                            <th class="text-center">OrderID</th>
                            <th class="text-center">CustomerID</th>
                            <th class="text-center">UserID</th>
                            <th class="text-center">OrderDate</th>
                            <th class="text-center">RentalDate</th>
                            <th class="text-center">TotalAmount</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">PromotionID</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">PaymentID</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="list-inspection">
                        <!-- 
                        <tr>
                            <td>1</td>
                            <td>Toyota</td>
                            <td>Corolla</td>
                            <td>Red</td>
                            <td>Sedan</td>
                            <td>$50</td>
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
                            <td>Honda</td>
                            <td>Civic</td>
                            <td>Blue</td>
                            <td>Hatchback</td>
                            <td>$55</td>
                            <td>Unavailable</td>
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
                            <td>Ford</td>
                            <td>Focus</td>
                            <td>Black</td>
                            <td>SUV</td>
                            <td>$60</td>
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
                         -->

                    </tbody>
                </table>
                
                <!-- Thêm một nút submit cho form -->
                <!-- <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div> -->
            </form>
        </div>
        <div class="block block-rounded pb-2 bg-body-light">
            <div class="block-content bg-body-light">
                <?php require "./mvc/views/admin/inc/pagination.php" ?>
            </div>
        </div>
    </div>
</div>