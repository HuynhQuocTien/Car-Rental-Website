<!-- Hero -->
<div class="bg-body-light ">
    <div class="content content-full py-2">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3"><?php echo $data['Title'] ?></h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Orders</li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $data['Title'] ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Orders History</h3>
            <!-- <div class="block-options">
                <a class="btn btn-hero btn-primary" asp-action="Create">
                    <i class="fa-regular fa-plus"></i> Add
                </a>
            </div> -->
        </div>
        <!-- <div class="block-content">
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
        </div> -->
        <div class="block-content pb-4">
                <table class="table table-striped table-vcenter fs-sm" id="model-table">
                    <thead>
                        <tr>
                            <th style="width: 100px;">ID</th>
                            <th>Customer</th>
                            <th>Payment Method</th>
                            <th>Order Date</th>
                            <th>Rental Date</th>
                            <!-- <th>Shipping Method</th> -->
                            <th>Total</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userOrders">
                        <!-- Rental Orders will be loaded here via AJAX -->
                        <!-- Example Row
                        -->
                    </tbody>
                </table>
        </div>
        <div class="block-content bg-body-light">
            <?php require "./mvc/views/user/inc/pagination.php" ?>
        </div>
    </div>
</div>