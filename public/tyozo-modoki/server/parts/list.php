<?php
	function body()
	{
		$baseDir  = Setting::ImageDirectory;
		$html     = '';

		if ( is_dir($baseDir) && $dh = opendir($baseDir) ) {
			while ( ($f = readdir($dh)) !== false ) {
				$files[] = $f;
			}

			foreach ( $files as $file ) {
				$filePath       = $baseDir.$file;
				$fileTimeFormat = date(Setting::DateTimeFormat, filemtime($filePath));
				$fileSize       = (filesize($filePath) / 1024);
				$fileSizeFormat = number_format($fileSize, 3);

				if ( in_array(pathinfo($filePath, PATHINFO_EXTENSION), Setting::TargetExtention()) ) {
					if ( Setting::WarningSize > $fileSize ) {
						$colorsize = 'success';
					} else if ( Setting::DangerSize > $fileSize ) {
						$colorsize = 'warning';
					} else {
						$colorsize = 'danger';
					}

					$html .= <<<HTML
							<tr>
								<td><a class="screenshot" rel="{$filePath}" href="{$filePath}">{$file}</a></td>
								<td><span class="label label-{$colorsize}">{$fileSizeFormat}KB</span></td>
								<td>{$fileTimeFormat}</td>
								<td><span class="glyphicon glyphicon-trash delete" data-file="{$file}"></span></td>
							</tr>
HTML;
				}
			}

			closedir($dh);
			unset($file);
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