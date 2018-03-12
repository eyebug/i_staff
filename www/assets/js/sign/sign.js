function init() {
    $('div#login-detail').hide();
    $('button.option').bind('click', next);
    $('button.submit').bind('click', submit);
    initDate();
}

function submit(e) {
    e.preventDefault();
    var formdata = $('form#sign-detail').serializeArray();
    var data = {};
    var gyms = [];
    $(formdata).each(function (index, obj) {
        data[obj.name] = obj.value;
    });
    data["gyms"] = gyms;
    $.ajax({
        type: 'POST',
        url: '/sign/doSign',
        data: data,
        success: function (data) {
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
                        $('input[name="num"]').focus();
                    } else {
                        clearForm();
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


function initDate() {
    var datatimepickerConfig = {
        language: 'zh-CN',
        format: 'yyyy-mm-dd hh:ii:ss',
        autoclose: true,
        todayBtn: true,
        weekStart: 1,
        minView: 0,
        startDate: new Date(),
        startView: 1
    };
    $("input.datetimepicker").datetimepicker(datatimepickerConfig);
}

$(function () {
    init();
});