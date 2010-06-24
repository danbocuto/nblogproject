<?php
if(!defined('IN_BLOG'))
{
	exit;
}


function nb_connect($sqlconfig)
{
	$link = @mysql_connect($sqlconfig['host'], $sqlconfig['username'], $sqlconfig['password']);
	@mysql_select_db($sqlconfig['dbname'], $link);
	return $link;
}

function nb_config()
{
	$sql = mysql_query("SELECT * FROM `config`");
	$config = array();
	while($row = mysql_fetch_array($sql))
	{
		$config[$row['nome']] = $row['valor'];
	}
	return $config;
}

function nb_slug($string)
{
	$string = strtolower(trim($string));
	$string = str_replace(' ', '-', $string);
	$slug = preg_replace('/[^a-z0-9-]/', '', $string);
	
	$i = 0;
	if(nb_slug_exists($slug))
	{
		$i++;
		while(nb_slug_exists($slug . '-' . $i))
		{
			$i++;
		}
	
		$slug = ($i == 0) ? $slug : $slug . '-' . $i;
	}
	
	return $slug;
	
}

function nb_slug_exists($slug)
{
	$slug = mysql_real_escape_string($slug);
	$query = mysql_query("SELECT `codigo` FROM `postagens` WHERE `slug` = '{$slug}' LIMIT 0, 1");
	
	if(mysql_num_rows($query) == 1)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function generate_option_list($list_items = array(), $selected)
{ 
    foreach($list_items as $value => $label)
    {
    
        $html .= ($selected == $value) ? "<option value=\"{$value}\" selected=\"selected\">{$label}</option>" : "<option value=\"{$value}\">{$label}</option>";
        
    }
    return $html;
}
?>