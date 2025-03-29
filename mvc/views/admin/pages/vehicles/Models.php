<!-- Hero -->
<div class="bg-body-light">
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
                <button class="btn btn-hero btn-primary" data-bs-toggle="modal" data-bs-target="#addModelModal">
                    <i class="fa-regular fa-plus"></i> Add
                </button>
            </div>
        </div>
        <div class="block-content pb-4">
            <table class="table table-bordered table-striped table-vcenter" id="model-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Name</th>
                        <th>Make</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Add Model Modal -->
<div class="modal fade" id="addModelModal" tabindex="-1" aria-labelledby="addModelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModelModalLabel">Add New Model</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addModelForm">
                    <div class="row mb-3">
                        <div class="col-md-9">
                            <label for="modelName" class="form-label">Model Name</label>
                            <input type="text" class="form-control" id="modelName" name="modelName" required>
                        </div>
                        <div class="col-md-3">
                            <label for="modelYear" class="form-label">Year</label>
                            <input type="number" class="form-control" id="modelYear" name="modelYear" min="1900" max="2099" value="<?php echo date('Y'); ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="makeId" class="form-label">Make</label>
                        <div class="input-group">
                            <select class="form-select" id="makeId" name="makeId" required>
                                <option value="">Select Make</option>
                                <?php foreach ($data['Makes'] as $make): ?>
                                    <option value="<?php echo $make['id']; ?>"><?php echo $make['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#quickAddMakeModal">
                                <i class="fa fa-plus"></i> Add New
                            </button>
                        </div>
                    </div>
                    
                    <!-- Các trường khác nếu cần -->
                    <div class="mb-3">
                        <label for="modelDescription" class="form-label">Description (Optional)</label>
                        <textarea class="form-control" id="modelDescription" name="modelDescription" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveModelBtn">Save Model</button>
            </div>
        </div>
    </div>
</div>

<!-- Quick Add Make Modal (Nested) -->
<div class="modal fade" id="quickAddMakeModal" tabindex="-1" aria-labelledby="quickAddMakeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quickAddMakeModalLabel">Quick Add Make</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="quickAddMakeForm">
                    <div class="mb-3">
                        <label for="quickMakeName" class="form-label">Make Name</label>
                        <input type="text" class="form-control" id="quickMakeName" name="quickMakeName" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveQuickMakeBtn">Save & Select</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý khi nhấn nút Save Model
    document.getElementById('saveModelBtn').addEventListener('click', function() {
        const modelData = {
            name: document.getElementById('modelName').value,
            year: document.getElementById('modelYear').value,
            makeId: document.getElementById('makeId').value,
            description: document.getElementById('modelDescription').value
        };
        
        if (!modelData.name || !modelData.makeId) {
            alert('Please fill all required fields');
            return;
        }
        
        fetch('/models/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(modelData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('addModelModal')).hide();
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred');
        });
    });
    
    // Xử lý khi nhấn nút Save Quick Make
    document.getElementById('saveQuickMakeBtn').addEventListener('click', function() {
        const makeName = document.getElementById('quickMakeName').value;
        
        if (!makeName) {
            alert('Please enter make name');
            return;
        }
        
        fetch('/makes/quick-add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ name: makeName })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Thêm option mới vào select
                const makeSelect = document.getElementById('makeId');
                const newOption = new Option(makeName, data.id, true, true);
                makeSelect.add(newOption);
                
                // Đóng modal quick add
                bootstrap.Modal.getInstance(document.getElementById('quickAddMakeModal')).hide();
                
                // Reset form
                document.getElementById('quickAddMakeForm').reset();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred');
        });
    });
    
    // Reset form khi modal đóng
    document.getElementById('addModelModal').addEventListener('hidden.bs.modal', function() {
        document.getElementById('addModelForm').reset();
    });
    
    document.getElementById('quickAddMakeModal').addEventListener('hidden.bs.modal', function() {
        document.getElementById('quickAddMakeForm').reset();
    });
});
</script>