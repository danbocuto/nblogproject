  <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	new nicEditor({fullPanel : true, maxHeight : 200}).panelInstance('content');
    });
</script>
<div class="page">
	<h1 class="edit"><?=ucfirst($mode)?> </h1>
	<span class="error-text"><?=$response_text?></span>
	<form action="admin.php?mode=<?=$mode?>&codigo=<?=$post['codigo']?>" method="post">
	<p>
		<label for="title"><?=_POSTTITULO?></label><br />
		<input type="text" size="80" id="title" name="data[titulo]" value="<?=htmlspecialchars(stripslashes($post['titulo']))?>" />
        <input type="hidden" size="80" id="pagina" name="data[pagina]" value="0" />
	</p>
	
	<p>
		<label for="content"><?=_CONTEUDO?></label><br />
		<textarea style="height: 190px;" cols="150" id="content" name="data[conteudo]"><?=htmlspecialchars(stripslashes($post['conteudo']))?></textarea><br />
	</br>
		<label for="status"><?=_POSTSTATUS?></label><br />
		<select id="status" name="data[publicado]">
			<?=generate_option_list(array('0' => ''._POSTNOTPUB.'', '1' => ''._POSTPUB.''), $post['publicado'])?>
		</select>
    </p>
	<p>
		<input class="button" type="submit" name="form_edit" value="<?=ucfirst($mode)?>" />
	</p>
</div>