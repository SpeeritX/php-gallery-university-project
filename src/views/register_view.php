<?php include "includes/header.inc.php"; ?>

<section>
	<h2>Zarejestruj się</h2>

	<?php if(isset($model['statement'])): ?>
		<?php include "includes/statement.inc.php"; ?>
	<?php endif ?>

	<form method="post">
		<input type="email" name="email" placeholder="E-mail" required />
		<input type="text" name="login" placeholder="Login" required />
		<input type="password" name="password" placeholder="Hasło" required />
		<input type="password" name="password_again" placeholder="Powtórz hasło" required />
		<input class="button" type="submit" name="register" value="Zarejestruj się"/>
	</form>
</section>

<?php include "includes/footer.inc.php"; ?>

