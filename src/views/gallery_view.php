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

				<?php $images = $model['images'];?>
				<div class="gallery">
					<?php for($i = $model['first']; $i < $model['last']; ++$i) : ?>
						<div class="img-container zoom">
							<a target="_blank" href="<?= IMG_PATH . 'mark/' . $images[$i]['name'] ?>">
								<img src="<?=IMG_PATH . 'thumbnails/' . $images[$i]['name']?>" />
								<h3><?= $images[$i]['title'] . ' - ' . $images[$i]['author'] ?></h3>
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
