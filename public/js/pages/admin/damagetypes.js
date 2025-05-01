Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);

Dashmix.onLoad((() => class {
  static initValidation() {
    Dashmix.helpers("jq-validation"), jQuery("#damageTypeForm").validate({
      rules: {
        "DamageName": {
          required: !0
        },
        "FineAmount": {
          required: !0
        },
        "VehicleTypesID": {
          required: !0
        },
      },
      messages: {
        "Name": {
          required: "Please enter Color name",
        }
      }
    })
  }
  static init() {
    this.initValidation()
  }
}.init()));

const renderData = function (data) {
    let html = "";
    data.forEach((item) => {
        let nameType = item.VehicleTypesID + " - " + item.NameType;
      html += `<tr>
        <td>${item.DamageTypeID}</td>
        <td>${item.DamageName}</td>
        <td>${item.FineAmount}</td>
        <td>${nameType}</td>
        <td class="text-center">
          <div class="btn-group">
          <button class="btn btn-sm btn-alt-secondary js-view"
                  data-id="${item.DamageTypeID}"
                  data-name="${item.DamageName}"
                  data-fine="${item.FineAmount}"
                  data-vid="${item.VehicleTypesID}"
                  title="View details">
           <i class="fa fa-eye me-1"></i>
          </button>
            <button class="btn btn-sm btn-alt-secondary js-edit" 
                    data-id="${item.DamageTypeID}"
                    data-name="${item.DamageName}"
                    data-fine="${item.FineAmount}"
                    data-vid="${item.VehicleTypesID}"
                    title="Edit">
              <i class="fa fa-pencil-alt"></i>
            </button>
            <button class="btn btn-sm btn-alt-secondary js-delete" 
                    data-id="${item.DamageTypeID}"
                    title="Delete">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </td>
      </tr>`;
    });
    
    $("#list-damageTypes").html(html);
    $('[data-bs-toggle="tooltip"]').tooltip();
  };

  $(".btn-add").off('submit').on("click", function (e) {
    $("#DamageTypeID").val("").prop("disabled", false);
    $("#DamageName").val("").prop("disabled", false);
    $("#FineAmount").val("").prop("disabled", false);
    $("#VehicleTypeID").val("").prop("disabled", false);

    $(".title-add").show();
    $(".title-update").hide();
    $(".title-view").hide();
    

    $("#saveBtn").show();
    $("#updateBtn").hide();

    $("#addModelForm").modal("show");

  });

  $("#saveBtn").off('submit').on("click", function (e) {
    e.preventDefault();
    // Validate
    if ($("#damageTypeForm").valid()) {
      $.ajax({
        type: "post",
        url: BaseUrl + "inspections/addDamageType",
        data: {
          DamageName: $("#DamageName").val(),
          FineAmount: $("#FineAmount").val(),
          VehicleTypesID: $("#VehicleTypeID").val(),
        },
        dataType: "json",
        success: function (response) {
          console.log(response.valid)
          $("#addModelForm").modal("hide");
          $("#DamageName").val("");
          $("#FineAmount").val("");
          $("#VehicleTypeID").val("");
          Dashmix.helpers('jq-notify', { type: 'success', icon: 'fa fa-check me-1', message: `Added successfully!`,
            z_index: 9999,
          });
          mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
        },
      });
    } else {
      Dashmix.helpers('jq-notify', { type: 'danger', icon: 'fa fa-times me-1', message: `Add failed!` });
    }
  });
  

  $(document).on("click", ".js-edit", function () {
    let id = $(this).data("id");
    let name = $(this).data("name");
    let fine = $(this).data("fine");
    let vehicleType = $(this).data("vid");
    $(".title-add").hide();
    $(".title-update").show();
    $(".title-view").hide();

    $("#DamageTypeID").val(id);
    $("#DamageName").val(name).prop("disabled", false);
    $("#FineAmount").val(fine).prop("disabled", false);
    $("#VehicleTypeID").val(vehicleType).prop("disabled", false);
    
    $("#saveBtn").hide();
    $("#updateBtn").show().attr("data-id", id);
    
    $("#addModelForm").modal("show");
});

$("#updateBtn").off('submit').on("click", function (e) {
  e.preventDefault();
  // Validate
  if ($("#damageTypeForm").valid()) {
    $.ajax({
      type: "post",
      url: BaseUrl + "inspections/updateDamageType",
      data: {
        DamageTypeID: $(this).data("id"),
        DamageName: $("#DamageName").val(),
        FineAmount: $("#FineAmount").val(),
        VehicleTypesID: $("#VehicleTypeID").val(),
      },
      dataType: "json",
      success: function (response) {
        console.log(response.valid)
        $("#addModelForm").modal("hide");
        $("#DamageName").val("");
        $("#FineAmount").val("");
        $("#VehicleTypeID").val("");
        Dashmix.helpers('jq-notify', { type: 'success', icon: 'fa fa-check me-1', message: `Added successfully!`,
          z_index: 9999,
        });
        mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
      },
    });
  } else {
    Dashmix.helpers('jq-notify', { type: 'danger', icon: 'fa fa-times me-1', message: `Add failed!` });
  }
});

  $(document).on("click", ".js-view", function () {
    let id = $(this).data("id");
    let name = $(this).data("name");
    let fine = $(this).data("fine");
    let vehicleType = $(this).data("vid");
    $(".title-add").hide();
    $(".title-update").show();
    $(".title-view").hide();

    $("#DamageTypeID").val(id);
    $("#DamageName").val(name).prop("disabled", true);
    $("#FineAmount").val(fine).prop("disabled", true);
    $("#VehicleTypeID").val(vehicleType).prop("disabled", true);
    
    $("#saveBtn").hide();
    $("#updateBtn").hide();
    
    $("#addModelForm").modal("show");
});


$(document).on("click", ".js-delete", function () {
  const id = $(this).data("id");

  Swal.fire({
    title: "Are you sure you want to delete this customer?",
    text: "This action cannot be undone!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Delete",
    cancelButtonText: "Cancel"
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: BaseUrl + "inspections/deleteDamageType",
        data: {
          DamageTypeID: id,
        },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            Swal.fire("Deleted!", "The customer has been successfully deleted.", "success");
            mainPagePagination.getPagination(
              mainPagePagination.option,
              mainPagePagination.valuePage.curPage
            );
          } else {
            Swal.fire("Failed!", response.message || "Failed to delete the customer!", "error");
          }
        },
        error: function () {
          Swal.fire("Error!", "An error occurred while deleting the customer.", "error");
        }
      });
    }
  });
});



const mainPagePagination = new Pagination();
mainPagePagination.option.controller = "inspections";
mainPagePagination.option.model = "DamageTypeModel";
mainPagePagination.option.limit = 5;
mainPagePagination.option.filter = {};
mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
