var iHotel = iHotel || {};
iHotel.roomBill = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, dataList = new YP.list, dataForm = new YP.form;
    var searchButton = $("#searchBtn");

    /**
     * 初始化列表
     */
    function initList() {
        $("#filter_date").datetimepicker(datatimepickerConfig);
        dataList.init({
            colCount: 9,
            autoLoad: true,
            listUrl: ypGlobal.listUrl,
            listDomObject: $("#dataList"),
            searchButtonDomObject: searchButton,
            listTemplate: 'dataList_tpl',
            listSuccess: function (data) {
                dataList.writeListData(data);
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
        $("#edit_date").datetimepicker(datatimepickerConfig);
        // 初始化表单保存
        var detailModal = $("#editor");
        dataForm.init({
            editorDom: $("#listEditor"),
            saveButtonDom: $("#saveListData"),
            checkParams: eval(ypGlobal.checkParams),
            modelDom: detailModal,
            saveBefore: function (saveParams) {
                dataForm.updateParams({
                    saveUrl: saveParams.id > 0 ? ypGlobal.updateUrl : ypGlobal.createUrl
                });
                saveParams = dataForm.makeRecord(saveParams, saveParams.id, saveParams.room + '_' + saveParams.date);
                return saveParams;
            },
            saveSuccess: function (data) {
                dataList.reLoadList();
            },
            saveFail: function (data) {
                tips.show(data.msg);
            }
        });
        // 新建产品
        $("#createData").on('click', function () {
            $("[createShow=1]").show();
            dataForm.writeEditor({
                editorDom: $("#listEditor")
            });
        });
        // 编辑产品
        $("#dataList").on('click', 'button[op=editDataOne]', function () {
            var $editId = $(this).data('dataid'), $dataDom = $("#dataList").find("[dataId=" + $editId + "]");
            var dataList = {};
            $dataDom.find('td').each(function (key, value) {
                var dataOne = $(value);
                if (dataOne.attr('type')) {
                    dataList[dataOne.attr('type')] = dataOne.data('value');
                }
            });
            dataForm.writeEditor({
                editorDom: $("#listEditor"),
                writeData: dataList
            });
            $("[createShow=1]").hide();
            detailModal.modal('show');
        });
    }

    function initDelete() {
        $("#dataList").on('click', 'button[op=deleteDataOne]', function () {
            if (!confirm('确认删除？')) {
                return false;
            }
            var deleteBtn = $(this), dataId = $(this).data('dataid');
            var saveParams = {};
            saveParams.id = dataId;
            deleteBtn.button('loading');
            var xhr = ajax.ajax({
                url: ypGlobal.deleteUrl,
                type: "POST",
                data: saveParams,
                cache: false,
                dataType: "json",
                timeout: 10000
            });
            xhr.done(function (data) {
                dataList.reLoadList();
            }).fail(function (data) {
                tips.show(data.msg);
                deleteBtn.button('reset');
            });
        });
    }

    function init() {
        initList();
        initEditor();
        initDelete();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.roomBill.init();
})
