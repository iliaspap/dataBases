<!DOCTYPE html>

<?php
$conn = new mysqli(
  $servername = "localhost",
  $username = "asdf_admin",
  $password = "databases2021",
  $database =  "asdf_palace"
);
?>

<html lang="en" dir="ltr">

	<head>
		<meta charset="utf-8">
		<?php include "./navigation.php"?>
	</head>

	<body>
		<?php
		$sql = "SELECT * FROM category_charges";

		$stmt = $conn->prepare($sql);
		$stmt->execute();


		echo "<table>";
		echo "<tr>";
		echo "<th>service_description</th>";
		echo "<th>total amount</th>";
		echo "<th>number of transactions</th>";
		echo "</tr>";

		$result = $stmt->get_result();

		if($result->num_rows > 0){
		    while($row = $result->fetch_assoc()){
		        echo "<tr><td>".$row["service_description"]."</td><td>".$row["amount"]."</td><td>".$row["num"]."</td></tr>";
		    }
		    echo "</table>";
		}

		echo "\n\n";

		// echo "<table>";
		// echo "<tr>";
		// echo "<th>nfc id</th>";
		// echo "<th>Surname</th>";
		// echo "<th>Name</th>";
		// echo "<th>Date of birth</th>";
		// echo "<th>id document number</th>";
		// echo "<th>amount</th>";
		// echo "</tr>";
		//
		// $result = $stmt->get_result();
		// echo "Number of transctions: " ;
		// echo $result->num_rows;
		//
		// if($result->num_rows > 0){
		//     while($row = $result->fetch_assoc()){
		//         echo "<tr><td>".$row["service_description"]."</td><td>".$row["surname"]."</td><td>".$row["name"]."</td><td>".$row["service_charge_datetime"]."</td><td>".$row["description"]."</td><td>".$row["amount"]."</td></tr>";
		//     }
		//     echo "</table>";
		// }


		 ?>
	</body>
</html>
