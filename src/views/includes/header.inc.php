<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<meta name="author" content="Jędrzej Głowaczewski" />
	<title>Książki - fantastyka</title>
	<link rel="stylesheet" href="static/css/style.css" />
	<link rel="stylesheet" href="static/css/contact.css" />
	<link rel="stylesheet" href="static/css/form.css" />
		<link rel="stylesheet" href="static/css/menu.css" />
	<link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:300,300i&amp;subset=latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Cairo&amp;subset=latin-ext" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="static/js/menu-script.js"></script>
	<script src="static/js/search.js"></script>
	</head>
<body>
    <header>
	<div class="container">
		<h1>O Książkach</h1>
		<h2>fantastycznych</h2>
	</div>
</header>

<nav>
	<div class="container on-hover">
        <div id="menu-button">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 80 40">
                <g>
                    <animateTransform id="button-anim"
                                        attributeType="xml"
                                        attributeName="transform"
                                        type="rotate"
                                        from="180 40 20"
                                        to="0 40 20"
                                        dur="0.3s"
                                        begin="click" />

                    <path style="fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="M 24,12 H 56"
                            id="path-top"
                            inkscape:connector-curvature="0" />
                    <path inkscape:connector-curvature="0"
                            id="path-mid"
                            d="M 24,20 H 56"
                            style="fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
                    <path inkscape:connector-curvature="0"
                            id="path-bot"
                            d="M 24,28 H 56"
                            style="fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
                </g>
            </svg>
        </div>
		<ul id="main-menu" class="main-menu">
			<li class="dropdown">
				<a class="<?php if(is_active('home')): ?> selected <?php endif ?>" href="home"> Wstęp </a>
				<div class="dropdown-content">
					<a onclick="ToggleMenu()" href="home#generally">Ogółem</a>
					<a onclick="ToggleMenu()" href="home#in-poland">W Polsce</a>
				</div>
			</li>
			<li><a class="<?php if(is_active('gallery') || is_active('selected')): ?> selected <?php endif ?>" href="gallery"> Co Przeczytać? </a></li>
			<li><a class="<?php if(is_active('contact')): ?> selected <?php endif ?>" href="contact"> Kontakt </a></li>
		</ul>
	</div>
</nav>

	<main>
	
		<div class="container">
		<?php include_once "login_bar.inc.php"; ?>