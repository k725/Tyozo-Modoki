<?php
	function body()
	{
		$baseDir  = Setting::ImageDirectory;
		$html     = '';

		if (is_dir($baseDir))
		{
			$path  = glob($baseDir.'*');
			$files = array();
			$ftmp  = array();

			foreach ($path as $file)
			{
				if (is_file($file))
				{
					$time    = filemtime($file);
					$ftmp[]  = $time;
					$files[] = array(
						'time' => date(Setting::DateTimeFormat, $time),
						'path' => $file,
						'name' => str_replace($baseDir, '', $file),
						'size' => filesize($file) / 1024
					);
				}
			}

			array_multisort($ftmp, SORT_DESC, $files);

			foreach ($files as $key => $value)
			{
				$filePath       = $value['path'];
				$fileName       = $value['name'];
				$fileTimeFormat = $value['time'];
				$fileSize       = $value['size'];

				if (in_array(pathinfo($filePath, PATHINFO_EXTENSION), Setting::TargetExtention()))
				{
					if      (Setting::WarningSize > $fileSize) $fileLabel = 'success';
					else if (Setting::DangerSize > $fileSize)  $fileLabel = 'warning';
					else                                       $fileLabel = 'danger';

					$fileSize = number_format($fileSize, 3);

					$html .= <<<HTML
								<tr>
									<td><a class="screenshot" rel="{$fileName}" href="{$fileName}">{$fileName}</a></td>
									<td><span class="label label-{$fileLabel}">{$fileSize}KB</span></td>
									<td>{$fileTimeFormat}</td>
									<td><span class="glyphicon glyphicon-trash delete" data-file="{$fileName}"></span></td>
								</tr>

HTML;
				}
			}

			unset($ftmp, $files);
		}

		return <<<HTML
					<div class="page-header">
						<h2>File Upload</h2>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<form id="ajaxform">
								<input type="file" id="file" name="imagedata" style="display:none;">
								<div class="input-group" id="file_div">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button" id="file_select">
											<i class="glyphicon glyphicon-folder-open"></i>
										</button>
									</span>
									<input id="file_dummy" type="text" class="form-control" placeholder="Select image file... (jpg, png, gif)" disabled>
									<span class="input-group-btn">
										<button type="button" id="submit" class="btn btn-primary">
											<span class="glyphicon glyphicon-cloud-upload"></span> Upload
										</button>
									</span>
								</div>
							</form>
							<div class="progress" id="file_progress" style="display:none;">
								<div class="progress-bar progress-bar-info" id="file_progress_bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
									<span id="file_progress_number">0%</span>
								</div>
							</div>
						</div>
					</div>

					<div class="page-header">
						<h2>File List</h2>
					</div>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>FileName</th><th>FileSize</th><th>CreateDate</th><th>Delete</th>
								</tr>
							</thead>
							<tbody id="fileList">
{$html}
							</tbody>
						</table>
					</div>

					<div class="modal fade" id="model-dialog" tabindex="-1" role="dialog" aria-labelledby="modal-dialog-title" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									<h4 class="modal-title" id="modal-dialog-title">Confirm File Delete.</h4>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-xs-12">
											<div class="thumbnail">
												<img id="model-img">
											</div>
											<p id="modal-response"></p>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" id="model-img-delete">Delete</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								</div>
							</div>
						</div>
					</div>

HTML;
	}