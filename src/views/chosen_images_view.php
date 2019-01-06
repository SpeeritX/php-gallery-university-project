<?php include_once "includes/header.inc.php"; ?>

<section>
	<h2>Co warto przeczytać?</h2>

	<div id="pages">
		<a class="page-button" href="gallery"> Wszystkie </a>
		<a class="page-button" href="selected"> Zapamiętane </a>
	</div>

	<form method="post" class="gallery"/>

		<?php $img = $_SESSION['chosen_images'];?>
		<?php for($i = $model['first']; $i < $model['last']; ++$i) : ?>
			<?php if($img[$i]['private'] == false ||
					(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && $_SESSION['user'] == $img[$i]['user'])): ?>
				<div class="img-container">
					<a class="zoom" target="_blank" href="<?= IMG_PATH . 'mark/' . $img[$i]['name'] ?>">
						<img src="<?=IMG_PATH . 'thumbnails/' . $img[$i]['name']?>" />
					</a>
					<div class="img-description"> 
						<p> Tytuł: <?= $img[$i]['title'] ?> </p> 
						<p> Autor: <?= $img[$i]['author'] ?> </p> 
						<p> Dodano przez: <?= $img[$i]['added_by'] ?> </p>
						<input type="checkbox" name="chosen[]" value="<?= $img[$i]['_id'] ?>"/>
					</div>
				</div>
			<?php endif ?>
		<?php endfor ?>
		<input class="button" type="submit" name="apply" value="Zapamiętaj zaznaczone"/>
	</form>
	<div id="pages">
		<a class="page-button" href="gallery?page=<?= $model['prev']?>"> Poprzednia strona </a>
		<a class="page-button" href="gallery?page=<?= $model['next']?>"> Następna strona </a>
	</div>
</section>

<?php include_once "includes/footer.inc.php"; ?>
