<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">User Management</h1>
            <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">User List</h3>
            <div class="block-options">
                <button type="button" class="btn btn-hero btn-primary me-2" data-bs-toggle="modal"
                    data-bs-target="#modal-user" id="btn-add">
                    Add User
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-vcenter">
                    <thead>
                        <tr class="bg-body-dark">
                            <th class="d-none d-sm-table-cell text-center" style="width: 40px;">#</th>
                            <th class="text-center" style="width: 70px;"><i class="si si-user"></i></th>
                            <th class="d-none d-sm-table-cell">Full Name</th>
                            <th class="d-none d-sm-table-cell">Phone</th>
                            <th class="d-none d-sm-table-cell">Identity Card</th>
                            <th class="d-none d-sm-table-cell">Gender</th>
                            <th class="d-none d-sm-table-cell">Date of Birth</th>
                            <th class="d-none d-lg-table-cell">Role</th>
                            <th class="d-none d-lg-table-cell">Status</th>
                            <th class="text-center" style="width: 80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="listUser">
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

<div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-labelledby="modal-user" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header block-header block-header-default">
                <h3 class="block-title">Add User</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content" style="max-height: 650px; overflow-y: auto">
                <form novalidate="novalidate" onsubmit="return false;" class="js-validation" id="btabs-static-home"
                    role="tabpanel" aria-labelledby="btabs-static-home-tab" tabindex="0">
                    <div class="mb-2">
                        <label class="form-label" for="val-fullname">Full Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-fullname" name="val-fullname"
                            placeholder="Enter full name..">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-phone">Phone <span class="text-danger">*</span></label>
                        <input class="form-control" id="val-phone" name="val-phone" placeholder="Enter phone number..">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-identity">Identity Card <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-identity" name="val-identity"
                            placeholder="Enter identity card number..">
                    </div>
                    <div class="mb-2">
                        <label for="val-birthday" class="form-label">Date of Birth <span
                                class="text-danger">*</span></label>
                        <input type="text" class="js-flatpickr form-control form-control-alt" id="val-birthday"
                            name="val-birthday" placeholder="Select date of birth...">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-role">Role <span class="text-danger">*</span></label>
                        <select class="form-select" id="val-role" name="val-role">
                                <option value="">Please select</option>
                            <option value="1">Admin</option>
                            <option value="2">Staff</option>
                        </select>
                    </div>
                    <div class="mb-2 d-flex gap-4">
                        <label for="gender-male" class="form-label">Gender</label>
                        <div class="space-x-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="gender-male" name="user_gender"
                                    value="0" checked>
                                <label class="form-check-label" for="gender-male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="gender-female" name="user_gender"
                                    value="1">
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
                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">
                    Exit
                </button>
                <button type="submit" class="btn btn-sm btn-primary add-user-element" id="btn-add-user">
                    Add
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-user" tabindex="-1" role="dialog" aria-labelledby="modal-user"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="block-header bg-primary-dark text-white">
                <h3 class="block-title">Edit User</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <form novalidate="novalidate" onsubmit="return false;" class="js-validation-edit" tabindex="0">
                    <input type="hidden" id="val-userid-edit" name="val-userid-edit">
                    <div class="mb-2">
                        <label class="form-label" for="val-fullname-edit">Full Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-fullname-edit" name="val-fullname-edit"
                            placeholder="Enter full name..">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-phone-edit">Phone <span class="text-danger">*</span></label>
                        <input class="form-control" id="val-phone-edit" name="val-phone-edit"
                            placeholder="Enter phone number..">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-identity-edit">Identity Card <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-identity-edit" name="val-identity-edit"
                            placeholder="Enter identity card number..">
                    </div>
                    <div class="mb-2">
                        <label for="val-birthday-edit" class="form-label">Date of Birth <span
                                class="text-danger">*</span></label>
                        <input type="text" class="js-flatpickr form-control form-control-alt" id="val-birthday-edit"
                            name="val-birthday-edit" placeholder="Select date of birth...">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-role-edit">Role <span class="text-danger">*</span></label>
                        <select class="form-select" id="val-role-edit" name="val-role-edit">
                            <option value="">Please select</option>
                            <option value="1">Admin</option>
                            <option value="2">Staff</option>
                        </select>
                    </div>
                    <div class="mb-2 d-flex gap-4">
                        <label for="gender-male-edit" class="form-label">Gender</label>
                        <div class="space-x-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="gender-male-edit"
                                    name="user_gender-edit" value="0" checked>
                                <label class="form-check-label" for="gender-male-edit">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="gender-female-edit"
                                    name="user_gender-edit" value="1">
                                <label class="form-check-label" for="gender-female-edit">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-5">
                        <label for="user_status-edit" class="form-label">Status</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="user_status-edit">
                            <label class="form-check-label" for="user_status-edit"></label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer block-content block-content-full text-end bg-body">
                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">
                    Exit
                </button>
                <button type="submit" class="btn btn-sm btn-primary add-user-element" id="btn-edit-user">
                    Update
                </button>
            </div>
        </div>
    </div>
</div>