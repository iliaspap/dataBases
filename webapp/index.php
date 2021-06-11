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
?>

<html>
	<head>
		<meta charset="utf-8">
		<title>The Grand Budapest Hotel</title>

		<!-- <button onclick="gotoCustomers()">Customers</button> -->
		<a href="./index2.php">Service Usage</a>

		<script type='text/javascript'>

			function askServiceUsage()
			{
				var q1;

				/*default values for input*/
				var q2 = "2000-01-01";//every date in the database is after this
				var q3 = "2021-12-31";//everty date in the database is before this one
				var q4 = 0; //every cost in the database is greater than this one
				var q5 = 1000; //every cost in the database is less than this one

				q1 = document.getElementById("choose_service").value;

				if (document.getElementById("from_date").value != "") {
					q2 = document.getElementById("from_date").value;
					if(q2 < "1000-01-01" || q2>"10000-01-01") {
						document.getElementById("Output").innerHTML = "Invalid date, try a year after 1000 and before 10000";
						return
					}

				}
				if (document.getElementById("to_date").value != "") {
					q3 = document.getElementById("to_date").value;
					if(q3 < "1000-01-01" || q2> "10000-01-01") {
						document.getElementById("Output").innerHTML = "Invalid date, try something after 1000 and before 10000";
						return
					}
				}

				if(document.getElementById("from_amount").value != "") {
					q4 = document.getElementById("from_amount").value;
				}

				if(document.getElementById("to_amount").value != "") {
					q5 = document.getElementById("to_amount").value;
				}

				const xhttp = new XMLHttpRequest();
				xhttp.onload = function() {
					document.getElementById("Output").innerHTML = this.responseText;
				}

				xhttp.open("GET", "getChargeInfo.php?q1="+q1+"&q2="+q2+"&q3="+q3+"&q4="+q4+"&q5="+q5);
				xhttp.send();
			}

		</script>

	</head>

	<body onload = "askServiceUsage()">
		<form>
			<label for="choose_service">Service Name</label>
			<select id = "choose_service" name = "Service Type" onchange="askServiceUsage()">
				<option value = "All" selected>All</option>
				<option value = "Drinks at the bar">Bar</option>
				<option value = "Gym">Gym</option>
				<option value = "Hairdressing">Hairdresser</option>
				<option value = "Meeting Room">Meeting Room</option>
				<option value = "Food and drinks at the restaurant">Restaurant</option>
				<option value = "Sauna">Sauna</option>
			</select>

			<label for="From Date">From Date</label>
			<input type="date" id="from_date" name="From Date" onchange="askServiceUsage()">

			<label for="To Date">To Date</label>
			<input type="date" id="to_date" name="To Date" onchange="askServiceUsage()">

			<label for="From Amount">From Amount</label>
			<input type="number" id="from_amount" name="From Amount" onchange="askServiceUsage()">

			<label for="To Amount">To Amount</label>
			<input type="number" id="to_amount" name="To Amount" onchange="askServiceUsage()">

		</form>

		<p id = "Output"></p>

	</body>
</html>
