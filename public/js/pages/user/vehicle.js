
Dashmix.helpersOnLoad(['jq-select2']);

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

// END Vehicle Management