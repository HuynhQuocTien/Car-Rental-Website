Dashmix.helpersOnLoad(["jq-select2"]);

const renderData = function (vehicles) {
  let html = "";
  vehicles.forEach((vehicle) => {
    html += `
        <div class="col-md-6 col-xl-4">
            <!-- Vehicle -->
              <div class="block block-rounded">
                 <div class="block-content p-0 overflow-hidden">
                    <a class="img-link img-fluid-100" data-toggle="layout" data-action="side_overlay_open" href="javascript:void(0)" style="
    height: 350px;
">
                      <img class="img-fluid rounded-top " src="${vehicle.ImageURL}" alt="" style="
    height: 100%;
">
                    </a>
                  </div>
                <div class="block-content">
                    <h4 class="h6 mb-2">${vehicle.MakeName} ${vehicle.ModelName}  ${vehicle.Year} - ${vehicle.ColorName}</h4>
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
                                <strong>${vehicle.FuelType}</strong>
                            </p>
                        </div>
                    </div>
                    <div class="row text-center m-0 border-top border-bottom bg-body-light">
                        <div class="col-6 border-end">
                            <p class="py-3 mb-0">
                                <!-- Icon seats -->
                                <svg width="30" height="30" ...></svg>
                                <strong>${vehicle.NameType}</strong>
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="py-3 mb-0">
                                <!-- Icon fuel -->
                                <svg width="32" height="32" ...></svg>
                                <strong>${vehicle.Transmission}</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="row">                        
                        <div class="col-12">
                            <a class="btn btn-sm btn-alt-primary w-100 js-detail-vehicle"  href="${BaseUrl}vehicles/viewDetail&id=${vehicle.VehicleDetailID}"
                               data-id="${vehicle.VehicleDetailID}" data-booking="false">
                                View and booking
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
  });

  $("#list-vehicles").html(html);
};

$(".js-detail-vehicle").click(function () {
  const vehicleDetailId = $(this).data("id");
  $.ajax({
    url: BaseUrl + "vehicles/save_id_detail_vehicle",
    type: "POST",
    dataType: "json",
    data: {
      id: vehicleDetailId,
    },
    success: function (response) {
      if (response.success) {
        window.location.href = BaseUrl + "vehicles/viewDetail";
      }
    },
  });
});

$("#vehicle-make").change(function () {
  const make = $(this).val();

  if (!make) {
    delete vehiclePagination.option.filter.make;
  } else {
    vehiclePagination.option.filter.make = +make;
  }

  vehiclePagination.getPagination(
    vehiclePagination.option,
    vehiclePagination.valuePage.curPage
  );
});
$("#vehicle-model").change(function () {
  const model = $(this).val();

  if (!model) {
    delete vehiclePagination.option.filter.model;
  } else {
    vehiclePagination.option.filter.model = +model;
  }

  vehiclePagination.getPagination(
    vehiclePagination.option,
    vehiclePagination.valuePage.curPage
  );
});
$("#vehicle-year").change(function () {
  const year = $(this).val();

  if (!year) {
    delete vehiclePagination.option.filter.year;
  } else {
    vehiclePagination.option.filter.year = +year;
  }

  vehiclePagination.getPagination(
    vehiclePagination.option,
    vehiclePagination.valuePage.curPage
  );
});
$("#vehicle-color").change(function () {
  const color = $(this).val();

  if (!color) {
    delete vehiclePagination.option.filter.color;
  } else {
    vehiclePagination.option.filter.color = +color;
  }

  vehiclePagination.getPagination(
    vehiclePagination.option,
    vehiclePagination.valuePage.curPage
  );
});

$("#db-travel-from, #db-travel-to")
  .datepicker({
    format: "mm/dd/yyyy",
    autoclose: true,
    todayHighlight: true,
  })
  .on("changeDate", function () {
    const fromDate = $("#db-travel-from").val();
    const toDate = $("#db-travel-to").val();

    if (fromDate && toDate) {
      vehiclePagination.option.filter.rentalDate = {
        from: fromDate,
        to: toDate,
      };
      vehiclePagination.getPagination(
        vehiclePagination.option,
        vehiclePagination.valuePage.curPage
      );
    }
  });

$('input[name="vehicle-type"]').change(function () {
  // Bỏ active cũ
  $('input[name="vehicle-type"]').closest(".form-check").removeClass("active");
  // Thêm active mới
  $(this).closest(".form-check").addClass("active");

  let vehicleTypeID = +$(this).val();
  if (vehicleTypeID === 0) {
    delete vehiclePagination.option.filter.vehicleType;
  } else {
    vehiclePagination.option.filter.vehicleType = vehicleTypeID;
  }

  vehiclePagination.getPagination(
    vehiclePagination.option,
    vehiclePagination.valuePage.curPage
  );
});

$("#db-travel-price").ionRangeSlider({
  type: "double",
  min: 0,
  max: 1000,
  from: 0,
  to: 1000,
  prefix: "$",
  onFinish: function (data) {
    // Cập nhật filter
    vehiclePagination.option.filter.price = {
      from: data.from,
      to: data.to,
    };
    vehiclePagination.getPagination(
      vehiclePagination.option,
      vehiclePagination.valuePage.curPage
    );
  },
});

$("#vehicle-seats").change(function () {
  const seats = $(this).val();

  if (!seats) {
    delete vehiclePagination.option.filter.seats;
  } else {
    vehiclePagination.option.filter.seats = +seats;
  }

  vehiclePagination.getPagination(
    vehiclePagination.option,
    vehiclePagination.valuePage.curPage
  );
});

$("#vehicle-fuel").change(function () {
  const fuel = $(this).val();

  if (!fuel) {
    delete vehiclePagination.option.filter.fuel;
  } else {
    vehiclePagination.option.filter.fuel = fuel;
  }

  vehiclePagination.getPagination(
    vehiclePagination.option,
    vehiclePagination.valuePage.curPage
  );
});
$("#vehicle-transmission").change(function () {
  const transmission = $(this).val();

  if (!transmission) {
    delete vehiclePagination.option.filter.transmission;
  } else {
    vehiclePagination.option.filter.transmission = transmission;
  }

  vehiclePagination.getPagination(
    vehiclePagination.option,
    vehiclePagination.valuePage.curPage
  );
});

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
