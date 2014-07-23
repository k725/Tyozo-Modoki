<?php
	class Setting
	{
		/*
		 * 注意:
		 * 1.
		 * ImageDirectoryは相対パスで書いてください。
		 * 最初に./等は書かず、最後は必ずスラッシュで終わらせてください。
		 * この項目を変更した場合は絶対に.htaccessも編集してください。
		 * 
		 * 2.
		 * WarningSizeはDangerSizeの値を超えないように設定してください。
		 * この設定項目はファイル一覧を表示した際、ファイルサイズによって
		 * ファイルサイズ表示の背景色を変えるために必要な設定項目です。
		 *
		 * 3.
		 * IdLengthは4文字以上が推奨です。
		 * a-z & A-Z & 0-9 = 62
		 * 62^6 = 56,800,235,584 通り -> デフォルト (IdLength = 6)
		 * 62^5 =    916,132,832 通り
		 * 62^4 =     14,776,336 通り
		 * 62^3 =        238,328 通り
		 * 62^2 =          3,844 通り -> 推奨されません
		 * 62^1 =             62 通り -> 推奨されません
		 *
		 * 4.
		 * PngCompressionは0~9以内に、JpgQualityは0~100以内に設定してください。
		 * ImgUsePngがtrueの場合、Pngが使用されます。なお、falseの場合はJpegが使用されます。
		 *
		 * 5.
		 * ファイル一覧を表示した際の日付フォーマットです。
		 * 詳細はphp公式サイトを確認してください。 http://php.net/manual/ja/datetime.formats.date.php
		 *
		 * 6.
		 * UrlShortStyleがtrueの場合、URLは短いURLが使用されます。(mod_rewrite必須)
		 * 短いURL例: http://example.com/foo.png
		 * 長いURL例: http://example.com/images/foo.png
		 */
		const ImageDirectory = 'images/';
		const WarningSize    = 50;
		const DangerSize     = 100;
		const SiteTitle      = 'Tyozo Modoki';
		const SiteSubTitle   = 'Private Gyazo';
		const IdLength       = 6;
		const PngCompression = 9;
		const JpgQuality     = 75;
		const ImgUsePng      = true;
		const DateTimeFormat = 'Y-m-d H:i.s';
		const UrlShortStyle  = true;

		static function TargetExtention()
		{
			return array('jpg', 'png');
		}
	}
?>