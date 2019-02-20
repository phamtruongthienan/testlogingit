var app = app || {};

app.init = function () {
	changeImage('#logoImage', 'input[id="logoFile"]', '#infoForm');
	$('input[type="checkbox"].minimal').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass   : 'iradio_minimal-blue'
	});
	$('[data-mask]').inputmask();
	$('.my-colorpicker').colorpicker();
	$(document).on('shown.bs.tab', 'a[href="#language"]', function (e) {
 	   $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

    $(document).on('shown.bs.tab', 'a[href="#information"], a[href="#seo"]', function (e) {
		$('#blockLanguage').show();
    });

    $(document).on('shown.bs.tab', 'a[href="#social"], a[href="#language"]', function (e) {
        $('#blockLanguage').hide();
    });

	var table_dynamic_language = $('.table-dynamic-language').DataTable({
		"processing": true,
        "serverSide": true,
        "ajax": base_admin+"/ajax/setting",
		'responsive': true,
		'paging': true,
		'lengthChange': true,
		'searching': true,
		'ordering': true,
		'info': true,
		'autoWidth': true,
		'scrollX': true,
		'scrollCollapse': true,
		"columns": [
			{"data": "id"},
			{"data": "name"},
			{"data": "code"},
			{"data": "default"},
			{"data": "currency_code"},
			{"data": "date_format"},
			{"data": "action"}
		],
		'columnDefs': [
			{
				width: '150px',
				targets: [3, 4, 5],
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0, 2],
				class: 'text-center'
			},
			{
				width: '200px',
				targets: [-1],
				orderable: false,
				class: 'text-center'
			},
			{
				targets: [3],
				orderable: false
			}
		],
		"drawCallback": function (settings) {
			if ($('input[type="radio"]').length > 0) {
				$('input[type="radio"]').iCheck({
					radioClass: 'iradio_minimal-blue'
				});
			}
		}
	});

	$(table_dynamic_language.table().container()).on('ifChecked', 'input[type="radio"]', function() {
		var id = $(this).data("id");
		$.ajax({
			url: base_admin + "/ajax/setting?action=update&type=2&id=" + id,
			type: "post",
			success: function (response) {
                if (response.code == '200') {
                    Lobibox.notify("success", {
                        title: 'Thông báo',
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        icon: false,
                        sound: false,
                        msg: response.msg
                    });
                    table_dynamic_language.ajax.reload(null, true);
                } else {
                    Lobibox.notify("warning", {
                        title: 'Thông báo',
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        icon: false,
                        sound: false,
                        msg: response.msg
                    });
                }
			},
			error: function (jqXHR, textStatus, errorThrown) {
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: 'Có lỗi trong quá trình xử lý'
                });
			}
		});
	});

	$('#infoForm').validator().on('submit', function (e) {
		$('#InfoBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
            app.SettingFormSubmit('#infoForm', '', '#InfoBtn', '');
		} else {
			$('#InfoBtn').button('reset');
		}
	});

    app.UpdateConfigMain();
    app.UpdateConfigOther();

	$('#seoForm').validator().on('submit', function (e) {
		$('#SeoBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
            app.SettingFormSubmit('#seoForm', '', '#SeoBtn', '');
		} else {
			$('#SeoBtn').button('reset');
		}
	});

	$('#socialForm').validator().on('submit', function (e) {
		$('#addSocialBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
            e.preventDefault();
            app.SettingFormSubmit('#socialForm', '', '#addSocialBtn', '');
		} else {
            $('#addSocialBtn').button('reset');
		}
	});

	$('#editLanguageForm').validator().on('submit', function (e) {
		$('#editLanguageBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
            e.preventDefault();
            app.SettingFormSubmit('#editLanguageForm', table_dynamic_language, '#editLanguageBtn', '#modal-language-edit');
		} else {
            $('#editLanguageBtn').button('reset');
		}
	});

	$(document).on('click', '.table-action-edit', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
        app.UpdateConfigLanguage(id);
		$('#modal-language-edit').modal('show');
	});

	$(document).on('click', '#editLanguageBtn', function (e) {
		e.preventDefault();
		$('#editLanguageForm').submit();
	});
};

