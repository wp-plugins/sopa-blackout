<?php
/**
 * @package SopaBlackout
 * @version 1.4
 */
/*
Plugin Name: SOPA Blackout
Plugin URI: http://blog.eagerterrier.co.uk/2012/01/stop-sopa-blackout-wp-plugin/
Description: Blacks out your website on January 18th 2012 in support of those against SOPA
Author: Toby Cox
Version: 1.4
Author URI: http://eagerterrier.co.uk
*/

$sopablackout_options = get_option('sopablackout_options'); 


function sopablackout_set_option($option_name, $option_value) {
	// first get the existing options in the database
	$sopablackout_ = get_option('sopablackout_options');
	// set the value
	$sopablackout_[$option_name] = $option_value;
	// write the new options to the database
	update_option('sopablackout_options', $sopablackout_);
}


function sopablackout_get_option($option_name) {

  // get options from the database
  $sopablackout_options = get_option('sopablackout_options'); 

  
  if (!$sopablackout_options || !array_key_exists($option_name, $sopablackout_options)) {
    // no options in database yet, or not this specific option 
    // create default options array

    
    $sopablackout_default_options=array();
    
    $sopablackout_default_options['test_mode']			= false;
    $sopablackout_default_options['show_blackout_to_logged_in_users'] = false;
    $sopablackout_default_options['message']			= '<p>On the Tuesday 24th January 2012, the US Senate will vote on the <a href="http://en.wikipedia.org/wiki/Stop_Online_Piracy_Act" target="_blank">internet censorship bill</a>.<br /><br />Whilst it is an American law, it has far reaching repurcusions for the web as a whole.<br /><br />There are many companies against SOPA, such as <a href="http://www.mattcutts.com/blog/internet-censorship-sopa/" target="_blank">Google</a>, <a href="http://blog.reddit.com/2012/01/stopped-they-must-be-on-this-all.html" target="_blank">Reddit</a>, <a href="http://news.cnet.com/8301-31921_3-57342914-281/silicon-valley-execs-blast-sopa-in-open-letter/" target="_blank">Facebook, Twitter, Wikipedia</a>, and today I am lending my weight to the argument by taking my site down for the day.<br /><br />If you think SOPA doesn\'t affect you, please think again. Watch the video below, or use the form below to force politicians to take notice.<br /><br />Thank you</p>';
    
	$sopablackout_default_options['blackoutdate_year']	= '2012';
	$sopablackout_default_options['blackoutdate_month']	= '01';
	$sopablackout_default_options['blackoutdate_day']	= '18';
	$sopablackout_default_options['blackoutdate']		= '2012-01-18';
	$sopablackout_default_options['blackouttimestart']	= 8;
	$sopablackout_default_options['blackouttimeend']	= 20;
	$sopablackout_default_options['blackouttimezone']	= null;
    
    $sopablackout_default_options['include_video']		= true;
    $sopablackout_default_options['include_form']		= true;
    $sopablackout_default_options['page_title']			= 'Supporting anti-SOPA Blackout day';

    // add default options to the database (if options already exist, 
    // add_option does nothing
    add_option('sopablackout_options', $sopablackout_default_options, 
               'Settings for Stop SOPA Blackout plugin');

    // return default option if option is not in the array in the database
    // this can happen if a new option was added to the array in an upgrade
    // and the options haven't been changed/saved to the database yet
    $result = $sopablackout_default_options[$option_name];

  } else {
    // option found in database
    $result = $sopablackout_options[$option_name];
  }
  

  return $result;
}

