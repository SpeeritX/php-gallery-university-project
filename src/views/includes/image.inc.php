<div class="img-container zoom">
	<a target="_blank" href="<?= $img?>">
		<img src="<?= $img?>" />
		<h3><?= substr($img, strlen(IMG_PATH), strlen($img) - 4 - strlen(IMG_PATH)) ?></h3>
	</a>
</div>