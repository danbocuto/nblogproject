<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>nBlog Admin</title>
<link rel="stylesheet" href="images/styles.css" type="text/css" />
<script type="text/javascript" src="images/dialog.js"></script>
</head>
<body>
<? include(PATH . 'includes/languages/'.$lang.'/admin.php'); ?>
<div class="navigation">
	<ul>
		<li><a href="admin.php?mode=lista_postagem"><?echo _POST;?></a></li>
		<li><a href="admin.php?mode=adiciona_postagem"><?echo _NEWPOST;?></a></li>
		<li><a href="admin.php?mode=lista_paginas"><?echo _PAGINA;?></a></li>
		<li><a href="admin.php?mode=adiciona_pagina"><?echo _NEWPAGINA;?></a></li>        
		<li><a href="admin.php?mode=opcoes"><?echo _OPTIONS;?></a></li>
		<li><a href="admin.php?mode=senha"><?echo _CHANGEPASS;?></a></li>
		<li><a href="admin.php?mode=logout" onclick="return confirm_dialog('admin.php?mode=logout', '<?=_MSGLOGOUT?>');"><?=_LOGOUT?></a></li>
	</ul>
	<br class="clear" />
</div>