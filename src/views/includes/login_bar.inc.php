<div id="login-bar">
	<!-- <div class="container"> -->
	<div class="login-container">
		<div id="user-name">
			<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) : ?>
				<?= $_SESSION['user'] ?>
			<?php else : ?>
				<?= 'Niezalogowany' ?>
			<?php endif ?>
		</div>

		<a class="link-button" href="add-image">Dodaj Książkę</a>
	</div>
		<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) : ?>
			<?php include_once "log_out.inc.php"; ?>
		<?php else : ?>
			<?php include_once "log_in.inc.php"; ?>
		<?php endif ?>
	<!-- </div> -->
</div>