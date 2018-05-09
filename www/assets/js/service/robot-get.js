var iHotel = iHotel || {};
iHotel.robotSendList = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, shoppingItemList = new YP.list;
    var robotForm = new YP.form, robotDeliverForm = new YP.form;

    /**
     * 初始化列表
     */
    function initAcitivityUserList() {
        $("#filter_hotelid,#filter_activityid").select2({
            placeholder: '全部',
            language: 'zh-CN'
        });
        shoppingItemList.init({
            colCount: 4,
            autoLoad: true,
            listUrl: ypGlobal.listUrl,
            listDomObject: $("#dataList"),
            searchButtonDomObject: $("#searchBtn"),
            listTemplate: 'dataList_tpl',
            listSuccess: function (data) {
                shoppingItemList.writeListData(data);
            },
            listFail: function (data) {
                tips.show('数据加载失败！');
            }
        });
    }

    /**
     * Modal for robot deliver
     */
    function initDeliverEditor() {
        var detailModal = $("#deiverEditor");
        robotDeliverForm.init({
            editorDom: $("#robotDeliverEditor"),
            saveButtonDom: $("#saveDeliverData"),
            checkParams: eval(ypGlobal.checkParams),
            modelDom: detailModal,
            saveBefore: function (saveParams) {
                robotDeliverForm.updateParams({
                    saveUrl: ypGlobal.robotSend,
                });
                saveParams.start = getSelect('start');
                saveParams.dest = getSelect('dest');
                YP_RECORD_VARS.isChange = true;
                return saveParams;
            },
            saveSuccess: function (data) {
                shoppingItemList.reLoadList();
                tips.show(data.msg, 'success');
            },
            saveFail: function (data) {
                tips.show(data.msg);
            }
        });
        // call the robot
        $("#deliverRobot").on('click', function (e) {
            e.preventDefault();
            robotDeliverForm.writeEditor({
                editorDom: $("#robotDeliverEditor")
            });
            $("#ossfile").html("");
            detailModal.modal('show');
        });
    }

    //Adjust modal form size
    function initCss() {
        var modalBody = $(".yulong .modal-body[mf=modalfix]");
        modalBody.height('300px');
        $(window).resize(function () {
            modalBody.height('300px');
        })

    }

    //fix select list when open it again
    function getSelect(type) {
        var selector = "#edit_" + type + " > option";
        var optionArray = $(selector);
        var valueText = optionArray.parent().siblings().children(".searchable-select-holder").html();
        var value = 0;
        optionArray.each(
            function () {
                if ($(this).html() == valueText) {
                    value = $(this).val();
                }
            }
        );
        return value;
    }


    function init() {
        initAcitivityUserList();
        initCss();
        initDeliverEditor();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.robotSendList.init();
});
