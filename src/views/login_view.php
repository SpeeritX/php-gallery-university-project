<?php include "includes/header.inc.php"; ?>

<section>
	<h2>Zaloguj się</h2>

	<?php if(isset($model['statement'])): ?>
		<?php include "includes/statement.inc.php"; ?>
	<?php endif ?>

	<?php if(!(isset($_SESSION['logged_in']) && $_SESSION['logged_in'])): ?>
		<form method="post">
			<input type="text" name="login" placeholder="Login" required />
			<input type="password" name="password" placeholder="Hasło" required />
			<input class="button" type="submit" name="register" value="Zaloguj się"/>
		</form>
	<?php endif ?>
</section>

<?php include "includes/footer.inc.php"; ?>
