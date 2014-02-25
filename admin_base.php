<?php
function main(){
	require_once('config.php');
	
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
				$size = filesize($dir.$file[$i]) / 1024;
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
					<tr>
						<td><a class="screenshot" rel="'.$dir.$file[$i].'" href="'.$dir.$file[$i].'">'.$file[$i].'</a></td>
						<td><span class="label label-'.$colorsize.'">'.number_format($size,3).'KB</span></td>
						<td>'.date('Y-m-d H:i.s',filectime($dir.$file[$i])).'</td>
						<td><a href="delete.php?file='.$file[$i].'"><span class="glyphicon glyphicon-trash"></span></a></td>
					</tr>';
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
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css">
	<style>
		::selection{ background:#b0c4de; }
		#screenshot{ position:absolute; border-radius:5px; border:5px solid #333; display:none; }
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
				<li><a href="admin.php">Admin</a></li>
				<li class="active"><a href="admin_base.php">Admin (TextBase)</a></li>
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
				<div class="table-responsive">
					<table class="table"> <!-- table-hover -->
						<tr>
							<th>FileName</th>
							<th>FileSize</th>
							<th>CreateDate</th>
							<th>Delete</th>
						</tr>
						<?php echo main();?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>