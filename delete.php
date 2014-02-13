<?php
	require_once('config.php');
	
	if(isset($_GET['file'])){
		$del = htmlspecialchars($_GET['file'], ENT_QUOTES);
	}
	
	if(isset($_GET['del'])){
		$flag = htmlspecialchars($_GET['del'], ENT_QUOTES);
	}
	
	if(isset($del) && isset($flag) && $flag == 'true' && file_exists($dir.$del)){
		chmod($dir.$del, 0777);
		unlink($dir.$del);
		$msg = array('Infomation','File delete done.');
		$html = '<p>Success<br>'.$del.' delete.</p><a href="admin.php" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Return</a>';
	}else{
		if(isset($del) && $del != '' && file_exists($dir.$del)){
			$msg = array('Infomation','File delete?');
			$html = '
			<div class="row">
				<div class="col-sm-8 col-md-4">
					<div class="thumbnail">
						<img src="'.$dir.$del.'">
					</div>
					<a href="admin.php" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Return</a>
					<a href="delete.php?file='.$del.'&del=true" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
				</div>
			</div>';
			
		}else{
			$msg = array('Error','undefined.');
			$html = '<p>Error<br>return to main page.</p><a href="admin.php" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Return</a>';
		}
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
			<h2><?php echo $msg[0];?> <small><?php echo $msg[1];?></small></h2>
			<?php echo $html;?>
		</div>
	</div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
</body>
</html>
