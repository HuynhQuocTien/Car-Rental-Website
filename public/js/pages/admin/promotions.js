Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);

const renderData = function (pros) {
    let html = "";
    pros.forEach((pro, index) => {
      html += `<tr>
        <td class="text-center">${index+1}</td>
        <td class="text-center">${pro.PromotionName}</td>
        <td class="text-center">${pro.VehicleID}</td>
        <td class="text-center">${pro.DiscountType == 0 ? 'Percent' : 'Cash' }</td>
        <td class="text-center">${pro.DiscountValue == 0 ? pro.DiscountValue+'%' : pro.DiscountValue+'$'}</td>
        <td class="text-center">${pro.CreatedAt}</td>
        <td class="text-center">${pro.StartDate}</td>
        <td class="text-center">${pro.EndDate}</td>
        <td class="text-center">${pro.Status}</td>
        <td class="text-center">
          <div class="btn-group">
            <button class="btn btn-sm btn-alt-secondary js-edit-promotion"
                    data-id="${pro.PromotionID}"            
                    title="Edit">
              <i class="fa fa-pencil-alt"></i>
            </button>
            <button class="btn btn-sm btn-alt-secondary js-delete-promotion"
                    data-id="${pro.PromotionID}"
                    title="Delete">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </td>
      </tr>`;
    });
  
    $("#list-promotions").html(html);
    $('[data-bs-toggle="tooltip"]').tooltip();
  };
  

  const mainPagePagination = new Pagination();
mainPagePagination.option.controller = "promotions";
mainPagePagination.option.model = "PromotionModel";
mainPagePagination.option.limit = 10;
mainPagePagination.option.filter = {};
mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);