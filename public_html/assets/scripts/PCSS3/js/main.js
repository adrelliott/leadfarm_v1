$(function()
{
	$('.modal-opener').on('click', function()
	{
		if( !$('#pcss3f-overlay').length )
		{
			$('body').append('<div id="pcss3f-overlay" class="pcss3f-overlay"></div>');
		}
		
		form = $($(this).data('form'));
		$('#pcss3f-overlay').fadeIn();
		form.css('top', '50%').css('left', '50%').css('margin-top', -form.outerHeight()/2).css('margin-left', -form.outerWidth()/2).fadeIn();
		
		return false;
	});
	
	$('.modal-closer').on('click', function()
	{		
		$('#pcss3f-overlay').fadeOut();
		$('.pcss3f-modal').fadeOut();
		
		return false;
	});
});