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
                    data-bs-target="#addModelForm" id="btn-add" data-role="add">
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
                            <th class="d-none d-sm-table-cell">
                                <div class="fw-semibold">Full Name</div>
                                <div class="text-muted small">Phone</div>
                            </th>
                            <th class="d-none d-sm-table-cell">
                                <div class="fw-semibold">Identity Card</div>
                                <div class="text-muted small">Email</div>
                            </th>
                            <th class="d-none d-sm-table-cell">
                                <div class="fw-semibold">Date of Birth</div>
                                <div class="text-muted small">Gender</div>
                            </th>
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

<div class="modal fade" id="addModelForm" tabindex="-1" role="dialog" aria-labelledby="addModelForm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header block-header block-header-default">
                <h3 class="block-title title-add">Add User</h3>
                <h3 class="block-title title-update">Update User</h3>
                <h3 class="block-title title-view">View detail user</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content" style="max-height: 650px; overflow-y: auto">
                <form novalidate="novalidate" id="addUserForm">
                    <!-- <div class="mb-3">
                        <label class="form-label">Profile Picture</label>
                        <div class="text-center">
                            <img id="profile-preview" src="https://via.placeholder.com/100" alt="Profile Preview" class="img-thumbnail mb-2" style="width: 100px; height: 100px;">
                            <input type="file" class="form-control" id="val-profile-picture" name="ProfilePicture" accept="image/*">
                        </div>
                    </div> -->
                    <div id="view-profile-div" class="mb-3 text-center position-relative" style="display: none;">
                        <div class="position-relative d-inline-block">
                            <!-- Preview hình ảnh -->
                            <img id="profile-view"
                                src="https://res.cloudinary.com/dapudsvwl/image/upload/v1744802442/sdh1er6okrxz39xpr8vp.jpg"
                                alt="Profile View" class="img-thumbnail" style="width: 100px; height: 100px;">
                            <!-- Nút "+" trong trường hợp không có hình -->
                            <div id="btn-add-picture-disabled"
                                class="position-absolute top-50 start-50 translate-middle text-center"
                                style="font-size: 24px; color: #6c757d; cursor: default; display: none;">
                                +
                            </div>
                        </div>
                    </div>

                    <div id="edit-profile-div" class="mb-3 text-center position-relative" style="display: none;">
                        <input type="text" id="userId" hidden name="UserID" value="0">
                        <input type="text" id="accountId" hidden name="AccountID" value="0">
                        <div class="position-relative d-inline-block">
                            <!-- Preview hình ảnh -->
                            <img id="profile-preview"
                                src="https://res.cloudinary.com/dapudsvwl/image/upload/v1744802442/sdh1er6okrxz39xpr8vp.jpg"
                                alt="Profile Preview" class="img-thumbnail"
                                style="width: 100px; height: 100px; cursor: pointer;">
                            <!-- Nút "X" để xóa -->
                            <button id="btn-remove-picture" type="button"
                                class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                style="display: none; transform: translate(25%, -25%); font-size: 0.7rem; padding: 0.2rem 0.4rem;">
                                ×
                            </button>
                            <!-- Nút "+" trong trường hợp không có hình -->
                            <div id="btn-add-picture"
                                class="position-absolute top-50 start-50 translate-middle text-center"
                                style="font-size: 24px; color: #6c757d; cursor: pointer;">
                                +
                            </div>
                        </div>
                        <!-- Input tệp ẩn -->
                        <input type="file" class="form-control d-none" id="val-profile-picture" name="ProfilePicture"
                            accept="image/*">
                    </div>
                    <!-- User Details -->
                    <div class="mb-2">
                        <label class="form-label" for="val-fullname">Full Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-fullname" name="FullName"
                            placeholder="Enter full name..">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-phone">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-phone" name="PhoneNumber"
                            placeholder="Enter phone number..">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-identity">Identity Card <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-identity" name="IdentityCard"
                            placeholder="Enter identity card number..">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-role">Role <span class="text-danger">*</span></label>
                        <select class="form-select" id="val-role" name="RoleID">
                            <option value="">Please select</option>
                            <?php foreach ($data["Roles"] as $role): ?>
                                <option value="<?= $role["RoleID"] ?>"><?= $role["RoleName"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-birthday">Date of Birth <span
                                class="text-danger">*</span></label>
                        <input type="text" class="js-flatpickr form-control" id="val-birthday" name="DateOfBirth"
                            placeholder="Select date of birth...">
                    </div>
                    <!-- Username -->
                    <div class="mb-3">
                        <label class="form-label" for="val-username">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="val-username" name="Username"
                            placeholder="Enter username..">
                    </div>
                    <!-- Account Details -->
                    <div class="mb-2">
                        <label class="form-label" for="val-email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="val-email" name="Email"
                            placeholder="Enter email address..">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-password">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="val-password" name="Password"
                            placeholder="Enter password..">
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="val-repassword">Re-enter Password <span
                                class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="val-repassword" name="RePassword"
                            placeholder="Re-enter password..">
                    </div>
                    <!-- Additional Details -->
                    <div class="mb-2">
                        <div class="d-flex justify-content-sm-between">
                            <label class="form-label">Gender</label>
                            <div class="form-check me-2">
                                <input class="form-check-input" type="radio" id="gender-male" name="Sex" value="0"
                                    checked>
                                <label class="form-check-label" for="gender-male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="gender-female" name="Sex" value="1">
                                <label class="form-check-label" for="gender-female">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="user_active">Active</label>
                            <input class="form-check-input" type="checkbox" id="user_active" name="Active" checked>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer block-content block-content-full text-end bg-body">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-primary" id="btn-add-user">Add</button>
                <button type="button" class="btn btn-sm btn-primary" id="btn-edit-user">Update</button>
            </div>
        </div>
    </div>
</div>