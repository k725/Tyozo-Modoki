<?php
	function body()
	{
		do {
			$fileName = getUniqueId().getExtention();
			$filePath = getImageDirPath().$fileName;
		} while ( file_exists($filePath) );

		if ( $_FILES['imagedata']['size'] < 1 || file_exists($filePath) || !move_uploaded_file($_FILES['imagedata']['tmp_name'], $filePath) )
		return ( Setting::UrlShortStyle === true ) ? getImageShortUri().'error.png' : getImageFullUri().'error.png';

		if ( Setting::ImgUsePng === true ) {
			$image = imagecreatefrompng($filePath);
			imagealphablending($image, false);
			imagesavealpha($image, true);
			imagepng($image, $filePath, getPngCompressRate());
			imagedestroy($image);

		} else {
			$image = imagecreatefromjpeg($filePath);
			imagejpeg($image, $filePath, getJpgQualityRate());
			imagedestroy($image);

		}

		chmod($filePath, 0644);
		return ( Setting::UrlShortStyle === true ) ? getImageShortUri().$fileName : getImageFullUri().$fileName;
	}