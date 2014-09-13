<?php
	/**
	 *   ______                              __  ___          __      __   _
	 *  /_  __/_  ______  ____  ____        /  |/  /___  ____/ /___  / /__(_)
	 *   / / / / / / __ \/_  / / __ \______/ /|_/ / __ \/ __  / __ \/ //_/ /
	 *  / / / /_/ / /_/ / / /_/ /_/ /_____/ /  / / /_/ / /_/ / /_/ / ,< / /
	 * /_/  \__, /\____/ /___/\____/     /_/  /_/\____/\__,_/\____/_/|_/_/
	 *     /____/
	 */
	require_once(dirname(__FILE__).'/tyozo-modoki/server/settings.php');
	require_once(dirname(__FILE__).'/tyozo-modoki/server/functions.php');

	switch ($_SERVER['REQUEST_URI'])
	{
		case '/':
			require_once(dirname(__FILE__).'/tyozo-modoki/server/template.php');
			break;

		case '/upload':
		case '/upload/json':
			if (basicAuth(Setting::LoginUser(), Setting::SiteTitle, Setting::AuthMessage))
			{
				require_once(dirname(__FILE__).'/tyozo-modoki/server/parts/upload.php');
			}

			break;

		case '/delete':
			if (basicAuth(Setting::LoginUser(), Setting::SiteTitle, Setting::AuthMessage))
			{
				require_once(dirname(__FILE__).'/tyozo-modoki/server/parts/delete.php');
			}

			break;

		case '/admin':
			if (basicAuth(Setting::LoginUser(), Setting::SiteTitle, Setting::AuthMessage))
			{
				require_once(dirname(__FILE__).'/tyozo-modoki/server/parts/list.php');
				require_once(dirname(__FILE__).'/tyozo-modoki/server/template.php');
			}

			break;

		default:
			header('HTTP/1.1 404 Not Found');
			echo Setting::NFoundMessage;
			break;
	}