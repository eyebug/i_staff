var iHotel = iHotel || {};
iHotel.robotShoppingList = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, shoppingItemList = new YP.list;
    var robotForm = new YP.form, robotDeliverForm = new YP.form;

    function getDeliverList() {
        var result = [];
        var itemArray = $('input.robotShopping');
        for (var i = 0; i < itemArray.length; i++) {
            if (itemArray[i].checked) {
                result.push(itemArray[i].value);
            }
        }
        return result;
    }

    /**
     * 初始化列表
     */
    function initAcitivityUserList() {
        $("#filter_hotelid,#filter_activityid").select2({
            placeholder: '全部',
            language: 'zh-CN'
        });

        shoppingItemList.init({
            colCount: 9,
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
            },
            handlerParams: function (params) {// 请求前处理参数
                params.lastname = getSelect('lastname');
                params.room = getSelect('room');
                return params;
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
                    saveUrl: ypGlobal.deliverRobot,
                    itemList: getDeliverList()
                });
                saveParams = robotDeliverForm.makeRecord(saveParams, saveParams.id, saveParams.titleLang1);
                saveParams.itemList = getDeliverList();
                saveParams.start = getSelect('start');
                saveParams.dest = getSelect('dest');
                return saveParams;
            },
            saveSuccess: function (data) {
                shoppingItemList.reLoadList();
                tips.show(data.data.msg, 'success');
            },
            saveFail: function (data) {
                tips.show(data.msg);
            }
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
        var selector = "#filter_" + type + " > option";
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

    /**
     * Get room of selected orders
     *
     * @returns {*}
     */
    function getRoom() {
        var room = '';
        var nextRoom = '';
        var checkArray = $('#dataList > tr > td > input[type=checkbox]');
        checkArray.each(function () {
            if (this.checked) {
                nextRoom = $(this).parent().siblings()[2].innerHTML;
                if (room === '') {
                    room = nextRoom;
                } else {
                    if (room !== nextRoom) {
                        return false;
                    }
                }
            }
        });
        if (room === '' || room !== nextRoom) {
            return false;
        } else {
            return room;
        }
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
    iHotel.robotShoppingList.init();
})
