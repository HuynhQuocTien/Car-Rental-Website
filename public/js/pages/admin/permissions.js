Dashmix.onLoad((() => class {
    static initValidation() {
        Dashmix.helpers("jq-validation"), jQuery(".form_role").validate({
            rules: {
                "NameRole": {
                    required: !0,
                }
            },
            messages: {
                "NameRole": {
                    required: "Please enter a name for the role",
                },
            }
        })
    }

    static init() {
        this.initValidation()
    }
}.init()));
const renderData = function (data) {
    let html = ``;
    data.forEach(item => {
        html += `<tr>
        <td class="text-center fs-sm"><strong>${item.RoleID}</strong></td>
        <td>${item.RoleName}</td>
        <td class="text-center fs-sm">${item.Quantity }</td>
        <td class="text-center col-action">
            <button data-function="18" data-permission="2" class="btn btn-sm btn-alt-secondary btn-show-update" data-id="${item.RoleID}" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
                <i class="fa fa-fw fa-pencil"></i>
            </button>
            <button data-function="18" data-permission="3" class="btn btn-sm btn-alt-secondary delete_roles" data-id="${item.RoleID}" data-bs-toggle="tooltip" aria-label="Delete"
                data-bs-original-title="Delete">
                <i class="fa fa-fw fa-times"></i>
            </button>
        </td>
    </tr>`
    });
    
    $("#list-roles").html(html);
    $('[data-bs-toggle="tooltip"]').tooltip();
};

