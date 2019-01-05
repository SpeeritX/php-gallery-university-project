<?php include_once "includes/header.inc.php"; ?>

<section>
	<h2>Co warto przeczytać?</h2>
	<div class="gallery">
		<?php $img = $model['images'];?>
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
					</div>
				</div>
			<?php endif ?>
		<?php endfor ?>

	</div>
	<div id="pages">
		<a class="page-button" href="gallery?page=<?= $model['prev']?>"> Poprzednia strona </a>
		<a class="page-button" href="gallery?page=<?= $model['next']?>"> Następna strona </a>
	</div>
</section>

<?php include_once "includes/footer.inc.php"; ?>
