var app = app || {};

app.init = function () {
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
		$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	if($('#changeTime').length > 0) {
		$('#changeTime').on('select2:select', function (e) {
			var url = e.params.data.element.dataset.href;
			window.location.href = url;
		});
	}

	var table_dynamic_search = $('.table-dynamic-search').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": base_admin + "/ajax/statics/keyword",
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
			[2, "desc"]
		],
		"columns": [
			{"data": "id"},
			{"data": "keyword"},
			{"data": "times"}
		],
		'columnDefs': [
			{
				targets: [1],
				orderable: false,
				class: 'text-ellipsis'
			},
			{
				width: '100px',
				targets: [0, 2],
				class: 'text-center'
			},
		]
	});
	var getUrlParameter = function getUrlParameter(sParam) {
		var sPageURL = window.location.search.substring(1),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;
	
		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');
	
			if (sParameterName[0] === sParam) {
				return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
			}
		}
	};
	var time_view = getUrlParameter('time');
	if(time_view.length > 0) {
		var url_view = base_admin + "/ajax/statics/view?time="+time_view;
	} else {
		var url_view = base_admin + "/ajax/statics/view";
	}
	var table_dynamic_view = $('.table-dynamic-view').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": url_view,
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
			[2, "desc"]
		],
		"columns": [
			{"data": "id"},
			{"data": "school"},
			{"data": "visits_count"},
		],
		'columnDefs': [
			{
				targets: [1],
				orderable: false,
				class: 'text-ellipsis'
			},
			{
				width: '100px',
				targets: [0, 2],
				class: 'text-center'
			},
			// {
			// 	width: '200px',
			// 	targets: [-1],
			// 	orderable: false,
			// 	class: 'text-center',
			// 	render: function (data, type, row, meta) {
			// 		return '<a' +
			// 				' class="table-action table-action-edit text-green cursor-pointer" data-id="' + data.id + '"><i' +
			// 				' class="fa fa-edit"></i></a>' +
			// 				' <a class="table-action text-red table-action-delete cursor-pointer" data-id="' + data.id + '"><i' +
			// 				' class="fa fa-trash"></i></a>';
			// 	}
			// }
		]
	});
}

app. cb = function (start, end) {
	$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
}

$(function() {
	app.init();
});