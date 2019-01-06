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

