<?php
/************************
 *        bBlog         *
 * nblog@neander.com.br *
 *    @copyright 2010   *
 ************************/

ob_start();
session_start();

//define('VERSION', '1.0.0');

define('PATH', '../');
define('IN_BLOG', true);
define('IN_ADMIN', true);

include(PATH . 'includes/config.php');
include(PATH . 'includes/varsdb.php');
include(PATH . 'includes/functions.php');
include(PATH . 'includes/languages/'.$lang.'/admin.php');
include(PATH . 'includes/versao.php');
$link = nb_connect($sqlconfig);
unset($sqlconfig);

if(!$link)
{
	die(_COULDCONNECT);
}

$config = nb_config();
$mode = mysql_real_escape_string($_GET['mode']);

//Start session
session_start();
//Check whether the session variable
//SESS_MEMBER_ID is present or not
if(!isset($_SESSION['SESS_MEMBER_ID']) || 
	(trim($_SESSION['SESS_MEMBER_ID'])=='')) {
    if(!defined('SESS_MEMBER_ID') && $mode != 'login'){
	header('Location: admin.php?mode=login');
}

	   
       
//	header("Location: admin.php?mode=login");
//	exit();
}

$header = ($mode == 'login') ? 'simple-header.php' : 'header.php';
include($header);
include('index.php');	
include('footer.php');
ob_end_flush();
?>