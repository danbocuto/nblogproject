<?php
/************************
 *        bBlog         *
 * nblog@neander.com.br *
 *    @copyright 2010   *
 ************************/
 
if(!defined('IN_BLOG'))
{
	exit;
}

if (filesize( PATH.'includes/varsdb.php') < 10) {
        header( "Location: install.php" );
        exit();
}
else {
    include(PATH.'includes/config.php');
    include(PATH.'includes/varsdb.php');
    include(PATH.'includes/functions.php');
    include(PATH.'includes/versao.php');
    include(PATH.'includes/languages/'.$lang.'/main.php');
    include(PATH.'includes/languages/'.$lang.'/install.php');
    $link = nb_connect($sqlconfig);
    unset($sqlconfig);
    define("_VERSAO",$versao);
    if(!$link){
    die(''._COULDCONNECT.'');
    }


$config = nb_config();
$post	= (string) mysql_real_escape_string($_GET['post']);
$page	= (int) mysql_real_escape_string(intval($_GET['page']));
$ppp	= (int) intval($config['posts-por-pg']);
$from	= (int) intval($ppp * $page);

//Verifica se é pagina ou post:
if ($post == '') {
    $rowpagina['pagina'] = 1;
    }
    else {  
$sqlpagina = "SELECT pagina FROM `postagens` WHERE `slug` = '{$post}' AND `publicado` = 1";
$resultpagina = mysql_query($sqlpagina);
$rowpagina = mysql_fetch_assoc($resultpagina);
}
if ($rowpagina['pagina'] == 1) {
    if (($post == 'pagina_inicial') or ($post == '')){
        $sql = "SELECT * FROM `postagens` WHERE `pagina` = 1 and `menu` = 1 and `paginaini` = 1 and `publicado` = 1";    
    }
    else {
        $sql = "SELECT * FROM `postagens` WHERE `pagina` = 1 and `slug` = '{$post}' AND `publicado` = 1";        
    }
    $navegacao = 0;
    $single = false;
}
else {
    $sql = ($post == '') ? "SELECT * FROM `postagens` WHERE `pagina` = 0 and `publicado` = 1 ORDER BY `data` DESC LIMIT ". $from ." ,  ". $ppp : "SELECT * FROM `postagens` WHERE `pagina` = 0 and `slug` = '{$post}' AND `publicado` = 1";
    $navegacao = 1;
}
//Verifica se a pagina é a do lista posts:
if ($post == 'all_posts'){
//    echo "<font color=\"#ffffff\">---------Variaveis---------:2<br>-Variavel(from): ".$from."<br>-Variavel(ppp): ".$ppp."<br>-Variavel(total):".$total."</font>";
    $sql = ($post == 'all_posts') ? 'SELECT * FROM `postagens` WHERE `pagina` = 0 and `publicado` = 1 ORDER BY `data` DESC LIMIT ' . $from . ', ' . $ppp : "SELECT * FROM `postagens` WHERE `pagina` = 0 and `publicado` = 1";
    $navegacao = 1;
}


$result = mysql_query($sql);
$total  = mysql_result(mysql_query("SELECT COUNT(*) FROM `postagens` WHERE `pagina` = 0 and `publicado` = 1"), 0);

if(mysql_num_rows($result) > 0)
{ 
	while($posts = mysql_fetch_array($result))
	{
		$vars = array(
			'$postid$'		=> $posts['codigo'],
			'$posturl$'		=> $posts['slug'],
			'$posttitle$'	=> stripslashes($posts['titulo']),
			'$postdate$'	=> strftime($config['formato-data'], $posts['data']),
			'$postcontent$'	=> stripslashes($posts['conteudo']),
			'$postmenu$'	=> $posts['menu'],            
		);
		
		$template_vars		= array_keys($vars);
		$template_values	= array_values($vars);
		if (($rowpagina['pagina'] == 1) or ($post == '')){
        $output = file_get_contents(PATH . 'includes/temas/'.$tema.'/template_page.html');
        }
        else {    
		$output = file_get_contents(PATH . 'includes/temas/'.$tema.'/template_post.html');
        }
		$output = str_replace($template_vars, $template_values, $output);
		
		$blog_posts .= $output;
	}
}
if (($rowpagina['pagina'] == 1) or ($post =='')){
    $single = false;
    }
    else {
        $single = ($post == 'all_posts') ? false : true;
        //$single = true;        
    }
if ($navegacao == 1){
    if($total > ($from + $ppp))
    {
    	$blog_previous = '<a href="' . $config['arquivo-index'] . '?post=all_posts&page=' . ($page + 1)  . '">'._OLDPAGEPOST.'</a>';
    }
    if($from > 0)
    {
    	$blog_next = '<a href="' . $config['arquivo-index'] . '?post=all_posts&page=' . ($page - 1)  . '">'._RECENTPAGEPOST.'</a>';
    }
}

}
?>