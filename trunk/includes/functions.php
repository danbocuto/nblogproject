<?php
if(!defined('IN_BLOG'))
{
	exit;
}


/*Fun��o que limita o texto*/
function limitatexto($texto, $final, $limite){
    $result = $texto;
    $len_texto = strlen($texto);
    $len_final = strlen($final);

    if ($len_texto + $len_final > $limite){
            for ($i=$limite-$len_final;$i!==-1;$i--){
                    if (substr($texto, $i, 1) == " " and substr($texto, $i-1, 1) !== " "){
                            return substr($texto, 0, $i).$final;
                            break;
                    }
            }
    }
    else{
        return $texto;
    }
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