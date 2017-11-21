var iHotel = iHotel || {};
iHotel.telList = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, dataList = new YP.list, dataForm = new YP.form;
    var searchButton = $("#searchBtn");

    /**
     * 初始化列表
     */
    function initList() {
        $("#filter_typeid").select2({
            placeholder: '全部',
            language: 'zh-CN'
        });
        dataList.init({
            colCount: 6,
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
        $("#edit_typeid").select2({
            placeholder: '全部',
            language: 'zh-CN',
            width: 230
        });
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
                saveParams = dataForm.makeRecord(saveParams, saveParams.id, saveParams.titleLang1);
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
    iHotel.telList.init();
})