function sopablackout_options() {


	if (isset($_POST['info_update'])) {

		?><div class="updated"><p><strong><?php 
		
		// process submitted form
		$sopablackout_options = get_option('sopablackout_options');
		$sopablackout_options['page_title']									= $_POST['page_title'];
		$sopablackout_options['message']									= $_POST['message'];
		$sopablackout_options['blackoutdate_year']							= $_POST['blackoutdate_year'];
		$sopablackout_options['blackoutdate_month']							= $_POST['blackoutdate_month'];
		$sopablackout_options['blackoutdate_day']							= $_POST['blackoutdate_day'];
		$sopablackout_options['blackouttimestart']							= $_POST['blackouttimestart'];
		$sopablackout_options['blackouttimeend']							= $_POST['blackouttimeend'];
		$sopablackout_options['blackouttimezone']							= $_POST['blackouttimezone'];
		$sopablackout_options['message']									= $_POST['message'];
		$sopablackout_options['include_form']								= ($_POST['include_form']=="true"		? true : false);
		$sopablackout_options['include_video']								= ($_POST['include_video']=="true"		? true : false);
		$sopablackout_options['test_mode']									= ($_POST['test_mode']=="true"			? true : false);
		$sopablackout_options['show_blackout_to_logged_in_users']			= ($_POST['show_blackout_to_logged_in_users']=="true"			? true : false);
		update_option('sopablackout_options', $sopablackout_options);

		_e('Options saved', 'mtli')
		?></strong></p></div><?php
	} 
	


	?>
	<div class="wrap">
		<form method="post">
			<h2>Stop SOPA Blackout</h2> 
				
			<div class="whitebg">
			<fieldset class="options" name="general">
				<legend><?php _e('General settings', 'sopablackout') ?></legend>
				<table width="100%" cellspacing="2" cellpadding="5" class="editform form-table">
					<tr>
						<td>Page Title</td>
					</tr>
					<tr>
						<td><input type="text" name="page_title" id="page_title" value="<?php echo sopablackout_get_option('page_title');?>" /> </td>
					</tr>
					<tr>
						<td>Include Video?</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="include_video" id="include_video" value="true" <?php if (sopablackout_get_option('include_video')) echo "checked"; ?> /> </td>
					</tr>
					<tr>
						<td>Include Form?</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="include_form" id="include_form" value="true" <?php if (sopablackout_get_option('include_form')) echo "checked"; ?> /> </td>
					</tr>
					<tr>
						<td>Message</td>
					</tr>
					<tr>
						<td><?php if(function_exists('wp_editor')){ wp_editor( stripslashes(sopablackout_get_option('message')), 'message' ); } else { ?><textarea name="message" id="message" style="width:800px; height:400px;"><?php echo stripslashes(sopablackout_get_option('message'));?></textarea><?php } ?></td>
					</tr>
				</table>
			</fieldset>
			<fieldset class="options" name="general">
				<legend><?php _e('Blackout Day', 'sopablackout') ?></legend>
				<table width="100%" cellspacing="2" cellpadding="5" class="editform form-table">
					<tr>
						<td>You can change the times of the Blackout Day here if you wish</td>
					</tr>
					<tr>
						<td>
							<?php $selecteddateday = sprintf('%02d',sopablackout_get_option('blackoutdate_day'));
								$selecteddatemonth = sprintf('%02d',sopablackout_get_option('blackoutdate_month'));
								$selecteddateyear = sopablackout_get_option('blackoutdate_year');?>
							<select name="blackoutdate_day" id="blackoutdate_day">
								<?php for($i=1;$i<32; $i++){ ?><option value="<?php echo sprintf('%02d',$i);?>"<?php if($selecteddateday==$i) echo ' selected';?>><?php echo $i;?></option><?php } ?>
							</select>
							<select name="blackoutdate_month" id="blackoutdate_month">
								<?php for($i=1;$i<13; $i++){ ?><option value="<?php echo sprintf('%02d',$i);?>"<?php if($selecteddatemonth==$i) echo ' selected';?>><?php echo date('F',strtotime('2012-'.$i.'-01'));?></option><?php } ?>
							</select>
							<select name="blackoutdate_year" id="blackoutdate_year">
								<?php for($i=2012;$i<(date('Y')+5); $i++){ ?><option value="<?php echo $i;?>"<?php if($selecteddateyear==$i) echo ' selected';?>><?php echo $i;?></option><?php } ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Start Time<td>
					</tr>
					<tr>
						<td>
							<select id="blackouttimestart" name="blackouttimestart">
								<?php $currenttimestart = sopablackout_get_option('blackouttimestart');?>
								<?php for($i=0; $i<25; $i++){ ?>
									<option value="<?php echo $i;?>"<?php if($currenttimestart==$i) echo ' selected';?>><?php echo sprintf('%02d', $i);?>:00:00</option>
								<?php } ?>
							</select>	
						</td>
					</tr>
					<tr>
						<td>End Time<td>
					</tr>
					<tr>
						<td>
							<select id="blackouttimeend" name="blackouttimeend">
								<?php $currenttimeend = sopablackout_get_option('blackouttimeend');?>
								<?php for($i=0; $i<25; $i++){ ?>
									<option value="<?php echo $i;?>"<?php if($currenttimeend==$i) echo ' selected';?>><?php echo sprintf('%02d', $i);?>:00:00</option>
								<?php } ?>
							</select>	
						</td>
					</tr>
					<tr>
						<td>Time Zone</td>
					</tr>
					<tr>
						<td>
							<select name="blackouttimezone" id="blackouttimezone">
								<option value="">Default - <?php echo date_default_timezone_get();?></option>
								<option value="America/New_York"<?php if(sopablackout_get_option('blackouttimezone')=='America/New_York') echo ' selected';?>>Eastern Time (New York)</option>
								<option value="America/Los_Angeles"<?php if(sopablackout_get_option('blackouttimezone')=='America/Los_Angeles') echo ' selected';?>>Pacific Time (Los Angeles)</option>
							</select>
						</td>
					</tr>
				</table>
			</fieldset>
			<fieldset class="options" name="general">
				<legend><?php _e('Enable test mode?', 'sopablackout') ?></legend>
				<table width="100%" cellspacing="2" cellpadding="5" class="editform form-table">
					<tr>
						<td>By checking this box you will turn on the SOPA blackout <b>RIGHT NOW</b></td>
					</tr>
					<tr>
						<td><input type="checkbox" name="test_mode" id="test_mode" value="true" <?php if (sopablackout_get_option('test_mode')) echo "checked"; ?> /> </td>
					</tr>
					<tr>
						<td>By default, logged in users will see your site's full content. If you would like logged in users to get the Stop SOPA Blackout page instead, click here</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="show_blackout_to_logged_in_users" id="show_blackout_to_logged_in_users" value="true" <?php if (sopablackout_get_option('show_blackout_to_logged_in_users')) echo "checked"; ?> /> </td>
					</tr>
				</table>
			</fieldset>
			<div class="submit">
				<input type="submit" name="info_update" value="<?php _e('Update options', 'sopablackout') ?>" /> 
			</div>
			</div>
		</form>
	</div>


<?php
}


