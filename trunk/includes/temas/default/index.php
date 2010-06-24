<?php
/************************
 *        bBlog         *
 * nblog@neander.com.br *
 *    @copyright 2010   *
 ************************/
 
define('IN_BLOG', true);
define('PATH', '');
include('includes/nblog.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$config['titulo-blog']?></title>
<link rel="stylesheet" type="text/css" href="includes/temas/<?=$tema?>/style.css" />

</head>

<div class="wrapper">
<div class="sub-wrapper">	
<div class="titulo">
<img src="imagens/nblog1.gif"/><br />
</div>
<!--<div class="cabecario"><h2><?=$versao?> <?=$config['desc-blog']?></h2></div> -->
<div class="cabecario"><h2>
<?
$sql = "SELECT * FROM `postagens` WHERE `menu` = 1 and `publicado` = 1 Order by `ordem`";
$result = mysql_query($sql);
while ($row = mysql_fetch_assoc($result)){
    if($row['link'] == null){
        echo "<a href=\"index.php?post={$row['slug']}\">{$row['titulo']}</a>&nbsp;&nbsp;&nbsp;";
    }
    else{
        echo "<a href=\"index.php?post=all_posts\">{$row['titulo']}</a>&nbsp;&nbsp;&nbsp;";        
    }

}
?>
</div>
	<div class="post">
    <?=$blog_posts?>
    </div>
    <!-- Navegador das Postagens -->
    <div class="navigation">
    		<? if(!$single) { ?>
    			<? if($blog_previous) {	?> <p class="previous-link"><?=$blog_previous?></p>	<? } ?>
    			<? if($blog_next) {	?>	<p class="next-link"><?=$blog_next?></p> <? } ?>
    		<? } ?>
    		<? if($single) { ?>
    			<p class="previous-link"><a href="<?=$config['arquivo-index']?>?post=all_posts"><?echo _RETURNPAGEPOST; ?></a></p>
    		<? } ?>
    <div class="clear"></div>
    </div>
    <!----------------------------->
<div class="footer">
<p>Powered by <a href="http://www.xxx.com.br">nBlog</a> <?=$versao?>. Copyright 2010 <a href="http://www.xxxxxx.com.br">Webmaster</a>.</p>
</div>
</div>
</div>
