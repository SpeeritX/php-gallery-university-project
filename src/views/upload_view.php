<!DOCTYPE html>
<html>
<head>
    <?php include "includes/head.inc.php"; ?>
	<link rel="stylesheet" href="static/css/form.css" />
	<script src="scripts/previous-site-script.js"></script>
</head>
<body>
    <?php include "includes/header.inc.php"; ?>
	<main>
		<div class="container">
			<section>
			<h2>Dodaj zdjęcie</h2>
				<?php if(isset($model['statement'])): ?>
					<?php include "includes/statement.inc.php"; ?>
				<?php endif ?>

				<form action="image-upload" method="post" class="wide" data-role="image_form" enctype="multipart/form-data" />
					<input type="file" name="image" id="image" required />
					<input type="text" name="title" placeholder="Tytuł" required />
					<input type="text" name="author" placeholder="Autor" required />
					<input type="text" name="watermark" placeholder="Znak wodny" required />
					<input class="button" type="submit" name="upload" value="Wyślij"/>
				</form>
			</section>
		</div>
	</main>
    <?php include "includes/footer.inc.php"; ?>
</body>
</html>