// Hook function for init action to do some initialization
function sopablackout_init() {
	// load texts for localization
	load_plugin_textdomain('sopablackout');
}



if(!function_exists('sopablackout_header')):
function sopablackout_header($status_header, $header, $text, $protocol) {
	if ( sopablackout_showtologgedinusers() ) {
		if( defined( 'WPCACHEHOME' ) ) {
			// Solves issue of white page output with Super Cache plugin version 0.9.9.6.
			// Did not occur when removing <html> and </html> tag in splash page source, so weird problem.
			ob_end_clean();
		}
		nocache_headers();
		return "$protocol 503 Service Unavailable";
	}
}
endif;

if(!function_exists('sopablackout_content')){
function sopablackout_content() {
	if ( sopablackout_showtologgedinusers() && !strstr(htmlspecialchars($_SERVER['REQUEST_URI']), '/wp-admin/') ) {
		if( strstr($_SERVER['PHP_SELF'],    'wp-login.php') 
				|| strstr($_SERVER['PHP_SELF'], 'async-upload.php') // Otherwise media uploader does not work 
				|| strstr(htmlspecialchars($_SERVER['REQUEST_URI']), '/plugins/') 		// So that currently enabled plugins work while in maintenance mode.
				|| strstr($_SERVER['PHP_SELF'], 'upgrade.php')
			){ 
				return; 
		} else {
		$sopablackout_page_title = sopablackout_get_option('page_title');
		$page = dirname(__FILE__) . '/sopablackout_display.php';
		include($page);
		exit();
	}
	}
}
}

if(!function_exists('sopablackout_feed')){
	function sopablackout_feed() {
		if ( !is_user_logged_in() ) {
			die('<?xml version="1.0" encoding="UTF-8"?>'.
				'<status>Service unavailable</status>');
		}
	}
}

if(!function_exists('sopablackout_add_feed_actions')){
	function sopablackout_add_feed_actions() {
		$feeds = array ('rdf', 'rss', 'rss2', 'atom');
		foreach ($feeds as $feed) {
			add_action('do_feed_'.$feed, 'sopablackout_feed', 1, 1);
		}
	}
}

function sopablackout_checkdate(){
	if(sopablackout_get_option('blackouttimezone')){
		date_default_timezone_set(sopablackout_get_option('blackouttimezone'));
	}
	$toreturn = false;
	if(date('Y-m-d')==sopablackout_get_option('blackoutdate_year').'-'.sprintf('%02d',sopablackout_get_option('blackoutdate_month')).'-'.sprintf('%02d',sopablackout_get_option('blackoutdate_day'))){
		if(date('H')>=sopablackout_get_option('blackouttimestart') && date('H')<sopablackout_get_option('blackouttimeend')){
			$toreturn = true;
		}
	}
	return $toreturn;
}

function sopablackout_testmode(){
	return sopablackout_get_option('test_mode');
}

function sopablackout_showtologgedinusers(){
	return ((!is_user_logged_in() && !is_admin()) || sopablackout_get_option('show_blackout_to_logged_in_users'));
}

if (function_exists('add_filter') && (sopablackout_checkdate() || sopablackout_testmode()) ){
	add_filter('status_header', 'sopablackout_header', 10, 4);
	add_action('template_redirect', 'sopablackout_content');
	sopablackout_add_feed_actions();
} 




/*  ADMIN FUNCTIONS AND HOOKS GO BELOW */


function sopablackout_admin() {

  if (function_exists('add_options_page')) {

    add_options_page('Stop SOPA Blackout' /* page title */, 
                     'SOPA Blackout' /* menu title */, 
                     8 /* min. user level */, 
                     basename(__FILE__) /* php file */ , 
                     'sopablackout_options' /* function for subpanel */);
  }

}


// Adding Admin CSS
function sopablackout_admin_css() {
	echo "
	<style type='text/css'>
	.form-table				{ margin-bottom: 0 !important; }
	.form-table th			{ font-size: 11px; min-width: 200px; }
	.form-table .largetext	{ font-size: 12px; }
	.form-table td			{ max-width: 500px; }
	.form-table tr:last-child	{ border-bottom: 1px solid #DEDEDE; }
	.form-table tr:last-child td { padding-bottom: 20px; }
	.form-table select		{ width: 275px; }
	.form-table input[type='text'] {width:800px;}
	</style>
	";
}

add_filter('admin_head', 'sopablackout_admin_css');
add_filter('admin_menu', 'sopablackout_admin');
add_filter('init', 'sopablackout_init');

?>