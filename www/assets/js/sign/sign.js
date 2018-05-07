function init() {
    $('div#login-detail').hide();
    $('button.option').bind('click', next);
    $('button.submit').bind('click', submit);
}

function submit(e) {
    e.preventDefault();
    var ob = $(e.currentTarget);
    ob.attr('disabled', true);
    var formdata = $('form#sign-detail').serializeArray();
    $.ajax({
        type: 'POST',
        url: '/sign/doSign',
        data: formdata,
        success: function (data) {
            ob.removeAttr('disabled');
            var msg = getMsg(data.code);
            if (data.code == 0) {
                alert(msg);
                window.location.href = "/sign/index?hotelid=" + $('input[name=hotelid]').val();
            } else {
                if (data.code == 1) {
                    alert(msg);
                    $('div#login-detail').hide();
                    $('div#info-detail').show();
                } else {
                    alert(msg);
                    $('input[name="room"]').focus();
                }
            }
        },
        error: function (request, status, error) {
            ob.removeAttr('disabled');
        }
    });

}

function getMsg(code) {
    var lang = getCookie('systemLang');
    var data = {
        'zh': {
            0: '成功',
            1: '请输入所有内容，重新输入？',
            4: '房间号和名称错误，登录失败。重新输入？',
            other: '系统错误，重试？'
        },
        'en': {
            0: 'Success',
            1: 'Please input all the required information, start over?',
            4: 'Room No. or Last Name are not matched, start over?',
            other: 'System Error，try again?'
        }
    };
    if (!data[lang]) {
        lang = 'zh';
    }
    var result = data[lang][code];
    if (result == undefined) {
        result = data[lang]['other'];
    }
    return result;
}

function getCookie(name) {
    var result = 'zh';
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) {
        result = parts.pop().split(";").shift();
    }
    return result;
}

function next() {
    $('div#info-detail').hide();
    $('div#login-detail').show();
}

$(function () {
    init();
});