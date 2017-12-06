$(function () {
    $("#changeHotel").on('click', '[op=changeHotel]', function () {
        var ajax = YP.ajax, changeHotelButton = $("#changeHotel > button");
        var hotelid = $(this).data('hotelid');
        if (hotelid == changeHotelButton.data('now')) {
            return true;
        }
        changeHotelButton.button('loading');
        var xhr = ajax.ajax({
            url: '/loginajax/changeHotelId/',
            type: 'POST',
            data: {hotelid: hotelid},
            cache: false,
            dataType: "json",
            timeout: 100000
        });
        xhr.done(function (data) {
            location.reload();
        }).fail(function (data) {
            tips.show(data.msg);
            changeHotelButton.button('reset');
        });
    });
});