jQuery(document).ready(function(){
	jQuery("#adminForm").validationEngine();
});

Joomla.submitform = function(pressbutton)
{
	//Unlock the page
	holdForm = false;

	if (typeof(pressbutton) == 'undefined')
	{
		jQuery("#adminForm").submit();
		return;
	}	
	var parts = pressbutton.split('.');

	jQuery("#task").val(pressbutton);
	switch(parts[parts.length-1])
	{
		case 'save':
		case 'save2copy':
		case 'save2new':
		case 'apply':
			//Call the validator
			break;

		default:
			jQuery("#adminForm").validationEngine('detach');
			break;
	}

	jQuery("#adminForm").submit();
}

Joomla.submitformAjax = function(task, form)
{
	if (typeof(form) === 'undefined')
		form = document.getElementById('adminForm');
	
	if (typeof(task) !== 'undefined' && task !== '')
		form.task.value = task;
	
	var parts = task.split('.');
	var taskName = parts[parts.length-1];	
	var taskIcon = jQuery('#adminForm .cktoolbar span.' + taskName);

	taskIcon.addClass('spinner');
	
	jQuery.post("index.php?return=json", jQuery(form).serialize(), function(response)
	{
		//alert(response);
		response = jQuery.parseJSON(response);
		if (response.transaction.result)
			parent.SqueezeBox.close();
		else
		{
			var msg = response.transaction.rawExceptions;
			if (msg.trim() == '')
				msg = 'Unknown error';
	
			alert(msg);
		}
	});
};