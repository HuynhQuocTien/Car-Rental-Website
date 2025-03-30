Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);

Dashmix.onLoad((() => class {
  static initValidation() {
    Dashmix.helpers("jq-validation"), jQuery("#addMakeForm").validate({
      rules: {
        "makeName": {
          required: !0
        },
        "country": {
          required: !0
        },
      },
      messages: {
        "makeName": {
          required: "Please enter make name",
        },
        "country": {
          required: "Please enter country name",
        }
      }
    })
  }
  static init() {
    this.initValidation()
  }
}.init()));

const renderData = function (makes) {
    let html = "";
    makes.forEach((make) => {
      html += `<tr>
        <td>${make.MakeID}</td>
        <td>${make.MakeName}</td>
        <td>${make.Country}</td>
        <td class="text-center">
          <div class="btn-group">
            <button class="btn btn-sm btn-alt-secondary js-edit" 
                    data-id="${make.MakeID}"
                    data-name="${make.MakeName}"
                    data-country="${make.Country}"
                    title="Edit">
              <i class="fa fa-pencil-alt"></i>
            </button>
            <button class="btn btn-sm btn-alt-secondary js-delete" 
                    data-id="${make.MakeID}"
                    title="Delete">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </td>
      </tr>`;
    });
    
    $("#list-make").html(html);
    $('[data-bs-toggle="tooltip"]').tooltip();
  };

  $(".btn-add").off('submit').on("click", function (e) {
    $("#makeId").val(""); 
    $("#makeName").val("");
    $("#country").val("");

    $("#makeIdContainer").addClass("d-none"); // Ẩn thẻ ID
    $("#addMakeModalLabel").text("Add New Make");

    $("#saveMakeBtn").show();
    $("#updateMakeBtn").hide();

    $("#addMakeModal").modal("show");

  });

  $("#saveMakeBtn").off('submit').on("click", function (e) {
    e.preventDefault();
    let name = $("#makeName").val();
    let country = $("#country").val();
    // Validate
    if ($("#addMakeForm").valid()) {
      $.ajax({
        type: "post",
        url: BaseUrl + "vehicles/addMake",
        data: {
          name: name,
          country: country,
        },
        dataType: "json",
        success: function (response) {
            console.log(response.valid)
            $("#addMakeModal").modal("hide");
            $("#makeName").val("");
            $("#country").val("");
          Dashmix.helpers('jq-notify', { type: 'success', icon: 'fa fa-check me-1', message: `Make added successfully!`,
            z_index: 9999,
          });
          mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
        },
      });
    } else {
      Dashmix.helpers('jq-notify', { type: 'danger', icon: 'fa fa-times me-1', message: `Add Make failed!` });
    }
  });

  $(document).on("click", ".js-edit", function () {
    let id = $(this).data("id");
    let name = $(this).data("name");

    $("#makeId").val(id);
    $("#makeName").val(name);
    $("#country").val($(this).data("country"));
    
    $("#makeIdContainer").removeClass("d-none"); // Hiện thẻ ID
    $("#addMakeModalLabel").text("Update Make");
    
    $("#saveMakeBtn").hide();
    $("#updateMakeBtn").show().attr("data-id", id);
    
    $("#addMakeModal").modal("show");
});

$("#updateMakeBtn").off('submit').click(function (e) {
  e.preventDefault();
  let id = $("#makeId").val();
  let name = $("#makeName").val();
  if ($("#addMakeForm").valid()) {
    $.ajax({
      type: "post",
      url: BaseUrl + "vehicles/updateMake",
      data: {
        id: id,
        name: name,
        country: $("#country").val(),
      },
      success: function (response) {
        console.log(response.valid)
        $("#addMakeModal").modal("hide");
        $("#makeName").val("");
        $("#country").val("");
        Dashmix.helpers('jq-notify', { type: 'success', icon: 'fa fa-check me-1', message: `Make updated successfully!`,
          z_index: 9999,
        });
        mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
        
      },
    });
    } else {
        Dashmix.helpers('jq-notify', { type: 'danger', icon: 'fa fa-times me-1', message: `Update make failed!` });
    }
});



const mainPagePagination = new Pagination();
mainPagePagination.option.controller = "vehicles";
mainPagePagination.option.model = "MakeModel";
mainPagePagination.option.limit = 5;
mainPagePagination.option.filter = {};
mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
