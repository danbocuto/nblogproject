<div class="page">
	<form class="login" action="admin.php?mode=login" method="post">
		<h1 class="login">Login</h1>
		<span class="error-text"><?=$error_text?></span>
		<p><label for="usuario">User:</label><br />
			<input id="usuario" size="30" type="text" name="usuario" />
		</p>
		<p><label for="senha">Password:</label><br />
			<input id="senha" size="30" type="password" name="senha" />
		</p>
		<p><input class="button" type="submit" name="frm_login" value="Login" /></p>
	</form>
</div>