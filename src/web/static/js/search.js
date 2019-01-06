function search(string)
{
	if (string.length == 0)
	{
		document.getElementById("gallery").innerHTML = "";
		return;
	}
	else
	{
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function ()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				document.getElementById("gallery").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET", "search?q=" + string, true);
		xmlhttp.send();
	}
}