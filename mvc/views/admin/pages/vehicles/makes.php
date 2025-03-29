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
                <a class="btn btn-hero btn-primary" data-bs-toggle="modal" data-bs-target="#addMakeModal">
                    <i class="fa-regular fa-plus"></i> Add
                </a>
            </div>
        </div>
        <div class="block-content pb-4">
            <table class="table table-bordered table-striped table-vcenter" id="make-table">
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
                    <div class="mb-3">
                        <label for="makeName" class="form-label">Make Name</label>
                        <input type="text" class="form-control" id="makeName" name="makeName" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveMakeBtn">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý khi nhấn nút Save cho Make
    document.getElementById('saveMakeBtn').addEventListener('click', function() {
        const makeName = document.getElementById('makeName').value;
        const makeLogo = document.getElementById('makeLogo').files[0];
        
        // Kiểm tra dữ liệu
        if (!makeName) {
            alert('Please enter make name');
            return;
        }
        
        // Tạo FormData để gửi cả file (nếu có)
        const formData = new FormData();
        formData.append('makeName', makeName);
        if (makeLogo) {
            formData.append('makeLogo', makeLogo);
        }
        
        // Gửi dữ liệu bằng AJAX (tuỳ chỉnh theo backend của bạn)
        fetch('/makes/add', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
                // Không đặt Content-Type khi dùng FormData, trình duyệt sẽ tự thiết lập
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Đóng modal và làm mới trang hoặc cập nhật bảng
                bootstrap.Modal.getInstance(document.getElementById('addMakeModal')).hide();
                location.reload(); // hoặc cập nhật bảng bằng JavaScript
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
    document.getElementById('addMakeModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('addMakeForm').reset();
    });
});
</script>