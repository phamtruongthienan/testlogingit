var app = app || {};
var table_dynamic_comment, table_dynamic_course, table_dynamic_program, table_dynamic_school;
app.init = function() {
	app.changeUrl($('#inputAddName'), $('#inputAddSEO'));
	app.changeUrl($('#inputAddSEO'), $('#inputAddSEO'));
	app.changeUrl($('#inputEditName'), $('#inputEditSEO'));
	app.changeUrl($('#inputEditSEO'), $('#inputEditSEO'));
	changeImage('#logoImage', 'input[id="logoFile"]');
	changeImage('#logoEditImage', 'input[id="logoEditFile"]');
	$('#schoolDetail, #addSchoolBtn, #editschoolDetail, #editSchoolBtn, #ckbFacility, #addPrevBtn, #editPrevBtn').hide();
	$('.select2').select2();
	$('.my-colorpicker').colorpicker();
	$("#add_city, #edit_city").select2({
		placeholder: "Chọn tỉnh/thành phố",
		allowClear: true
	});
	$("#add_district, #edit_district").select2({
		placeholder: "Chọn quận/huyện",
		allowClear: true
	});
	$("#add_ward, #edit_ward").select2({
		placeholder: "Chọn phường/xã",
		allowClear: true
	});
	$('.slider').slider();
	$('#tagCourse, #tagEditCourse').select2({
		data: ["Khóa 2018", "Khóa 2017"],
		tags: true,
		tokenSeparators: [','],
		placeholder: "Tên khóa học"
	});
	$('#tagClass, #tagEditClass').select2({
		data: ["Lớp 01", "Lớp 02"],
		tags: true,
		tokenSeparators: [','],
		placeholder: "Tên lớp học"
	});
	$('#tagTeacher, #tagEditTeacher').select2({
		data: ["Giáo viên mầm non", "Giáo viên tiếng anh"],
		tags: true,
		tokenSeparators: [','],
		placeholder: "Loại giáo viên"
	});
	$('[data-mask]').inputmask();
	$('#modal-course-list, #modal-program-list, #modal-comment-list').on('shown.bs.modal', function(e) {
		$.fn.dataTable.tables({
			visible: true,
			api: true
		}).columns.adjust();
	});

	$('.modal').on('show.bs.modal', function(e) {
		if ($('input[type="radio"], input[type="checkbox"]').length > 0) {
			$('input[type="radio"], input[type="checkbox"]').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass: 'iradio_minimal-blue'
			});
		}
	});
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function(e) {
		$.fn.dataTable.tables({
			visible: true,
			api: true
		}).columns.adjust();
	});
	$('a[href="#tab_vn"]').on('show.bs.tab', function(e) {
		console.log('vn');
	});
	$('a[href="#tab_en"]').on('show.bs.tab', function(e) {
		console.log('en');
	});
	$('a[href="#tab_vn_edit"]').on('show.bs.tab', function(e) {
		console.log('vn');
	});
	$('a[href="#tab_en_edit"]').on('show.bs.tab', function(e) {
		console.log('en');
	});

	table_dynamic_school = $('.table-dynamic-school').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": base_admin + "/ajax/school",
		'responsive': true,
		'paging': true,
		'lengthChange': true,
		'searching': true,
		'ordering': false,
		'info': true,
		'autoWidth': true,
		'scrollX': true,
		'scrollCollapse': true,
		"columns": [{
			"data": "id"
		}, {
			"data": "name"
		}, {
			"data": "level"
		}, {
			"data": "type"
		}, {
			"data": "district"
		}, {
			"data": "action"
		}],
		'columnDefs': [{
			targets: [1],
			class: 'text-ellipsis'
		}, {
			width: '200px',
			targets: [-1, 2, 3, 4],
			class: 'text-center'
		}, {
			width: '100px',
			targets: [0],
			class: 'text-center'
		}, {
			targets: [-1],
			orderable: false,
		}]
	});

	$('#CourseForm').validator().on('submit', function(e) {
		$('#addCourseBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
			app.CourseFormSubmit();
		} else {
			$('#addCourseBtn').button('reset');
		}
	});

	$('#addSchoolForm').validator().on('submit', function(e) {
		$('#addSchoolBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
			app.SchoolFormSubmit();
		} else {
			$('#addSchoolBtn').button('reset');
		}
	});

	$('#addSchoolForm').validator().on('submit', function(e) {
		$('#addSchoolBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
			setTimeout(function() {
				$('#alert_msg').removeClass('no-display');
				$('#addSchoolBtn').button('reset');
				setTimeout(function() {
					$('.alert').addClass('no-display');
				}, 3000);
			}, 1000);
		} else {
			$('#addSchoolBtn').button('reset');
		}
	});

	$('#editSchoolForm').validator().on('submit', function(e) {
		$('#editSchoolBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
			setTimeout(function() {
				$('#alert_msg_edit').removeClass('no-display');
				$('#editSchoolBtn').button('reset');
				setTimeout(function() {
					$('.alert').addClass('no-display');
				}, 3000);
			}, 1000);
		} else {
			$('#editSchoolBtn').button('reset');
		}
	});

	$('#ProgramForm').validator().on('submit', function(e) {
		$('#addProgramBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
			app.ProgramFormSubmit();
		} else {
			$('#addProgramBtn').button('reset');
		}
	});

	$('#editProgramForm').validator().on('submit', function(e) {
		$('#editProgramBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
			setTimeout(function() {
				$('#alert_msg_edit').removeClass('no-display');
				$('#editProgramBtn').button('reset');
				setTimeout(function() {
					$('.alert').addClass('no-display');
				}, 3000);
			}, 1000);
		} else {
			$('#editProgramBtn').button('reset');
		}
	});

	$(document).on('click', '#confirm-delete-modal #confirm-delete', function(e) {
		e.preventDefault();
		$('#confirm-delete-modal #confirm-delete').button('loading')
		var id = $('#confirm-delete-modal #id').val();
		var module_name = $('#confirm-delete-modal #module').val();
		if (module_name == 'comment') {
			app.DeleteComment(id);
		}
		if (module_name == 'course') {
			app.DeleteCourse(id);
		}
		if (module_name == 'program') {
			app.DeleteProgram(id);
		}
		if (module_name == 'school') {
			app.DeleteSchool(id);
		}
	});

	$(document).on('click', '.table-dynamic-comment .table-action-agree', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		app.UpdateCommentStatus(id);
	});

	$(document).on('click', '.table-dynamic-comment .table-action-delete', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		app.ConfirmDelete(id, 'comment');
	});

	$(document).on('click', '.table-dynamic-course .table-action-delete', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		app.ConfirmDelete(id, 'course');
	});

	$(document).on('click', '.table-dynamic-program .table-action-delete', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		app.ConfirmDelete(id, 'program');
	});

	$(document).on('click', '.table-dynamic-course .table-action-edit', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		$('#modal-course-edit').modal('show');
	});

	$(document).on('click', '.table-dynamic-school .table-action-edit', function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var lang = $(this).attr('data-lang');
		app.ClearFormSchool(id, lang, 'edit');
		app.UpdateSchool(id, lang);
	});

	$(document).on('click', '.table-dynamic-school .table-action-delete', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		app.ConfirmDelete(id, 'school');
	});

	$(document).on('click', '.table-dynamic-program .table-action-edit', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		$('#modal-program-edit').modal('show');
	});

	$(document).on('click', '.table-facility .table-action-edit', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		$('#modal-facility-edit').modal('show');
	});

	$(document).on('click', '#addSchool', function(e) {
		e.preventDefault();
		$('#modal-school-add').modal('show');
	});

	$(document).on('click', '#modal-course-list #addCourse', function(e) {
		e.preventDefault();
		var lang = $(this).attr('data-lang');
		var school_id = $(this).attr('data-school-id');
		app.ClearFormCourse(school_id, lang, 'add');
		$('#modal-course .tab_edit_course').attr('data-id', 'null')
		app.AddCourseForm(lang);
	});

	$(document).on('click', '#modal-program-list #addProgram', function(e) {
		e.preventDefault();
		var lang = $(this).attr('data-lang');
		var school_course_id = $(this).attr('data-course-id');
		var school_id = $(this).attr('data-school-id');
		app.ClearFormProgram(school_course_id, school_id, lang, 'add');
		$('#modal-program .tab_edit_program').attr('data-id', 'null')
		app.AddProgramForm(lang);
	});

	$(document).on('click', '#addFacility', function(e) {
		e.preventDefault();
		$('#modal-facility-add').modal('show');
	});

	$(document).on('click', '.table-dynamic-school .table-action-view-course', function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		$('#modal-course-list #addCourse').attr('data-school-id', id);
		if ($.fn.DataTable.isDataTable('.table-dynamic-course')) {
			$('.table-dynamic-course').DataTable().destroy();
			$('.table-dynamic-course tbody').empty();
		}
		app.ViewCourse(id);
	});

	$(document).on('click', '.table-dynamic-course .table-action-view-program', function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var school_id = $(this).attr('data-school-id');
		$('#modal-program-list #addProgram').attr('data-course-id', id);
		$('#modal-program-list #addProgram').attr('data-school-id', school_id);
		if ($.fn.DataTable.isDataTable('.table-dynamic-course')) {
			$('.table-dynamic-program').DataTable().destroy();
			$('.table-dynamic-program tbody').empty();
		}
		app.ViewProgram(id);
	});

	$(document).on('click', '.table-dynamic-program .table-action-edit, #modal-program .tab_edit_program', function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var lang = $(this).attr('data-lang');
		var school_course_id = $(this).attr('data-course-id');
		var school_id = $(this).attr('data-school-id');
		app.ClearFormProgram(school_course_id, school_id, lang, 'edit');
		app.UpdateProgram(id, lang);
	});

	$(document).on('click', '.table-dynamic-school .table-action-view-comment', function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		app.ViewComment(id);
	});

	$(document).on('click', '.table-dynamic-comment .table-action-reply', function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		$('#modal-comment-reply #content').summernote('code', '');
		$('#modal-comment-reply #id').val(id);
		app.ViewCommentReply(id);
	});

	$(document).on('click', '#modal-comment-reply #addCommentReply', function(e) {
		e.preventDefault();
		app.UpdateCommentReply();
	});

	$(document).on('click', '#modal-course .tab_edit_course', function(e) {
		e.preventDefault();
		var language = $(this).attr('data-language');
		$('#modal-course #language_id').val(language);
	});


	$(document).on('click', '.table-dynamic-course .table-action-edit, #modal-course .tab_edit_course', function(e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var lang = $(this).attr('data-lang');
		var school_id = $(this).attr('data-school-id');
		app.ClearFormCourse(school_id, lang, 'edit');
		app.UpdateCourse(id, lang);
	});
	

	$(document).on('click', '.table-dynamic-course .table-action-add', function(e) {
		e.preventDefault();
		$('#modal-program-list').modal('show');
	});

	$(document).on('click', '#addSchoolBtn', function(e) {
		e.preventDefault();
		$('#addSchoolForm').submit();
	});

	$(document).on('click', '#editSchoolBtn', function(e) {
		e.preventDefault();
		$('#editSchoolForm').submit();
	});

	$(document).on('click', '#addCourseBtn', function(e) {
		e.preventDefault();
		$('#CourseForm').submit();
	});

	$(document).on('click', '#editCourseBtn', function(e) {
		e.preventDefault();
		$('#editCourseForm').submit();
	});

	$(document).on('click', '#addProgramBtn', function(e) {
		e.preventDefault();
		$('#ProgramForm').submit();
	});

	$(document).on('click', '#editProgramBtn', function(e) {
		e.preventDefault();
		$('#editProgramForm').submit();
	});

	$(document).on('click', '#addNextBtn', function(e) {
		$(this).hide();
		$('#schoolGeneral').hide();
		$('#schoolDetail, #addSchoolBtn, #addPrevBtn').show();
	});

	$(document).on('click', '#addPrevBtn', function(e) {
		$(this).hide();
		$('#schoolGeneral, #addNextBtn').show();
		$('#schoolDetail, #addSchoolBtn').hide();
	});

	$(document).on('click', '#editNextBtn', function(e) {
		$(this).hide();
		$('#editschoolGeneral').hide();
		$('#editschoolDetail, #editSchoolBtn, #editPrevBtn').show();
	});

	$(document).on('click', '#editPrevBtn', function(e) {
		$(this).hide();
		$('#editschoolGeneral, #editNextBtn').show();
		$('#editschoolDetail, #editSchoolBtn').hide();
	});

	$('#add_type_facility').on("change", function(e) {
		var value = $(this).val();
		if (value == "1") {
			$('#ckbFacility').hide();
			$('#inputFacility').show();
		} else {
			$('#ckbFacility').show();
			$('#inputFacility').hide();
		}
	});

	$('.example-movie').barrating('show', {
		theme: 'bars-movie'
	});
}

