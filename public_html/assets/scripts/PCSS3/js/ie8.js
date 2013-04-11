$(function()
{
	$('input[type="checkbox"]:checked, input[type="radio"]:checked').addClass('checked');
	
	$('input[type="checkbox"] + label').on('click', function()
	{
		$(this).prev().toggleClass('checked');
	});
	
	$('input[type="radio"] + label').on('click', function()
	{
		if( $(this).prev().prop('checked') )
			return false;
		
		$(this).prev().addClass('checked').siblings('input[type="radio"]').removeClass('checked');;
	});
});