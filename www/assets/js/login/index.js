var iHotel = iHotel || {};
iHotel.loginIndex = (function ($, ypRecordVar) {

    var ajax = YP.ajax;

    function initLogin() {
        var user = $("#userName"), pass = $("#userPass"), buttonDom = $("#submitForm");
        var isAd = $("#isAd");
        var hotelList = $("option.hotelid"), hotel = $('#hotelid');


        buttonDom.on('click', function () {
            var params = {
                username: user.val(),
                password: pass.val(),
            };
            if (isAd[0] != undefined) {
                params.isAd = isAd[0].checked;
            }
            if (!params['username']) {
                showMsg('用户名不能为空！');
                return false;
            }
            if (!params['password']) {
                showMsg('密码不能为空！');
                return false;
            }
            params[ypRecordVar.recordPostVar] = "登录后台";
            doLogin(params);
        });
    }

    function doLogin(params) {
        var buttonDom = $("#submitForm");
        var url = '/loginajax/doLogin';
        buttonDom.button('loading');
        var xhr = ajax.ajax({
            url: url,
            type: 'POST',
            data: params,
            cache: false,
            dataType: 'json',
            timeout: 10000
        });
        xhr.done(function () {
            location.href = "/index/index";
        }).fail(function (data) {
            buttonDom.button('reset');
            showMsg(data.msg);
        });
    }

    function showMsg(message) {
        var messageDom = $("#message");
        if (message) {
            messageDom.show().html(message);
        }
    }

    function init() {
        initLogin();
    }

    return {
        init: init
    };
})(jQuery, YP_RECORD_VARS);

$(function () {
    iHotel.loginIndex.init();
})