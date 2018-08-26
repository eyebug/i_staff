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
                //write the data to the data table
                writeList(data);
            },
            listFail: function (data) {
                tips.show('数据加载失败！');
            }
        });
    }

    function writeList(data) {
        var html = '';
        if (data.data.list.length > 0) {
            html = template(shoppingItemList.listParams.listTemplate, data.data);
            var pageHtml = template(shoppingItemList.listParams.pageTemplate, data.data.pageData);
            shoppingItemList.listParams.pageDomObject.html(pageHtml).show();
        } else {
            html = template(shoppingItemList.listParams.noDataTemplate, {
                colCount: shoppingItemList.listParams.colCount
            });
            shoppingItemList.listParams.pageDomObject.hide();
        }
        dataTable(data);
    }

    function dataTable(data) {
        shoppingItemList.listParams.listDomObject.html('');
        var orderId = "";
        for(var i = 0; i< data.data.list.length; i++) {
            var order = data.data.list[i];
            if (orderId != order.id) {
                orderId = order.id;
                var count = 0;
                for (var j = i; j < data.data.list.length; j++) {
                    if (orderId == data.data.list[j].id) {
                        count = count + parseInt(data.data.list[i].count);
                    } else {
                        break;
                    }
                }
                var orderRowStr = '<tr dataid="%s" class="order" style="background-color: lightgrey;">\n' +
                    '    <td class="order close" data-value="%s" data-toggle="-" style="width: 100%;">+</td>\n' +
                    '    <td data-value="%s" type="id">%s</td>\n' +
                    '    <td type="createtime">%s</td>\n' +
                    '    <td type="room">%s</td>\n' +
                    '    <td></td>\n' +
                    '    <td data-value="%s" type="count">%s</td>\n' +
                    '    <td></td>\n' +
                    '    <td>%s</td>\n' +
                    '    <td></td>\n' +
                    '</tr>';
                var orderRow = $(orderRowStr.format(order.id, order.id, order.id, order.id, order.createtime, order.userRoom, count, count, order.status));
                shoppingItemList.listParams.listDomObject.append(orderRow);
            }

            var orderProductStr = '<tr dataid="%s" class="orderProduct" style="display: none; background-color: white ;">\n' +
                '    <td><input type="checkbox" value="%s" class="robotShopping"></td>' +
                '    <td data-value="%s" type="id">%s</td>\n' +
                '    <td type="createtime">%s</td>\n' +
                '    <td type="room">%s</td>\n' +
                '    <td>%s</td>\n' +
                '    <td data-value="%s" type="count">%s</td>\n' +
                '    <td>%s</td>\n' +
                '    <td>%s</td>\n' +
                '    <td>%s</td>\n' +
                '</tr>';
            var orderProductRow = $(orderProductStr.format(order.id, order.ordersProductsId, order.id, order.id, order.createtime, order.userRoom,
                order.shopping, order.count, order.count, order.admin, order.productstatusname, order.robotstatusname));
            shoppingItemList.listParams.listDomObject.append(orderProductRow);

        }
        shoppingItemList.listParams.listDomObject.show();
    }

    String.prototype.format= function(){
        var args = Array.prototype.slice.call(arguments);
        var count=0;
        return this.replace(/%s/g,function(s,i){
            return args[count++];
        });
    };


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
        // call the robot
        $("#deliverRobot").on('click', function (e) {
            e.preventDefault();
            //set selected room
            $('#edit_dest').siblings().children(".searchable-select-holder").html(getRoom());
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

    function initEvent() {
        $("#dataList").on('click', 'td[class~="order"]', function () {
            var button = $(this);
            var orderId = button.data('value');
            var dataDom = $("#dataList").find("tr[dataId=" + orderId + "]");
            dataDom.each(function (key, value) {
                var dataOne = $(value);
                if (dataOne.hasClass('orderProduct')) {
                    dataOne.toggle();
                }
            });
            var text = button.html();
            button.html(button.data('toggle'));
            button.data('toggle', text);

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
        initEvent();
        initDeliverEditor();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.robotShoppingList.init();
})
