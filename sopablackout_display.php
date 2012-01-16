<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php bloginfo('name'); ?> &rsaquo; <?php echo $sopablackout_page_title; ?></title>
	<style>
		body, html {background-color:#000000; color:#ffffff;font-family:"Trebuchet MS", Myriad, Arial;}
		div.sopablackout_padding {padding:24px; width:600px;}
		#container {width:1000px; margin:40px auto;}
		a {color:#00BCA4;}
		a:hover {text-decoration:none;}
		p, div.sopablackout_padding { font-size:14px; line-height:140%;}
	</style>
</head>
<body>
	<div id="container">
		<h1><?php bloginfo('name'); ?> - <?php echo $sopablackout_page_title;?></h1>
		<div class="sopablackout_padding">
			<?php echo nl2br(stripslashes(sopablackout_get_option('message')));?>
		</div>
		
		<?php if(sopablackout_get_option('include_video')){ ?>
			<div class="sopablackout_padding">
				<iframe src="http://player.vimeo.com/video/31100268" width="600" height="338" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			</div>
		<?php } ?>
		<?php if(sopablackout_get_option('include_form')){ ?>
			<div class="sopablackout_padding">
				<iframe src="http://americancensorship.org/callwidget" width="588" height="625" border="0"></iframe>
			</div>
		<?php } ?>
	</div>
	<?php wp_footer(); ?>
</body>
</html>