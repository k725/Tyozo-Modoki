<?php
	function body()
	{
		$baseDir  = Setting::ImageDirectory;
		$html     = '';

		if ( is_dir($baseDir) ) {
			$path  = glob(rtrim($baseDir, '/') . '/*');
			$files = array();
			$ftmp  = array();

			foreach ( $path as $file ) {
				if ( is_file($file) ) {
					$time    = filemtime($file);
					$ftmp[]  = $time;
					$files[] = array(
						'time' => $time,
						'name' => $file
					);
				}
			}

			array_multisort($ftmp, SORT_DESC, $files);
			unset($ftmp);

			foreach ( $files as $key => $value ) {
				$fileName       = $value['name'];
				$fileTimeFormat = date(Setting::DateTimeFormat, $value['time']);
				$fileSize       = (filesize($fileName) / 1024);
				$fileSizeFormat = number_format($fileSize, 3);

				if ( in_array(pathinfo($fileName, PATHINFO_EXTENSION), Setting::TargetExtention()) ) {
					if ( Setting::WarningSize > $fileSize ) {
						$colorsize = 'success';
					} else if ( Setting::DangerSize > $fileSize ) {
						$colorsize = 'warning';
					} else {
						$colorsize = 'danger';
					}

					$html .= <<<HTML
							<tr>
								<td><a class="screenshot" rel="{$fileName}" href="{$fileName}">{$fileName}</a></td>
								<td><span class="label label-{$colorsize}">{$fileSizeFormat}KB</span></td>
								<td>{$fileTimeFormat}</td>
								<td><span class="glyphicon glyphicon-trash delete" data-file="{$fileName}"></span></td>
							</tr>
HTML;
				}
			}

			unset($files);
		}

		return <<<HTML
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>FileName</th><th>FileSize</th><th>CreateDate</th><th>Delete</th>
							</tr>
						</thead>
						<tbody>
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