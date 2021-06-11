<?php

$conn = new mysqli(
  $servername = "localhost",
  $username = "asdf_admin",
  $password = "databases2021",
  $database =  "asdf_palace"
);

//** Change ii to dd when ready
if ($_GET['q1'] == "All") {
  $sql = "SELECT * FROM service_usage WHERE service_charge_datetime >= ? and service_charge_datetime <= ? and amount >= ? and amount <= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssdd",$_GET['q2'], $_GET['q3'], $_GET['q4'], $_GET['q5']);
}
else {
  $sql = "SELECT * FROM service_usage WHERE service_description = ? and service_charge_datetime >= ? and service_charge_datetime <= ? and amount >= ? and amount <= ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssdd", $_GET['q1'], $_GET['q2'], $_GET['q3'], $_GET['q4'], $_GET['q5']);
}
$stmt->execute();

echo "<table>";
echo "<tr>";
echo "<th>service_description</th>";
echo "<th>surname</th>";
echo "<th>name</th>";
echo "<th>service_charge_datetime</th>";
echo "<th>description</th>";
echo "<th>amount</th>";
echo "</tr>";

$result = $stmt->get_result();
echo "Number of transctions: " ;
echo $result->num_rows;

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr><td>".$row["service_description"]."</td><td>".$row["surname"]."</td><td>".$row["name"]."</td><td>".$row["service_charge_datetime"]."</td><td>".$row["description"]."</td><td>".$row["amount"]."</td></tr>";
    }
    echo "</table>";
}

$stmt->close();
$conn->close();

?>
