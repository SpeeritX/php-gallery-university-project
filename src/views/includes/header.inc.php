<div id="login-bar">
	<div class="container">
		<a href="add-image">Dodaj zdjęcie</a>
		<div id="register">
			<a href="login">Zaloguj się</a>
			<a href="register">Zarejestruj się</a>
		</div>
	</div>
</div>

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
				<a href="home"> Wstęp </a>
				<div class="dropdown-content">
					<a onclick="ToggleMenu()" href="index.html#generally">Ogółem</a>
					<a onclick="ToggleMenu()" href="index.html#in-poland">W Polsce</a>
				</div>
			</li>
			<li><a href="gallery"> Co Przeczytać? </a></li>
			<li><a href="contact"> Kontakt </a></li>
		</ul>
	</div>
</nav>