$(function() {

    $(document).on('click', '#sendContactBtn', function(event) {
        event.preventDefault();
        $.ajax({
            url: base_url + "/sendcontact",
            data: $('#form-contact').serialize(),
            type: "post",
            success: function(response) {
                if(response.code == 200) {
                    location.reload();
                } else {
                    Lobibox.notify("warning", {
                        title: 'Thông báo',
                        pauseDelayOnHover: false,
                        continueDelayOnInactiveTab: false,
                        icon: false,
                        sound: false,
                        msg: response.msg
                    });
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
            }
        });
    });
});