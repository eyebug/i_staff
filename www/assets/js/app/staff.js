var iHotel = iHotel || {};
iHotel.shoppingTagList = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, tagList = new YP.list, tagForm = new YP.form, ypRecord = YP.record;
    var searchButton = $("#searchBtn");

    /**
     * 初始化列表
     */
    function initList() {
        tagList.init({
            colCount: 9,
            autoLoad: true,
            listUrl: ypGlobal.listUrl,
            listDomObject: $("#dataList"),
            searchButtonDomObject: searchButton,
            listTemplate: 'dataList_tpl',
            listSuccess: function (data) {
                tagList.writeListData(data);
            },
            listFail: function (data) {
                tips.show('数据加载失败！');
            },
            handlerParams: function (params) {
                params.id = ypGlobal.id;
                return params;
            }

        });
    }

    /**
     * 初始化编辑新增
     */
    function initEditor() {
        // 初始化表单保存
        var detailModal = $("#editor");
        tagForm.init({
            editorDom: $("#listEditor"),
            saveButtonDom: $("#saveListData"),
            checkParams: eval(ypGlobal.checkParams),
            modelDom: detailModal,
            saveBefore: function (saveParams) {
                tagForm.updateParams({
                    saveUrl: saveParams.id > 0 ? ypGlobal.updateUrl : ypGlobal.createUrl,
                });
                saveParams = tagForm.makeRecord(saveParams, saveParams.id, saveParams.titleLang1);
                saveParams.id = ypGlobal.id;
                return saveParams;
            },
            saveSuccess: function (data) {
                tagList.reLoadList();
            },
            saveFail: function (data) {
                tips.show(data.msg);
            }
        });
    }

    function initStaffList() {
        bindButton();
        var staffModal = $("#staffListEditor"), staffEditorList = $("#staffEditorList"), saveStaff = $("#saveStaffList");
        $("#dataList").on('click', 'button[op=editStaffList]', function () {
            var $editId = $(this).data('dataid'), $dataDom = $("#dataList").find("[dataId=" + $editId + "]");
            var timeList = [];
            var washing = $dataDom.find('td[type=washing]').data('value');
            $.each($dataDom.find('td[type=schedule]').data('value').toString().split(','), function (key, value) {
                if (value) {
                    timeList.push(parseInt(value));
                }
            });
            staffEditorList.find('[op=edit_staffList]').each(function (key, value) {
                var staffOne = $(value), staffId = parseInt(staffOne.attr('value'));
                if ($.inArray(staffId, timeList) >= 0) {
                    staffOne.prop('checked', true).data('old', 1);
                } else {
                    staffOne.prop('checked', false).data('old', 0);
                }
            });
            staffEditorList.find('input[op=edit_staffWashing]').prop('checked', washing).data('old', washing);
            saveStaff.data('tagid', $editId);
            staffModal.modal('show');
        });

        saveStaff.on('click', function () {
            saveStaff.button('loading');
            var staffInsert = [];
            var staffDelete = [];
            var staffList = [];
            staffEditorList.find('[op=edit_staffList]').each(function (key, value) {
                var staffOne = $(value);
                if (staffOne.prop('checked')) {
                    staffList.push(staffOne.attr('value'));
                }
                if (staffOne.prop('checked') && staffOne.data('old') == 0) {
                    staffInsert.push(staffOne.attr('value'));
                }
                if (!staffOne.prop('checked') && staffOne.data('old') == 1) {
                    staffDelete.push(staffOne.attr('value'));
                }
            });
            var washing = staffEditorList.find('input[op=edit_staffWashing]');

            var statusRecord = '';
            if (staffInsert.length > 0) {
                statusRecord += '增加了' + staffInsert.join(",") + ';';
            }
            if (staffDelete.length > 0) {
                statusRecord += '减少了' + staffDelete.join(",") + ';';
            }
            if (washing.data('old') != washing.prop('checked')) {
                statusRecord += ('washing 变为 ' + washing.prop('checked'));
            }
            if (staffInsert.length == 0 && staffDelete.length == 0 && washing.data('old') == washing.prop('checked')) {
                saveStaff.button('reset');
                staffModal.modal('hide');
                return false;
            }
            var saveParams = {};
            saveParams.id = saveStaff.data('tagid');
            saveParams.timelist = staffList.join(',');
            if (washing.data('old') != washing.prop('checked')) {
                if (washing.prop('checked')) {
                    saveParams.washing = 1;
                } else {
                    saveParams.washing = 0;
                }
            }
            recordLog = ypRecord.getCreateLog({
                modelName: '员工推送配置',
                value: statusRecord
            });
            saveParams[YP_RECORD_VARS.recordPostId] = saveParams.id;
            saveParams[YP_RECORD_VARS.recordPostVar] = recordLog;

            var xhr = ajax.ajax({
                url: ypGlobal.updateUrl,
                type: "POST",
                data: saveParams,
                cache: false,
                dataType: "json",
                timeout: 100000
            });
            xhr.done(function (data) {
                saveStaff.button('reset');
                staffModal.modal('hide');
                tagList.reLoadList();
            }).fail(function (data) {
                tips.show(data.msg);
                saveStaff.button('reset');
            });
        });
    }

    function bindButton() {
        $('button.week').each(function (key, value) {
            var weekButton = $(value);
            weekButton.on('click', function () {
                var week = $(this).data('week');
                $('input.' + week).each(function (key, value) {
                    $(value).prop('checked', true);
                });
            });
        })
    }

    function init() {
        initList();
        initEditor();
        initStaffList();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.shoppingTagList.init();
})
