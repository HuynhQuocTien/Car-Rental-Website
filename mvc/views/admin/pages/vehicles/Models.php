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
            <h3 class="block-title">List Models</h3>
            <div class="block-options">
                <a class="btn btn-hero btn-primary" asp-action="Create">
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
            </table>

        </div>
    </div>
</div>