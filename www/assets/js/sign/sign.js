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
            if (data.code == 0) {
                alert('Success(签到成功)');
                window.location.href = "/sign/index";
            } else {
                var tryAgain = false;
                if (data.code == 1) {
                    tryAgain = confirm("请输入所有内容, 重新输入?");
                    $('div#login-detail').hide();
                    $('div#info-detail').show();
                    if (tryAgain) {
                        clearForm();
                    } else {
                        $('input[name="num"]').focus();
                    }
                } else {
                    tryAgain = confirm(data.msg + "，重新输入?");
                    if (tryAgain) {
                        clearForm();
                        $('div#login-detail').hide();
                        $('div#info-detail').show();
                    } else {
                        $('input[name="room"]').focus();
                    }
                }
            }
        },
        error: function (request, status, error) {
            ob.removeAttr('disabled');
        }
    });

}

function next() {
    $('div#info-detail').hide();
    $('div#login-detail').show();
}

function clearForm() {
    $("input[type=reset]").click();
}

$(function () {
    init();
});