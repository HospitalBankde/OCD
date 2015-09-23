$(document).ready(function()
{
	$('#select_dept').on('change', function()
	{
		console.log($(this).val());
		$.ajax(
		{
			url: 'doctorList/' + $(this).val(),
			method: 'GET',
			success: function(data)
			{
				alert('hi');
				console.log(data);
			}
		});
	});

});