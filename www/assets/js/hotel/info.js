var iHotel = iHotel || {};
iHotel.hotelInfo = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, infoForm = new YP.form;

    /**
     * 初始化编辑新增
     */
    function initEditor() {
        // 初始化表单保存
        infoForm.init({
            editorDom: $("#listEditor"),
            saveButtonDom: $("#saveListData"),
            checkParams: eval(ypGlobal.checkParams),
            saveUrl: ypGlobal.updateBaseUrl,
            saveBefore: function (saveParams) {
                saveParams = infoForm.makeRecord(saveParams, saveParams.id, saveParams.nameLang1);
                return saveParams;
            },
            saveSuccess: function (data) {
                tips.show('保存成功！', 'success', 1);
                setTimeout(function () {
                    location.reload();
                }, 1400);
            },
            saveFail: function (data) {
                tips.show(data.msg);
            }
        })
        ;
    }

    function init() {
        initEditor();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.hotelInfo.init();
})