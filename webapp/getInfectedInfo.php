<?php

$conn = new mysqli(
	$servername = "localhost",
	$username = "asdf_admin",
	$password = "databases2021",
	$database = "asdf_palace"
);
 $sql = "SELECT DISTINCT c.nfc_id, c.name, c.surname, c.date_of_birth, c.id_document_number, c.id_document_type, c.id_document_authority
 				FROM Customer as c, Visits as v1, Visits as v2
				WHERE v1.nfc_id= ? AND c.nfc_id=v2.nfc_id AND v1.nfc_id<>v2.nfc_id AND v1.space_id=v2.space_id AND ! ( v2.exit_datetime < v1.arrival_datetime OR v2.arrival_datetime > DATE_ADD(v1.exit_datetime, INTERVAL 1 HOUR) )";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['q']);
$stmt->execute();
$result = $stmt->get_result();
echo "Customers that might be infected: ";
echo $result->num_rows;

echo "<table>";
echo "<tr>";
echo "<th>nfc_id</th>";
echo "<th>Name</th>";
echo "<th>Surname</th>";
echo "<th>Date of birth</th>";
echo "<th>ID document number</th>";
echo "<th>ID document type</th>";
echo "<th>ID document authority</th>";
echo "</tr>";

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()){
		echo "<tr><td>".$row["nfc_id"]."</td><td> ".$row["name"]."</td><td> ".$row["surname"]."</td><td> ".$row["date_of_birth"]."</td><td> ".$row["id_document_number"]."</td><td>".$row["id_document_type"]."</td><td>".$row["id_document_authority"]."</td><td>";
	}
	echo "</table>";
}

$stmt->close();
$conn->close();

?>
