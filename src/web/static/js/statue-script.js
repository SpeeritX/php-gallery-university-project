
function ToggleMenu() {
	document.getElementById("main-menu").classList.toggle("show");
}


document.addEventListener("DOMContentLoaded", function () {
	if (localStorage.getItem("statue-accepted"))
		return;
	

	var warningContainer = document.createElement("DIV");
	warningContainer.setAttribute("id", "warning-container")

	var warningDiv = document.createElement("DIV");
	warningDiv.setAttribute("class", "data-warning")
	warningDiv.innerHTML = document.getElementById("data-popup").innerHTML;

	var acceptBtn = document.createElement("BUTTON");
	acceptBtn.setAttribute("onclick", "closeWarning()");
	var acceptText = document.createTextNode("Rozumiem");
	acceptBtn.appendChild(acceptText);
	warningDiv.appendChild(acceptBtn);

	var goBackBtn = document.createElement("BUTTON");
	goBackBtn.setAttribute("onclick", "goBack()");
	var goBackText = document.createTextNode("Zabierz mnie stąd!");
	goBackBtn.appendChild(goBackText);
	warningDiv.appendChild(goBackBtn);

	warningContainer.appendChild(warningDiv);

	document.body.appendChild(warningContainer);
});

function closeWarning() {
	document.getElementById("warning-container").remove();
	localStorage.setItem("statue-accepted", true);
}

function goBack() {
	if (sessionStorage.getItem("previous-site") == null)
		window.location.href = "index.html";
	else 
		window.location.href = sessionStorage.getItem("previous-site");
}
