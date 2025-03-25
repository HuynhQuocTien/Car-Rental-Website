  <!-- <script src="../public/js/jquery.min.js"></script>
  <script src="../public/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="../public/js/popper.min.js"></script>
  <script src="../public/js/bootstrap.min.js"></script>
  <script src="../public/js/jquery.easing.1.3.js"></script>
  <script src="../public/js/jquery.waypoints.min.js"></script>
  <script src="../public/js/jquery.stellar.min.js"></script>
  <script src="../public/js/owl.carousel.min.js"></script>
  <script src="../public/js/jquery.magnific-popup.min.js"></script>
  <script src="../public/js/aos.js"></script>
  <script src="../public/js/jquery.animateNumber.min.js"></script>
  <script src="../public/js/bootstrap-datepicker.js"></script>
  <script src="../public/js/jquery.timepicker.min.js"></script>
  <script src="../public/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="../public/js/google-map.js"></script>
  <script src="../public/js/main.js"></script>
  <script src="../public/js/chat.js"></script> -->


  <script src="../public/js/plugins/jquery-validation/jquery.validate.js"></script>

  <!-- jQuery (required for BS Datepicker plugin) -->

  <!-- Page JS Plugins -->
  <script src="../public/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="../public/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
  <script src="../public/js/plugins/slick-carousel/slick.min.js"></script>
  <script src="../public/js/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="../public/js/plugins/select2/js/select2.full.min.js"></script>
  <script src="../public/js/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../public/js/plugins/bootstrap-notify/bootstrap-notify.js"></script>
  <!-- <script src="../public/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script> -->

  <!-- Page JS Helpers (BS Datepicker plugin) -->
  <script>
Dashmix.helpersOnLoad(['jq-datepicker', 'jq-rangeslider', 'jq-slick']);
  </script>
  <!-- Script to handle form switching -->
  <script>
document.getElementById('btnLogin').addEventListener('click', () => {
    document.getElementById('registerForm').classList.add('d-none');
    document.getElementById('forgotPasswordForm').classList.add('d-none');
    document.getElementById('forgotPasswordForm').classList.add('d-none');
    document.getElementById('resetPasswordForm').classList.add('d-none');
    document.getElementById('loginForm').classList.remove('d-none');
});
document.getElementById('showRegister').addEventListener('click', () => {
    document.getElementById('loginForm').classList.add('d-none');
    document.getElementById('registerForm').classList.remove('d-none');
});

document.getElementById('showForgotPassword').addEventListener('click', () => {
    document.getElementById('loginForm').classList.add('d-none');
    document.getElementById('forgotPasswordForm').classList.remove('d-none');
});
document.getElementById('sendOTP').addEventListener('click', () => {
    document.getElementById('forgotPasswordForm').classList.add('d-none');
    document.getElementById('otpForm').classList.remove('d-none');
});
document.getElementById('comfirmOTP').addEventListener('click', () => {
    document.getElementById('otpForm').classList.add('d-none');
    document.getElementById('resetPasswordForm').classList.remove('d-none');
});
document.getElementById('backToLogin').addEventListener('click', () => {
    document.getElementById('registerForm').classList.add('d-none');
    document.getElementById('loginForm').classList.remove('d-none');
});

document.getElementById('backToLoginFromForgot').addEventListener('click', () => {
    document.getElementById('forgotPasswordForm').classList.add('d-none');
    document.getElementById('loginForm').classList.remove('d-none');
});
  </script>
  <?php 
    if($data['Page'] == "home"){
        echo "<script>
$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    autoclose: true
});

$('.carousel').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    adaptiveHeight: true
});
</script>";
    }
  ?>
  <!-- Vehicle Management -->
  <script>
Dashmix.helpersOnLoad(['jq-select2']);
  </script>
  <script>
let categories = [],
    colors = [],
    brands = [],
    prices = [];

$("[name='categories']").on("click", function(t) {
    let id = parseInt($(this).val());
    let index = categories.findIndex(c => c == id);
    if (index != -1) {
        categories.splice(index, 1);
    } else {
        categories.push(id);
    }
})

$("[name='colors']").on("click", function(t) {
    let id = parseInt($(this).val());
    let index = colors.findIndex(c => c == id);
    if (index != -1) {
        colors.splice(index, 1);
    } else {
        colors.push(id);
    }
})

$("[name='brands']").on("click", function(t) {
    let id = parseInt($(this).val());
    let index = brands.findIndex(c => c == id);
    if (index != -1) {
        brands.splice(index, 1);
    } else {
        brands.push(id);
    }
})

$("[name='prices']").on("click", function(t) {
    let id = $(this).val();
    let index = prices.findIndex(c => c == id);
    if (index != -1) {
        prices.splice(index, 1);
    } else {
        prices.push(id);
    }
})


