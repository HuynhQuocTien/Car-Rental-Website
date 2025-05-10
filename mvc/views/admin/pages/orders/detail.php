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
<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">List Rental Orders</h3>
        </div>
        <div class="block-content">
            <div class="row mb-1">
                <div class="col-2">
                    <select id="order-status" class="form-select" aria-label="Filters">
                        <option value="-2" selected>All</option>
                        <option value="-1">Canceled</option>
                        <option value="0">Unconfirmed</option>
                        <option value="1">Confirmed</option>
                    </select>
                </div>
                <div class="col-4">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping"><i class="fa fa-fw fa-search"></i></span>
                        <input type="text" class="form-control" id="order-query" name="order-query" placeholder="Search all orders..">
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        <input type="text" class="form-control" id="order-start-time" name="order-start-time" placeholder="From" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                        <span class="input-group-text fw-semibold">
                            <i class="fa fa-fw fa-arrow-right"></i>
                        </span>
                        <input type="text" class="form-control" id="order-end-time" name="order-end-time" placeholder="To" data-week-start="1" data-autoclose="true" data-today-highlight="true">
                    </div>
                </div>
            </div>
        </div>
        <div class="block-content pb-4">
                <table class="table table-striped table-vcenter fs-sm" id="model-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Vehicle Name</th>
                            <th>Color</th>
                            <th>License Plate Number</th>
                            <th>Rental Type</th>

                            <th>Return Date</th>
                            <th>Actual Return Date</th>
                            <!-- <th>Shipping Method</th> -->
                            <th>Damage Penalty</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="rentalorderdetails">
                        <!-- Rental Orders will be loaded here via AJAX -->
                        <!-- Example Row
                        -->
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
