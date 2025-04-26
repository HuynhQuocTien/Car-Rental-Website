Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);

Dashmix.onLoad((() => class {
  static initValidation() {
    Dashmix.helpers("jq-validation"), jQuery("#addVehicleTypeForm").validate({
      rules: {
        "vehicleTypeName": {
          required: !0
        },
      },
      messages: {
        "vehicleTypeName": {
          required: "Please enter vehicle type name",
        }
      }
    })
  }
  static init() {
    this.initValidation()
  }
}.init()));

const renderData = function (types) {
    let html = "";
    types.forEach((type) => {
      html += `<tr>
        <td>${type.VehicleTypesID}</td>
        <td>${type.NameType}</td>
        <td class="text-center">
          <div class="btn-group">
            <button class="btn btn-sm btn-alt-secondary js-edit" 
                    data-id="${type.VehicleTypesID}"
                    data-name="${type.NameType}"
                    title="Edit">
              <i class="fa fa-pencil-alt"></i>
            </button>
            <button class="btn btn-sm btn-alt-secondary js-delete" 
                    data-id="${type.VehicleTypesID}"
                    title="Delete">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </td>
      </tr>`;
    });
    
    $("#list-types").html(html);
    $('[data-bs-toggle="tooltip"]').tooltip();
  };

  $(".btn-add").off('submit').on("click", function (e) {
    $("#vehicleTypeId").val(""); 
    $("#vehicleTypeName").val("");

    $("#vehicleTypeIdContainer").addClass("d-none"); // Ẩn thẻ ID
    $("#addVehicleTypeModalLabel").text("Add New Vehicle Type");

    $("#saveVehicleTypeBtn").show();
    $("#updateVehicleTypeBtn").hide();

    $("#addVehicleTypeModal").modal("show");

  });

  $("#saveVehicleTypeBtn").off('submit').on("click", function (e) {
    e.preventDefault();
    let name = $("#vehicleTypeName").val();
    // Validate
    if ($("#addVehicleTypeForm").valid()) {
      $.ajax({
        type: "post",
        url: BaseUrl + "vehicles/addVehicleType",
        data: {
          name: name,
        },
        dataType: "json",
        success: function (response) {
          console.log(response.valid)
          $("#addVehicleTypeModal").modal("hide");
          $("#vehicleTypeName").val("");
          Dashmix.helpers('jq-notify', { type: 'success', icon: 'fa fa-check me-1', message: `Vehicle type added successfully!`,
            z_index: 9999,
          });
          mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
        },
      });
    } else {
      Dashmix.helpers('jq-notify', { type: 'danger', icon: 'fa fa-times me-1', message: `Add vehicle type failed!` });
    }
  });

  $(document).on("click", ".js-edit", function () {
    let id = $(this).data("id");
    let name = $(this).data("name");

    $("#vehicleTypeId").val(id); // input ID
    $("#vehicleTypeName").val(name); //input Name
    
    $("#vehicleTypeIdContainer").removeClass("d-none"); // Hiện thẻ ID
    $("#addVehicleTypeModalLabel").text("Update Vehicle Type");
    
    $("#saveVehicleTypeBtn").hide();
    $("#updateVehicleTypeBtn").show().attr("data-id", id);
    
    $("#addVehicleTypeModal").modal("show");
});

$("#updateVehicleTypeBtn").off('submit').click(function (e) {
  e.preventDefault();
  let id = $("#vehicleTypeId").val();
  let name = $("#vehicleTypeName").val();
    $.ajax({
      type: "post",
      url: BaseUrl + "vehicles/updateVehicleType",
      data: {
        id: id,
        name: name,
      },
      success: function (response) {
        console.log(response)
        $("#addVehicleTypeModal").modal("hide");
        $("#vehicleTypeName").val("");
        $("#modal-add-user").modal("hide");
        Dashmix.helpers('jq-notify', { type: 'success', icon: 'fa fa-check me-1', message: `Vehicle type updated successfully!`,
          z_index: 9999,
        });
        mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
        
      },
    });
});



const mainPagePagination = new Pagination();
mainPagePagination.option.controller = "vehicles";
mainPagePagination.option.model = "VehicleTypeModel";
mainPagePagination.option.limit = 5;
mainPagePagination.option.filter = {};
mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
