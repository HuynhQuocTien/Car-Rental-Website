Dashmix.helpersOnLoad(['js-flatpickr', 'jq-datepicker']);

const renderDetail = function (orderdetails) {
    console.log(orderdetails);
    if (orderdetails.length === 0) {
        $("#list-rentalorderdetails").html('<tr><td colspan="8" class="text-center">No data available</td></tr>');
        return;
    }
    let html = "";
    orderdetails.forEach((detail) => {
      html += `<tr>
        <td>${detail.VehicleDetailID}</td>
        <td>${detail.RentalRate}</td>
      </tr>`;
    });
  
    $("#rentalorderdetails").html(html);
    $('[data-bs-toggle="tooltip"]').tooltip();
};


const mainPagePagination = new Pagination();
mainPagePagination.option.controller = "rentalorders";
mainPagePagination.option.model = "RentalOrderModel";
mainPagePagination.option.limit = 10;
mainPagePagination.option.filter = {};
mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);