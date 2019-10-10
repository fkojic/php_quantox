$(document).on('click', '#showCreate', function () {
    if($("#createForm").is(":hidden")) {
        $("#createForm").show();
    } else {
        $("#createForm").hide();
    }

});