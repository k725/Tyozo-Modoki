$(function() {
	var tr;

	$(document).on('click', '.delete', function(){
		tr = $(this);
		$('#model-img').attr('src', './' + $(this).data('file'));
		$('#model-dialog').modal('show');
	});

	$('#model-img-delete').click(function() {
		$.ajax({
			type: 'POST',
			url: '/delete',
			dataType: 'json',
			data: {
				'file': $(tr).data('file')
			}
		}).done(function(data) {
			if (data.Success) {
				$('#model-dialog').modal('hide');
				$(tr).closest('tr').hide('slow', function() {
					$(tr).closest('tr').remove();
				});
			} else {
				$('#modal-response').text(data.Message);
			}
		}).fail(function(data) {
			$('#modal-response').text('エラーが発生しました。' + data.status + ' - ' + data.statusText);
		});
	});
});