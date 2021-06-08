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
				document.getElementById("Output").innerHTML = "Poutses: " + x1 + x2 + x3 + x4 + x5;
			}
		</script>

	</head>

	<body>
		<form>
			<label for="choose_service">Service Name</label>
			<select id = "choose_service" name = "Service Type" onchange="myFunction()">
				<option value = "All" selected>All</option>
				<option value = "Bar">Bar</option>
				<option value = "Gym">Gym</option>
				<option value = "Hairdresser">Hairdresser</option>
				<option value = "Meeting Room">Meeting Room</option>
				<option value = "Restaurant">Restaurant</option>
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















		<!-- <table>
			<tr>
				<th>nfc_id</th>
				<th>name</th>
				<th>surname</th>
				<th>date_of_birth</th>
				<th>id_document_number</th>
				<th>id_document_type</th>
				<th>id_document_authority</th>
			</tr> -->
			<!-- <?php
			// $sql = "SELECT * FROM Customer";
			// $result = $conn-> query($sql);
			// // if ($result === TRUE) {
			// //   echo "Database created successfully";
			// // } else {
			// //   echo "Error creating database: " . $conn->errno;
			// // }
			// if($result->num_rows > 0){
			// 	while($row = $result->fetch_assoc()){
			// 		echo "<tr><td>".$row["nfc_id"]."</td><td>".$row["name"]."</td><td>".$row["surname"]."</td><td>".$row["date_of_birth"]."</td><td>".$row["id_document_number"]."</td><td>".$row["id_document_type"]."</td><td>".$row["id_document_authority"]."</td><tr>";
			// 	}
			// 	echo "</table>";
			// }
			// else{
			// 	$conn->close();
			// }
			?> -->
		<!-- </table> -->
	</body>
</html>
