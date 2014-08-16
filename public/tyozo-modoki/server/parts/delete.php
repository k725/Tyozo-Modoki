<?php
	function body()
	{
		$filePath = getParseHtml($_POST['file']);

		if ( file_exists($filePath) ) {
			if ( in_array(pathinfo($filePath, PATHINFO_EXTENSION), Setting::TargetExtention()) && unlink($filePath) ) {
				$json = array('Success' => true, 'Message' => 'Done.');
			} else {
				$json = array('Success' => false, 'Message' => 'Failed to remove.');
			}
		} else {
			$json = array('Success' => false, 'Message' => 'File does not exist.');
		}

		return json_encode($json);
	}