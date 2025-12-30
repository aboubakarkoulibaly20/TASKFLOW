
/**--------------------------------------------------------------------------------------
 * [CATEGORIES - CREATE AND EDIT (ACTIONS MODAL)]
 * @description: form validation for actions modal
 * -------------------------------------------------------------------------------------*/
function NXCategoriesCreateActions() {
    //add category - form validation
    $("#actionsModalForm").validate().destroy();
    $("#actionsModalForm").validate({
        rules: {
            category_name: "required"
        },
        submitHandler: function (form) {
            nxAjaxUxRequest($("#actionsModalButton"));
        }
    });
}

/**--------------------------------------------------------------------------------------
 * [UPDATE CLIENT CATEGORY SELECT]
 * @description: update the select2 dropdown
 * -------------------------------------------------------------------------------------*/
function NXUpdateClientCategory() {
    if ($("#client_categoryid").length) {
        var id = $("#client_categoryid").attr('data-new-category-id');
        var name = $("#client_categoryid").attr('data-new-category-name');
        if (id && name) {
            var newOption = new Option(name, id, true, true);
            $("#client_categoryid").append(newOption).trigger('change');
        }
    }
}
