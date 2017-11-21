var iHotel = iHotel || {};
iHotel.appShare = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, ypRecord = YP.record;
    var enableDataList, disableDataList, saveShareData;

    /**
     * 初始化列表
     */
    function initShortCutIconList() {
        saveShareData.hide();
        enableDataList.html(template('listLoading_tpl', {
            colCount: 1
        }));
        disableDataList.html(template('listLoading_tpl', {
            colCount: 1
        }));
        var xhr = ajax.ajax({
            url: ypGlobal.listUrl,
            type: 'POST',
            cache: false,
            dataType: "json",
            timeout: 100000
        });
        xhr.done(function (data) {
            saveShareData.data('old', data.data.enable);
            enableDataList.html(template('dataList_tpl', {shareList: data.data.enable}));
            disableDataList.html(template('dataList_tpl', {shareList: data.data.disable}));
            saveShareData.show();
        }).fail(function (data) {
            tips.show(data.msg);
        });
    }

    function initEditor() {
        enableDataList.sortable({
            connectWith: "[op=shareList]",
            placeholder: "ui-state-highlight",
            items: "[op=shareOne]",
            update: function () {
                var emptyShare = enableDataList.find("#emptyShare");
                if (enableDataList.find("[op=shareOne]").length) {
                    emptyShare.hide();
                } else {
                    emptyShare.show();
                }
            }
        }).disableSelection();
        disableDataList.sortable({
            connectWith: "[op=shareList]",
            placeholder: "ui-state-highlight",
            items: "[op=shareOne]",
            update: function () {
                var emptyShare = disableDataList.find("#emptyShare");
                if (disableDataList.find("[op=shareOne]").length) {
                    emptyShare.hide();
                } else {
                    emptyShare.show();
                }
            }
        }).disableSelection();

        saveShareData.on('click', function () {
            var oldDataInfo = saveShareData.data('old');
            var oldData = [], oldDataTitle = [];
            $.each(oldDataInfo, function (key, value) {
                oldData.push(value.key);
                oldDataTitle.push(value.title);
            });

            var newData = [], newDataTitle = [];
            enableDataList.find('[op=shareOne]').each(function (key, value) {
                newData.push($(value).data('key'));
                newDataTitle.push($(value).html());
            });
            if (oldData.join(',') == newData.join(',')) {
                tips.show('保存成功', 'success');
                return true;
            }
            recordLog = ypRecord.getEditLog({
                modelName: 'APP分享',
                value: [{from: oldDataTitle.join(','), to: newDataTitle.join(',')}]
            });
            var saveParams = {};
            saveParams.share = newData.join(',');
            saveParams[YP_RECORD_VARS.recordPostId] = ypGlobal.hotelid;
            saveParams[YP_RECORD_VARS.recordPostVar] = recordLog;

            saveShareData.button('loading');
            var xhr = ajax.ajax({
                url: ypGlobal.updateUrl,
                type: "POST",
                data: saveParams,
                cache: false,
                dataType: "json",
                timeout: 10000
            });
            xhr.done(function (data) {
                saveShareData.button('reset');
                tips.show('保存成功', 'success');
                initShortCutIconList();
            }).fail(function (data) {
                tips.show(data.msg);
                saveShareData.button('reset');
            });
        });
    }

    function init() {
        enableDataList = $("#enableDataList");
        disableDataList = $("#disableDataList");
        saveShareData = $("#saveShareData");
        initShortCutIconList();
        initEditor();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.appShare.init();
})
