var iHotel = iHotel || {};
iHotel.roomRoomType = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, dataList = new YP.list, dataForm = new YP.form,
        ypRecord = YP.record;
    var searchButton = $("#searchBtn");

    /**
     * 初始化列表
     */
    function initList() {
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

    function initEditResList() {
        var typeResModal = $("#resEditor"), resEditorList = $("#resEditorList"), saveRes = $("#saveRes");
        $("#dataList").on('click', 'button[op=editResList]', function () {
            var $editId = $(this).data('dataid'), $dataDom = $("#dataList").find("[dataId=" + $editId + "]");
            var typeResList = [];
            var dataTypeRes = $dataDom.find('td[type=residList]').data('value').toString();
            $.each(dataTypeRes.split(','), function (key, value) {
                if (value) {
                    typeResList.push(parseInt(value));
                }
            });
            resEditorList.find('[op=edit_typeRes]').each(function (key, value) {
                var typeResOne = $(value), typeResKey = parseInt(typeResOne.attr('value'));
                if ($.inArray(typeResKey, typeResList) >= 0) {
                    typeResOne.prop('checked', true).data('old', 1);
                } else {
                    typeResOne.prop('checked', false).data('old', 0);
                }
            });
            saveRes.data('userid', $editId);
            typeResModal.modal('show');
        });

        saveRes.on('click', function () {
            saveRes.button('loading');
            var statusInsert = [];
            var statusDelete = [];
            var typeRes = [];
            resEditorList.find('[op=edit_typeRes]').each(function (key, value) {
                var typeResOne = $(value);
                if (typeResOne.prop('checked')) {
                    typeRes.push(typeResOne.attr('value'));
                }
                if (typeResOne.prop('checked') && typeResOne.data('old') == 0) {
                    statusInsert.push(typeResOne.data('title'));
                }
                if (!typeResOne.prop('checked') && typeResOne.data('old') == 1) {
                    statusDelete.push(typeResOne.data('title'));
                }
            });
            var statusRecord = '';
            if (statusInsert.length > 0) {
                statusRecord += '增加了' + statusInsert.join(",") + ';';
            }
            if (statusDelete.length > 0) {
                statusRecord += '减少了' + statusDelete.join(",") + ';';
            }
            if (statusInsert.length == 0 && statusDelete.length == 0) {
                typeResModal.modal('hide');
                return false;
            }
            var saveParams = {};
            saveParams.id = saveRes.data('userid');
            saveParams.typeres = typeRes.join(',');
            recordLog = ypRecord.getCreateLog({
                modelName: '房型物品',
                value: statusRecord
            });
            saveParams[YP_RECORD_VARS.recordPostId] = saveParams.id;
            saveParams[YP_RECORD_VARS.recordPostVar] = recordLog;

            var xhr = ajax.ajax({
                url: '/roomajax/updateRoomTypeRes',
                type: "POST",
                data: saveParams,
                cache: false,
                dataType: "json",
                timeout: 10000
            });
            xhr.done(function (data) {
                saveRes.button('reset');
                typeResModal.modal('hide');
                dataList.reLoadList();
            }).fail(function (data) {
                tips.show(data.msg);
                saveRes.button('reset');
            });
        });
    }

    function initArticleEditor() {
        $("#dataList").on('click', 'button[op=editArticle]', function () {
            window.open('/article/editor?dataid=' + $(this).data('dataid') + '&datatype=' + $(this).data('type') + '&article=' + $(this).data('article'));
        });
    }

    function init() {
        initList();
        initEditor();
        initEditResList();
        initArticleEditor();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.roomRoomType.init();
})
