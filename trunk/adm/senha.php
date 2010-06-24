<div class="page">
	<h1 class="edit"><?=_PASSUPDATE?></h1>
	<p><?=_PASSMSG?></p>
	
	<span class="error-text"><?=$response_text?></span>
	<form action="admin.php?mode=senha" method="post">
	
	<p>
		<label for="senha_atual"><?=_PASSATUAL?>:</label><br />
		<input type="password" name="senha_atual" id="senha_atual" />
	</p>

	<p>
		<label for="nova_senha"><?=_PASSNEW?>:</label><br />
		<input type="password" name="nova_senha" id="nova_senha" />
	</p>
	
	<p>
		<label for="confirma_senha"><?=_PASSNEWCONF?>:</label><br />
		<input type="password" name="confirma_senha" id="confirma_senha" />
	</p>
	
	<p>
		<input class="button" type="submit" name="form_senha" value="<?=_GRAVAR?>" />
	</p>
	
	
	
</div>
