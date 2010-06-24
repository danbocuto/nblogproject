<?
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>nBlog Installer</title>
<style type="text/css">
<!--
body {
	margin:0 auto;
	padding:10px;
	font-family:Geneva, Arial, Helvetica, sans-serif;
	font-size:1.0em;
}
div#wrapper {
	width:50%;
	margin:0 auto;
	padding:0;
}
span.success {
	font-weight:bold;
	color:#339900;
}
span.error {
	font-weight:bold;
	color:#ff0000;
}
span.sqlerror strong, span.tip strong {
	display:block;
	padding:5px;
	background-color:#ccc;
}
span.sqlerror, span.tip {
	border:1px solid #ccc;
	margin-top:10px;
	display:block;
	font-size:0.9em;
}
span.sqlerror span, span.tip span {	
	display:block;
	padding:5px;
}
span.sqlerror strong {
	background-color:#3399CC;
}
span.sqlerror {
	border:1px solid #3399CC;
}
em {
	background-color:#ddd;
	font-family:"Courier New", Courier, monospace;
}
h1 {
	border-bottom:1px solid #ddd;
	font-size:1.4em;
	color:#333;
}
a {
	font-size:0.9em;
	color:#ffffff;
	background-color:#333333;
	padding:3px;
	text-decoration:none;
}
//-->
</style>
</head>

<body>

