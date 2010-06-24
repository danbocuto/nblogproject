<head>
  <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	new nicEditor({fullPanel : true, maxHeight : 200}).panelInstance('area2');
    });
</script>
</head>
<body>

<div id="content"><?=$texto?></div>
<form action="teste3.php" method="post">
Campo 1: <input type=text name=campo1><br>
Campo 2: <input type=text name=campo2><br>
<textarea style="height: 300px;width: 510px;" name="area2" cols="50" id="area2"><?=stripslashes($_POST['area2'])?></textarea>
<input type=submit value="OK">
</form>

<?php
echo "O valor de CAMPO 1 é: " . $_POST["campo1"];
echo "<br>O valor de CAMPO 2 é: " . $_POST["campo2"];
//echo "<br>O valor de CAMPO 2 é: " . $_POST['area2'];
$texto = $_POST["area2"];
echo "<br>O valor de CAMPO 2 é: " .stripslashes($texto);

?>
