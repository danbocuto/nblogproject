<?php
if(!defined('IN_ADMIN') || !defined('IN_BLOG'))
{
header('Location: admin.php');
	exit;
}

switch($mode)
{
	default:
	case 'lista_postagens':
     		
		$result = mysql_query('SELECT * FROM `postagens` Where `pagina` = 0 Order by `data` DESC') or die(mysql_error());
		
		while($row = mysql_fetch_assoc($result))
		{
			$published = ($row['publicado'] == 1) ? ''._POSTPUB.'' : ''._POSTNOTPUB.'';
			
			$preview_link = ($row['publicado'] == 1) ? "<a href=\"../{$config['arquivo-index']}?post={$row['slug']}\"><img src=\"images/view.png\" alt=\""._VIEWPOST."\"/></a>&nbsp;&nbsp;&nbsp;" : '';
			$post_list .= "<tr>
								<td><a href=\"admin.php?mode=edita_postagem&codigo={$row['codigo']}\">{$row['titulo']}</a></td>
								<td>" . strftime($config['formato-data'], $row['data']) . "</td>
								<td>{$published}</td>
                                <td></td>
								<td>
								{$preview_link}
								<a href=\"admin.php?mode=apaga&codigo={$row['codigo']}\" onclick=\"return confirm_dialog('admin.php?mode=delete&codigo={$row['codigo']}', '"._REMOVPOSTMSG."')\"><img src=\"images/delete.png\" alt=\""._REMOVPOST."\" /></a>
								</td>
							</tr>";
		}
			
		include('list.php');
	break;
    //--------------------------------------------------------------------------------------------------------------------------------------------
	case 'lista_paginas':
     		
		$result = mysql_query('SELECT * FROM `postagens` Where `pagina` = 1 Order by `ordem` ASC') or die(mysql_error());
		
		while($row = mysql_fetch_assoc($result))
		{
			$published = ($row['publicado'] == 1) ? ''._POSTPUB.'' : ''._POSTNOTPUB.'';
			
			$preview_link = ($row['publicado'] == 1) ? "<a href=\"../{$config['arquivo-index']}?post={$row['slug']}\"><img src=\"images/view.png\" alt=\""._VIEWPOST."\"/></a>&nbsp;&nbsp;&nbsp;" : '';
			$post_list .= "<tr>
								<td><a href=\"admin.php?mode=edita_pagina&codigo={$row['codigo']}\">{$row['titulo']}</a></td>
								<td>" . strftime($config['formato-data'], $row['data']) . "</td>
								<td>{$published}</td>
								<td>{$row['ordem']}</td>
								<td>
								{$preview_link}
								<a href=\"admin.php?mode=apaga&codigo={$row['codigo']}\" onclick=\"return confirm_dialog('admin.php?mode=delete&codigo={$row['codigo']}', '"._REMOVPOSTMSG."')\"><img src=\"images/delete.png\" alt=\""._REMOVPOST."\" /></a>
								</td>
							</tr>";
		}
			
		include('list.php');
	break;
	//--------------------------------------------------------------------------------------------------------------------------------------------
	case 'edita_postagem':
	
        $codigo = mysql_real_escape_string($_GET['codigo']);
		$post_sql = "SELECT * FROM `postagens` WHERE `codigo` = '{$codigo}'";
		$result = mysql_query($post_sql);
		$post = mysql_fetch_assoc($result);

		if(mysql_num_rows($result) == 1)
		{
			
			if(isset($_POST['form_edit']))
			{
				
				$data = $_POST['data'];
				
				if($_POST['data']['titulo'] != $post['titulo'])
				{
					$data['slug'] = nb_slug($_POST['data']['titulo']);
				}
				
				$sql = '';
				$i = 1;
				foreach($data as $field => $value)
				{
					if($value == '')
					{
						$failed = true;
						break;
					}
					
					$sql .= "`" . mysql_real_escape_string($field) . "` = '" . mysql_real_escape_string($value) . "'";
					$sql .= ($i == sizeof($data)) ? '' : ', ';
										
					$i++;
				}
				
				if($failed)
				{			
					$response_text = ''._POSTUPDATEERROR.'';
				}
				else 
				{	
					$sql = mysql_query("UPDATE `postagens` SET {$sql} WHERE `codigo` = '{$codigo}'") or die(mysql_error());
					$result = mysql_query($post_sql);
					$post = mysql_fetch_assoc($result);
					$response_text = ''._POSTUPDATED.'';
				}
			}
		
						
			include('edit.php');
		}
	break;
	//--------------------------------------------------------------------------------------------------------------------------------------------
	case 'edita_pagina':
		
		$codigo = mysql_real_escape_string($_GET['codigo']);
		$post_sql = "SELECT * FROM `postagens` WHERE `codigo` = '{$codigo}'";
		$result = mysql_query($post_sql);
		$post = mysql_fetch_assoc($result);

		if(mysql_num_rows($result) == 1)
		{
			
			if(isset($_POST['form_edit']))
			{
				
				$data = $_POST['data'];
				
				if($_POST['data']['titulo'] != $post['titulo'])
				{
					$data['slug'] = nb_slug($_POST['data']['titulo']);
				}
				
				$sql = '';
				$i = 1;
				foreach($data as $field => $value)
				{
					if($value == '')
					{
						$failed = true;
						break;
					}
					
					$sql .= "`" . mysql_real_escape_string($field) . "` = '" . mysql_real_escape_string($value) . "'";
					$sql .= ($i == sizeof($data)) ? '' : ', ';
										
					$i++;
				}
				
				if($failed)
				{			
					$response_text = ''._POSTUPDATEERROR.'';
				}
				else 
				{	
					$sql = mysql_query("UPDATE `postagens` SET {$sql} WHERE `codigo` = '{$codigo}'") or die(mysql_error());
					$result = mysql_query($post_sql);
					$post = mysql_fetch_assoc($result);
					$response_text = ''._POSTUPDATED.'';
				}
			}
		
						
			include('editp.php');
		}
	break;
	//--------------------------------------------------------------------------------------------------------------------------------------------
	case 'opcoes':
	
		if(isset($_POST['frm_opt']))
		{
			
				$data = $_POST['data'];

				foreach($data as $name => $value)
				{
					
					if($value == '')
					{
						$failed = true;
						break;
					}
					
					$name = mysql_real_escape_string($name);
					$value = mysql_real_escape_string($value);
					
					$sql = mysql_query("UPDATE `config` SET `valor` = '{$value}' WHERE `nome` = '{$name}'") or die(mysql_error());
				
				}
				
				if($failed)
				{
					$response_text = ''._POSTUPDATEERROR.'';
				}
				else
				{
					$response_text = ''._OPTUPDATED.'';
				}			
				
			
		}
		
		$sql = mysql_query("SELECT * FROM `config` WHERE `nome` <> 'senha'");
		
		while($row = mysql_fetch_array($sql))
		{
			$option_list .= "<p>
								<label for=\"{$row['nome']}\">" . str_replace('-', ' ', trim(ucfirst($row['nome']))) . "</label><br />
								<input type=\"text\" name=\"data[{$row['nome']}]\" value=\"" . stripslashes($row['valor']) . "\" id=\"{$row['nome']}\" /><br /><span class=\"form-text\">{$row['descricao']}</span>
							</p>";
		}
	
		include('options.php');
		
	break;
//--------------------------------------------------------------------------------------------------------------------------------------------	
	case 'adiciona_postagem':
		
		if(isset($_POST['form_edit']))
		{
				$data = $_POST['data'];
				
				$data['slug'] = nb_slug($_POST['data']['titulo']);
				$data['data']      = time();
				
				$sql ='';
				$i = 1;
				foreach($data as $field => $value)
				{
					if($value == '')
					{
						$failed = true;
						break;
					}
					$fields .= "`" . mysql_real_escape_string($field) . "`";
					$values .= "'" . mysql_real_escape_string($value) . "'";
					
					$values .= ($i == sizeof($data)) ? '' : ', ';
					$fields .= ($i == sizeof($data)) ? '' : ', ';
					
					$i++;
				}
				
				$post = $_POST['data'];
				
				if($failed)
				{
					$response_text = ''._POSTUPDATEERROR.'';
				}
				else
				{
					$result = mysql_query("INSERT INTO `postagens` ({$fields}) VALUES({$values})");
					$response_text = ($result) ? ''._POSTADDOK.'' : ''._POSTADDERROR.'';
				}
			
		}
		
		include('edit.php');
		
	break;
//--------------------------------------------------------------------------------------------------------------------------------------------
	case 'adiciona_pagina':
		
		if(isset($_POST['form_edit']))
		{
				$data = $_POST['data'];
				
				$data['slug'] = nb_slug($_POST['data']['titulo']);
				$data['data']      = time();
				
				$sql ='';
				$i = 1;
				foreach($data as $field => $value)
				{
					if($value == '')
					{
						$failed = true;
						break;
					}
					$fields .= "`" . mysql_real_escape_string($field) . "`";
					$values .= "'" . mysql_real_escape_string($value) . "'";
					
					$values .= ($i == sizeof($data)) ? '' : ', ';
					$fields .= ($i == sizeof($data)) ? '' : ', ';
					
					$i++;
				}
				
				$post = $_POST['data'];
				
				if($failed)
				{
					$response_text = ''._POSTUPDATEERROR.'';
				}
				else
				{
					$result = mysql_query("INSERT INTO `postagens` ({$fields}) VALUES({$values})");
					$response_text = ($result) ? ''._POSTADDOK.'' : ''._POSTADDERROR.'';
				}
			
		}
		
		include('editp.php');
		
	break;
//--------------------------------------------------------------------------------------------------------------------------------------------
	case 'apaga':
		
		$codigo = mysql_real_escape_string($_GET['codigo']);
		
		$post_sql = "SELECT * FROM `postagens` WHERE `codigo` = '{$codigo}'";
		$result = mysql_query($post_sql);
		
		if(mysql_num_rows($result) == 1)
		{
			$result = mysql_query("DELETE FROM `postagens` WHERE `codigo` = '{$codigo}'");
			if($result)
			{
				header("Location: admin.php?mode=lista");
			}
			else
			{
				die(mysql_error());
			}
		}
		else
		{
			header("Location: admin.php?mode=lista");
		}
	break;
//--------------------------------------------------------------------------------------------------------------------------------------------
	case 'login':
        if(isset($_POST['frm_login'])){
		$post_sql = "SELECT codigo FROM `usuarios` WHERE `nome` = '".$_POST['usuario']."' and `senha` = '".md5($_POST['senha'])."'";
		$result = mysql_query($post_sql);
        //$num_rows = mysql_num_rows($result);
        //echo "$num_rows Rows\n";

          echo "Username: ".$_POST['usuario']." Senha: ".$_POST['senha']." Senha Com MD5:'".md5($_POST['senha'])."'";
            if(mysql_num_rows($result) > 0) {
            	session_regenerate_id();
                //echo "Username: ".$_POST['usuario']." Senha: ".$_POST['senha']." Senha Com MD5: ".md5($_POST['senha'])."";
            	$member=mysql_fetch_assoc($result);
            	$_SESSION['SESS_MEMBER_ID']=$member['codigo'];
            	session_write_close();
                header("location: admin.php?mode=list");
            	exit();
            }
        }
        include('login.php');
        break;
//--------------------------------------------------------------------------------------------------------------------------------------------	
	case 'senha':
		
		if(isset($_POST['form_senha']))
		{
		
			if($_POST['senha_atual'] != '' && $_POST['nova_senha'] != '' && $_POST['confirma_senha'] != '')
			{
				$senha_atual = md5($_POST['senha_atual']);
				$nova_senha	  = md5($_POST['nova_senha']);
				$confirma_senha = md5($_POST['confirma_senha']);
				$codigo_usuario = $_SESSION['SESS_MEMBER_ID'];

                $confirma_usuario = mysql_result(mysql_query("SELECT `senha` FROM `usuarios` WHERE `senha` = '{$senha_atual}'"), 0);
				if($senha_atual == $confirma_usuario)
				{
					
					if($nova_senha == $confirma_senha)
					{
						$result = mysql_query("UPDATE `usuarios` SET `senha` = '{$nova_senha}' WHERE `codigo` = '{$codigo_usuario}'");
						if($result)
						{
							$response_text = 'Password updated';
						}
						else
						{
							$response_text = 'Could not update password';
						}
					}
					else
					{
						$response_text = 'Both passwords must match';
					}
	
				}
				else
				{
					$response_text = 'Current password incorrect';
				}			
			}
			else
			{
				$response_text = 'You must fill out all fields';
			}
            
		}
		include('senha.php');
	break;
//--------------------------------------------------------------------------------------------------------------------------------------------
	case 'logout':
        //Start session
        session_start();
        //Unset the variable SESS_MEMBER_ID stored in session
        unset($_SESSION['SESS_MEMBER_ID']);
		header('Location: admin.php?mode=login');
	break;
		
}
?>