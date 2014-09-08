<?php
	if (array_shift(get_included_files()) === __FILE__) exit(Setting::FailMessage);
	if ($_SERVER['REQUEST_URI'] === '/upload/json') header('Content-Type: application/json; charset=utf-8');

	do
	{
		$fileName = getUniqueId().'.png';
		$filePath = getImageDirPath().$fileName;
	} while (file_exists($filePath));

	if (!isset($_FILES['imagedata']['error']) ||
		!is_int($_FILES['imagedata']['error']) ||
		!move_uploaded_file($_FILES['imagedata']['tmp_name'], $filePath) ||
		!imageCreatePng($filePath))
	{
		if (file_exists($filePath))
		{
			unlink($filePath);
		}

		switch ($_SERVER['REQUEST_URI'])
		{
			case '/upload': exit(getImageShortUri().'error.png');

			case '/upload/json':
				$j = array(
					'success' => false,
					'uri'     => getImageShortUri().'error.png',
					'time'    => null,
					'size'    => null,
					'color'   => null
				);

				exit(json_encode($j));
		}
	}

	chmod($filePath, 0644);

	switch ($_SERVER['REQUEST_URI'])
	{
		case '/upload':
			echo getImageShortUri().$fileName;
			break;

		case '/upload/json':
			$fileSize = filesize($filePath) / 1024;

			if      (Setting::WarningSize > $fileSize) $fileLabel = 'success';
			else if (Setting::DangerSize > $fileSize)  $fileLabel = 'warning';
			else                                       $fileLabel = 'danger';

			$fileSize = number_format($fileSize, 3);
			$j        = array(
				'success' => true,
				'uri'     => getImageShortUri().$fileName,
				'name'    => $fileName,
				'time'    => date(Setting::DateTimeFormat, filemtime($filePath)),
				'size'    => $fileSize,
				'color'   => $fileLabel
			);

			echo json_encode($j);
			break;
	}