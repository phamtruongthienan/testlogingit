$(function() {
    if ($().validator) {
        $('#form-forget-password').validator().on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();
                Lobibox.notify("success", {
                    // position: 'top right',
                    title: 'Thành công',
                    pauseDelayOnHover: false,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: 'Gửi mail thành công.'
                });
            }
        })
    }
});