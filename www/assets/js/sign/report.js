var iHotel = iHotel || {};
iHotel.showingReportList = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, dataList = new YP.list;

    /**
     * 初始化列表
     */
    function initReportList() {
        dataList.init({
            colCount: 10,
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

    function initExport() {
        var exportButton = $("#exportBtn");
        exportButton.on('click', function () {
            exportButton.button('loading');
            filterParams = dataList.getFilterParams();
            var url = '/sign/export?';
            var params = [];
            $.each(filterParams, function (key, value) {
                params.push(key + '=' + value);
            });
            window.open(url + params.join('&'));
            exportButton.button('reset');
        });
    }

    function init() {
        initReportList();
        initExport();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.showingReportList.init();
})