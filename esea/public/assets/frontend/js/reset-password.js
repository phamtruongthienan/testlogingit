$(function() {
    if ($().validator) {
        $('#form-reset-account').validator().on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();
                $('.alert').html('').hide();
                $.ajax({
                    url: base_url + "/reset-password",
                    data: $('#form-reset-account').serialize(),
                    type: "post",
                    success: function(response) {
                        if (response.code == '200') {
                            $('#reset_main').hide();
                            $('#reset_ty').show();
                            $('.alert').html('').hide();
                        } else {
                            $('.alert').html(response.msg).show();
                        }
                        grecaptcha.reset();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#reset_main').show();
                        $('#reset_ty').hide();
                        grecaptcha.reset();
                    }
                });
            }
        });

        $(document).on("click", ".btn-reset", function(event) {
            event.preventDefault();
            $('#form-reset-account').submit();
        });
    }
});