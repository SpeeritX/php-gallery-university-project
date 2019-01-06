<?php include_once "includes/header.inc.php"; ?>

<section>
	<h2>Co warto przeczytać?</h2>

	<form id="gallery-container" method="post">
		<div class="gallery-menu">
			<a class="<?php if(is_active('gallery')): ?> selected <?php endif ?>" href="gallery"> Wszystkie </a> |
			<a class="<?php if(is_active('selected')): ?> selected <?php endif ?>" href="selected"> Zapamiętane </a>
			<div>
				<input type="submit" name="apply" 
					<?php if(is_active('gallery')): ?> 
						value="Zatwierdź zaznaczone" 
					<?php else: ?>
						value="Usuń zaznaczone z zapamiętanych"
					<?php endif ?>/>
			</div>
		</div>

		<div id="search-bar">
			<a class="link-button" href="search">Wyszukaj</a>
		</div>

		<div id="gallery">
			<?php foreach($model['images'] as $img) : ?>
				<div class="img-container">
					<a class="zoom" target="_blank" href="<?= IMG_PATH . 'mark/' . $img['name'] ?>">
						<img src="<?=IMG_PATH . 'thumbnails/' . $img['name']?>" />
					</a>
					<div class="img-description"> 
						<input class="img-checkbox" type="checkbox" name="chosen[]" value="<?= $img['_id'] ?>" 
							<?php if(is_active('gallery') && is_chosen($img['_id'])): ?> 
								checked 
							<?php endif ?> />
						<p> Tytuł: <?= $img['title'] ?> </p> 
						<p> Autor: <?= $img['author'] ?> </p> 
						<p> Dodano przez: <?= $img['added_by'] ?> </p>
						<?php if($img['private']): ?>
							<p class="private-info" > Prywatne </p>
						<?php endif ?>
					</div>
				</div>
			<?php endforeach ?>	
		</div>
		
	</form>
	<div id="pages">
		<?php if($model['prev']): ?>
			<a class="page-button" href="gallery?page=<?= $model['prev']?>"> Poprzednia strona </a>
		<?php endif ?>
		<?php if($model['next']): ?>
			<a class="page-button" href="gallery?page=<?= $model['next']?>"> Następna strona </a>
		<?php endif ?>
	</div>
</section>

<?php include_once "includes/footer.inc.php"; ?>
