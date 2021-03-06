<?php if (array_shift(get_included_files()) === __FILE__) exit(Setting::FailMessage) ?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
		<meta name="robots" content="noindex, nofollow">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title><?php echo getSiteHeadTitle() ?></title>

		<link rel="icon" href="/tyozo-modoki/client/logo.png">
		<link rel="apple-touch-icon" href="/tyozo-modoki/client/logo.png">
		<link rel="apple-touch-icon-precomposed" href="/tyozo-modoki/client/logo.png">

		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="/tyozo-modoki/client/style.css">
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
					<a class="navbar-brand navbar-brand_fix mfont" href="/"><?php echo Setting::SiteTitle ?></a>
				</div>

				<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
					<ul class="nav navbar-nav">
						<li <?php echo getItemActive() ?>><a href="/admin">Admin area</a></li>
					</ul>
				</nav>
			</div>
		</header>

		<div class="container main">
			<div class="row">
				<div class="col-xs-12">
					<h1><?php echo Setting::SiteTitle ?> <small>Private Gyazo</small></h1>
					<div class="page-header">
						<h2>Save the Screenshot</h2>
					</div>
					<p>The Easiest Way to Capture My Screen<br>
					Easy Share and Easy Delete.</p>

<?php echo (function_exists('body')) ? body() : '' ?>
				</div>
			</div>
		</div>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="/tyozo-modoki/client/preview.js"></script>
		<script src="/tyozo-modoki/client/delete.js"></script>
		<script src="/tyozo-modoki/client/upload.js"></script>
	</body>
</html>