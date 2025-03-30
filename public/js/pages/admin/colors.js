Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);

Dashmix.onLoad((() => class {
  static initValidation() {
    Dashmix.helpers("jq-validation"), jQuery("#addColorForm").validate({
      rules: {
        "colorName": {
          required: !0
        },
      },
      messages: {
        "colorName": {
          required: "Please enter Color name",
        }
      }
    })
  }
  static init() {
    this.initValidation()
  }
}.init()));

const renderData = function (colors) {
    let html = "";
    colors.forEach((color) => {
      html += `<tr>
        <td>${color.ColorID}</td>
        <td>${color.ColorName}</td>
        <td class="text-center">
          <div class="btn-group">
            <button class="btn btn-sm btn-alt-secondary js-edit" 
                    data-id="${color.ColorID}"
                    data-name="${color.ColorName}"
                    title="Edit">
              <i class="fa fa-pencil-alt"></i>
            </button>
            <button class="btn btn-sm btn-alt-secondary js-delete" 
                    data-id="${color.ColorID}"
                    title="Delete">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </td>
      </tr>`;
    });
    
    $("#list-color").html(html);
    $('[data-bs-toggle="tooltip"]').tooltip();
  };

  $(".btn-add").off('submit').on("click", function (e) {
    $("#colorId").val(""); 
    $("#colorName").val("");

    $("#colorIdContainer").addClass("d-none"); // Ẩn thẻ ID
    $("#addColorModalLabel").text("Add New Color");

    $("#saveColorBtn").show();
    $("#updateColorBtn").hide();

    $("#addColorModal").modal("show");

  });

  $("#saveColorBtn").off('submit').on("click", function (e) {
    e.preventDefault();
    let name = $("#colorName").val();
    // Validate
    if ($("#addColorForm").valid()) {
      $.ajax({
        type: "post",
        url: BaseUrl + "vehicles/addColor",
        data: {
          name: name,
        },
        dataType: "json",
        success: function (response) {
          console.log(response.valid)
          $("#addColorModal").modal("hide");
          $("#colorName").val("");
          Dashmix.helpers('jq-notify', { type: 'success', icon: 'fa fa-check me-1', message: `Color added successfully!`,
            z_index: 9999,
          });
          mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
        },
      });
    } else {
      Dashmix.helpers('jq-notify', { type: 'danger', icon: 'fa fa-times me-1', message: `Add Color failed!` });
    }
  });

  $(document).on("click", ".js-edit", function () {
    let id = $(this).data("id");
    let name = $(this).data("name");

    $("#colorId").val(id);
    $("#colorName").val(name);
    
    $("#colorIdContainer").removeClass("d-none"); // Hiện thẻ ID
    $("#addColorModalLabel").text("Update Color");
    
    $("#saveColorBtn").hide();
    $("#updateColorBtn").show().attr("data-id", id);
    
    $("#addColorModal").modal("show");
});

$("#updateColorBtn").off('submit').click(function (e) {
  e.preventDefault();
  let id = $("#colorId").val();
  let name = $("#colorName").val();
  if ($("#addColorForm").valid()) {
    $.ajax({
      type: "post",
      url: BaseUrl + "vehicles/updateColor",
      data: {
        id: id,
        name: name,
      },
      success: function (response) {
        console.log(response.valid)
        $("#addColorModal").modal("hide");
        $("#colorName").val("");
        Dashmix.helpers('jq-notify', { type: 'success', icon: 'fa fa-check me-1', message: `Color updated successfully!`,
          z_index: 9999,
        });
        mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
        
      },
    });
    } else {
        Dashmix.helpers('jq-notify', { type: 'danger', icon: 'fa fa-times me-1', message: `Update Color failed!` });
    }
});



const mainPagePagination = new Pagination();
mainPagePagination.option.controller = "vehicles";
mainPagePagination.option.model = "ColorModel";
mainPagePagination.option.limit = 5;
mainPagePagination.option.filter = {};
mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
