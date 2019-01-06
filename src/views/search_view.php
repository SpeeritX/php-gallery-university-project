<?php include_once "includes/header.inc.php"; ?>

<section>
	<h2>Co warto przeczytać?</h2>

	<div id="gallery-container">
		<div class="gallery-menu">
			<a href="gallery"> Wszystkie </a> |
			<a href="selected"> Zapamiętane </a>
		</div>

		<div id="search-bar">
			<input type="text" onkeyup="search(this.value)" placeholder="Szukaj"/>
		</div>

		<div id="gallery">
		
		</div>
	</div>
</section>

<?php include_once "includes/footer.inc.php"; ?>
