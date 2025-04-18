
Dashmix.helpersOnLoad(['jq-select2']);

const renderData = function (vehicles) {
    let html = "";
    vehicles.forEach((vehicle) => {
        html += `
        <div class="col-md-6 col-xl-4">
            <!-- Vehicle -->
            <div class="block block-rounded">
                <div class="block-content p-0 overflow-hidden">
                    <a class="img-link img-fluid-100" data-toggle="layout"
                        data-action="side_overlay_open" href="javascript:void(0)">
                        <img class="img-fluid rounded-top" src="https://res.cloudinary.com/dapudsvwl/image/upload/v1745000059/dvgjjnwwutuqdrqnpatz.jpg"
                            alt="">
                    </a>
                </div>
                <div class="block-content">
                    <h4 class="h6 mb-2">${vehicle.MakeName} ${vehicle.ModelName}</h4>
                    <h5 class="h2 fw-light push">
                        $${vehicle.DailyPrice} <span class="fs-3 text-muted">per day</span>
                    </h5>
                </div>
                <div class="block-content p-0">
                    <div class="row text-center m-0 border-top border-bottom bg-body-light">
                        <div class="col-6 border-end">
                            <p class="py-3 mb-0">
                                <!-- Icon seats -->
                                <svg width="30" height="30" ...></svg>
                                <strong>${vehicle.Seats}</strong> Seats
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="py-3 mb-0">
                                <!-- Icon fuel -->
                                <svg width="32" height="32" ...></svg>
                                <strong>RON 95</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-6">
                            <a class="btn btn-sm btn-primary w-100" href="javascript:void(0)">
                                Rent
                            </a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-sm btn-alt-primary w-100 js-detail-vehicle" 
                               data-id="${vehicle.VehicleDetailID}">
                                View
                            </a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <a class="btn btn-sm btn-outline-primary w-100 js-add-detail" 
                               data-id="${vehicle.VehicleDetailID}">
                                Add to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
    });

    $("#list-vehicles").html(html);
};

// Initialize pagination for vehicles
const vehiclePagination = new Pagination();
vehiclePagination.option.controller = "vehicles";
vehiclePagination.option.model = "VehicleDetailModel";
vehiclePagination.option.limit = 9;
vehiclePagination.option.filter = {};
vehiclePagination.getPagination(
vehiclePagination.option,
vehiclePagination.valuePage.curPage
);


// let categories = [],
//   colors = [],
//   brands = [],
//   prices = [];

// $("[name='categories']").on("click", function(t) {
//   let id = parseInt($(this).val());
//   let index = categories.findIndex(c => c == id);
//   if (index != -1) {
//       categories.splice(index, 1);
//   } else {
//       categories.push(id);
//   }
// })

// $("[name='colors']").on("click", function(t) {
//   let id = parseInt($(this).val());
//   let index = colors.findIndex(c => c == id);
//   if (index != -1) {
//       colors.splice(index, 1);
//   } else {
//       colors.push(id);
//   }
// })

// $("[name='brands']").on("click", function(t) {
//   let id = parseInt($(this).val());
//   let index = brands.findIndex(c => c == id);
//   if (index != -1) {
//       brands.splice(index, 1);
//   } else {
//       brands.push(id);
//   }
// })

// $("[name='prices']").on("click", function(t) {
//   let id = $(this).val();
//   let index = prices.findIndex(c => c == id);
//   if (index != -1) {
//       prices.splice(index, 1);
//   } else {
//       prices.push(id);
//   }
// })


// $(".filters_listing_1 .dropdown-menu .filter_type ul").on("click", function(t) {
//   t.stopPropagation()
// })

// const getBadge = (value) => {
//   let result = '';
//   switch (value) {
//       case false:
//           result = `<span class="badge rounded-pill bg-warning">Draft</span>`;
//           break;
//       case true:
//           result = `<span class="badge rounded-pill bg-success">Public</span>`;
//           break;
//       default:
//           result = `<span class="badge rounded-pill bg-secondary">Unknown</span>`;
//   }
//   return result;
// };


// $(document).ready(function() {
//   jQuery.extend(jQuery.fn.dataTable.ext.classes, {
//       sWrapper: "dataTables_wrapper dt-bootstrap5",
//       sFilterInput: "form-control",
//       sLengthSelect: "form-select"
//   });
//   jQuery.extend(!0, jQuery.fn.dataTable.defaults, {
//       language: {
//           lengthMenu: "_MENU_",
//           search: "_INPUT_",
//           searchPlaceholder: "Search..",
//           info: "Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",
//           paginate: {
//               first: '<i class="fa fa-angle-double-left"></i>',
//               previous: '<i class="fa fa-angle-left"></i>',
//               next: '<i class="fa fa-angle-right"></i>',
//               last: '<i class="fa fa-angle-double-right"></i>'
//           }
//       }
//   });
//   // var table = $("#vehicle-table").DataTable({
//   // 	pageLength: 10,
//   // 	lengthMenu: [
//   // 		[5, 10, 20],
//   // 		[5, 10, 20]
//   // 	],
//   // 	"processing": true,
//   // 	"serverSide": true,
//   // 	"filter": false,
//   // 	"lengthChange": false,
//   // 	// // "ajax": {
//   // 	// // 	"url": "/admin/products/getproducts",
//   // 	// // 	"type": "POST",
//   // 	// // 	"datatype": "json",
//   // 	// // 	"data": function (d) {
//   // 	// // 		d.query = $('#product-query').val();
//   // 	// // 		d.categories = categories;
//   // 	// // 		d.colors = colors;
//   // 	// // 		d.brands = brands;
//   // 	// // 		d.prices = prices;
//   // 	// // 	}
//   // 	// // },
//   // 	// "columnDefs": [
//   // 		{ "targets": [3,4,6], "sortable": false },
//   // 	],
//   // 	"columns": [
//   // 		{ "data": "id", "name": "Id", "autoWidth": true, "className": "text-center" },
//   // 		{
//   // 			"data": "name", "name": "Name", 
//   // 			"render": function (data, type, row) {
//   // 				return `<div class="d-flex gap-2 align-items-center">
//   // 														<img class="rounded" style="width: 40px; height: 40px" src="/img/products/${row.thumbnail.name}" />
//   // 										${row.name}
//   // 									</div>`;
//   // 			},
//   // 		},
//   // 		{ "data": "price", "name": "Price", "autoWidth": true, "className": "text-center fw-bold", render: (data) => `$${data}` },
//   // 		{ "data": "category.name", "name": "Category", "autoWidth": true},
//   // 		{ "data": "brand.name", "name": "Brand", "autoWidth": true },
//   // 		{ "data": "status", "name": "Status", "autoWidth": true, "render": (data) => getBadge(data) },
//   // 		{
//   // 			"render": function (data, type, row) {
//   // 				return `<div class="btn-group">
//   // 									<a href="/products/${row.slug}" class="btn btn-sm btn-alt-secondary" >
//   // 									  <i class="fa fa-eye"></i>
//   // 									</a>
//   // 									<a href="/admin/products/edit/${row.id}" class="btn btn-sm btn-alt-secondary">
//   // 									  <i class="fa fa-pencil-alt"></i>
//   // 									</a>
//   // 									<button type="button" data-id="${row.id}" class="btn btn-sm btn-alt-secondary btn-delete">
//   // 									   <i class="fa fa-times"></i>
//   // 									</button></div>`;
//   // 			}, "className": "text-center"
//   // 		}
//   // 	],
//   // 	order: [
//   // 		[0, 'desc']
//   // 	],
//   // 	autoWidth: !1,
//   // 	responsive: !0
//   // });

//   $('#product-query').on('change', function() {
//       table.draw();
//   });

//   $("[name='categories'],[name='colors'],[name='brands'],[name='prices']").on('click', function() {
//       table.draw();
//   });
// });

// $(document).on("click", ".btn-delete", async function() {
//   let trid = $(this).data("id");
//   let result = await Swal.fire({
//       title: "Are you sure?",
//       text: "Would you like to delete this product?",
//       icon: "warning",
//       showCancelButton: true,
//       confirmButtonText: "Yes, I'm sure",
//       cancelButtonText: "Cannel"
//   });

//   if (result.value) {
//       try {
//           let response = await $.post(`./Products/Delete/${trid}`);
//           Swal.fire("Deleted!", "Successfully deleted the product.", "success");
//           $(this).closest('tr').remove();
//       } catch (error) {
//           console.error("Error:", error);
//           Swal.fire("Lỗi !", "Deletion of the product was not successful.", "error");
//       }
//   }
// });

// // END Vehicle Management