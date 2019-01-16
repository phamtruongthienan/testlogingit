$(function() {
	$(document).on("hidden.bs.modal", '.modal', function (e) {
    if($('.modal:visible').length)
    {				
      $('body').addClass('modal-open');
    }
  });

  $(window).on("load", function() {    
    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
    
    if($(".wysihtml5-toolbar").length) {
      $(".wysihtml5-toolbar .modal .close").attr("data-wysihtml5-dialog-action", "cancel");
    }
  });
});