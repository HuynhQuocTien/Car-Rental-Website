<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">List Roles</h3>
            <div class="block-options">
                <button data-function="18" data-permission="2" type="button" class="btn btn-hero btn-primary"
                    data-bs-toggle="modal" data-bs-target="#modal-add-role"><i class="fa-regular fa-plus me-1"></i>
                    Add</button>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center">
                <div class="col-md-11">
                    <!-- <form action="be_pages_ecom_orders.html" method="POST" onsubmit="return false;">
                        <div class="mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-alt" id="one-ecom-orders-search"
                                    name="one-ecom-orders-search" placeholder="Tìm kiếm nhóm quyền..">
                                <span class="input-group-text bg-body border-0">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </form> -->
                    <div class="table-responsive">
                        <table class="table table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Name role</th>
                                    <th class="text-center">Number of users</th>
                                    <th class="text-center col-header-action">Action</th>
                                </tr>
                            </thead>
                            <tbody id="list-roles"></tbody>
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
    </div>
</div>

<!-- Modal   -->
<div class="modal fade" id="modal-add-role" tabindex="-1" role="dialog" aria-labelledby="modal-add-role"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title add-role-element">Add permission group</h5>
                <h5 class="modal-title update-role-element">Edit permission group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-1">
                <form class="form_role">
                    <div class="mb-2">
                        <label class="form-label" for="NameRole">Name Role</label>
                        <input type="text" class="form-control form-control-alt" id="NameRole" name="NameRole"
                            placeholder="Enter name role..">
                    </div>
                    <table class="table table-vcenter table-role">
                        <thead>
                            <tr>
                                <th>Name Role</th>
                                <th class="text-center">All</th>
                                <th class="text-center">View</th>
                                <th class="text-center">Add</th>
                                <th class="text-center">Update</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <tr>
                                <td>Vehicles</td>
                                <td class="text-center">
                                    <input type="checkbox" class="check-all-row form-check-input">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="vehicles" value="4" data-id="4">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="vehicles" value="1" data-id="4">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="vehicles" value="2" data-id="4">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="vehicles" value="3" data-id="4">
                                </td>
                            </tr>
                            <tr>
                                <td>Vehicle Type</td>
                                <td class="text-center">
                                    <input type="checkbox" class="check-all-row form-check-input">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="vehiclecategory" value="4"  data-id="5">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="vehiclecategory" data-id="5"
                                        value="1">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="vehiclecategory" data-id="5"
                                        value="2">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="vehiclecategory" data-id="5"
                                        value="3">
                                </td>
                            </tr>
                            <tr>
                                <td>Colors</td>
                                <td class="text-center">
                                    <input type="checkbox" class="check-all-row form-check-input">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="colors" value="4" data-id="6">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="colors" value="1"  data-id="6">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="colors" value="2"  data-id="6">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="colors" value="3"  data-id="6">
                                </td>
                            </tr>
                            <tr>
                                <td>Makes</td>
                                <td class="text-center">
                                    <input type="checkbox" class="check-all-row form-check-input">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="makes" value="4" data-id="7">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="makes" value="1" data-id="7">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="makes" value="2" data-id="7">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="makes" value="3" data-id="7">
                                </td>
                            </tr>
                            <tr>
                                <td>Models</td>
                                <td class="text-center">
                                    <input type="checkbox" class="check-all-row form-check-input">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="models" value="4" data-id="8">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="models" value="1" data-id="8">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="models" value="2" data-id="8">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="models" value="3" data-id="8">
                                </td>
                            </tr>
                            <tr>
                                <td>Rental Orders</td>
                                <td class="text-center">
                                    <input type="checkbox" class="check-all-row form-check-input">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="rentalorders" value="4" data-id="9">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="rentalorders" value="1" data-id="9">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="rentalorders" value="2" data-id="9">
                                </td>
                                <td class="text-center">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td>Inspections</td>
                                <td class="text-center">
                                    <input type="checkbox" class="check-all-row form-check-input">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="inspections" value="4" data-id="10">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="inspections" value="1" data-id="10">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="inspections" value="2" data-id="10">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="inspections" value="3" data-id="10">
                                </td>
                            </tr>
                            <tr>
                                <td>Damage Types</td>
                                <td class="text-center">
                                    <input type="checkbox" class="check-all-row form-check-input">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="damagetypes" value="4" data-id="11">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="damagetypes" value="1" data-id="11">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="damagetypes" value="2" data-id="11">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="damagetypes" value="3" data-id="11">
                                </td>
                            </tr>
                            <tr>
                                <td>Deposits</td>
                                <td class="text-center">
                                    <input type="checkbox" class="check-all-row form-check-input">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="deposits" value="4" data-id="12">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="deposits" value="1" data-id="12">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="deposits" value="2" data-id="12">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="deposits" value="3" data-id="12">
                                </td>
                            </tr> 
                            <tr>                                
                                <td>Promotions</td>
                                <td class="text-center">
                                    <input type="checkbox" class="check-all-row form-check-input">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="promotions" value="4" data-id="15">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="promotions" value="1" data-id="15">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="promotions" value="2" data-id="15">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="promotions" value="3" data-id="15">
                                </td>
                            </tr>
                            <tr>
                                <td>Users</td>
                                <td class="text-center">
                                    <input type="checkbox" class="check-all-row form-check-input">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="users" value="4" data-id="16">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="users" value="1" data-id="16">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="users" value="2" data-id="16">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="users" value="3" data-id="16">
                                </td>
                            </tr>
                            <tr>
                                <td>Customers</td>
                                <td class="text-center">
                                    <input type="checkbox" class="check-all-row form-check-input">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="customers" value="4" data-id="17">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="customers" value="1" data-id="17">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="customers" value="2" data-id="17">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="customers" value="3" data-id="17">
                                </td>
                            </tr>
                            <tr>           
                                <td>Permissions</td>
                                <td class="text-center">
                                    <input type="checkbox" class="check-all-row form-check-input">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="permissions" value="4" data-id="18">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="permissions" value="1" data-id="18">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="permissions" value="2" data-id="18">
                                </td>
                                <td class="text-center">
                                    <input class="form-check-input" type="checkbox" name="permissions" value="3" data-id="18">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row justify-content-around">
                        <div class="col-4 form-check form-switch d-flex justify-content-center gap-2">
                            <input class="form-check-input" type="checkbox" value="7" id="dashboard" data-id="1"
                                name="dashboard">
                            <label class="form-check-label" for="dashboard">Dashboard</label>
                        </div>
                        <div class="col-4 form-check form-switch d-flex justify-content-center gap-2">
                            <input class="form-check-input" type="checkbox" value="5" id="approval" data-id="2"
                                name="approval">
                            <label class="form-check-label" for="approval">Approval Order</label>
                        </div>
                        <div class="col-4 form-check form-switch d-flex justify-content-center gap-2">
                            <input class="form-check-input" type="checkbox" value="6" id="inspector"  data-id="3"
                                name="inspector">
                            <label class="form-check-label" for="inspector">Inspector Vehicle</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="idrole">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-primary add-role-element" id="save-role">Save</button>
                <button type="button" class="btn btn-sm btn-primary update-role-element" id="update-role-btn">Update</button>
            </div>
        </div>
    </div>
</div>