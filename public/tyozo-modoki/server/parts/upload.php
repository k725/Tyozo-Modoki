<?php
	if (array_shift(get_included_files()) === __FILE__) exit(Setting::FailMessage);
	if ($_SERVER['REQUEST_URI'] === '/upload/json')
	{
		header('Content-Type: application/json; charset=utf-8');
	}

	do
	{
		$fileName = getUniqueId(Setting::IdLength).'.png';
		$filePath = getImageDirPath().$fileName;
	} while (file_exists($filePath));

	$uri = getImageShortUri();

	switch ($_SERVER['REQUEST_URI'])
	{
		case '/upload':
			if (isset($_FILES['imagedata']['error']) ||
				is_int($_FILES['imagedata']['error']) ||
				move_uploaded_file($_FILES['imagedata']['tmp_name'], $filePath) ||
				imageCreatePng($filePath, Setting::PngCompression))
			{
				exit($uri.$fileName);
			}
			else
			{
				exit($uri.'error.png');
			}

		case '/upload/json':
			if (!empty($_POST['url']) &&
				imageCreatePng($filePath, Setting::PngCompression, true, $_POST['url']))
			{
				$fileSize = filesize($filePath) / 1024;

				if      (Setting::WarningSize > $fileSize) $fileLabel = 'success';
				else if (Setting::DangerSize > $fileSize)  $fileLabel = 'warning';
				else                                       $fileLabel = 'danger';

				exit(json_encode(array(
					'success'       => true,
					'get_image_url' => $uri.$fileName,
					'name'          => $fileName,
					'time'          => date(Setting::DateTimeFormat, filemtime($filePath)),
					'size'          => number_format($fileSize, 3),
					'color'         => $fileLabel
				)));
			}
			else
			{
				exit(json_encode(array(
					'success'       => false,
					'get_image_url' => $uri.'error.png',
					'time'          => null,
					'size'          => null,
					'color'         => null
				)));
			}
	}