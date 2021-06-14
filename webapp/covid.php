<!DOCTYPE html>

<html>

	<head>
		<?php include "./navigation.php" ?>

		<script type='text/javascript'>

			function askCustomerVisits()
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

				xhttp.open("GET", "getCustomerVisits.php?q="+q);
				xhttp.send();
			}

		</script>

	</head>

    <body>

		<form>
			<label for="NFC_ID">Choose Customer NFC_ID</label>
			<input type="number" id="nfc_id" name="NFC_ID" onchange="askCustomerVisits()">
		</form>

		<p id="Output"></p>

	</body>

</html>
