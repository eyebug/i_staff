var iHotel = iHotel || {};
iHotel.activityAcitivityUserList = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, acitivityUserList = new YP.list;

    /**
     * 初始化列表
     */
    function initAcitivityUserList() {
        $("#filter_hotelid,#filter_activityid").select2({
            placeholder: '全部',
            language: 'zh-CN'
        });
        acitivityUserList.init({
            colCount: 5,
            autoLoad: true,
            listUrl: ypGlobal.listUrl,
            listDomObject: $("#dataList"),
            searchButtonDomObject: $("#searchBtn"),
            listTemplate: 'dataList_tpl',
            listSuccess: function (data) {
                acitivityUserList.writeListData(data);
            },
            listFail: function (data) {
                tips.show('数据加载失败！');
            }
        });
    }

    function init() {
        initAcitivityUserList();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.activityAcitivityUserList.init();
})
