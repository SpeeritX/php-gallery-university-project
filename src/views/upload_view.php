<?php include "includes/header.inc.php"; ?>

<section>
	<h2>Dodaj książkę</h2>
	<?php if(isset($model['statement'])): ?>
		<?php include "includes/statement.inc.php"; ?>
	<?php endif ?>

	<form action="image-upload" method="post" class="wide" data-role="image_form" enctype="multipart/form-data" />
		<input type="file" name="image" id="image" required />
		<input type="text" name="title" placeholder="Tytuł" required />
		<input type="text" name="author" placeholder="Autor" required />
		<input type="text" name="watermark" placeholder="Znak wodny" required />
		<input type="text" name="added_by" placeholder="Dodano przez" 
			<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?> value="<?= $_SESSION['user'] ?>" <?php endif ?>
		required />

		<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
			<div class="radio-button"> 
				<input class="radio" type="radio" name="privacy" value="public" checked> Publiczne<br>
			</div>
			<div class="radio-button"> 
				<input class="radio" type="radio" name="privacy" value="private"> Prywatne<br>
			</div>
		<?php endif ?>
		<input class="button" type="submit" name="upload" value="Wyślij"/>
	</form>
</section>
<?php include "includes/footer.inc.php"; ?>