<?php
	if (array_shift(get_included_files()) === __FILE__) exit(Setting::FailMessage);

	$fileInfo = pathinfo(getParseHtml($_POST['file']));
	$filePath = getImageDirPath().$fileInfo['basename'];

	if (file_exists($filePath))
	{
		if (in_array($fileInfo['extension'], Setting::TargetExtention()) && unlink($filePath))
		{
			$json = array(
				'success' => true,
				'message' => 'Done.'
			);
		}
		else
		{
			$json = array(
				'success' => false,
				'message' => 'Failed to remove.'
			);
		}
	}
	else
	{
		$json = array(
			'success' => false,
			'message' => 'File does not exist.'
		);
	}

	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($json);