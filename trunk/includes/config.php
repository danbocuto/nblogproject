<?php
if(!defined('IN_BLOG'))
{
	exit;
}

//(language)Digite a linguagem do site:
$lang = 'pt_BR';

//(Date format)Digite o formato da data que pode ser de acordo com setlocale() ou desetlocale():
setlocale(LC_ALL,'pt_BR','ptb');
define("_VERSAO", "1.0.0");

//()Theme)Digite o nome do tema escolhido:
$tema = 'neander';

?>