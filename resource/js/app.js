$(document).on('click', '#showCreate', function () {
    if($("#createForm").is(":hidden")) {
        $("#createForm").show();
    } else {
        $("#createForm").hide();
    }

});
$(document).on('click', '#addGrade', function () {
    if($(".grades").length < 4) {
        var html = `<div class="form-group">
                    <input type="number" min="1" max="10" name="grades[]" value="" class="width100 input-group grades" />
                </div>`
        $('#formgrades').append(html);
    }
});
