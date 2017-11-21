var iHotel = iHotel || {};
iHotel.articleEditor = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert;

    function initEditor() {
        $(".navbar-custom").css('margin-bottom', 0);
        var language = ypGlobal.language == 'zh' ? 'zh-cn' : 'en';
        CKEDITOR.replace('article', {
            language: language,
            height: $(window).height() - 225
        });
        // CKEDITOR.replace('textarea_id', {allowedContent: true});

        $("#closeEditor").on('click', function () {
            if (confirm("您确定要关闭本页吗？")) {
                window.opener = null;
                window.open('', '_self');
                window.close();
            }
        });
    }

    function initSaveContent() {
        var saveButton = $("#saveListData");
        saveButton.on('click', function () {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            var content = $("#article").val();
            params = {};
            params.content = content;
            params.dataid = ypGlobal.dataid;
            params.datatype = ypGlobal.datatype;
            params.article = ypGlobal.article;
            saveButton.button('loading');
            var xhr = ajax.ajax({
                url: '/article/save',
                type: "POST",
                data: params,
                cache: false,
                dataType: "json",
                timeout: 10000
            });
            xhr.done(function (data) {
                saveButton.button('reset');
                if (confirm("保存成功，即将关闭本页")) {
                    window.parent.opener.location.reload();
                    window.opener = null;
                    window.open('', '_self');
                    window.close();
                }
            }).fail(function (data) {
                tips.show(data.msg);
                saveButton.button('reset');
            });
        });
    }

    function initViewLink() {
        $("#viewLink").on('click', function () {
            var viewLink = $(this).data('link');
            if (viewLink) {
                $("#linkContent").val(viewLink);
                $("#linkView").modal('show');
            }
        });
    }

    function init() {
        initEditor();
        initSaveContent();
        initViewLink();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.articleEditor.init();
})
