<?php
	require_once(dirname(__FILE__).'/tyozo-modoki/server/settings.php');
	require_once(dirname(__FILE__).'/tyozo-modoki/server/functions.php');

	if ( !isset($_GET['admin']) && !isset($_GET['del']) && isset($_FILES['imagedata']['error']) && is_int($_FILES['imagedata']['error']) ) {
		require_once(dirname(__FILE__).'/tyozo-modoki/server/parts/upload.php');
		echo body();

	} else if ( !isset($_GET['admin']) && isset($_GET['delete']) ) {
		require_once(dirname(__FILE__).'/tyozo-modoki/server/parts/delete.php');
		header('Content-Type: application/json;');
		echo body();

	} else if ( isset($_GET['admin']) && !isset($_GET['delete']) ) {
		require_once(dirname(__FILE__).'/tyozo-modoki/server/template_header.php');
		require_once(dirname(__FILE__).'/tyozo-modoki/server/parts/list.php');
		echo body();
		require_once(dirname(__FILE__).'/tyozo-modoki/server/template_footer.php');

	} else {
		require_once(dirname(__FILE__).'/tyozo-modoki/server/template_header.php');
		require_once(dirname(__FILE__).'/tyozo-modoki/server/template_footer.php');

	}