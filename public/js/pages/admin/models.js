Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);

Dashmix.onLoad((() => class {
    static initValidation() {
      Dashmix.helpers("jq-validation"), jQuery("#addModelForm").validate({
        rules: {
          "modelName": {
            required: !0
          },
          "makeId": {
            required: !0
          },
          "vehicleType": {
            required: !0
          }
        },
        messages: {
          "modelName": {
            required: "Please enter model name",
          },
          "makeId": {
            required: "Please select a make",
          },
          "vehicleType": {
            required: "Please select a vehicle type",
          }
        }
      })
    }
    static init() {
      this.initValidation()
    }
  }.init()));
  
  const renderData = function (models) {
    console.log(models);
    let html = "";
    models.forEach((model) => {
      html += `<tr>
        <td>${model.ModelID}</td>
        <td>${model.ModelName}</td>
        <td>${model.MakeName}</td>
        <td>${model.NameType}</td>
        <td class="text-center">
          <div class="btn-group">
            <button class="btn btn-sm btn-alt-secondary js-edit" 
                    data-id="${model.ModelID}"
                    data-name="${model.ModelName}"
                    data-makeid="${model.MakeID}"
                    data-vehicletype="${model.VehicleTypesID}"
                    data-nametype="${model.NameType}"
                    title="Edit">
              <i class="fa fa-pencil-alt"></i>
            </button>
            <button class="btn btn-sm btn-alt-secondary js-delete" 
                    data-id="${model.ModelID}"
                    title="Delete">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </td>
      </tr>`;
    });
    
    $("#list-model").html(html);
    $('[data-bs-toggle="tooltip"]').tooltip();
  };
  
  // Xử lý nút Add
  $(".btn-add").on("click", function (e) {
    $("#modelId").val(""); 
    $("#modelName").val("");
    $("#makeId").val("");
    $("#vehicleType").val("");
  
    $("#modelIdContainer").addClass("d-none");
    $("#addModelModalLabel").text("Add New Model");
  
    $("#updateModelBtn").hide();
    $("#saveModelBtn").show();
  
    $("#addModelModal").modal("show");
  });
  
  // Xử lý nút Save
  $("#saveModelBtn").on("click", function (e) {
    e.preventDefault();
    
    if ($("#addModelForm").valid()) {
      $.ajax({
        type: "post",
        url: BaseUrl + "vehicles/addModel",
        data: {
          name: $("#modelName").val(),
          makeId: $("#makeId").val(),
          vehicleType: $("#vehicleType").val()
        },
        dataType: "json",
        success: function (response) {
          if (response) {
            $("#addModelModal").modal("hide");
            Dashmix.helpers('jq-notify', { 
              type: 'success', 
              icon: 'fa fa-check me-1', 
              message: 'Model added successfully!',
              z_index: 9999,
            });
            mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
          } else {
            Dashmix.helpers('jq-notify', { 
              type: 'danger', 
              icon: 'fa fa-times me-1', 
              message: response.message || 'Add Model failed!'
            });
          }
        },
        error: function() {
          Dashmix.helpers('jq-notify', { 
            type: 'danger', 
            icon: 'fa fa-times me-1', 
            message: 'Error occurred while adding model'
          });
        }
      });
    }
  });
  
  // Xử lý nút Edit
  $(document).on("click", ".js-edit", function () {
    let id = $(this).data("id");
    let name = $(this).data("name");
  
    $("#modelId").val(id);
    $("#modelName").val(name);
    $("#makeId").val($(this).data("makeid"));
    $("#vehicleType").val($(this).data("vehicletype"));
    
    $("#modelIdContainer").removeClass("d-none");
    $("#addModelModalLabel").text("Update Model");
    
    $("#saveModelBtn").hide();
    $("#updateModelBtn").show().attr("data-id", id);
    
    $("#addModelModal").modal("show");
  });
  
  // Xử lý nút Update
  $("#updateModelBtn").on("click", function (e) {
    e.preventDefault();
    
    if ($("#addModelForm").valid()) {
      $.ajax({
        type: "post",
        url: BaseUrl + "vehicles/updateModel",
        data: {
          id: $("#modelId").val(),
          name: $("#modelName").val(),
          makeId: $("#makeId").val(),
          vehicleType: $("#vehicleType").val()
        },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            $("#addModelModal").modal("hide");
            Dashmix.helpers('jq-notify', { 
              type: 'success', 
              icon: 'fa fa-check me-1', 
              message: 'Model updated successfully!',
              z_index: 9999,
            });
            mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
          } else {
            Dashmix.helpers('jq-notify', { 
              type: 'danger', 
              icon: 'fa fa-times me-1', 
              message: response.message || 'Update model failed!'
            });
          }
        },
        error: function() {
          Dashmix.helpers('jq-notify', { 
            type: 'danger', 
            icon: 'fa fa-times me-1', 
            message: 'Error occurred while updating model'
          });
        }
      });
    }
  });
  
  // Xử lý nút Delete (nếu cần)
  $(document).on("click", ".js-delete", function () {
    const id = $(this).data("id");
    
    // Hiển thị confirm dialog trước khi xóa
    if (confirm("Are you sure you want to delete this model?")) {
      $.ajax({
        type: "post",
        url: BaseUrl + "vehicles/deleteModel",
        data: { id: id },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            Dashmix.helpers('jq-notify', { 
              type: 'success', 
              icon: 'fa fa-check me-1', 
              message: 'Model deleted successfully!',
              z_index: 9999,
            });
            mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
          } else {
            Dashmix.helpers('jq-notify', { 
              type: 'danger', 
              icon: 'fa fa-times me-1', 
              message: response.message || 'Delete model failed!'
            });
          }
        },
        error: function() {
          Dashmix.helpers('jq-notify', { 
            type: 'danger', 
            icon: 'fa fa-times me-1', 
            message: 'Error occurred while deleting model'
          });
        }
      });
    }
  });



const mainPagePagination = new Pagination();
mainPagePagination.option.controller = "vehicles";
mainPagePagination.option.model = "ModelModel";
mainPagePagination.option.limit = 5;
mainPagePagination.option.filter = {};
mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
