$(function () {
    // tips = YP.alert;
    ajax = YP.ajax;
    var url = YP_GLOBAL_VARS.resetUrl;

    $("#dataList").on('click', 'button[op=editDataOne]', function () {
        var token = $('input[type="hidden"]').val();
        var button = $(this);
        data = {
            token: token,
            user_id: button.data('dataid')
        };
        var msg = "重置住客密码，使住客可以再次初始化密码";
        var myConfirm = confirm(msg);
        if (!myConfirm) return false;

        toggelButton(button);
        var xhr = ajax.ajax({
            url: url,
            type: "POST",
            data: data,
            cache: false,
            dataType: "json",
            timeout: 10000
        });
        xhr.done(function (res) {
            toggelButton(button);
            YP.alert.show('重置成功', 'success');
        }).fail(function (res) {
            toggelButton(button);
            YP.alert.show(res.msg);
        });
    });


    function toggelButton(button) {
        var txt = button.text().trim();
        button.text(button.data('loading-text').trim());
        button.data('loading-text', txt);
        var status = button.attr('disabled');
        if (status == 'disabled') {
            button.removeAttr('disabled');
        } else {
            button.attr('disabled', 'disabled');
        }
    }

});
