$('#formSelect select').change(function () {
    if ($(this).val() !== '') {
        $('#formAjout').hide();
        $('h4').hide();
    }else {
        $('#formAjout').show();
        $('h4').show();
    }
});

$('#formAjout input').keyup(function () {
    if(!isEveryInputEmpty($('#formAjout input'))) {
        $('#formSelect').hide();
        $('h4').hide();
    } else {
        $('#formSelect').show();
        $('h4').show();
    }
});

function isEveryInputEmpty(element) {
    var allEmpty = true;

    $(element).each(function() {
        if ($(this).val() !== '') {
            allEmpty = false;
            return false;
        }
    });

    return allEmpty;
}
