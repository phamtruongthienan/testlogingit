var app = app || {};

app.init = function () {	
	app.changeUrl($('#inputAddName'), $('#inputAddSEO'));
	app.changeUrl($('#inputAddSEO'), $('#inputAddSEO'));
	app.changeUrl($('#inputEditName'), $('#inputEditSEO'));
	app.changeUrl($('#inputEditSEO'), $('#inputEditSEO'));
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});
	$('.modal').on( 'show.bs.modal', function (e) {
		if ($('input[type="radio"], input[type="checkbox"]').length > 0) {
			$('input[type="radio"], input[type="checkbox"]').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass: 'iradio_minimal-blue'
			});
		}		
		$('.select2').select2();
	});

	var table_dynamic_news = $('.table-dynamic-news').DataTable({
		"processing": true,
		"ajax": base_admin + "/ajax/news",
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
			{"data": "layout"},
			{"data": "active"},
			{"data": "action"}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '200px',
				targets: [-1, 2]
			},
			{
				width: '100px',
				targets: [0, -2],
				class: 'text-center'
			},
			{
				targets: [-1],
				class: 'text-center',
				orderable: false,
			}
		]		
	});

	$('#addNewsForm').validator().on('submit', function (e) {
		$('#addNewsBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg').removeClass('no-display');
						$('#addNewsBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#addNewsBtn').button('reset');
		}
	});
	

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		var id = $(this).data('id');
		console.log(id);
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		}).one('click', '#confirm-delete', function (e) {
				table.row(row.parents('tr')).remove().draw();
				app.DeleteNews(id, table_dynamic_news);
		});
	});

	$(document).on('click', '.table-action-edit,#modal-news .tab_edit_news', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		var lang = $(this).attr('data-lang');
		app.ClearFormNews(lang,'update');
		app.LoadFormNews(id,lang);
	});

	$(document).on('click', '#addNews', function (e) {
		e.preventDefault();
		var lang = $(this).attr('data-lang');
		app.ClearFormNews(lang, 'add');
		console.log("themclick1" + lang);
		$('#modal-news').modal('show');		
	});

	$(document).on('click', '#addNewsBtn', function (e) {
		e.preventDefault();
		app.NewsFormSubmit(table_dynamic_news);
		// $('#addNewsForm').submit();
	});

}

app.xoa_dau = function (str) {
	str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
	str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
	str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
	str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
	str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
	str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
	str = str.replace(/đ/g, "d");
	return str;
}

app.string_to_slug = function (str) {
  str = str.replace(/^\s+|\s+$/g, ''); // trim
	str = str.toLowerCase();  
	str = app.xoa_dau(str);// remove accents, swap ñ for n, etc
  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

  return str;
}

app.changeUrl = function (elementConvert, elementValue) {	
	elementConvert.keyup(function() {
		var val = $(this).val();
		var url = app.string_to_slug(val);
		elementValue.val(url);
	});
}

app.ClearFormNews = function(lang, type) {
	$('#modal-news ul > li').removeClass('active');
	$('#modal-news #lang').val(lang);
    if (type == "add") {
		$('#modal-news .nav-tabs').hide();
		$('#modal-news .modal-title').html('Thêm bài viết mới1');
		$('#modal-news #action').val("insert");
		$('#modal-news #inputAddName').val("");
		$('#modal-news #inputAddSEO').val("");
		$('#modal-news #inputKeyWord').val("");
		$('#modal-news #inputDescription').val("");
		$('#modal-news #inputAddContent').summernote('code',"");
		$('#modal-news #addStatus').iCheck('uncheck');
		$('#modal-news #id').val("");
		return;
    } else {
		$('#modal-news .nav-tabs').show();
		$('#modal-news #action').val("update");
        $('#modal-news .modal-title').html('Cập nhật bài viết');
	}
	$('#modal-news .tab_edit_news[data-lang=' + lang + ']').parent().addClass('active');
}

app.NewsFormSubmit = function(table) {
    $.ajax({
        url: base_admin + "/ajax/news",
        type: "post",
        data: $('#addNewsForm').serialize(),
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
                table.ajax.reload(null, true);
                $('#addNewsBtn').button('reset');
				$('#modal-news').modal('hide');
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
}

app.LoadFormNews = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/news?lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mNewsTranslationsAll !== "undefined") {
                    $.each(response.data.mNewsTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
							console.log(response.data.id + response.data.mLayout.name);	
							console.log(v.content);
                            $('#modal-news #id').val(response.data.id);
                            $('#modal-news .tab_edit_news').attr('data-id', response.data.id)
							$('#modal-news #inputAddName').val(v.title);
							$('#modal-news #inputAddSEO').val(v.slug);
							$('#modal-news #inputKeyWord').val(v.meta_keyword);
							$('#modal-news #inputDescription').val(v.meta_description);
							$('#modal-news #inputAddContent').summernote('code', v.content);
							$('#modal-news #inputAddLayout').val(response.data.mLayout.id).trigger('change');
							if(response.data.status == 1)
								$('#modal-news #addStatus').iCheck('check');
							else
								$('#modal-news #addStatus').iCheck('uncheck');
                        }
                    });
				}
                $('#modal-news').modal('show');
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

app.DeleteNews = function(id, table) {
    $.ajax({
        url: base_admin + "/ajax/news?action=delete&id=" + id,
        type: "post",
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
                table.ajax.reload(null, true);
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
            $('#confirm-delete-modal #confirm-delete').button('reset');
            $('#confirm-delete-modal').modal('hide');
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
            $('#confirm-delete-modal #confirm-delete').button('reset');
            $('#confirm-delete-modal').modal('hide');
        }
    });
}
$(function() {
	app.init();
});