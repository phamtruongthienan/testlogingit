var app = app || {};

app.init = function () {	
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
			{"data": "title"},
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
		]		
	});

	$('#editNewsForm').validator().on('submit', function (e) {
		$('#editNewsBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				app.submitForm(table_dynamic_news);
				$('#modal-news-edit').modal('hide');
				$('#editNewsBtn').button('reset');
		} else {
				$('#editNewsBtn').button('reset');
		}
	});

	app.submitForm = function (table_dynamic_news) {
		$.ajax({
			url: base_admin + "/ajax/news",
			data: $('#editNewsForm').serialize(),
			type: "post",
			success: function (response) {
					if (response.code == '200') {	
						table_dynamic_news.ajax.reload(null, true);
						$('#editNewsBtn').button('reset');
						Lobibox.notify("success", {
							title: 'Thông báo',
							pauseDelayOnHover: false,
							continueDelayOnInactiveTab: false,
							icon: false,
							sound: false,
							msg: response.msg
						});
						$('#confirm-delete-modal').modal('hide');
					} else {
						Lobibox.notify("warning", {
							title: 'Thông báo',
							pauseDelayOnHover: false,
							continueDelayOnInactiveTab: false,
							icon: false,
							sound: false,
							msg: 'Có lỗi xảy ra'
						});
					}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				Lobibox.notify("warning", {
					title: 'Thông báo',
					pauseDelayOnHover: false,
					continueDelayOnInactiveTab: false,
					icon: false,
					sound: false,
					msg: 'Có lỗi xảy ra'
				});
			}
		});
	}

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
		$('#modal-news-edit #id').val($(this).data('id'));
		var lang = $(this).attr('data-lang');
        app.ClearFormNews(lang, 'delete');
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		}).one('click', '#confirm-delete', function (e) {
				app.submitForm(table_dynamic_news);
		});
	});

	$(document).on('click', '.table-action-edit, #modal-news-edit .tab_edit_news', function (e) {
		e.preventDefault();
        var id = $(this).attr('data-id');
        var lang = $(this).attr('data-lang');
        app.ClearFormNews(lang, 'update');
        app.UpdateNews(id, lang);
	});

	app.ClearFormNews = function(lang, type) {
		if (type == "insert") {
			$('#modal-news-edit .nav-tabs').hide();
			$('#modal-news-edit #ttlModal').html(' Thêm cấp tin tức mới');
			$('#modal-news-edit #action').val(type);
		} else {
			$('#modal-news-edit .nav-tabs').show();
			$('#modal-news-edit #ttlModal').html(' Cập nhật tin tức');
			$('#modal-news-edit #action').val(type);
		}
		$('#modal-news-edit ul > li').removeClass('active');
		$('#modal-news-edit .tab_edit_news[data-lang=' + lang + ']').parent().addClass('active');
		$('#modal-news-edit #lang').val(lang);
	}

	app.UpdateNews = function(id, lang) {
		$('#modal-news-edit #inputEditName').prop('required',false);
		$('#modal-news-edit #inputEditSEO').prop('required',false);
		$('#modal-news-edit #inputTitle').prop('required',false);
		$('#modal-news-edit #inputKeyWord').prop('required',false);
		$('#modal-news-edit #inputDescription').prop('required',false);
        $('#modal-news-edit').validator('validate');
        $('#modal-news-edit #inputEditName').prop('required',true);
		$('#modal-news-edit #inputEditSEO').prop('required',true);
		$('#modal-news-edit #inputTitle').prop('required',true);
		$('#modal-news-edit #inputKeyWord').prop('required',true);
		$('#modal-news-edit #inputDescription').prop('required',false);
        $('#modal-news-editr').validator('update');
		$.ajax({
			url: base_admin + "/ajax/news?id=" + id,
			type: "get",
			success: function(response) {
				if (response.code == '200') {
					$('#modal-news-edit .tab_edit_news').attr('data-id', id);
					if(response.data[0].status == 1) {
						$('#modal-news-edit #editStatus').iCheck('check');
					} else {
						$('#modal-news-edit #editStatus').iCheck('uncheck');
					}
					$('#modal-news-edit #inputEditLayout').val(response.data[0].mLayout.id).trigger('change');
					if ( response.data[0].mNewsTranslationsAll !== "undefined") {
						$.each(response.data[0].mNewsTranslationsAll, function(k, v) {
							if (lang == v.language_id) {
								$('#modal-news-edit #id').val(v.id);
								$('#modal-news-edit #inputEditName').val(v.title);
								$('#modal-news-edit #inputEditSEO').val(v.slug);
								$('#modal-news-edit #inputTitle').val(v.meta_title);
								$('#modal-news-edit #inputKeyWord').val(v.meta_keyword);
								$('#modal-news-edit #inputDescription').val(v.meta_keyword);
								$('#modal-news-edit #inputEditContent').summernote('code', v.content);
							}
						});
					}
					$('#modal-news-edit').modal('show');
				} else {
					Lobibox.notify("warning", {
						title: 'Thông báo',
						pauseDelayOnHover: true,
						continueDelayOnInactiveTab: false,
						icon: false,
						sound: false,
						msg: 'Có lỗi xảy ra'
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
					msg: 'Có lỗi xảy ra'
				});
			}
		});
	};

	$(document).on('click', '#addNews', function (e) {
		e.preventDefault();
		var lang = $(this).attr('data-lang');
		$('#editNewsForm')[0].reset();
		$('#modal-news-edit #inputEditContent').summernote('code', '');
        app.ClearFormNews(lang, 'insert');
		$('#modal-news-edit').modal('show');	
	});

	$(document).on('click', '#editNewsBtn', function (e) {
		e.preventDefault();
		$('#editNewsForm').submit();
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

$(function() {
	app.init();
});