<html>
<head>
<script type="text/javascript">
	function sendrequest(method, url){
		let xhr = new XMLHttpRequest();
		xhr.open(method, url);
		if (method == 'POST')
			xhr.send("test=test");
		else 
			xhr.send();
		xhr.onerror = function() {
		  console.log("Request failed");
		};
	}

	window.onload = function(){
		let url = "https://samesite123.herokuapp.com/same.php";

		document.getElementById("getbtn").addEventListener("click", function(event){
			sendrequest("GET", url);
		})
		document.getElementById("postbtn").addEventListener("click", function(event){
			sendrequest("POST", url);
		})
	}
</script>
</head>
<body>
	<a href="https://samesite123.herokuapp.com/same.php" target="_blank">Open in new Tab</a><br>
	<form method="POST" action="https://samesite123.herokuapp.com/same.php" target="_blank">
		<input type="Submit" value="Post in new Tab" >
	</form>
	<button id="getbtn">GET with XMLHttpRequest</button><br>
	<button id="postbtn">POST with XMLHttpRequest</button>
</body>