$(".filters_listing_1 .dropdown-menu .filter_type ul").on("click", function(t) {
    t.stopPropagation()
})

const getBadge = (value) => {
    let result = '';
    switch (value) {
        case false:
            result = `<span class="badge rounded-pill bg-warning">Draft</span>`;
            break;
        case true:
            result = `<span class="badge rounded-pill bg-success">Public</span>`;
            break;
        default:
            result = `<span class="badge rounded-pill bg-secondary">Unknown</span>`;
    }
    return result;
};


$(document).ready(function() {
    jQuery.extend(jQuery.fn.dataTable.ext.classes, {
        sWrapper: "dataTables_wrapper dt-bootstrap5",
        sFilterInput: "form-control",
        sLengthSelect: "form-select"
    });
    jQuery.extend(!0, jQuery.fn.dataTable.defaults, {
        language: {
            lengthMenu: "_MENU_",
            search: "_INPUT_",
            searchPlaceholder: "Search..",
            info: "Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",
            paginate: {
                first: '<i class="fa fa-angle-double-left"></i>',
                previous: '<i class="fa fa-angle-left"></i>',
                next: '<i class="fa fa-angle-right"></i>',
                last: '<i class="fa fa-angle-double-right"></i>'
            }
        }
    });
    // var table = $("#vehicle-table").DataTable({
    // 	pageLength: 10,
    // 	lengthMenu: [
    // 		[5, 10, 20],
    // 		[5, 10, 20]
    // 	],
    // 	"processing": true,
    // 	"serverSide": true,
    // 	"filter": false,
    // 	"lengthChange": false,
    // 	// // "ajax": {
    // 	// // 	"url": "/admin/products/getproducts",
    // 	// // 	"type": "POST",
    // 	// // 	"datatype": "json",
    // 	// // 	"data": function (d) {
    // 	// // 		d.query = $('#product-query').val();
    // 	// // 		d.categories = categories;
    // 	// // 		d.colors = colors;
    // 	// // 		d.brands = brands;
    // 	// // 		d.prices = prices;
    // 	// // 	}
    // 	// // },
    // 	// "columnDefs": [
    // 		{ "targets": [3,4,6], "sortable": false },
    // 	],
    // 	"columns": [
    // 		{ "data": "id", "name": "Id", "autoWidth": true, "className": "text-center" },
    // 		{
    // 			"data": "name", "name": "Name", 
    // 			"render": function (data, type, row) {
    // 				return `<div class="d-flex gap-2 align-items-center">
    // 														<img class="rounded" style="width: 40px; height: 40px" src="/img/products/${row.thumbnail.name}" />
    // 										${row.name}
    // 									</div>`;
    // 			},
    // 		},
    // 		{ "data": "price", "name": "Price", "autoWidth": true, "className": "text-center fw-bold", render: (data) => `$${data}` },
    // 		{ "data": "category.name", "name": "Category", "autoWidth": true},
    // 		{ "data": "brand.name", "name": "Brand", "autoWidth": true },
    // 		{ "data": "status", "name": "Status", "autoWidth": true, "render": (data) => getBadge(data) },
    // 		{
    // 			"render": function (data, type, row) {
    // 				return `<div class="btn-group">
    // 									<a href="/products/${row.slug}" class="btn btn-sm btn-alt-secondary" >
    // 									  <i class="fa fa-eye"></i>
    // 									</a>
    // 									<a href="/admin/products/edit/${row.id}" class="btn btn-sm btn-alt-secondary">
    // 									  <i class="fa fa-pencil-alt"></i>
    // 									</a>
    // 									<button type="button" data-id="${row.id}" class="btn btn-sm btn-alt-secondary btn-delete">
    // 									   <i class="fa fa-times"></i>
    // 									</button></div>`;
    // 			}, "className": "text-center"
    // 		}
    // 	],
    // 	order: [
    // 		[0, 'desc']
    // 	],
    // 	autoWidth: !1,
    // 	responsive: !0
    // });

    $('#product-query').on('change', function() {
        table.draw();
    });

    $("[name='categories'],[name='colors'],[name='brands'],[name='prices']").on('click', function() {
        table.draw();
    });
});

$(document).on("click", ".btn-delete", async function() {
    let trid = $(this).data("id");
    let result = await Swal.fire({
        title: "Are you sure?",
        text: "Would you like to delete this product?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, I'm sure",
        cancelButtonText: "Cannel"
    });

    if (result.value) {
        try {
            let response = await $.post(`./Products/Delete/${trid}`);
            Swal.fire("Deleted!", "Successfully deleted the product.", "success");
            $(this).closest('tr').remove();
        } catch (error) {
            console.error("Error:", error);
            Swal.fire("Lỗi !", "Deletion of the product was not successful.", "error");
        }
    }
});
  </script>

  <!-- END Vehicle Management -->
  <script src="../public/js/pages/user/auth.js"></script>