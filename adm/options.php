<div class="page">
	<h1 class="edit"><?=_OPTALTER?></h1>
	
	<p><?=_OPTMSG?></p>
	
	<span class="error-text"><?=$response_text?></span>
		
	<form action="admin.php?mode=options" method="post">
	
	<?=$option_list?>
	
	<p>
		<input type="submit" class="button" name="frm_opt" value="<?=_GRAVAR?>" />
	</p>
</div>
