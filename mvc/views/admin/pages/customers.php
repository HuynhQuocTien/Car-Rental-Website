<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Customer</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Customers</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">List Customer</h3>
            <div class="block-options">
                <button type="button" class="btn btn-hero btn-primary me-2" data-bs-toggle="modal"
                        data-bs-target="#modal-customer" id="btn-add">
                    Add Customer
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-vcenter">
                    <thead>
                        <tr class="bg-body-dark">
                            <th class="d-sm-table-cell text-center" style="width: 40px;">#</th>
                            <th class="text-center" style="width: 70px;"><i class="si si-user"></i></th>
                            <th class="d-sm-table-cell">Full Name</th>
                            <th class="d-sm-table-cell">Phone</th>
                            <th class="d-sm-table-cell">Identity Card</th>
                            <th class="d-sm-table-cell">Date of Birth</th>
                            <th class="d-sm-table-cell">Gender</th>
                            <th class="d-lg-table-cell">Status</th>
                            <th class="d-lg-table-cell">Total Ordered</th>
                            <th class="text-center" style="width: 80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="listCustomer">
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
</div>

<!-- Hero and table remain the same as before -->

<div class="modal fade" id="modal-customer" tabindex="-1" role="dialog" aria-labelledby="modal-customer"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header block-header block-header-default">
                <h3 class="block-title title-add">Add customer</h3>
                <h3 class="block-title title-update">Update customer</h3>
                <h3 class="block-title title-view">View customer</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content" style="max-height: 650px; overflow-y: auto">
                <form novalidate="novalidate" onsubmit="return false;" class="js-validation"
                        id="addCustomerForm" role="tabpanel" aria-labelledby="addcustomerform-tab" tabindex="0">
                    <!-- Account Information Section -->
                    <div class="mb-4">
                        <h4 class="border-bottom pb-2">Account Information</h4>
                        <div class="mb-2">
                            <label class="form-label" for="Username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="Username" name="Username" placeholder="Enter username..">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="Email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="Email" name="Email" placeholder="Enter email..">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="Password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter password..">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="ProfilePicture">Profile Picture</label>
                            <input type="file" class="form-control" id="ProfilePicture" name="ProfilePicture">
                        </div>
                        <div class="d-flex align-items-center gap-5">
                            <label for="AccountActive" class="form-label">Account Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="AccountActive" name="AccountActive" checked>
                                <label class="form-check-label" for="AccountActive"></label>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information Section -->
                    <div class="mb-4">
                        <h4 class="border-bottom pb-2">Customer Information</h4>
                        <div class="mb-2">
                            <label class="form-label" for="FullName">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="FullName" name="FullName" placeholder="Enter full name..">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="PhoneNumber">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="Enter phone number..">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="IdentityCard">Identity Card (CCCD) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="IdentityCard" name="IdentityCard" placeholder="Enter identity card number..">
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label class="form-label" for="IDCardBefore">ID Card Front Image</label>
                                <input type="file" class="form-control" id="IDCardBefore" name="IDCardBefore">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="IDCardAfter">ID Card Back Image</label>
                                <input type="file" class="form-control" id="IDCardAfter" name="IDCardAfter">
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="DateOfBirth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-alt" id="DateOfBirth" name="DateOfBirth">
                        </div>
                        <div class="mb-2 d-flex gap-4">
                            <label class="form-label">Gender</label>
                            <div class="space-x-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="gender-male" name="Sex" value="0" checked>
                                    <label class="form-check-label" for="gender-male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="gender-female" name="Sex" value="1">
                                    <label class="form-check-label" for="gender-female">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-5">
                            <label for="CustomerActive" class="form-label">Customer Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="CustomerActive" name="CustomerActive" checked>
                                <label class="form-check-label" for="CustomerActive"></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="model-footer block-content block-content-full text-end bg-body">
                <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">
                    Exit
                </button>
                <button type="submit" class="btn btn-sm btn-primary"
                        id="btn-add-customer">
                    Add
                </button>
                <button type="submit" class="btn btn-sm btn-primary"
                            id="btn-edit-customer">
                    Edit
                </button>
            </div>
        </div>
    </div>
</div>