app.UpdateConfigMain = function() {
    $.ajax({
        url: base_admin + "/ajax/setting?table=main",
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.configMainTranslations !== "undefined") {
                    $.each(response.data.configMainTranslations, function(k, v) {
                        if(v.logo != null) {
                            $('#infoForm #logoImage').attr('src', base_url+'/img/'+v.logo)
                        } else {
                            $('#infoForm #logoImage').attr('src', base_url+'/assets/backend/img/avatar.png');
                        }
						$('#infoForm .id').val(response.data.id);
                        $('#seoForm .id').val(response.data.id);
						$('#infoForm #name').val(v.name);
                        $('#infoForm #company_name').val(v.company_name);
                        $('#infoForm #slogan').val(v.slogan);
                        $('#infoForm #quote').val(v.quote);
                        $('#infoForm #address').val(v.address);
                        $('#infoForm #phone').val(v.phone);
                        $('#infoForm #email').val(v.email);
                        $('#infoForm #represent').val(v.represent);
                        $('#infoForm #num_promo').val(v.num_promo);

                        if(v.enable_ssl) {
                            $('#seoForm #enable_ssl').iCheck('check');
						} else {
                            $('#seoForm #enable_ssl').iCheck('uncheck');
						}
                        $('#seoForm #meta_title').val(v.meta_title);
                        $('#seoForm #meta_keyword').val(v.meta_keyword);
                        $('#seoForm #meta_description').val(v.meta_description);
                        $('#seoForm #analytics_id').val(v.analytics_id);
                        $('#seoForm #facebook_page').val(v.facebook_page);
                        $('#seoForm #googleplus_page').val(v.googleplus_page);
                        var bg_search = v.background_search.split(",");
                        var element_search = $('#infoForm .background_search.my-colorpicker');
                        $.each(bg_search, function(k, v) {
                            $(element_search[k]).colorpicker('setValue', v);
                        });

                        var bg_promotion = v.background_promotion.split(",");
                        var element_promotion = $('#infoForm .background_promotion.my-colorpicker');
                        $.each(bg_promotion, function(k, v) {
                            $(element_promotion[k]).colorpicker('setValue', v);
                        });

                        var bg_client = v.background_client.split(",");
                        var element_client = $('#infoForm .background_client.my-colorpicker');
                        $.each(bg_client, function(k, v) {
                            $(element_client[k]).colorpicker('setValue', v);
                        });
                    });
                }
            } else {
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
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
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                icon: false,
                sound: false,
                msg: response.msg
            });
        }
    });
};

app.UpdateConfigOther = function() {
    $.ajax({
        url: base_admin + "/ajax/setting?table=other",
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                $.each(response.data, function(k, v) {
                    switch (v.key) {
                        case 'FB_APP_ID':
                            $('#socialForm #FB_APP_ID').val(v.value);
                            break;
                        case 'FB_APP_KEY':
                            $('#socialForm #FB_APP_KEY').val(v.value);
                            break;
                        case 'FB_APP_CALLBACK':
                            $('#socialForm #FB_APP_CALLBACK').val(v.value);
                            break;
                        case 'GG_APP_ID':
                            $('#socialForm #GG_APP_ID').val(v.value);
                            break;
                        case 'GG_APP_KEY':
                            $('#socialForm #GG_APP_KEY').val(v.value);
                            break;
                        case 'GG_APP_CALLBACK':
                            $('#socialForm #GG_APP_CALLBACK').val(v.value);
                            break;
                        default:
                            $('#socialForm #GG_KEY_MAP').val(v.value);
                    }
                })
            } else {
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
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
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                icon: false,
                sound: false,
                msg: response.msg
            });
        }
    });
};

app.UpdateConfigLanguage = function(id) {
    $.ajax({
        url: base_admin + "/ajax/setting?id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                $('#editLanguageForm .id').val(response.data.id);
                $('#editLanguageForm #name').val(response.data.name);
                $('#editLanguageForm #code').text(response.data.code);
                $('#editLanguageForm #currency_code').val(response.data.currency_code);
                if(response.data.mExchangeRate.length > 0) {
                    $('#editLanguageForm #rate').val(response.data.mExchangeRate[0].rate);
                } else {
                    $('#editLanguageForm #rate').val('');
                }
                $('#editLanguageForm #date_format').val(response.data.date_format).trigger('change');
            } else {
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
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
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                icon: false,
                sound: false,
                msg: response.msg
            });
        }
    });
};

app.SettingFormSubmit = function(form, table, btn, modal) {
    $.ajax({
        url: base_admin + "/ajax/setting",
        type: "post",
        data: $(form).serialize(),
        success: function(response) {
            if (response.code == '200') {
                Lobibox.notify("success", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: response.msg
                });
                if(table != '') {
                    table.ajax.reload(null, true);
				}
                $(btn).button('reset');
                if(modal != '') {
                    $(modal).modal('hide');
                }
            } else {
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
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
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                icon: false,
                sound: false,
                msg: 'Có lỗi trong quá trình xử lý'
            });
        }
    });
};

$(function() {
	app.init();
});