<?php

	define('IN_BLOG', true);
	define('PATH', '');
	include(PATH . 'includes/varsdb.php');
	include(PATH . 'includes/config.php');
	include(PATH . 'includes/functions.php');
	include(PATH . 'includes/languages/'.$lang.'/install.php');
    switch($passo){
	default:
        echo'<div id="wrapper"><img src="imagens/install/install.jpg" alt="Instalation Image" width="100" height="100" /><h1>'._INSTALLING.' nBlog v'._VERSAO.'</h1>';
        echo _WELCOMEINSTALL;
        echo"
        <form action=\"install.php?passo=1\" method=\"post\">
        <p>
        <input type=\"submit\" class=\"button\" name=\"envia\" value="._INITINSTALL." />
        </p></form>
        ";
        break;
    case '1':
        echo'<div id="wrapper"><img src="imagens/install/install.jpg" alt="Instalation Image" width="100" height="100" /><h1>'._INSTALLING.' nBlog v'._VERSAO.'</h1>';
        echo "  
        <p>"._INSTALLPASSO1."</p><br/>
        <form action=\"install.php?passo=2\" method=\"post\">
            <p>
            <label>"._INSTALLHOST."</label><br/>
            <input type=\"text\" name=\"host\" value=\"\" id=\"\"/><br/>
            </p>
            <p>
            <label>"._INSTALLDBNAME."</label><br/>
            <input type=\"text\" name=\"dbname\" value=\"\" id=\"\"/><br/>
            </p>
            <p>
            <label>"._INSTALLUSERNAME."</label><br/>
            <input type=\"text\" name=\"username\" value=\"\" id=\"\"/><br/>
            </p>
            <label>"._INSTALLPASSWORD."</label><br/>
            <input type=\"text\" name=\"password\" value=\"\" id=\"\"/><br/>
            </p>
            <p>
            <input type=\"submit\" class=\"button\" name=\"envia\" value="._INSTALLNEXTSTEP." />
            </p>
        </form>
        ";
        break;
    case '2':
        echo'<div id="wrapper"><img src="imagens/install/install.jpg" alt="Instalation Image" width="100" height="100" /><h1>'._INSTALLING.' nBlog v'._VERSAO.'</h1>';
        if(($_POST['dbname'] == '') or ($_POST['host'] == '') or ($_POST['username'] == '') or ($_POST['password'] == '')){
            echo _INSTALLERRORFIELD;
            break;
        }
        $link = mysql_connect($_POST['host'], $_POST['username'], $_POST['password']);
        if (!$link) {
            die(_ERRORCONNECT.": <font color='#FF0000'>". mysql_error()."</font>");
        }
        
        $sql = "CREATE DATABASE ".$_POST['dbname']."";
        if (mysql_query($sql, $link)) {
            echo "<p>"._INSTALLPASSO3."</p><br/>";
            echo _OKCREATE.": ".$_POST['dbname']."\n";
        } else {
            echo _ERRORCREATE.": <font color='#FF0000'>". mysql_error() . "</font>\n";
        }
        echo"
        <form action=\"install.php?passo=3\" method=\"post\">
        <p>
        <input type=\"hidden\" name=\"dbname\" value=\"".$_POST['dbname']."\" id=\"\"/><br/>
        <input type=\"hidden\" name=\"host\" value=\"".$_POST['host']."\" id=\"\"/><br/>
        <input type=\"hidden\" name=\"username\" value=\"".$_POST['username']."\" id=\"\"/><br/>
        <input type=\"hidden\" name=\"password\" value=\"".$_POST['password']."\" id=\"\"/><br/>
        <input type=\"submit\" class=\"button\" name=\"envia\" value="._INSTALLNEXTSTEP." />
        </p></form>
        ";
        break;
    case '3':
        echo'<div id="wrapper"><img src="imagens/install/install.jpg" alt="Instalation Image" width="100" height="100" /><h1>'._INSTALLING.' nBlog v'._VERSAO.'</h1>';    
        include(PATH . 'includes/install/install_functions.php');
        echo _INSTALLPASSO4;
        populate_db($_POST['dbname'],'nblog.sql',$_POST['host'],$_POST['username'],$_POST['password']);
        echo"
        <form action=\"install.php?passo=4\" method=\"post\">
        <p>
        <input type=\"hidden\" name=\"dbname\" value=\"".$_POST['dbname']."\" id=\"\"/><br/>
        <input type=\"hidden\" name=\"host\" value=\"".$_POST['host']."\" id=\"\"/><br/>
        <input type=\"hidden\" name=\"username\" value=\"".$_POST['username']."\" id=\"\"/><br/>
        <input type=\"hidden\" name=\"password\" value=\"".$_POST['password']."\" id=\"\"/><br/>
        <input type=\"submit\" class=\"button\" name=\"envia\" value="._INSTALLNEXTSTEP." />
        </p></form>
        ";
        break;  
    case '4':
        if (file_exists( 'includes/varsdb.php' )) {
                $canWrite = is_writable( 'includes/varsdb.php' );
        } else {
                $canWrite = is_writable( '..' );
        }
    
        $config = "<?\n";
        $config .= "if(!defined('IN_BLOG'))\n";
        $config .= "{\n";
        $config .= "	exit;\n";
        $config .= "}\n";
        $config .= "\$sqlconfig = array();\n";
        $config .= "\$sqlconfig['username'] = '{$_POST['username']}';\n";
        $config .= "\$sqlconfig['password'] = '{$_POST['password']}';\n";
        $config .= "\$sqlconfig['host']     = '{$_POST['host']}';\n";
        $config .= "\$sqlconfig['dbname']   = '{$_POST['dbname']}';\n";
        $config .= "?>";
        if ($canWrite && ($fp = fopen("includes/varsdb.php", "w"))) {
            fputs( $fp, $config, strlen( $config ) );
            fclose( $fp );
            echo'<div id="wrapper"><img src="imagens/install/install.jpg" alt="Instalation Image" width="100" height="100" /><h1>nBlog v'._VERSAO.' - '._INSTALLFINOK.'</h1>';
            echo _INSTALLFINADM."
            <form action=\"adm/admin.php?mode=login\" method=\"post\">
            <p>
            <input type=\"submit\" class=\"button\" name=\"envia\" value="._INSTALLADMINBT." />
            </p></form>
            ";
                            
        } else {
            $canWrite = false;
            echo'<div id="wrapper"><img src="imagens/install/install.jpg" alt="Instalation Image" width="100" height="100" /><h1>'._INSTALLFINERRO.' nBlog v'._VERSAO.'</h1>';
        }

        break;        
}
?>
</div>
</body>
</html>
<?
ob_end_flush();
?>
		