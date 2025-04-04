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
                        data-bs-target="#modal-customer" id="btn-and">
                    Add Customer
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="row mb-3">
                <div class="input-group">
                    <input type="text" class="form-control form-control-alt" id="searchInput" name="searchInput" placeholder="Tên khách hàng...">
                    <button type="submit" class="input-group-text bg-body border-0 btn-search">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter">
                    <thead>
                        <tr class="bg-body-dark">
                            <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>
                            <th class="text-center" style="width: 70px;"><i class="si si-user"></i></th>
                            <th class="d-none d-sm-table-cell">Name</th>
                            <th class="d-none d-sm-table-cell">Email</th>
                            <th class="d-none d-sm-table-cell">Phone</th>
                            <th class="d-none d-sm-table-cell">Gender</th>
                            <th class="d-none d-sm-table-cell">BirthDay</th>
                            <th class="d-none d-lg-table-cell">Status</th>
                            <th class="text-center" style="width: 80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="listCustomer">
                    </tbody>
                </table>
                <nav class="pagination-container">
                    
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-customer" tabindex="-1" role="dialog" aria-labelledby="modal-customer"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header block-header block-header-default">
                <h3 class="block-title">Add customer</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content" style="max-height: 650px; overflow-y: auto">
                <form novalidate="novalidate" onsubmit="return false;" class="js-validation"
                        id="btabs-static-home" role="tabpanel" aria-labelledby="btabs-static-home-tab" tabindex="0">
                    <div class="mb-2">
                        <label class="form-label" for="val-fullname">FullName <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-fullname" name="val-fullname" placeholder="Enter a fullname..">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-username">UserName <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-username" name="val-username" placeholder="Enter a username..">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="val-email" name="val-email" placeholder="Your valid email..">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-phone">Phone <span class="text-danger">*</span></label>
                        <input class="form-control" id="val-phone" name="val-phone" placeholder="Your valid phone..">
                    </div>
                    <div class="mb-2">
                        <label for="val-birthday" class="form-label">BirthDay <span class="text-danger">*</span></label>
                        <input type="text" class="js-flatpickr form-control form-control-alt" id="val-birthday"
                                name="val-birthday" placeholder="Please enter birthday...">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-password">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="val-password" name="val-password" placeholder="Choose a safe one..">
                    </div>
                    <div class="mb-2 d-flex gap-4">
                        <label for="gender-male" class="form-label">Gender</label>
                        <div class="space-x-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="gender-male" name="user_gender" value="1" checked>
                                <label class="form-check-label" for="gender-male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="gender-female" name="user_gender" value="0">
                                <label class="form-check-label" for="gender-female">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-5">
                        <label for="user_status" class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="user_status" checked>
                            <label class="form-check-label" for="user_status"></label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="model-footer block-content block-content-full text-end bg-body">
                <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">
                    Exit
                </button>
                <button type="submit" class="btn btn-sm btn-primary add-user-element"
                        id="btn-add-user">
                    Add
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-customer" tabindex="-1" role="dialog" aria-labelledby="modal-customer"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
                <div class="block-header bg-primary-dark text-white">
                    <h3 class="block-title">Edit customer</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <form novalidate="novalidate" onsubmit="return false;" class="js-validation-edit" tabindex="0">
                        <div class="mb-2">
                            <label class="form-label" for="val-fullname-edit">FullName <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="val-fullname-edit" name="val-fullname-edit" placeholder="Enter a fullname..">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="val-username-edit">UserName <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="val-username-edit" name="val-username-edit" placeholder="Enter a username..">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="val-email-edit">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="val-email-edit" name="val-email-edit" placeholder="Your valid email..">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" for="val-phone-edit">Phone <span class="text-danger">*</span></label>
                            <input class="form-control" id="val-phone-edit" name="val-phone-edit" placeholder="Your valid phone..">
                        </div>
                        <div class="mb-2">
                            <label for="val-birthday-edit" class="form-label">BirthDay <span class="text-danger">*</span></label>
                            <input type="text" class="js-flatpickr form-control form-control-alt" id="val-birthday-edit"
                                   name="val-birthday-edit" placeholder="Please enter birthday...">
                        </div>
                        <div class="mb-2 d-flex gap-4">
                            <label for="gender-male-edit" class="form-label">Gender</label>
                            <div class="space-x-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="gender-male-edit" name="user_gender-edit" value="1" checked>
                                    <label class="form-check-label" for="gender-male-edit">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="gender-female-edit" name="user_gender-edit" value="0">
                                    <label class="form-check-label" for="gender-female-edit">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-5">
                            <label for="user_status-edit" class="form-label">Status</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="user_status-edit" checked>
                                <label class="form-check-label" for="user_status-edit"></label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                            data-bs-dismiss="modal">
                        Exit
                    </button>
                    <button type="submit" class="btn btn-sm btn-primary add-user-element"
                            id="btn-edit-user">
                        Edit
                    </button>
                </div>
        </div>
    </div>
</div>