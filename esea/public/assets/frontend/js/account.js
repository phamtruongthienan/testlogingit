var logo;
$(function() {
    
    $('.genitive').fastselect({
        elementClass: 'fstElement txt-search-advanced _8',
        placeholder: "Add genitive",
        maxItems: 4
    });

    $('.block-form-add-child').hide();
    $('.block-user-change-password').hide();
    $('#form-account-change-pass').hide();
    
    $(document).on('click', '.btn-child-edit', function(event) {
        event.preventDefault();
        var id = $(this).attr('data-id');
        $.ajax({
            url: base_url + "/child?id="+id+"&include=m_school.m_schooltranslations",
            type: "get",
            success: function(response) {
                if(response.code == 200) {
                    $('#idChild').val(response.data.id);
                    $('#nameChild').val(response.data.name); 
                    result = response.data.genitive.split(',');
                        $.each( $('#genitiveChild > option'), function(i,v) {
                            $.each( result, function(item,val) {
                            if($(v).attr('value') == val){
                                $('#genitiveChild option[value="'+$(v).attr('value')+'"]').attr('selected','selected');
                            }
                        })
                    })
                    $('.genitive1').fastselect({
                        elementClass: 'fstElement txt-search-advanced _8',
                        placeholder: "Add genitive",
                        maxItems: 4
                    });

                    if(response.data.gender == 1) {
                        $('#boy').prop("checked", true);
                    } else {
                        $('#girl').prop("checked", true);
                    }
                    $('#birthChild').val(response.data.dob.replace(' 00:00:00', ''));
                    $('.block-list-child').fadeOut(function() {
                        $('.block-form-child').fadeIn();
                    });
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

    $(document).on('click', '.btn-child-add', function(event) {
        event.preventDefault();
        $('.block-form-child').hide();
        $('.block-list-child').fadeOut(function() {
            $('.block-form-add-child').fadeIn();
        });
    });

    $(document).on('click', '.btn-add-child-save', function(event) {
        event.preventDefault();
        $.ajax({
            url: base_url + "/account/add_child",
            data: $('#form-add-child').serialize(),
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

    $(document).on("click", ".unWishlist", function() {
        var action_type =  $(this).attr('data-action');
        var  data_post = {
            id: $(this).attr('data-id'),
            action: action_type,
        };
        $.ajax({
            url: base_url + "/wishlist",
            data: data_post,
            type: "post",
            success: function(response) {
                if(response.code == 200) {
                    Lobibox.notify("success", {
                        title: 'Thông báo',
                        pauseDelayOnHover: false,
                        continueDelayOnInactiveTab: false,
                        icon: false,
                        sound: false,
                        msg: response.msg
                    });
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
    
    $(document).on("click", ".btn-user-save-changePassword", function() {
        $.ajax({
            url: base_url + "/account/change_password",
            data: $('#form-account-change-pass').serialize(),
            type: "post",
            success: function(response) {
                if(response.code == 200) {
                    Lobibox.notify("success", {
                        title: 'Thông báo',
                        pauseDelayOnHover: false,
                        continueDelayOnInactiveTab: false,
                        icon: false,
                        sound: false,
                        msg: 'Thay đổi mật khẩu thành công'
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

    $('.block-user-edit').hide();
    $(".file-upload").on('change', function() {
        readURL(this);
    });

    $(".upload-button").on('click', function() {
        $(".file-upload").click();
    });

    $(document).on("click", ".btn-user-edit", function(event) {
        event.preventDefault();
        $('#form-account-change-pass').fadeOut();
        $('.block-user-info').fadeOut(function() {
            $('.block-user-edit').fadeIn();
        });
    });

    $(document).on("click", ".btn-user-changePassword", function(event) {
        event.preventDefault();
        $('#form-account-change-pass').fadeIn();
        $('.btn-user-changePassword').hide();
    });

    $(document).on("click", ".btn-user-save", function(event) {
        event.preventDefault();
        // $('.btn-user-save').hide();
        $('#form-account').submit();
    });

   
    $(document).on("click", ".btn-child-delete", function(event) {
        event.preventDefault();
        var id = $(this).attr('data-id');
        $('#confirm-delete-modal #idChild').val(id);
        $('#confirm-delete-modal').modal('show');
    });

    $(document).on("click", ".btn-child-save", function(event) {
        event.preventDefault();
        $('.btn-child-save').hide();
        $('#form-child').submit();
    });

    $('.birthday').datepicker({
        format: "yyyy-mm-dd",
        clearBtn: true,
        language: "vi"
    });

    if ($().validator) {
        $('#form-account').validator().on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();
                var dob = $('#birthdayAccount').val();
                $.ajax({
                    url: base_url + "/account/update",
                    data: $('#form-account').serialize()+'&logo='+encodeURIComponent($('#logoAccount').attr('value')),
                    type: "post",
                    success: function(response) {
                        if(response.code == 200) {
                            Lobibox.notify("success", {
                                title: 'Thông báo',
                                pauseDelayOnHover: false,
                                continueDelayOnInactiveTab: false,
                                icon: false,
                                sound: false,
                                msg: response.msg
                            });
                            if($('#logoAccount').val() != "") {
                                $('#avatar_main').css('background-image', 'url('+$('#logoAccount').val()+')');
                            }
                            $('#logoAccount').val('');
                            $('.block-user-edit').fadeOut(function() {
                                $('.block-user-info').fadeIn();
                            });
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
                // setTimeout(function() {
                //     $('.btn-user-save').fadeIn();
                //     location.reload();
                // }, 300);
            }
        });

        $('#form-child').validator({
            custom: {
                required: function($el) {
                    return !!$.trim($el.val())
                }
            }
        }).on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();
                $.ajax({
                    url: base_url + "/account/update_child",
                    data: $('#form-child').serialize(),
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
                            $('.block-form-child').fadeOut(function() {
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
            }
        });
    }

    $(document).on("click", "#confirm-delete", function(event) {
        event.preventDefault();
        $.ajax({
            url: base_url + "/account/delete_child",
            data: {idChild: $('#confirm-delete-modal #idChild').val()},
            type: "post",
            success: function(response) {
                if(response.code == 200) {
                    Lobibox.notify("success", {
                        title: 'Thông báo',
                        pauseDelayOnHover: false,
                        continueDelayOnInactiveTab: false,
                        icon: false,
                        sound: false,
                        msg: response.msg
                    });
                    $('#child_item_'+$('#confirm-delete-modal #idChild').val()).remove();
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
    $(document).on("focusin", ".birthday", function() {
        $(this).prop('readonly', true);
    });

    $(document).on("focusout", ".birthday", function() {
        $(this).prop('readonly', false);
    });
});

var readURL = function(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            if((e.target.result).length < 3000000) {
                $('#avatar_frame').css('background-image', 'url(' + e.target.result + ')');
                $('#logoAccount').val(e.target.result);
                logo = e.target.result;
            } else {
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: false,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: 'Vui lòng chọn ảnh có dung lượng thấp hơn 3MB.'
                });
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}