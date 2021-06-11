<?php


$conn = new mysqli(
	$servername = "localhost",
	$username = "asdf_admin",
	$password = "databases2021",
	$database = "asdf_palace"
);

$sql = "SELECT s.space_id, s.name, s.description_location, v.arrival_datetime, v.exit_datetime FROM Visits as v JOIN Space as s ON v.space_id = s.space_id WHERE v.nfc_id = ?";
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
