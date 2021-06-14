<?php

$conn = new mysqli(
	$servername = "localhost",
	$username = "asdf_admin",
	$password = "databases2021",
	$database = "asdf_palace"
);
//πρωτα βρίσκουμε τα visits του δοσμένου nfc_id
//μετά κανουμε join με όλο τον πίνακα visits με συνθήκες τον χρόνο και το nfc_id διαφορετικό από το δοσμένου
//από αυτό παίρνουμε μόνο το δεύτερο nfc_id pinf(possibly infected)
//κάνουμε join με τον πίνακα των customers
$sql = "WITH rightNFC AS (
			SELECT *
			FROM
			WHERE nfc_id= ?),
			pinf(nfc_id) AS (
			SELECT v.nfc_id
			FROM Visits as v
			JOIN rightNFC as r
			ON r.space_id=v.space_id AND r.nfc_id <> v.nfc_id AND  NOT (v.exit_datetime < r.arrival_datetime OR v.arrival_datetime > DATE_ADD(v.exit_datetime, INTERVAL 1 HOUR))
 			)
		SELECT *
		FROM Customer
		JOIN pinf ON pinf.nfc_id = Customer.nfc_id";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['q']);
$stmt->execute();

$result = $stmt->get_result();
echo "Number of visits: ";
echo $result->num_rows;

echo "<table>";
echo "<tr>";
echo "<th>space_id</th>";
echo "<th>space_name</th>";
echo "<th>space_description_location</th>";
echo "<th>arrival_datetime</th>";
echo "<th>exit_datetime</th>";
echo "</tr>";

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()){
		echo "<tr><td>".$row["space_id"]."</td><td> ".$row["name"]."</td><td> ".$row["description_location"]."</td><td> ".$row["arrival_datetime"]."</td><td> ".$row["exit_datetime"]."</td></tr>";
	}
	echo "</table>";
}

$stmt->close();
$conn->close();

?>
