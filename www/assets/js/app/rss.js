var iHotel = iHotel || {};
iHotel.appPush = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, dateList = new YP.list;

    /**
     * 初始化列表
     */
    function initdateList() {
        dateList.init({
            colCount: 7,
            autoLoad: true,
            listUrl: ypGlobal.listUrl,
            listDomObject: $("#dataList"),
            searchButtonDomObject: $("#searchBtn"),
            listTemplate: 'dataList_tpl',
            listSuccess: function (data) {
                dateList.writeListData(data);
            },
            listFail: function (data) {
                tips.show('数据加载失败！');
            }
        });
    }

    function initInsert() {
        var rssList = new YP.list;
        rssList.init({
            colCount: 5,
            autoLoad: false,
            listUrl: ypGlobal.rssUrl,
            listDomObject: $("#rssList"),
            searchButtonDomObject: $("#searchBtn"),
            listTemplate: 'rssList_tpl',
            listSuccess: function (data) {
                rssList.writeListData(data);
            },
            listFail: function (data) {
                tips.show('数据加载失败！');
            }
        });
        var modal = $("#editor");
        $("#createData").on('click', function () {
            modal.modal('show');
            return;
        });

        $("#rssList").on('click', '[op=createRes]', function () {
            var createBt = $(this), dateId = createBt.data('dataid');
            createBt.button('loading');
            var rssIdList = [];
            $("#dataList [op=deleteRss]").each(function (key, value) {
                rssIdList.push($(value).data('dataid'));
            });
            rssIdList.push(dateId);
            var xhr = ajax.ajax({
                url: ypGlobal.updateUrl,
                type: "POST",
                data: {rsslist: rssIdList.join(',')},
                cache: false,
                dataType: "json",
                timeout: 10000
            });
            xhr.done(function (data) {
                createBt.button('reset');
                tips.show('保存成功', 'success');
                rssList.reLoadList();
                dateList.reLoadList();
            }).fail(function (data) {
                tips.show(data.msg);
                createBt.button('reset');
            });
        });
    }

    function initDelete() {
        $("#dataList").on('click', '[op=deleteRss]', function () {
            if (!confirm('确认删除？')) {
                return false;
            }
            var deleteBt = $(this), dataId = deleteBt.data('dataid');
            deleteBt.button('loading');
            var rssIdList = [];
            $("#dataList [op=deleteRss]").each(function (key, value) {
                var rssIdOne = $(value).data('dataid');
                if (rssIdOne !== dataId) {
                    rssIdList.push($(value).data('dataid'));
                }
            });
            var xhr = ajax.ajax({
                url: ypGlobal.updateUrl,
                type: "POST",
                data: {rsslist: rssIdList.join(',')},
                cache: false,
                dataType: "json",
                timeout: 10000
            });
            xhr.done(function (data) {
                deleteBt.button('reset');
                dateList.reLoadList();
            }).fail(function (data) {
                tips.show(data.msg);
                deleteBt.button('reset');
            });
        });
    }

    function init() {
        initdateList();
        initInsert();
        initDelete();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.appPush.init();
})
