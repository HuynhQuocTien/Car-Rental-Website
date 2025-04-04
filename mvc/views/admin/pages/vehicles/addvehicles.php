<!-- Page Content -->
<form id="product-form" method="POST" onsubmit="return false;">
<div class="content">
    <div class="row">
        <div class="col-8">
            <!-- Info -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add product</h3>
                </div>
                <div class="block-content">
                        <div class="mb-4">
                            <label class="form-label" for="product-name">Name</label>
                            <input type="text" class="form-control" id="product-name" name="product-name">
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label" for="product-price">Price ($)</label>
                                <input type="number" class="form-control" id="product-price" name="product-price">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="product-price-sale">Price sale ($)</label>
                                <input type="number" class="form-control" id="product-price-sale" name="product-price-sale">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea id="js-ckeditor" name="product-description"></textarea>
                        </div>
                </div>
            </div>
            <!-- END Info -->
            <!-- Variant -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Variant</h3>
                    <div class="block-options">
                        <button type="button" class="btn btn-alt-primary btn-sm btn-hero" data-bs-toggle="modal" data-bs-target="#modal-variant"><i class="fa-regular fa-plus"></i> Add</button>
                    </div>
                </div>
                <div class="block-content block-content-full variants-container" style="display: none">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Variant</th>
                                <th scope="col">Size</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="variant-color">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Variant-->
            <!-- Variant -->
            <div class="block block-rounded table-variant-container" style="display: none">
                <div class="block-content block-content-full">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Variants</th>
                                <th scope="col">Stock</th>
                                @* <th scope="col">Status</th> *@
                            </tr>
                        </thead>
                        <tbody id="table-variant">
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Variant-->
        </div>
        <div class="col-4">
            <!-- Meta Data -->
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                            <label class="form-label">Is featured?</label>
                        <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" value="" id="is-featured" name="is-featured">
                                <label class="form-check-label" for="is-featured"></label>
                        </div>
                    </div>
                        <div class="mb-4">
                            <label class="form-label" for="product-slug">Slug</label>
                            <input type="text" class="form-control" id="product-slug" name="product-slug">
                        </div>
                    <div class="mb-4">
                        <label class="form-label" for="product-status">Status</label>
                            <select class="js-select2 form-select" id="product-status" name="product-status" style="width: 100%;" data-placeholder="Choose status..">
                            <option></option>
                            <option value="1" selected>Published</option>
                            <option value="0">Draft</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="product-label">Label</label>
                            <select class="js-select2 form-select" id="product-label" name="product-label" style="width: 100%;" data-placeholder="Choose label..">
                            <option></option>
                            <option value="0" selected>No label</option>
                            <option value="1">New</option>
                            <option value="2">Hot</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="brand-id">Brand</label>
                        <select class="js-select2 form-select" id="brand-id" name="brand-id" style="width: 100%;" data-placeholder="Choose brand..">
                            <option></option>
                            @foreach (var brand in ViewBag.Brands)
                            {
                                <option value="@brand.Id">@brand.Name</option>
                            }
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="category-id">Category</label>
                        <select class="js-select2 form-select" id="category-id" name="category-id" style="width: 100%;" data-placeholder="Choose category..">
                            <option></option>
                            @foreach (var brand in ViewBag.Categories)
                            {
                                <option value="@brand.Id">@brand.Name</option>
                            }
                        </select>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary btn-hero" id="btn-save-product">Save</button>
                    </div>
                </div>
            </div>
            <!-- END Meta Data --> 
        </div>
    </div>
</div>
</form>
<!-- Modal -->
<div class="modal" id="modal-variant" tabindex="-1" role="dialog" aria-labelledby="modal-variant" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header block-header block-header-default">
                <h3 class="block-title">Variant</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body block block-rounded block-transparent mb-0">
                <div class="block-content">
                    <form id="form-variant" onsubmit="return false;">
                        <div class="mb-4">
                            <label class="form-label" for="color-id">Color</label>
                            <select class="js-select2 form-select" id="color-id" name="color-id" style="width: 100%;" data-container="#modal-variant" data-placeholder="Choose one..">
                                <option></option>
                                @foreach (var color in ViewBag.Colors)
                                {
                                    <option value="@color.Id">@color.Name</option>
                                }
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="size-id">Size</label>
                            <select class="js-select2 form-select" id="size-id" name="size-id" style="width: 100%;" data-placeholder="Choose many.." data-container="#modal-variant" multiple>
                                <option></option>
                                @foreach (var size in ViewBag.Sizes)
                                {
                                    <option value="@size.Id">@size.Name</option>
                                }
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="upload-image">Images</label>
                            <div class="upload-image-container">
                                <input type="file" id="upload-image" name="upload-image" class="upload-image-input" hidden multiple />
                                <div class="no-image">
                                    <p>Select files to upload</p>
                                </div>
                                <div class="has-image">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer block-content block-content-full text-end bg-body">
                <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btn-add-variant" class="btn btn-sm btn-primary">Save</button>
                <button type="button" id="btn-update-variant" class="btn btn-sm btn-primary" data-bs-dismiss="modal" data-index="0" style="display: none">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->