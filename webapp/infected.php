<!DOCTYPE html>

<html>

	<head>
		<?php include "./navigation.php" ?>

		<script type='text/javascript'>

			function askInfected()
			{
				console.log("mphke sthn synarthsh");
				var q = document.getElementById("nfc_id").value;
				if (q == "") {
					document.getElementById("Output").innerHTML = "";
					return;
				}
				console.log(q);
				const xhttp = new XMLHttpRequest();
				xhttp.onload = function() {
					document.getElementById("Output").innerHTML = this.responseText;
				}

				xhttp.open("GET", "getInfectedInfo.php?q="+q);
				xhttp.send();
			}

		</script>

	</head>

	<body>

		<form>
			<label for="NFC_ID">Choose Infected Customer's NFC_ID</label>
			<input type="number" id="nfc_id" name="NFC_ID" onchange="askInfected()">
		</form>

		<p id="Output"></p>

	</body>

</html>
