<?php
	/**
	 * サイトのタイトル取得
	 * @return string none
	 */
	function getSiteTitle()
	{
		return Setting::SiteTitle;
	}

	/**
	 * サイトのサブタイトル取得
	 * @return string none
	 */
	function getSiteSubTitle()
	{
		return Setting::SiteSubTitle;
	}

	/**
	 * htmlのtitleタグ中身取得
	 * @return string '場所 - サイトタイトル' で返します。
	 */
	function getSiteHeadTitle()
	{
		$title = ( isset($_GET['admin']) ) ? 'Admin area' : 'Home';
		return $title.' - '.Setting::SiteTitle;
	}

	/**
	 * BootStrap3用のツールバー用
	 * @return string URL引数にadminが含まれていた場合に、class="active"を返します。
	 */
	function getItemActive()
	{
		return ( isset($_GET['admin']) ) ? 'class="active"' : '';
	}

	/**
	 * ユニークなIDを取得
	 * @param  int    $length IDの長さ。
	 * @return string         none
	 */
	function getUniqueId($length=Setting::IdLength)
	{
		for ( $i = 0, $str = null; $i < $length; ) {
			$num = mt_rand(0x30, 0x7A);
			if ( (0x30 <= $num && $num <= 0x39) || (0x41 <= $num && $num <= 0x5A) || (0x61 <= $num && $num <= 0x7A) ) {
				$str .= chr($num);
				$i++;
			}
		}

		return $str;
	}

	/**
	 * 現在のプロトコルを取得
	 * @return string httpsの場合は'https://'、そうでない場合は'http://'を返します。
	 */
	function getProtocol()
	{
		return ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ) ? 'https://' : 'http://';
	}

	/**
	 * 画像ディレクトリへのフルパスを取得
	 * @return string '/foo/var/path/'の形式で返します。
	 */
	function getImageDirPath()
	{
		return dirname(__FILE__).'/../../'.Setting::ImageDirectory;
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
	 * 画像ディレクトリへの正しいURLを取得
	 * @return string 'http://example.com/images/'の形式で返します。
	 */
	function getImageFullUri()
	{
		return getProtocol().$_SERVER['HTTP_HOST'].'/'.Setting::ImageDirectory;
	}

	/**
	 * PNGファイルの圧縮率を取得
	 * @param  int $rate 圧縮率(0~9)
	 * @return int       0~9以外の場合、0を返します。
	 */
	function getPngCompressRate($rate=Setting::PngCompression)
	{
		return ( is_int($rate) && 0 <= $rate && $rate <= 9 ) ? $rate : 0;
	}

	/**
	 * Jpegファイルの品質を取得
	 * @param  int $rate 圧縮率(0~100)
	 * @return int       0~100以外の場合、0を返します。
	 */
	function getJpgQualityRate($rate=Setting::JpgQuality)
	{
		return ( is_int($rate) && 0 <= $rate && $rate <= 100 ) ? $rate : 75;
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
	 * 保存対象の拡張子
	 * @param  boolean $dot ドットを含めるか。
	 * @return string       Setting::ImgUsePngがtrueの場合png、そうでない場合はjpgを返します。
	 */
	function getExtention($dot=true)
	{
		$dot = ( $dot ) ? '.' : '';
		return ( Setting::ImgUsePng === true ) ? $dot.'png' : $dot.'jpg';
	}