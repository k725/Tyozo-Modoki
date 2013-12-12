<?php
function main(){
	
	// CONFIG START
	$dir = './'; // 相対パスで画像のディレクトリ指定 最後はスラッシュで
		
	// color > color2 になるように指定。小数点指定とかわけわからんことして動かなくなっても知りません
	$color = 50;	//ファイルサイズがこの数値KB以上だった場合オレンジ色
	$color2 = 100;	//ファイルサイズがこの数値KB以上だった場合赤色
	// CONFIG END
	
	$all = 0;
	$main = null;
	$imglist = null;
	$imgrand = array();
	if (is_dir($dir) && $dh = opendir($dir)) {
		while (($files = readdir($dh)) !== false) {
			$file[] = $files;
		}
		
		for($i=0;$i<count($file);$i++) {
			if(preg_match('/\.png$/',$file[$i])){
				$size = floor(filesize($file[$i]) / 1024);
				if($color > $size){ // 50kb以下
					$colorsize = 'success';
				}else {
					if($color2 < $size){ // 100kb以上
						$colorsize = 'danger';
					}else{
						$colorsize = 'warning'; // 50kb以上
					}
				}
				$imglist.= '
					<div class="col-sm-12 col-md-2">
						<div class="thumbnail">
							<div class="imgbox">
								<a href="'.$dir.$file[$i].'" class="thumbnail">
									<img src="'.$dir.$file[$i].'" class="imgbox2">
								</a>
							</div>
							<div class="caption" style="margin-top:5px;font-size:120%;">
								<span class="label label-'.$colorsize.'">'.$size.'KB</span>
							</div>
						</div>
					</div>';
				$imgrand[] = $imglist;
				$imglist = '';
				$all++;
			}
		}
		
		closedir($dh);
		$file = array();
	}
	
	for($i=0;$i<count($imgrand);$i++){
		$main.= "$imgrand[$i]\n";
	}
	return $main;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="robots" content="noindex,nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>StarRainPicture</title>
	
	<link rel="icon" href="favicon.ico">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.lightbox.css">
	<style>
		::selection{ background:#b0c4de; }
		div.imgbox{ height: auto; width: auto; height: 155px; width: 100%; }
		img.imgbox2{ height: auto; width: auto; max-height: 100%; max-width: 100%; }
	</style>
</head>
<body>
<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand navbar-brand_fix mfont" href="./">StarRainPicture</a>
		</div>
		
		<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
			<ul class="nav navbar-nav">
				<li class="active"><a href="admin.php">Admin</a></li>
			</ul>
		</nav>
	</div>
</header>

<div class="container" style="padding-top:40px;">
	<div class="row">
		<div class="col-xs-12">
			<h1>StarRainPicture <small>Photo Gallery</small></h1>

			<div class="page-header">
				<h2>Save to Screenshot</h2>
			</div>
			<p>The Easiest Way to Capture My Screen<br>
			Easy Share and Easy Delete.</p>
			<div class="row">
				<div class="thumbnails" data-toggle="lightbox">
					<?php echo main();?>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.2/js/bootstrap.min.js"></script>
<script src="js/bootstrap.lightbox.js"></script>
</body>
</html>