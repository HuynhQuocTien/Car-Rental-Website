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
            <h3 class="block-title">List Colors</h3>
            <div class="block-options">
                <a class="btn btn-hero btn-primary" data-bs-toggle="modal" data-bs-target="#addColorModal">
                    <i class="fa-regular fa-plus"></i> Add
                </a>
            </div>
        </div>
        <div class="block-content pb-4">
            <table class="table table-bordered table-striped table-vcenter" id="color-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">
                            ID
                        </th>
                        <th style="width: 75%">
                            Name
                        </th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['Colors'] as $color) : ?>
                        <tr id="row-<?php echo $color['ColorID'] ?>">
                            <td class="text-center">
                                <?php echo $color['ColorID'] ?>
                            </td>
                            <td class="fw-semibold">
                                <?php echo $color['ColorName'] ?>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#editColorModal" data-id="<?php echo $color['ColorID'] ?>" data-name="<?php echo $color['ColorName'] ?>">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-alt-secondary delete-color" data-id="<?php echo $color['ColorID'] ?>">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- Add Color Modal -->
<div class="modal fade" id="addColorModal" tabindex="-1" aria-labelledby="addColorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addColorModalLabel">Add New Color</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addColorForm">
                    <div class="mb-3">
                        <label for="colorName" class="form-label">Color Name</label>
                        <input type="text" class="form-control" id="colorName" name="colorName" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveColorBtn">Save</button>
            </div>
        </div>
    </div>
</div>