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
            <h3 class="block-title">List Makes</h3>
            <div class="block-options">
                <a class="btn btn-hero btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addMakeModal">
                    <i class="fa-regular fa-plus"></i> Add
                </a>
            </div>
        </div>
        <div class="block block-rounded pb-2">
            <div class="block-content bg-body-light">
            <form action="#" id="search-form" onsubmit="return false;">
                <div class="row mb-4">
                    <div class="input-group justify-content-center">
                        <div class="col-md-6 d-flex gap-3">
                            <input type="text" class="form-control form-control-alt" id="search-input"
                                name="search-input" placeholder="Tìm kiếm...">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="block-content pb-4">
            <table class="table table-bordered table-striped table-vcenter" id="make-table">
                <thead>
                    <tr>
                        <th style="width: 10%;">
                            ID
                        </th>
                        <th style="width: 35%">
                            Name
                        </th>
                        <th style="width: 35%">
                            Country
                        </th>
                        <th class="text-center" style="width: 20%">Action</th>
                    </tr>
                </thead>
                <tbody id="list-make">
                    <!-- Data will be populated here by JavaScript -->
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

<!-- Add Make Modal -->
<div class="modal fade" id="addMakeModal" tabindex="-1" aria-labelledby="addMakeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMakeModalLabel">Add New Make</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addMakeForm">
                    <!-- Hidden ID for editing mode -->
                    <div class="mb-3 d-none" id="makeIdContainer">
                        <label for="makeId" class="form-label">ID</label>
                        <input type="text" class="form-control" id="makeId" name="makeId" readonly
                            style="cursor: not-allowed; background-color: #f8f9fa;">
                    </div>
                    <!-- Make Name -->
                    <div class="mb-3">
                        <label for="makeName" class="form-label">Make Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="makeName" name="makeName" required
                            placeholder="e.g. Toyota, Honda, Ford">
                    </div>
                    <!-- Country -->
                    <div class="mb-3">
                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="country" name="country" required
                            placeholder="e.g. Japan, USA, Germany">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveMakeBtn">Save</button>
                <button type="button" class="btn btn-primary" id="updateMakeBtn" data-id="">Update</button>
            </div>
        </div>
    </div>
</div>

