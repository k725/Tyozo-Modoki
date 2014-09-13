$(function() {
	var base64;

	$('#submit').click(function() {
		if ($('#file').val() == '') {
			$('#file_div').addClass('has-error');

			return false;
		} else {
			$('#file_div').removeClass('has-error');
			$('#file_progress_bar').removeClass('progress-bar-danger')
								   .addClass('progress-bar-info');
		}

		$('#file_progress').fadeIn(200);

		$.ajax({
			url      : '/upload/json',
			type     : 'POST',
			dataType : 'json',
			data     : {
				'url' : base64
			},
			xhr      : function() {
				var XHR = $.ajaxSettings.xhr();

				if(XHR.upload) {
					XHR.upload.addEventListener('progress', function(e) {
							var progress = (parseInt(e.loaded / e.total * 10000) / 100);

							$('#file_progress_number').html(progress + '%');
							$('#file_progress_bar').css('width', progress + '%')
												   .attr('aria-valuenow', progress);

							if (progress == 100) {
								$('#file_progress_number').html(progress + '% Loading...');
							}
					}, false);
				}

				return XHR;
			}
		}).done(function(data) {
			if (data.success) {
				$('#file_progress').fadeOut(1000);
				$('#fileList').prepend('<tr>'+
					'<td><a class="screenshot" rel="'+data.name+'" href="'+data.name+'">'+data.name+'</a></td>'+
					'<td><span class="label label-'+data.color+'">'+data.size+'KB</span></td>'+
					'<td>'+data.time+'</td>'+
					'<td><span class="glyphicon glyphicon-trash delete" data-file="'+data.name+'"></span></td>'+
				'</tr>');

			} else {
				$('#file_progress_number').html('This is not an image file. or File size is too large.');
				$('#file_progress_bar').removeClass('progress-bar-info')
									   .addClass('progress-bar-danger');
			}
		}).fail(function(data) {
			$('#file_progress_number').html('Error... / ' + data.status + ' - ' + data.statusText);
			$('#file_progress_bar').removeClass('progress-bar-info')
								   .addClass('progress-bar-danger');
		});
	});

	$('#file').change(function() {
		$('#file_dummy').val($(this).val());

		if (!this.files.length) return;

		var file = this.files[0],
			fr   = new FileReader();

		fr.onload = function(event) {
			base64 = event.target.result;
		};
		fr.readAsDataURL(file);
	});

	$('#file_select').click(function() {
		$('#file').click();
	});
});