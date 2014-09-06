<?php
/*
Plugin Name: Mybb Last Topics    
Plugin URI: http://wordpress.org/extend/plugins/mybb-last-topics/
Description: Show the last posts of mybb forum  
Version: 1.0
Author: Mahdi Khaksar
Author URI: http://www.progpars.com
License: iwordpress.ir
*/
define( 'MYPLUGINNAME_PATH', plugin_dir_path(__FILE__) );
require_once('mybbwidget.php');
load_plugin_textdomain('mybb','wp-content/plugins/mybb-last-topics/langs');
//require mybb_config.php
if(file_exists(MYPLUGINNAME_PATH .'/mybb_config.php')){
	require(MYPLUGINNAME_PATH .'/mybb_config.php');
}
//plugin
function lasttopics()
{
	//global variable
	global $mysql_connect,$wpdb,$mybb_mysqlquery,$row,$plugin_name,$mybburl,$dbhost,$dbname,$dbuser,$dbpass,$dbprifix,$limit,$tid;
	
	//database connect and query
	$mysql_connect = mysql_connect($dbhost,$dbuser,$dbpass) or die("" . __('Error communicating with the database', 'mybb') . "");
	mysql_select_db($dbname) or die("" . __('Error communicating with the database', 'mybb') . "");
	mysql_query("SET NAMES utf8");

//html 
$currentlang = get_bloginfo('language');
if($currentlang=="fa-IR")
{
	echo '<!doctype html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>'. __('Recent Forum Posts', 'mybb') .'</title>	
	<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/'. basename(dirname(__FILE__)) .'/mybblasttopics_css_rtl.css" />
	</head>
	<body>
	<div class="ForumLastTopic">
		  <div class="Head">
		   <span class="col1">'. __('Title Latest Posts Forum', 'mybb') .'</span>
			<span class="col2">'. __('Reply', 'mybb') .'</span>
			 <span class="col3">'. __('Visit', 'mybb') .'</span>
			  <span class="col4">'. __('Last Post', 'mybb') .'</span>
			<div class="Clear"></div>
		  </div>
		  <div id="MTForumBlock">
		   <table cellspacing="1" cellpadding="0" class="Forumsbox">
						<tbody>';
$mybb_mysqlquery = mysql_query("SELECT tid,subject,lastposter,replies,views FROM ".$dbprifix."threads ORDER BY lastpost DESC LIMIT $limit");
	
	while($row = mysql_fetch_array($mybb_mysqlquery)) {
	$tid = $row['tid'];
	echo "
			<tr>
				<td class=\"col1\"><img class=\"titleicon\" src='" . get_bloginfo('wpurl') . '/wp-content/plugins/'. basename(dirname(__FILE__)) ."/images/topic.png' /><a class=\"titlelinks\" href=\"".$mybburl."/showthread.php?tid=".$row['tid']."\" target=\"_blank\" >".$row['subject']."</a></td>
				<td class=\"col2\">".$row['replies']."</td>
				<td class=\"col3\">".$row['views']."</td>
				<td class=\"col4\">".$row['lastposter']."</td>
			</tr>";
	}

	echo "
		</tbody>
		  </table>
		</div>
	</div>
	</body>
	</html>";
}
else
{
	echo '<!doctype html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>'.__('Recent Forum Posts', 'mybb').'</title>	
	<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/'. basename(dirname(__FILE__)) .'/mybblasttopics_css_ltr.css" />
	</head>
	<body>
	<div class="ForumLastTopic">
		  <div class="Head">			 
		   <span class="col4">'. __('Last Post', 'mybb') .'</span>
		     <span class="col3">'. __('Visit', 'mybb') .'</span>
			<span class="col2">'. __('Reply', 'mybb') .'</span>
		    <span class="col1">'. __('Title Latest Posts Forum', 'mybb') .'</span>
			<div class="Clear"></div>
		  </div>
		  <div id="MTForumBlock">
		   <table cellspacing="1" cellpadding="0" class="Forumsbox">
						<tbody>';
	$mybb_mysqlquery = mysql_query("SELECT tid,subject,lastposter,replies,views FROM ".$dbprifix."threads ORDER BY lastpost DESC LIMIT $limit");
	
	while($row = mysql_fetch_array($mybb_mysqlquery)) {
	$tid = $row['tid'];
	echo "
			<tr>
				<td class=\"col1\"><img class=\"titleicon\" src='" . get_bloginfo('wpurl') . '/wp-content/plugins/'. basename(dirname(__FILE__)) ."/images/topic.png' /><a class=\"titlelinks\" href=\"".$mybburl."/showthread.php?tid=".$row['tid']."\" target=\"_blank\" >".$row['subject']."</a></td>
				<td class=\"col2\">".$row['replies']."</td>
				<td class=\"col3\">".$row['views']."</td>
				<td class=\"col4\">".$row['lastposter']."</td>
			</tr>";
	}


	echo "
		</tbody>
		  </table>
		</div>
	</div>
	</body>
	</html>";
}
	}
add_shortcode('lasttopics','lasttopics');

//plugin admin options
function admin_options_lasttopics()
{
	$plugin_name = MYPLUGINNAME_PATH .'/panel_mybblasttopics.php';
	if(is_admin())
	{
		add_menu_page(''. __(' Latest Posts Forum mybb', 'mybb') .'', ''. __('MYBB', 'mybb') .'', 'administrator',$plugin_name,'',plugins_url('images/icon.png',__FILE__),26);
	}
	
}
add_action('admin_menu', 'admin_options_lasttopics');


function mybb_forum_last_wg(){
		//global variable
	global $mysql_connect,$wpdb,$mybb_mysqlquery,$row,$plugin_name,$mybburl,$dbhost,$dbname,$dbuser,$dbpass,$dbprifix,$limit,$tid;
	
	//database connect and query
	$mysql_connect = mysql_connect($dbhost,$dbuser,$dbpass) or die("" . __('Error communicating with the database', 'mybb') . "");
	mysql_select_db($dbname) or die("" . __('Error communicating with the database', 'mybb') . "");
	mysql_query("SET NAMES utf8");

		echo '<!doctype html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/'. basename(dirname(__FILE__)) .'/mybblasttopics_css_ltr.css" />
	</head>
	<body>
	<div class="ForumLastTopic">
		  <div id="MTForumBlock">
		   <table>
						<tbody>';
	$mybb_mysqlquery = mysql_query("SELECT tid,subject,views FROM ".$dbprifix."threads ORDER BY lastpost DESC LIMIT $limit");
	
	while($row = mysql_fetch_array($mybb_mysqlquery)) {
	$tid = $row['tid'];
	echo "
			<tr>
				<td class=\"col1\"><img class=\"titleicon\" src='" . get_bloginfo('wpurl') . '/wp-content/plugins/'. basename(dirname(__FILE__)) ."/images/topic.png' /><a class=\"titlelinks\" href=\"".$mybburl."/showthread.php?tid=".$row['tid']."\" target=\"_blank\" >".$row['subject']."</a></td>
				<td class=\"col3\">".$row['views']."</td>
			</tr>";
	}


	echo "
		</tbody>
		  </table>
		</div>
	</div>
	</body>
	</html>";
}
?>