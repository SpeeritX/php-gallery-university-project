<?php 
const IMG_PATH = 'images/';
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once "includes/head.inc.php"; ?>
	<script src="scripts/previous-site-script.js"></script>
</head>
<body>
    <?php include_once "includes/header.inc.php"; ?>
	<main>
		<div class="container">
			<section>
				<h2>Co warto przeczytać?</h2>

				<?php $images = glob(IMG_PATH . '*.{jpg,png,gif}', GLOB_BRACE);?>
				<div class="gallery">
					<?php for($i = $model['first']; $i < $model['last']; ++$i) : ?>
						<div class="img-container zoom">
							<a target="_blank" href="<?= $images[$i] ?>">
								<img src="<?= $images[$i]?>" />
								<h3><?= substr($images[$i], strlen(IMG_PATH), strlen($images[$i]) - 4 - strlen(IMG_PATH)) ?></h3>
							</a>
						</div>
					<?php endfor ?>

				</div>
				<a class="button" href="gallery?page=<?= $model['prev']?>"> Poprzednia strona </a>
				<a class="button" href="gallery?page=<?= $model['next']?>"> Następna strona </a>
			</section>
		</div>
	</main>
    <?php include_once "includes/footer.inc.php"; ?>
</body>
</html>