app.xoa_dau = function(str) {
	str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
	str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
	str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
	str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
	str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
	str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
	str = str.replace(/đ/g, "d");
	return str;
}

app.string_to_slug = function(str) {
	str = str.replace(/^\s+|\s+$/g, ''); // trim
	str = str.toLowerCase();
	str = app.xoa_dau(str); // remove accents, swap ñ for n, etc
	str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
		.replace(/\s+/g, '-') // collapse whitespace and replace by -
		.replace(/-+/g, '-'); // collapse dashes

	return str;
}

app.changeUrl = function(elementConvert, elementValue) {
	elementConvert.keyup(function() {
		var val = $(this).val();
		var url = app.string_to_slug(val);
		elementValue.val(url);
	});
}

app.ConfirmDelete = function(id, module_name) {
	$('#confirm-delete-modal #id').val(id);
	$('#confirm-delete-modal #module').val(module_name);
	$('#confirm-delete-modal').modal({
		backdrop: 'static',
		keyboard: false
	});
}

//COMMENT
app.UpdateCommentStatus = function(id) {
	$.ajax({
		url: base_admin + "/ajax/school/comment?action=status&id=" + id,
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
				table_dynamic_comment.ajax.reload(null, true);
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

app.DeleteComment = function(id) {
	$.ajax({
		url: base_admin + "/ajax/school/comment?action=delete&id=" + id,
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
				table_dynamic_comment.ajax.reload(null, true);
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
			$('#confirm-delete-modal').modal('hide');
			$('#confirm-delete-modal #confirm-delete').button('reset');
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
			$('#confirm-delete-modal').modal('hide');
			$('#confirm-delete-modal #confirm-delete').button('reset');
		}
	});
}

app.ViewComment = function(id) {

	if ($.fn.DataTable.isDataTable('.table-dynamic-comment')) {
		$('.table-dynamic-comment').DataTable().destroy();
		$('.table-dynamic-comment tbody').empty();
	}
	table_dynamic_comment = $('.table-dynamic-comment').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": base_admin + "/ajax/school/comment?id=" + id,
		'responsive': true,
		'paging': true,
		'lengthChange': true,
		'searching': true,
		'ordering': true,
		'info': true,
		'autoWidth': true,
		'scrollX': true,
		'scrollCollapse': true,
		"order": [
			[3, "desc"]
		],
		"columns": [{
			"data": "id"
		}, {
			"data": "name"
		}, {
			"data": "address"
		}, {
			"data": "created_at"
		}, {
			"data": "content"
		}, {
			"data": "rating"
		}, {
			"data": "reply"
		}, {
			"data": "action"
		}],
		'columnDefs': [{
			width: '50px',
			targets: [0],
			class: 'text-center',
			orderable: true,
		}, {
			width: '100px',
			targets: [1],
			class: 'text-center',
			orderable: false,
		}, {
			width: '100px',
			targets: [2],
			class: 'text-center',
			orderable: false,
		}, {
			width: '100px',
			targets: [3],
			class: 'text-center',
			orderable: true,
		}, {
			width: '400px',
			targets: [4],
			class: 'text-multi-row',
			orderable: false,
		}, {
			width: '100px',
			targets: [5],
			class: 'text-center',
			orderable: true,
		}, {
			width: '50px',
			targets: [6],
			class: 'text-center',
			orderable: false,
		}, {
			width: '50px',
			targets: [7],
			class: 'text-center',
			orderable: false,
		}],
		'drawCallback': function(settings) {
			$('[data-toggle="tooltip"]').tooltip();
			$('.article').expander();
		},
		'initComplete': function(settings, json) {
			$('[data-toggle="tooltip"]').tooltip();
			$('.article').expander();
			$('#modal-comment-list').modal('show');
		}
	});
}

