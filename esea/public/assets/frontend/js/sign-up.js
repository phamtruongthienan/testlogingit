$(function() {
    if ($().validator) {
        $('#form-create-account').validator().on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();
                $('.alert').html('').hide();
                $.ajax({
                    url: base_url + "/sign-up",
                    data: $('#form-create-account').serialize(),
                    type: "post",
                    success: function(response) {
                        if (response.code == '200') {
                            $('#signup_main').hide();
                            $('#signup_ty').show();
                            $('.alert').html('').hide();
                        } else {
                            $('.alert').html(response.msg).show();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#signup_main').show();
                        $('#signup_ty').hide();
                    }
                });
            }
        });

        $(document).on("click", ".btn-create", function(event) {
            event.preventDefault();
            $('#form-create-account').submit();
        });
    }
});