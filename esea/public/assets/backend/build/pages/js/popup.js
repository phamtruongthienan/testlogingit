var app = app || {};

app.init = function () {		
	changeImage('#logoImage', 'input[id="image"]','#AdvertiseForm');
	$('.select2').select2();
	$('[data-mask]').inputmask();
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    	$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});
	$('#modal-advertise').on( 'show.bs.modal', function (e) {
		if ($('input[type="checkbox"]').length > 0) {
			$('input[type="checkbox"]').iCheck({
				checkboxClass: 'icheckbox_minimal-blue'
			});
		}
	});

	var table_dynamic_advertise = $('.table-dynamic-advertise').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": base_admin+"/ajax/advertise",
		'responsive': true,
		'paging': true,
		'lengthChange': true,
		'searching': true,
		'ordering': true,
		'info': true,
		'autoWidth': true,
		'scrollX': true,
		'scrollCollapse': true,
		'order': [[0, 'desc']],
		"columns": [
			{"data": "id"},
			{"data": "img"},
			{"data": "type"},
			{"data": "position"},
			{"data": "target"},
			{"data": "link"},
			{"data": "status"},
			{"data": "action"}
		],
		'columnDefs': [
			{
				width: '150px',
				targets: [1, 2, 3, 4],
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0, -2, -1],
				class: 'text-center'
			}
		]		
	});
	
	$('#AdvertiseForm').validator().on('submit', function (e) {
		$('#AdvertiseBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				app.submitForm(table_dynamic_advertise);
				$('#modal-advertise').modal('hide');
				$('#AdvertiseBtn').button('reset');
		} else {
				$('#AdvertiseBtn').button('reset');
		}
	});

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
		app.clearForm('delete');
		$('#modal-advertise #id').val($(this).data('id'));
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		}).one('click', '#confirm-delete', function (e) {
				app.submitForm(table_dynamic_advertise);
		});
	});

	$(document).on('click', '.table-action-edit', function (e) {
		e.preventDefault();
		app.clearForm('update');
		var id = $(this).data('id');
		$.ajax({
				url: base_admin + "/ajax/advertise?id=" + id,
				type: "get",
				success: function (response) {
						if (response.code == '200') {	
								$('#modal-advertise #id').val(response.data.id);
								$('#modal-advertise #type').val(response.data.type).trigger("change");
								$('#modal-advertise #content').summernote('code', response.data.mAdvertsTranslations[0].content);
								if(response.data.mAdvertsTranslations[0].image != null) {
									$('#modal-advertise #logoImage').attr('src', base_url+'/img/'+response.data.mAdvertsTranslations[0].image)
								}
								$('#modal-advertise #position').val(response.data.position).trigger("change");
								$('#modal-advertise #target').val(response.data.target).trigger("change");
								$('#modal-advertise #link').val(response.data.link);
								$('#modal-advertise #start_date').val(response.data.start_date);
								$('#modal-advertise #end_date').val(response.data.end_date);
								if(response.data.status == 1) {
									$('#modal-advertise #status').iCheck('check');
								} else {
									$('#modal-advertise #status').iCheck('uncheck');
								}
								$('#modal-advertise').modal('show');
						} else {
								$('#error-modal').modal('show');
						}
				},
				error: function (jqXHR, textStatus, errorThrown) {
						$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
				}
		});
	});

	$(document).on('click', '#addAdvertise', function (e) {
		e.preventDefault();
		app.clearForm('insert');
		$('#modal-advertise').modal('show');		
	});

	$(document).on('click', '#AdvertiseBtn', function (e) {
		e.preventDefault();
		$('#AdvertiseForm').submit();
	});

	$('#type').on("change", function (e) {
		app.changeSelect($(this).val());
	});
}

app.changeSelect = function (value) {
	switch (value)
	{
			case "1":
			case "4":
			{
				$('#link').prop('required',true);		
				$("#AdvertiseForm").validator('update'); 
				$('#StaticImg').hide();
				break;
			}
			case "2":
			{	
				$('#link').prop('required',false);
				$("#AdvertiseForm").validator('validate');
				$('#content').prop('required',true);	
				$("#AdvertiseForm").validator('update'); 
				$('#StaticImg').hide();	
				break;
			}
			case "3":
			{
				$('#StaticImg').show();
				break;
			}
			default:
			{
				$('#link, #content').prop('required',false);
				$("#AdvertiseForm").validator('validate');
				$('#StaticImg').hide();
			}
	}	
}


app.submitForm = function (table_dynamic_advertise) {
	$.ajax({
		url: base_admin + "/ajax/advertise",
		data: $('#AdvertiseForm').serialize(),
		type: "post",
		success: function (response) {
				if (response.code == '200') {	
					table_dynamic_advertise.ajax.reload(null, true);
					$('#alert_msg_edit').removeClass('no-display');
					$('#AdvertiseBtn').button('reset');
				} else {
					$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
				}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
		}
	});
}
app.clearForm = function (action) {
	$('#modal-advertise #action').val(action);
	$('#modal-advertise #id').val('');
	$('#modal-advertise #type').val(1).trigger("change");
	$('#modal-advertise #content').summernote('code', '');
	$('#modal-advertise #logoImage').attr('src', base_url+'/assets/backend/img/no_image.png')
	$('#modal-advertise #image_hash').val('');
	$('#modal-advertise #position').val(null).trigger("change");
	$('#modal-advertise #target').val(null).trigger("change");
	$('#modal-advertise #link').val('');
	$('#modal-advertise #start_date').val('');
	$('#modal-advertise #end_date').val('');
	$('#modal-advertise #status').iCheck('uncheck');	
}


$(function() {
	app.init();
});