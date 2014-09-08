<?php
	class Setting
	{
		const ImageDirectory = 'images/';
		const WarningSize    = 50;
		const DangerSize     = 100;
		const SiteTitle      = 'Tyozo Modoki';
		const FailMessage    = 'Direct access is not allowed / Tyozo-Modoki';
		const AuthMessage    = 'Authentication is required to access. / Tyozo-Modoki';
		const NFoundMessage  = '404 Not Found / Tyozo-Modoki';
		const IdLength       = 6;
		const PngCompression = 9;
		const DateTimeFormat = 'Y-m-d H:i.s';

		static function TargetExtention()
		{
			return array(
				'png',
				'jpg'
			);
		}

		static function LoginUser()
		{
			return array(
				'admin'  => 'foopassword',
				'john'   => 'foobar'
			);
		}
	}
?>