$(document).ready(function () {

    $('.check-all-row').on('change', function () {
        var $row = $(this).closest('tr');
        var isChecked = $(this).is(':checked'); 
    
        $row.find('input.form-check-input').not('.check-all-row').prop('checked', isChecked);
    });
    

    $('.table-role').on('change', 'input.form-check-input:not(.check-all-row)', function () {
        var $row = $(this).closest('tr');
        var $checkboxes = $row.find('input.form-check-input').not('.check-all-row');
        var $checkAll = $row.find('.check-all-row');
    
        var allChecked = $checkboxes.length === $checkboxes.filter(':checked').length; 
        $checkAll.prop('checked', allChecked);
    });
    
    
    function getDataForm() {
        let roles = [];
        let arr = $("[type='checkbox']:not(.check-all-row)");
        
        $.each(arr, function (i, item) {
            let $item = $(item);
            let value = $item.val();
            let check = $item.prop("checked");
            let dataId = $item.data("id");
    
            if (check) {
                let role = {
                    permissionID: value,
                    functionID: dataId
                };
                roles.push(role);
            }
        });
    
        return roles;
    }
    
    

    $("#save-role").click(function (e) {
        e.preventDefault();
        let roles = getDataForm();
        if ($(".form_role").valid()) {
            if(roles.length != 0) {
                $.ajax({
                    type: "post",
                    url: BaseUrl + "permissions/create",
                    data: {
                        name: $("#NameRole").val(),
                        roles: roles
                    },
                    success: function (response) {
                        console.log(response);
                        if (response) {
                            $("#modal-add-role").modal("hide");                            
                            Dashmix.helpers('jq-notify', { type: 'success', icon: 'fa fa-check me-1', message: 'Permission creation successful' });
                            mainPagePagination.getPagination(
                                mainPagePagination.option,
                                mainPagePagination.valuePage.curPage
                              );
                        } else {
                            Dashmix.helpers('jq-notify', { type: 'danger', icon: 'fa fa-times me-1', message: 'Permission creation failed!' });
                        }
                    }
                });
            } else {
                Dashmix.helpers('jq-notify', { type: 'danger', icon: 'fa fa-times me-1', message: 'Please select permission!!! ' });
            }
        }
    });


    // function loadDataTable() {
    //     let html = ``;
    //     $.getJSON(BaseUrl + "permissions/renderData",
    //         function (data) {
    //             data.forEach(item => {
    //                 html += `<tr>
    //                 <td class="text-center fs-sm"><strong>${item.RoleID}</strong></td>
    //                 <td>${item.RoleName}</td>
    //                 <td class="text-center fs-sm">${item.Quantity }</td>
    //                 <td class="text-center col-action">
    //                     <button data-role="nhomquyen" data-action="update" class="btn btn-sm btn-alt-secondary btn-show-update" data-id="${item.RoleID}" data-bs-toggle="tooltip" aria-label="Edit" data-bs-original-title="Edit">
    //                         <i class="fa fa-fw fa-pencil"></i>
    //                     </button>
    //                     <button data-role="nhomquyen" data-action="delete" class="btn btn-sm btn-alt-secondary delete_roles" data-id="${item.RoleID}" data-bs-toggle="tooltip" aria-label="Delete"
    //                         data-bs-original-title="Delete">
    //                         <i class="fa fa-fw fa-times"></i>
    //                     </button>
    //                 </td>
    //             </tr>`
    //             });
    //             $("#list-roles").html(html);
    //             $('[data-bs-toggle="tooltip"]').tooltip();
    //         }
    //     );
    // }

    $("[data-bs-target='#modal-add-role']").click(function (e) {
        e.preventDefault();
        $(".add-role-element").show();
        $(".update-role-element").hide();
    });

    let e = Swal.mixin({
        buttonsStyling: !1,
        target: "#page-container",
        customClass: {
            confirmButton: "btn btn-success m-1",
            cancelButton: "btn btn-danger m-1",
            input: "form-control"
        }
    });

    $(document).on("click", ".delete_roles", function () {
        let id = $(this).data('id');
        let index = $(this).data("index");
        e.fire({
            title: "Are you sure?",
            text: "Do you want to delete this role?",
            icon: "warning",
            showCancelButton: !0,
            customClass: {
                confirmButton: "btn btn-danger m-1",
                cancelButton: "btn btn-secondary m-1",
            },
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            html: !1,
            preConfirm: (e) =>
                new Promise((e) => {
                    setTimeout(() => {
                        e();
                    }, 50);
                }),
        }).then((t) => {
            if (t.value == true) {
                $.ajax({
                    type: "post",
                    url: BaseUrl + "permissions/delete",
                    data: {
                        roleID: id,
                    },
                    success: function (response) {
                        if (response==true) {
                            e.fire("Deleted!", "Delete successful", "success");
                            mainPagePagination.getPagination(
                                mainPagePagination.option,
                                mainPagePagination.valuePage.curPage
                                );
                        } else {
                            e.fire("Lỗi !", "Delete fail!", "error");
                        }
                    }
                });
            }
        });
    });

    $("#modal-add-role").on('hidden.bs.modal', function () {
        $("#NameRole").val("");
        $("[type='checkbox']").prop("checked", false);
    });

    $(document).on("click", ".btn-show-update", function () {
        $(".add-role-element").hide();
        $(".update-role-element").show();
        let roleID = $(this).data('id');
        $("[name='idrole']").val(roleID);
        $.ajax({
            type: "post",
            url: BaseUrl + "permissions/get",
            data: {
                roleID: roleID
            },
            dataType: "json",
            success: function (response) {
                console.log(response)                
                $("#NameRole").val(response.RoleName);
                $(".form-check-input").prop("checked", false);
                $.each(response.permissions, function (index, item) {
                    $(`[data-id="${item.FunctionID}"][value="${item.PermissionID}"]`)
                        .prop('checked', true)
                        .trigger('change');
                });
                $("#modal-add-role").modal("show");
            }
        });
    });

    $("#update-role-btn").click(function (e) {
        e.preventDefault();
        let roles = getDataForm();
        if ($(".form_role").valid()) {
            if(roles.length != 0) {
                $.ajax({
                    type: "post",
                    url: BaseUrl + "permissions/update",
                    data: {
                        roleID: $("[name='idrole']").val(),
                        name: $("#NameRole").val(),
                        roles: roles
                    },
                    success: function (response) {
                        if (response==true) {
                            $("#modal-add-role").modal("hide");
                            Dashmix.helpers('jq-notify', { type: 'success', icon: 'fa fa-check me-1', message: 'Update successful!' });
                            mainPagePagination.getPagination(
                                mainPagePagination.option,
                                mainPagePagination.valuePage.curPage
                            );
                        } else {
                            Dashmix.helpers('jq-notify', { type: 'danger', icon: 'fa fa-times me-1', message: 'Update failed!' });
                        }
                    }
                });
            } else {
                Dashmix.helpers('jq-notify', { type: 'danger', icon: 'fa fa-times me-1', message: 'Please select permission!!!' });
            }
        }
    });
});

const mainPagePagination = new Pagination();
mainPagePagination.option.controller = "permissions";
mainPagePagination.option.model = "RoleModel";
mainPagePagination.option.limit = 5;
mainPagePagination.option.filter = {};
mainPagePagination.getPagination(mainPagePagination.option, mainPagePagination.valuePage.curPage);
