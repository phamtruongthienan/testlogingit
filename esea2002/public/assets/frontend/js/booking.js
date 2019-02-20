$(function() {

        $('#datetimepicker').datetimepicker({
            format:'Y-m-d H:i',
            defaultDate:new Date(),
            minDate:0,
            minTime:0,
            inline:true,
        });

        // console.log(datetimepicker({format: 'Y-m-d H:i:s'}));

    // $('.timepicker').timepicker({
    //     showInputs: false
    // });

    $(document).on("click", "#bookingBtn", function() {
        var d= moment(new Date($('#datetimepicker').datetimepicker('getValue'))).format('YYYY-MM-DD H:mm:00');
        $('#dateBooking').val(d);
        $.ajax({
            url: base_url + "/booking",
            data: $('#bookingForm').serialize(),
            type: "post",
            success: function(response) {
                if(response.code == 200) {
                    Lobibox.notify("success", {
                        title: 'Thông báo',
                        pauseDelayOnHover: false,
                        continueDelayOnInactiveTab: false,
                        icon: false,
                        sound: false,
                        msg: 'Bạn đã đặt lịch tham quan trường thành công'
                    });
                    setTimeout(function(){
                        window.location.reload();
                    }, 300);
                } else {
                    Lobibox.notify("warning", {
                        title: 'Thông báo',
                        pauseDelayOnHover: false,
                        continueDelayOnInactiveTab: false,
                        icon: false,
                        sound: false,
                        msg: response.msg
                    });
                    $('.block-form-add-child').fadeOut(function() {
                        $('.block-list-child').fadeIn();
                    });
                    $('.btn-child-save').show();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: false,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: 'Có lỗi trong quá trình cập nhật'
                });
                $('.block-form-child').fadeOut(function() {
                    $('.block-list-child').fadeIn();
                });
                $('.btn-child-save').show();
            }
        });
    });
});