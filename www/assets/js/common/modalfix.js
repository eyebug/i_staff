$(function () {
    var modalBody = $(".yulong .modal-body[mf=modalfix]");
    modalBody.height($(window).height() - 240);
    $(window).resize(function () {
        modalBody.height($(window).height() - 240)
    })

    $("#languageList").on('click', '[op=changeLanguage]', function () {
        var ajax = YP.ajax, changeLanguageButton = $("#changeLanguageButton");
        var language = $(this).data('language');
        if (language == changeLanguageButton.data('now')) {
            return true;
        }
        changeLanguageButton.button('loading');
        var xhr = ajax.ajax({
            url: '/loginajax/changeLangugae/',
            type: 'POST',
            data: {language: language},
            cache: false,
            dataType: "json",
            timeout: 100000
        });
        xhr.done(function (data) {
            location.reload();
        }).fail(function (data) {
            tips.show(data.msg);
            changeLanguageButton.button('reset');
        });
    });
});
