<?php
	/**
	 * htmlのtitleタグ中身取得
	 * @return string '場所 - サイトタイトル' で返します。
	 */
	function getSiteHeadTitle()
	{
		if      ($_SERVER['REQUEST_URI'] === '/admin') $title = 'Admin area';
		else if ($_SERVER['REQUEST_URI'] === '/')      $title = 'Home';
		else                                           $title = 'Error';

		return $title.' - '.Setting::SiteTitle;
	}

	/**
	 * BootStrap3用のツールバー用
	 * @return string URL引数にadminが含まれていた場合に、class="active"を返します。
	 */
	function getItemActive()
	{
		return ($_SERVER['REQUEST_URI'] === '/admin') ? 'class="active"' : '';
	}

	/**
	 * ユニークなIDを取得
	 * @param  int    $length IDの長さ。
	 * @return string         none
	 */
	function getUniqueId($length)
	{
		for ($i = 0, $str = null; $i < $length;)
		{
			$num = mt_rand(0x30, 0x7A);
			if ((0x30 <= $num && $num <= 0x39) || (0x41 <= $num && $num <= 0x5A) || (0x61 <= $num && $num <= 0x7A))
			{
				$str .= chr($num);
				$i++;
			}
		}

		return $str;
	}

	/**
	 * 画像ディレクトリへのフルパスを取得
	 * @return string '/foo/var/path/'の形式で返します。
	 */
	function getImageDirPath()
	{
		// /foo/var/www/tyozo-modoki/server/../../[ImageDir]
		return dirname(__FILE__).'/../../'.Setting::ImageDirectory;
	}

	/**
	 * 現在のプロトコルを取得
	 * @return string httpsの場合は'https://'、そうでない場合は'http://'を返します。
	 */
	function getProtocol()
	{
		return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
	}

	/**
	 * 画像ディレクトリへの短いURLを取得
	 * @return string 'http://example.com/'の形式で返します。
	 */
	function getImageShortUri()
	{
		return getProtocol().$_SERVER['HTTP_HOST'].'/';
	}

	/**
	 * PNGファイルの圧縮率を取得
	 * @param  int $rate 圧縮率(0~9)
	 * @return int       0~9以外の場合、6を返します。
	 */
	function getPngCompressRate($rate)
	{
		return (is_int($rate) && 0 <= $rate && $rate <= 9) ? $rate : 6;
	}

	/**
	 * テキストをエンコードします
	 * @param  string $str エンコードするテキスト。
	 * @param  string $enc 文字コード。
	 * @return string      エンコード済テキストを返します。
	 */
	function getParseHtml($str, $enc='UTF-8')
	{
		return htmlspecialchars($str, ENT_QUOTES, $enc);
	}

	/**
	 * BASIC認証
	 * @param  string $userArray ユーザ/パスワードの配列
	 * @param  string $autiTitle 認証時に表示するメッセージ
	 * @param  string $authFail  認証失敗時に表示するメッセージ
	 * @return bool              成功した場合true、失敗した場合falseを返します。
	 */
	function basicAuth($userArray, $autiTitle, $authFail)
	{
		if (isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'], $userArray[$_SERVER['PHP_AUTH_USER']]) && 
			$_SERVER['PHP_AUTH_PW'] === $userArray[$_SERVER['PHP_AUTH_USER']])
		{
			return true;
		}

		header('WWW-Authenticate: Basic realm="'.$autiTitle.'"');
		header('HTTP/1.0 401 Unauthorized');
		echo $authFail;
		return false;
	}

	/**
	 * PNG画像を生成
	 * @param  string   $path     ファイルパス
	 * @param  int      $rate     PNGの圧縮率
	 * @param  bool     $isbase64 BASE64?
	 * @param  string   $base64   BASE64文字列
	 * @return bool               成功した場合はtrue、失敗した場合はfalseを返します。
	 */
	function imageCreatePng($path, $rate, $isbase64=false, $base64=null)
	{
		if ($isbase64 && !is_null($base64))
		{
			$rep64 = preg_replace('/^data:image\/(jpeg|gif|png);base64,/', '', $base64);
			$rep64 = base64_decode($rep64);
			$image = imagecreatefromstring($rep64);

			if (!$image)
			{
				return false;
			}
		}
		else
		{
			switch (exif_imagetype($path))
			{
				case IMAGETYPE_GIF:
					$image = imagecreatefromgif($path);
					break;

				case IMAGETYPE_JPEG:
					$image = imagecreatefromjpeg($path);
					break;

				case IMAGETYPE_PNG:
					$image = imagecreatefrompng($path);
					break;

				default:
					return false;
			}
		}

		imagealphablending($image, false);
		imagesavealpha($image, true);

		if (!imagepng($image, $path, getPngCompressRate($rate)))
		{
			return false;
		}

		imagedestroy($image);
		return true;
	}