var iHotel = iHotel || {};
iHotel.feedbackResult = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, dateList = new YP.list;
    var searchButton = $("#searchBtn");

    /**
     * 初始化列表
     */
    function initList() {
        dateList.init({
            colCount: 9,
            autoLoad: true,
            listUrl: ypGlobal.listUrl,
            listDomObject: $("#dataList"),
            searchButtonDomObject: searchButton,
            listTemplate: 'dataList_tpl',
            listSuccess: function (data) {
                dateList.writeListData(data);
            },
            listFail: function (data) {
                tips.show('数据加载失败！');
            }
        });
    }

    /**
     * 初始化编辑新增
     */
    function initEditor() {
        // 初始化表单保存
        var detailModal = $("#editor");
        // 编辑产品
        $("#dataList").on('click', 'button[op=editDataOne]', function () {
            var answerInfo = $(this).data('answer');
            $("#answerInfoList").html(template('answerInfoList_tpl', {answerList: answerInfo}));
            detailModal.modal('show');
        });
    }

    function init() {
        initList();
        initEditor();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.feedbackResult.init();
})
