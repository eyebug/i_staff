var iHotel = iHotel || {};
iHotel.feedbackQuestion = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, dateList = new YP.list, dataFrom = new YP.form, ypRecord = YP.record;
    var searchButton = $("#searchBtn");

    /**
     * 初始化列表
     */
    function initList() {
        $("#filter_listid").select2({
            placeholder: '全部',
            language: 'zh-CN'
        });
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
        var questionTypeEdit = $("#questionTypeEdit");
        // 初始化表单保存
        var detailModal = $("#editor");
        $("#edit_listid").select2({
            placeholder: '全部',
            language: 'zh-CN',
            width: 210
        });
        dataFrom.init({
            editorDom: $("#listEditor"),
            saveButtonDom: $("#saveListData"),
            checkParams: eval(ypGlobal.checkParams),
            modelDom: detailModal,
            saveBefore: function (saveParams) {
                dataFrom.updateParams({
                    saveUrl: saveParams.id > 0 ? ypGlobal.updateUrl : ypGlobal.createUrl
                });
                saveParams = dataFrom.makeRecord(saveParams, saveParams.id, saveParams.question);
                return saveParams;
            },
            saveSuccess: function (data) {
                dateList.reLoadList();
            },
            saveFail: function (data) {
                tips.show(data.msg);
            }
        });
        // 新建产品
        $("#createData").on('click', function () {
            dataFrom.writeEditor({
                editorDom: $("#listEditor")
            });
            questionTypeEdit.show();
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
            dataFrom.writeEditor({
                editorDom: $("#listEditor"),
                writeData: dataList
            });
            questionTypeEdit.hide();
            detailModal.modal('show');
        });
    }

    function initOptionEditor() {
        var optionEditor = $("#optionEditor"), optionEditorList = $("#optionEditorList"), saveOption = $("#saveOption");
        $("#dataList").on('click', 'button[op=editOption]', function () {
            var $editId = $(this).data('dataid'), opitonInfo = $(this).data('option');
            optionEditorList.html(template('optionEditorList_tpl', {optionList: opitonInfo}));
            saveOption.data('questionid', $editId);
            saveOption.data('old', opitonInfo);
            optionEditor.modal('show');
        });

        $("#createOption").on('click', function () {
            optionEditorList.append(template('optionEditorList_tpl', {optionList: ['']}));
        });
        optionEditorList.on('click', '[op=deleteOption]', function () {
            if (confirm('确认删除？')) {
                $(this).parents('[op=editFiled]').remove();
            }
        });

        optionEditorList.sortable().on("sortupdate", function (event, ui) {
        });

        saveOption.on('click', function () {
            var optionList = [];
            optionEditorList.find('[op=optionInput]').each(function () {
                var option = $(this).val().trim();
                if (option != '') {
                    optionList.push(option);
                }
            });
            if (JSON.stringify(optionList) == JSON.stringify(saveOption.data('old'))) {
                optionEditor.modal('hide');
                return true;
            }
            var saveParams = {id: saveOption.data('questionid'), option: optionList}

            var oldOption = saveOption.data('old');
            oldOption = oldOption ? oldOption : [];
            recordLog = ypRecord.getEditLog({
                modelName: '房型物品',
                value: [{title: '问题选项', from: oldOption.join(','), to: optionList.join(',')}]
            });
            saveParams[YP_RECORD_VARS.recordPostId] = saveParams.id;
            saveParams[YP_RECORD_VARS.recordPostVar] = recordLog;

            saveOption.button('loading');
            var xhr = ajax.ajax({
                url: '/feedbackajax/updateOption',
                type: 'POST',
                data: saveParams,
                cache: false,
                dataType: "json",
                timeout: 100000
            });
            xhr.done(function (data) {
                saveOption.button('reset');
                dateList.reLoadList();
                optionEditor.modal('hide');
            }).fail(function (data) {
                tips.show(data.msg);
                saveOption.button('reset');
            });
        });
    }

    function init() {
        initList();
        initEditor();
        initOptionEditor();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.feedbackQuestion.init();
})
