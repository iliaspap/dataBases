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
		<title>The Budapest Hotel</title>
	</head>
	<body>
		<table>
			<tr>
				<th>nfc_id</th>
				<th>name</th>
				<th>surname</th>
				<th>date_of_birth</th>
				<th>id_document_number</th>
				<th>id_document_type</th>
				<th>id_document_authority</th>
			</tr>
			<?php
			$sql = "SELECT * FROM Customer";
			$result = $conn-> query($sql);
			// if ($result === TRUE) {
			//   echo "Database created successfully";
			// } else {
			//   echo "Error creating database: " . $conn->errno;
			// }
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo "<tr><td>".$row["nfc_id"]."</td><td>".$row["name"]."</td><td>".$row["surname"]."</td><td>".$row["date_of_birth"]."</td><td>".$row["id_document_number"]."</td><td>".$row["id_document_type"]."</td><td>".$row["id_document_authority"]."</td><tr>";
				}
				echo "</table>";
			}
			else{
				$conn->close();
			}
			?>
		</table>
	</body>
</html>
