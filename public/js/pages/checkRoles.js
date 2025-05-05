let role = [];

$.getJSON(BaseUrl + "permissions/getRole", function (data, textStatus, jqXHR) {
  role = data;
});

$(document).ajaxStop(function () {
  $("[data-function]").each(function() {
    const funcId = $(this).data("function");
    const permId = $(this).data("permission");    
    if (role[funcId] && role[funcId].includes(String(permId))) {
      console.log("show");
      $(this).addClass("show");
    } else {
      $(this).remove();
    }
  });
  
  // Xử lý các phần tử khác
  $(".col-action").each(function() {
    if ($(this).children().length == 0) {
      $(this).remove();
    }
  });
  
  $(".col-header-action").each(function() {
    $(this).toggle($(this).closest("table").find(".col-action").length > 0);
  });
});

