<!DOCTYPE html>

<?php
	// Create connection
	$conn = new mysqli(
		$servername = "localhost",
		$username = "root",
		$password = "",
		$database =  "Hotel"
	);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	echo "Connected successfully";
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>The Grand Budapest Hotel</title>

		<script type='text/javascript'>
			function myFunction()
			{
				var x1 = document.getElementById("choose_service").value;
				var x2 = document.getElementById("from_date").value;
				var x3 = document.getElementById("to_date").value;
				var x4 = document.getElementById("from_amount").value;
				var x5 = document.getElementById("to_amount").value;

				// if (x2 < "2021-01-01" || x2 > "2021-12-31") {
				// 	document.getElementById("Output").innerHTML = "Invalid or incomplete date";
				// }

				const xhttp = new XMLHttpRequest();
				xhttp.onload = function() {
					document.getElementById("Output").innerHTML = this.responseText;
				}

				xhttp.open("GET", "getChargeInfo.php?q="+x2);
				xhttp.send();
			}
		</script>

	</head>

	<body>
		<form>
			<label for="choose_service">Service Name</label>
			<select id = "choose_service" name = "Service Type" onchange="myFunction()">
				<option value = "All" selected>All</option>
				<option value = "Drinks at the bar">Bar</option>
				<option value = "Gym">Gym</option>
				<option value = "Hairdresser">Hairdresser</option>
				<option value = "Meeting Room">Meeting Room</option>
				<option value = "Food and drinks at the restaurant">Restaurant</option>
				<option value = "Sauna">Sauna</option>
			</select>

			<label for="From Date">From Date</label>
			<input type="date" id="from_date" name="From Date" onchange="myFunction()">

			<label for="To Date">To Date</label>
			<input type="date" id="to_date" name="To Date" onchange="myFunction()">

			<label for="From Amount">From Amount</label>
			<input type="number" id="from_amount" name="From Amount" onchange="myFunction()">

			<label for="To Amount">To Amount</label>
			<input type="number" id="to_amount" name="To Amount" onchange="myFunction()">

		</form>

		<p id = "Output"></p>

	</body>
</html>
