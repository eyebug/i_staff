$(function () {
    tips = YP.alert;
    ajax = YP.ajax;
    var url = YP_GLOBAL_VARS.callRobot;
    var data = {
        type: 'guide',
    };
    $('#roomGuideBtn').click(function (e) {
        var button = $('#roomGuideBtn');
        toggelButton(button)
        data.dest = $('#room_dest').val();
        var xhr = ajax.ajax({
            url: url,
            type: "POST",
            data: data,
            cache: false,
            dataType: "json",
            timeout: 10000
        });
        xhr.done(function (res) {
            toggelButton(button)
            tips.show(res.data.msg, 'success');
        }).fail(function (res) {
            toggelButton(button)
            tips.show(res.msg);
        });
    });

    $('#floorGuideBtn').click(function (e) {
        var button = $(this);
        data.dest = $('#floor_dest').val();
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
            toggelButton(button)
            tips.show(res.data.msg, 'success');
        }).fail(function (res) {
            toggelButton(button)
            tips.show(res.msg);
        });
    });

    $('#callRobot').click(function (e) {
        var button = $(this);
        var data = {};
        data.dest = $('#public_dest').val();
        toggelButton(button)
        var xhr = ajax.ajax({
            url: url,
            type: "POST",
            data: data,
            cache: false,
            dataType: "json",
            timeout: 10000
        });
        xhr.done(function (res) {
            toggelButton(button)
            tips.show(res.data.msg, 'success');
        }).fail(function (res) {
            toggelButton(button)
            tips.show(res.msg);
        });
    });


    function toggelButton(button) {
        var txt = button.text().trim();
        button.text(button.attr('data-loading-text').trim());
        button.attr('data-loading-text', txt);
        var status = button.attr('disabled');
        if (status == 'disabled') {
            button.removeAttr('disabled');
        } else {
            button.attr('disabled', 'disabled');
        }

    }

})
