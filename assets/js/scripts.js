$(document).ready(function(){

	$('#createBTN').on('click', function(){
		var url = $('#url').val();
		var main_url = $('#main_url').val();
		
		$.ajax({
			type: 'POST',
			url: 'main/index/',
			dataType: 'html',
			data: {
				'url' : url,
				'main_url' : main_url
			},
			success: function(data)
			{
				$('#content').html(data);
			}
		});
	});
});