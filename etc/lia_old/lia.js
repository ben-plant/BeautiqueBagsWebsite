document.write("<p>Hello! I'm being written by Lia's JavaScript. If you can see me, it means it's gonna work.</p>");

var xhr = new XMLHttpRequest();
xhr.open('get', 'lia/lia.php');

xhr.onreadystatechange = function() {
	if (xhr.readyState === 4) {
		if (xhr.status === 200) {
			alert(xhr.responseText);
		}
		else
		{
			alert('Error: ' + xhr.status);
		}
	}
}

xhr.send(null);
