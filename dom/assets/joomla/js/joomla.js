Joomla.orderTable = function()
{
	table = document.getElementById("sortTable");
	direction = document.getElementById("directionTable");
	order = table.options[table.selectedIndex].value;

	if (order != currentListOrder)
		dirn = 'asc';
	else
		dirn = direction.options[direction.selectedIndex].value;
		
	Joomla.tableOrdering(order, dirn, '');
}

Joomla.resetFilters = function()
{
	jQuery('.element-filter').val('');
	jQuery('.element-search').val('');
	Joomla.submitform();
}