$(function () {
    $('.deleteFile').click(function (e) {
        var showId = $(this).data('show'), inputId = $(this).data('for');
        var showElement = $(this).siblings("#" + showId);
        showElement.hide();

        var key = showElement.attr('src') || showElement.attr('href');
        var inputElement = $(this).siblings("#" + inputId);
        inputElement.attr('type', 'hidden');
        inputElement.val(key);
    });
});

function fileReset(ob) {
    if (typeof(ob) != 'object' || !ob.data('show') || !ob.data('for')) {
        throw "Error element";
    }
    var showElement = ob.siblings('#' + ob.data('show'));
    var inputElement = ob.siblings('#' + ob.data('for'));
    showElement.show();
    inputElement.attr('type', 'file');
}