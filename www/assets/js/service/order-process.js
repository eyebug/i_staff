var iHotel = iHotel || {};
iHotel.robotShoppingList = (function ($, ypGlobal) {

    var ajax = YP.ajax, tips = YP.alert, shoppingItemList = new YP.list;

    /**
     * 初始化列表
     */
    function initAcitivityUserList() {
        $("#filter_hotelid,#filter_activityid").select2({
            placeholder: '全部',
            language: 'zh-CN'
        });
        shoppingItemList.init({
            colCount: 10,
            autoLoad: true,
            listUrl: ypGlobal.listUrl,
            listDomObject: $("#dataList"),
            searchButtonDomObject: $("#searchBtn"),
            listTemplate: 'dataList_tpl',
            listSuccess: function (data) {
                writeList(data);
            },
            listFail: function (data) {
                tips.show('数据加载失败！');
            }
        });
    }


    var tagForm = new YP.form;

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
                    saveUrl: ypGlobal.updateUrl
                });
                saveParams = tagForm.makeRecord(saveParams, saveParams.id, saveParams.titleLang1);
                YP_RECORD_VARS.isChange = 1;
                return saveParams;
            },
            saveSuccess: function (data) {
                tips.show('Success', 'success');
                shoppingItemList.reLoadList();
            },
            saveFail: function (data) {
                tips.show(data.msg);
            }
        });
        // 新建产品
        $("#createData").on('click', function () {
            tagForm.writeEditor({
                editorDom: $("#listEditor")
            });
        });
        // 编辑产品
        $("#dataList").on('click', 'button[op=editDataOne]', function () {
            var $editId = $(this).data('ordersproductsid'),
                $dataDom = $("#dataList").find("[ordersproductsid=" + $editId + "]");
            var dataList = {};
            $dataDom.find('td').each(function (key, value) {
                var dataOne = $(value);
                if (dataOne.attr('type')) {
                    dataList[dataOne.attr('type')] = dataOne.data('value');
                    if (dataOne.attr('type') == 'adminid') {
                        dataList['adminid'] = $('#current_userid').val();
                    }
                    if (dataOne.attr('type') == 'memo' && dataList[dataOne.attr('type')] == '') {
                        dataList['memo'] = $('#current_username').val();
                    }
                }
            });
            tagForm.writeEditor({
                editorDom: $("#listEditor"),
                writeData: dataList
            });
            detailModal.modal('show');
        });
    }

    function writeList(data) {
        if (data.data.list.length > 0) {
            var pageHtml = template(shoppingItemList.listParams.pageTemplate, data.data.pageData);
            shoppingItemList.listParams.pageDomObject.html(pageHtml).show();
        } else {
            shoppingItemList.listParams.pageDomObject.hide();
        }
        dataTable(data);
    }

    function dataTable(data) {
        shoppingItemList.listParams.listDomObject.html('');
        var orderId = "";
        for (var i = 0; i < data.data.list.length; i++) {
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
                var orderRowStr = '<tr orderid="%s" ordersproductsid="%s" class="order"  style="background-color: lightgrey ;">\n' +
                    '    <td data-value="%s" type="orderid" class="order"><span class="order close" data-value="%s" data-toggle="-">+</span>%s</td>\n' +
                    '    <td data-value="%s" type="createtime">%s</td>\n' +
                    '    <td>%s</td>\n' +
                    '    <td></td>\n' +
                    '    <td>%s</td>\n' +
                    '    <td></td>\n' +
                    '    <td>%s</td>\n' +
                    '    <td></td>\n' +
                    '    <td></td>\n' +
                    '    <td></td>\n' +
                    '    <td></td>\n' +
                    '</tr>';
                var orderRow = $(orderRowStr.format(order.id, order.ordersProductsId, order.id, order.id, order.id, order.createtime, order.createtime, order.userRoom, count, order.status));
                shoppingItemList.listParams.listDomObject.append(orderRow);
            }

            var orderProductStr = '<tr orderid="%s" ordersproductsid="%s" class="orderProduct" style="background-color: white; display: none">\n' +
                '    <td data-value="%s" type="orderid">%s</td>\n' +
                '    <td type="createtime">%s</td>\n' +
                '    <td>%s</td>\n' +
                '    <td>%s</td>\n' +
                '    <td data-value="%s" type="count">%s</td>\n' +
                '    <td data-value="%s" type="price">%s</td>\n' +
                '    <td data-value="%s" type="productstatus">%s</td>\n' +
                '    <td data-value="%s" type="status">%s</td>\n' +
                '    <td data-value="%s" type="adminid">%s</td>\n' +
                '    <td data-value="%s" type="memo">%s</td>\n' +
                '    <td data-value="%s" type="ordersproductsid" style="display: none">%s</td>\n' +
                '    <td><button class="btn btn-info btn-sm" data-ordersproductsid="%s" op="editDataOne" type="button" style="%s">修改</button>' +
                '    </td>\n' +
                '</tr>';
            var isHidden = '';
            if (order.productstatus == 3 || order.productstatus == 4) {
                isHidden = 'display: none;';
            }
            var orderProductRow = $(orderProductStr.format(order.id, order.ordersProductsId, order.id, order.id, order.createtime, order.userRoom,
                order.shopping, order.count, order.count, order.price, order.price, order.productstatus, order.productstatusname, order.robotstatus, order.robotstatusname,
                order.adminid, order.admin, order.memo, order.memo, order.ordersProductsId, order.ordersProductsId, order.ordersProductsId, isHidden));
            shoppingItemList.listParams.listDomObject.append(orderProductRow);

        }
        shoppingItemList.listParams.listDomObject.show();
    }

    String.prototype.format = function () {
        var args = Array.prototype.slice.call(arguments);
        var count = 0;
        return this.replace(/%s/g, function (s, i) {
            return args[count++];
        });
    };


    function initEvent() {
        $("#dataList").on('click', 'td[class~="order"]', function () {
            var button = $(this);
            var orderId = button.data('value');
            var dataDom = $("#dataList").find("tr[orderid=" + orderId + "]");
            dataDom.each(function (key, value) {
                var dataOne = $(value);
                if (dataOne.hasClass('orderProduct')) {
                    dataOne.toggle();
                }
            });
            var spanEle = $(button.children()[0]);
            var text = spanEle.html();
            spanEle.html(spanEle.data('toggle'));
            spanEle.data('toggle', text);

        })
    }

    //Adjust modal form size
    function initCss() {
        var modalBody = $(".yulong .modal-body[mf=modalfix]");
        modalBody.height('300px');
        $(window).resize(function () {
            modalBody.height('300px');
        })

    }


    function init() {
        initAcitivityUserList();
        initEditor();
        initCss();
        initEvent();
    }

    return {
        init: init
    };
})(jQuery, YP_GLOBAL_VARS);

$(function () {
    iHotel.robotShoppingList.init();
})
