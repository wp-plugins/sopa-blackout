<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php bloginfo('name'); ?> &rsaquo; <?php echo $sopablackout_page_title; ?></title>
	<style>
		body, html {background-color:#000000; color:#ffffff;font-family:"Trebuchet MS", Myriad, Arial;}
		div {padding:24px;}
		#container {width:1000px; margin:20px auto;}
		p, div { font-size:14px; line-height:140%;}
	</style>
</head>
<body>
	<div id="container">
		<h1><?php bloginfo('name'); ?> - <?php echo $sopablackout_page_title;?></h1>
		<div>
			<?php echo nl2br(stripslashes(sopablackout_get_option('message')));?>
		</div>
		
		<?php if(sopablackout_get_option('include_video')){ ?>
			<div>
				<iframe src="http://player.vimeo.com/video/31100268" width="600" height="338" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			</div>
		<?php } ?>
		<?php if(sopablackout_get_option('include_form')){ ?>
			<div>
				<iframe src="http://americancensorship.org/callwidget" width="588" height="625" border="0"></iframe>
			</div>
		<?php } ?>
	</div>
</body>
</html>