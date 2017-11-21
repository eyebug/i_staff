var iHotel = iHotel || {};
iHotel.showingOrderList = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, dataList = new YP.list;

    /**
     * 初始化列表
     */
    function initOrderList() {
        dataList.init({
            colCount: 5,
            autoLoad: true,
            listUrl: ypGlobal.listUrl,
            listDomObject: $("#dataList"),
            searchButtonDomObject: $("#searchBtn"),
            listTemplate: 'dataList_tpl',
            listSuccess: function (data) {
                dataList.writeListData(data);
            },
            listFail: function (data) {
                tips.show('数据加载失败！');
            }
        });
    }

    function init() {
        initOrderList();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.showingOrderList.init();
})
