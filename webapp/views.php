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

    echo "<br>";
    
    $sql2 = "SELECT * FROM customer_data";

    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();

		echo "<table>";
		echo "<tr>";
		echo "<th>nfc id</th>";
		echo "<th>Surname</th>";
		echo "<th>Name</th>";
		echo "<th>Date of birth</th>";
		echo "<th>id document number</th>";
    echo "<th>id document type</th>";
    echo "<th>id document authority</th>";
    echo "<th>phone 1</th>";
    echo "<th>phone 2</th>";
    echo "<th>email 1</th>";
    echo "<th>email 2</th>";
		echo "</tr>";

		$result2 = $stmt2->get_result();
		echo "Number of customers " ;
		echo $result2->num_rows;

		if($result2->num_rows > 0){
		    while($row = $result2->fetch_assoc()){
		        echo "<tr><td>".$row["nfc_id"]."</td><td>".$row["surname"]."</td><td>".$row["name"]."</td><td>"
            .$row["date_of_birth"]."</td><td>".$row["id_document_number"]."</td><td>".$row["id_document_authority"]."</td><td>".$row["id_document_type"]."</td><td>"
            .$row["phone1"]."</td><td>".$row["phone2"]."</td><td>".$row["email1"]."</td><td>".$row["email2"]."</td></tr>";
		    }
		    echo "</table>";
		}

    $stmt->close();
    $stmt2->close();
    $conn->close();

		 ?>
	</body>
</html>
