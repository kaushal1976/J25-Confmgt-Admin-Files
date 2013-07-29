(function($){
	var getRadioColor = function(val){
		switch(val){
			case '': return 'primary';
			case 0: case '0': return 'danger';
			case 1: case '1': return 'success';
			default: return 'success';
		}
	}
	$('document').ready(function(){
		$(".btn-group label").click(function() {			
			var label = $(this);
			var input = $('#' + label.attr('for'));
			if (!input.prop('checked')) {
				label.closest('.btn-group').find("label").removeClass('active'
					+	' btn-primary btn-danger btn-success');
				
				label.addClass('active btn-' + getRadioColor(input.val()));
				input.prop('checked', true);
			}
		});
		
		$(".btn-group input[checked=checked]").each(function() {
			$("label[for=" + $(this).attr('id') + "]").addClass('active btn-' + getRadioColor($(this).val()));
		});
	});
})(jQuery);