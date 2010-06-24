<html>
<head>
<script language="javascript" type="text/javascript" src="includes/js/sonner.js"></script>
</head>
<body>
<?
include "versao.php";
?>
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#D4D4D4">
  <tr>
    <td><form action="versaogera.php" method="post" name="form1">
        <p align="center">&nbsp;</p>
        <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif">Atualizador
          do Arquivo &quot;versao.php&quot;.</font></p>
  <table width="41%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="29%"><font face="Verdana, Arial, Helvetica, sans-serif">Release:</font></td>
      <td width="71%"><font face="Verdana, Arial, Helvetica, sans-serif">
        <input type="text" name="release" value="<? echo _RELEASE; ?>">
        </font></td>
    </tr>
      <tr>
      <td><font face="Verdana, Arial, Helvetica, sans-serif">CodName:</font></td>
      <td><font face="Verdana, Arial, Helvetica, sans-serif">
        <input type="text" name="codename"  value="<? echo _CODENAME; ?>">
        </font></td>
    </tr>
    <tr>
      <td><font face="Verdana, Arial, Helvetica, sans-serif">Data:</font></td>
      <td><font face="Verdana, Arial, Helvetica, sans-serif">
        <input name="data" type="text" value="<? echo date('d-m-y');?>" onKeyPress="return txtBoxFormat(this,true,'99-99-99', event)">
        </font></td>
    </tr>
    <tr>
      <td><font face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
      <td><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif">
                <input type="submit" name="Submit" value="Atualizar Arquivo">
                </font></div></td>
    </tr>
     <tr>
      <td><font face="Verdana, Arial, Helvetica, sans-serif">Versão Gerada:</font></td>
      <td></td>
    </tr>
  </table><font face="Verdana, Arial, Helvetica, sans-serif"> <center> <? echo $versao;?></font>
  <p>&nbsp; </p>
  <p>&nbsp; </p>
</form></td>
  </tr>
</table>
</body>
</html>

<?
if(isset($release)){
if (file_exists( 'versao.php' )) {
        $canWrite = is_writable( 'versao.php' );
} else {
        $canWrite = is_writable( 'versao.php' );
}

list ($dia,$mes,$ano) = split ('[-]',$data);
$devlevel = "$ano.$mes.$dia";
$realtime = date('H:m');
$config = "<?\n";
$config .= "DEFINE( '_RELEASE', '{$release}' );\n";
$config .= "DEFINE( '_DEV_LEVEL', '{$devlevel}' );\n";
$config .= "DEFINE( '_CODENAME', '{$codename}' );\n";
$config .= "\$versao = 'v'._DEV_LEVEL.'['._CODENAME.'] '._RELEASE.'';\n";
$config .= "?>";
        if ($canWrite && ($fp = fopen("versao.php", "w"))) {
                fputs( $fp, $config, strlen( $config ) );
                fclose( $fp );
        } else {
                $canWrite = false;
        }
}
?>