app.ViewCommentReply = function(id) {
	$.ajax({
		url: base_admin + "/ajax/school/comment?comment_id=" + id,
		type: "get",
		success: function(response) {
			if (response.code == '200') {
				if (response.data.mSchoolCommentReplies.length > 0) {
					$('#modal-comment-reply #content').summernote('code', response.data.mSchoolCommentReplies[0].content);
				}
				$('#modal-comment-reply').modal('show');
			} else {
				Lobibox.notify("warning", {
					title: 'Thông báo',
					pauseDelayOnHover: true,
					continueDelayOnInactiveTab: false,
					icon: false,
					sound: false,
					msg: 'Có lỗi trong quá trình xử lý'
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

app.UpdateCommentReply = function() {
	$.ajax({
		url: base_admin + "/ajax/school/comment",
		type: "post",
		data: $('#modal-comment-reply #CommentReplyForm').serialize(),
		success: function(response) {
			if (response.code == '200') {
				table_dynamic_comment.ajax.reload(null, true);
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
			$('#modal-comment-reply').modal('hide');
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
//COMMENT

// COURSE
app.DeleteCourse = function(id) {
	$.ajax({
		url: base_admin + "/ajax/school/course?action=delete&id=" + id,
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
				table_dynamic_course.ajax.reload(null, true);
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
			$('#confirm-delete-modal').modal('hide');
			$('#confirm-delete-modal #confirm-delete').button('reset');
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
			$('#confirm-delete-modal').modal('hide');
			$('#confirm-delete-modal #confirm-delete').button('reset');
		}
	});
}

app.ClearFormCourse = function(school_id, lang, type) {
	if (type == "add") {
		$('#modal-course .nav-tabs').hide();
		$('#modal-course .form-title').html('Thêm khóa học mới');
		$('#modal-course #action').val('insert');
	} else {
		$('#modal-course .nav-tabs').show();
		$('#modal-course .form-title').html('Thay đổi khóa học');
		$('#modal-course #action').val('update');
	}
	$('#modal-course ul > li').removeClass('active');
	$('#modal-course .tab_edit_course[data-lang=' + lang + ']').parent().addClass('active');
	$('#modal-course #lang').val(lang);
	$('#modal-course #school_id').val(school_id);
	$('#modal-course #meta_title').val('');
	$('#modal-course #meta_keyword').val('');
	$('#modal-course #meta_description').val('');
	$('#modal-course #school_class').empty();
	$('#modal-course #name').val('');
	$('#modal-course #name_class').val('');
	$('#modal-course #content').summernote('code', '');
	$('#modal-course #school_class').val(null).trigger('change');
	$('#modal-course #age').slider('setValue', [0, 0]);
	$('#modal-course #age_month').slider('setValue', [0, 0]);
	$('#modal-course #num_student').val('');
	$('#modal-course #num_teacher').val('');
	$('#modal-course #start_date').val('');
	$('#modal-course #end_date').val('');
	$('#modal-course #status').iCheck('uncheck');
}

app.CourseFormSubmit = function() {
	$.ajax({
		url: base_admin + "/ajax/school/course",
		type: "post",
		data: $('#CourseForm').serialize(),
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
				table_dynamic_course.ajax.reload(null, true);
				$('#addCourseBtn').button('reset');
				$('#modal-course').modal('hide');
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

app.AddCourseForm = function(lang) {
	$.ajax({
		url: base_admin + "/ajax/school/course?action=view&lang=" + lang + "&id=null",
		type: "get",
		success: function(response) {
			if (response.code == '200') {
				$.each(response.school_class, function(i, item) {
					$.each(item.mSchoolClassTranslationsAll, function(k, v) {
						if (lang == v.language_id) {
							var newOption = new Option(v.name, v.id, false, false);
							$('#modal-course #school_class').append(newOption).trigger('change');
						}
					});
				});
				$('#modal-course').modal('show');
			} else {
				Lobibox.notify("warning", {
					title: 'Thông báo',
					pauseDelayOnHover: true,
					continueDelayOnInactiveTab: false,
					icon: false,
					sound: false,
					msg: 'Có lỗi trong quá trình xử lý'
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

app.ViewCourse = function(id) {
	table_dynamic_course = $('.table-dynamic-course').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": base_admin + "/ajax/school/course?id=" + id,
		'responsive': true,
		'paging': true,
		'lengthChange': true,
		'searching': true,
		'ordering': true,
		'info': true,
		'autoWidth': true,
		'scrollX': true,
		'scrollCollapse': true,
		"columns": [{
			"data": "id"
		}, {
			"data": "name"
		}, {
			"data": "name_class"
		}, {
			"data": "start_date"
		}, {
			"data": "end_date"
		}, {
			"data": "num_student"
		}, {
			"data": "program"
		}, {
			"data": "action"
		}],
		'columnDefs': [{
			width: '50px',
			targets: [0],
			class: 'text-center',
			orderable: true,
		}, {
			width: '100px',
			targets: [1],
			class: 'text-center',
			orderable: false,
		}, {
			width: '100px',
			targets: [2],
			class: 'text-center',
			orderable: false,
		}, {
			width: '100px',
			targets: [3],
			class: 'text-center',
			orderable: true,
		}, {
			width: '100px',
			targets: [4],
			class: 'text-center',
			orderable: true,
		}, {
			width: '100px',
			targets: [5],
			class: 'text-center',
			orderable: true,
		}, {
			width: '50px',
			targets: [6],
			class: 'text-center',
			orderable: false,
		}, {
			width: '50px',
			targets: [7],
			class: 'text-center',
			orderable: false,
		}],
		'drawCallback': function(settings) {
			$('[data-toggle="tooltip"]').tooltip();
			$('.article').expander();
		},
		'initComplete': function(settings, json) {
			$('[data-toggle="tooltip"]').tooltip();
			$('.article').expander();
			$('#modal-course-list').modal('show');
		}
	});
}

app.UpdateCourse = function(id, lang) {
	$.ajax({
		url: base_admin + "/ajax/school/course?action=view&lang=" + lang + "&id=" + id,
		type: "get",
		success: function(response) {
			if (response.code == '200') {
				if (typeof response.school_class !== "undefined") {
					$.each(response.school_class, function(i, item) {
						$.each(item.mSchoolClassTranslationsAll, function(k, v) {
							if (lang == v.language_id) {
								var newOption = new Option(v.name, item.id, false, false);
								$('#modal-course #school_class').append(newOption).trigger('change');
							}
						});
					});
				}
				if (typeof response.data.mSchoolCourseTranslationsAll !== "undefined") {
					$.each(response.data.mSchoolCourseTranslationsAll, function(k, v) {
						if (lang == v.language_id) {
							$('#modal-course #name').val(v.name);
							$('#modal-course #name_class').val(v.name_class);
							$('#modal-course #meta_title').val(v.meta_title);
							$('#modal-course #meta_keyword').val(v.meta_keyword);
							$('#modal-course #meta_description').val(v.meta_description);
							$('#modal-course #content').summernote('code', v.content);
						}
					});
				}
				if (typeof response.data.mSchoolClass !== "undefined") {
					$.each(response.data.mSchoolClass.mSchoolClassTranslationsAll, function(k, v) {
						if (lang == v.language_id) {
							$('#modal-course #school_class').val(v.id).trigger('change');
						}
					});
				}
				if (Object.keys(response.data).length > 0) {
					$('#modal-course #id').val(response.data.id);
					$('#modal-course .tab_edit_course').attr('data-id', response.data.id)
					if (response.data.age_month == 1) {
						$('#modal-course #age_month').slider('setValue', [response.data.age, response.data.age_to]);
					} else {
						$('#modal-course #age').slider('setValue', [response.data.age, response.data.age_to]);
					}
					$('#modal-course #num_student').val(response.data.num_student);
					$('#modal-course #num_teacher').val(response.data.num_teacher);
					$('#modal-course #start_date').val(response.data.start_date);
					$('#modal-course #end_date').val(response.data.end_date);
					if (response.data.status == 1) {
						$('#modal-course #status').iCheck('check');
					} else {
						$('#modal-course #status').iCheck('uncheck');
					}
				}
				$('#modal-course').modal('show');
			} else {

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
}

// COURSE

// PROGRAM
app.ViewProgram = function(id) {
	table_dynamic_program = $('.table-dynamic-program').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": base_admin + "/ajax/school/program?id=" + id,
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
			{
				"data": "id"
			}, 
			{
				"data": "name"
			}, 
			{
				"data": "time"
			}, 
			{
				"data": "fee"
			}, 
			{
				"data": "action"
			}
		],
		'columnDefs': [{
			targets: [1],
			class: 'text-ellipsis'
		}, {
			width: '200px',
			targets: [-1],
			class: 'text-center'
		}, {
			width: '100px',
			targets: [0],
			class: 'text-center'
		}, {
			targets: [-1],
			orderable: false,
		}],
		'drawCallback': function(settings) {
			$('[data-toggle="tooltip"]').tooltip();
			$('.article').expander();
		},
		'initComplete': function(settings, json) {
			$('[data-toggle="tooltip"]').tooltip();
			$('.article').expander();
			$('#modal-program-list').modal('show');
		}
	});
}

app.ClearFormProgram = function(school_course_id, school_id, lang, type) {
	if (type == "add") {
		$('#modal-program .nav-tabs').hide();
		$('#modal-program .form-title').html('Thêm chương trình mới');
		$('#modal-program #action').val('insert');
	} else {
		$('#modal-program .nav-tabs').show();
		$('#modal-program .form-title').html('Thay đổi chương trình');
		$('#modal-program #action').val('update');
	}
	$('#modal-program ul > li').removeClass('active');
	$('#modal-program .tab_edit_program[data-lang=' + lang + ']').parent().addClass('active');
	$('#modal-program #lang').val(lang);
	$('#modal-program #school_course_id').val(school_course_id);
	$('#modal-program #school_id').val(school_id);
	$('#modal-program #unit1').val(null).trigger('change');
	$('#modal-program #unit2').val(null).trigger('change');
	$('#modal-program #unit3').val(null).trigger('change');
	$('#modal-program #unit4').val(null).trigger('change');
	$('#modal-program #name').val('');
	$('#modal-program #time').val('');
	$('#modal-program #fee').val('');
	$('#modal-program #content').summernote('code', '');
}

app.AddProgramForm = function(lang) {
	$('#modal-program').modal('show');
}

app.UpdateProgram = function(id, lang) {
	$.ajax({
		url: base_admin + "/ajax/school/program?action=view&lang=" + lang + "&id=" + id,
		type: "get",
		success: function(response) {
			if (response.code == '200') {
				
				if (typeof response.data.mSchoolProgramTranslationsAll !== "undefined") {
					$.each(response.data.mSchoolProgramTranslationsAll, function(k, v) {
						if (lang == v.language_id) {
							$('#modal-program #name').val(v.name);
							$('#modal-program #content').summernote('code',v.content);
						}
					});
				}
				$('#modal-program #id').val(response.data.id);
				$('#modal-program #time').val(response.data.time);
				$('#modal-program #fee').val(response.data.fee);
				$('#modal-program #unit1').val(response.data.unit_1).trigger('change');
				$('#modal-program #unit2').val(response.data.unit_2).trigger('change');
				$('#modal-program #unit3').val(response.data.unit_3).trigger('change');
				$('#modal-program #unit4').val(response.data.unit_4).trigger('change');
				$('#modal-program .tab_edit_program').attr('data-id', response.data.id)
				$('#modal-program').modal('show');
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

app.ProgramFormSubmit = function() {
	$.ajax({
		url: base_admin + "/ajax/school/program",
		type: "post",
		data: $('#ProgramForm').serialize(),
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
				table_dynamic_program.ajax.reload(null, true);
				$('#addProgramBtn').button('reset');
				$('#modal-program').modal('hide');
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

app.DeleteProgram = function(id) {
	$.ajax({
		url: base_admin + "/ajax/school/program?action=delete&id=" + id,
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
				table_dynamic_program.ajax.reload(null, true);
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
			$('#confirm-delete-modal').modal('hide');
			$('#confirm-delete-modal #confirm-delete').button('reset');
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
			$('#confirm-delete-modal').modal('hide');
			$('#confirm-delete-modal #confirm-delete').button('reset');
		}
	});
}

// PROGRAM

//SCHOOL
app.ClearFormSchool = function(id, lang, type) {
	if (type == "add") {
		$('#modal-school .nav-tabs').hide();
		$('#modal-school .form-title').html('Thêm trường học mới');
		$('#modal-school #action').val('insert');
	} else {
		$('#modal-school .nav-tabs').show();
		$('#modal-school .form-title').html('Thay đổi trường học');
		$('#modal-school #action').val('update');
	}
	$('#modal-school ul > li').removeClass('active');
	$('#modal-school .tab_edit_school[data-lang=' + lang + ']').parent().addClass('active');
	$('#modal-school #lang').val(lang);
	$('#modal-school #id').val(id);

	$('#modal-school #name').val('');
	$('#modal-school #slug').val('');
	$('#modal-school #meta_title').val('');
	$('#modal-school #meta_keyword').val('');
	$('#modal-school #meta_description').val('');
	$('#modal-school .branch').iCheck('uncheck');
	$('#modal-school #address').val('');
	$('#modal-school #city').val(null).trigger('change');
	$('#modal-school #district').val(null).trigger('change');
	$('#modal-school #ward').val(null).trigger('change');
	$('#modal-school #branch_school').val(null).trigger('change');
	$('#modal-school #level').val(null).trigger('change');
	$('#modal-school #type').val(null).trigger('change');
	$('#modal-school #phone').val('');
	$('#modal-school #email').val('');
	$('#modal-school .teacher').val('');
	$('#modal-school .num_teacher').val('');
	$('#modal-school #image360').val('');
	$('#modal-school #info').summernote('code', '');
	$('#modal-school #pdf').val('');
	$('#modal-school #intro').summernote('code', '');
	$('#modal-school #video').val('');
	$('#modal-school .imagefile').val('');
	$('#modal-school #background_1').val('');
	$('#modal-school #background_2').val('');
	$('#modal-school #background_3').val('');
	$('#modal-school #background_4').val('');
	$('#modal-school #background_5').val('');
	$('#modal-school #search').iCheck('uncheck');
	$('#modal-school #status').iCheck('uncheck');
	$('#modal-school #language').val(null).trigger('change');
	$('#modal-school #fee').val('0,0');
}

app.UpdateSchool = function(id, lang) {
	$.ajax({
		url: base_admin + "/ajax/school?action=view&lang=" + lang + "&id=" + id,
		type: "get",
		success: function(response) {
			if (response.code == '200') {
		
				$('#modal-school').modal('show');
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

app.DeleteSchool = function(id) {
	$.ajax({
		url: base_admin + "/ajax/school?action=delete&id=" + id,
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
				table_dynamic_school.ajax.reload(null, true);
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
			$('#confirm-delete-modal').modal('hide');
			$('#confirm-delete-modal #confirm-delete').button('reset');
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
			$('#confirm-delete-modal').modal('hide');
			$('#confirm-delete-modal #confirm-delete').button('reset');
		}
	});
}

app.SchoolFormSubmit = function() {
	$.ajax({
		url: base_admin + "/ajax/school",
		type: "post",
		data: $('#SchoolForm').serialize(),
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
				table_dynamic_school.ajax.reload(null, true);
				$('#addSchoolBtn').button('reset');
				$('#modal-school').modal('hide');
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
//SCHOOL
$(function() {
	app.init();
});