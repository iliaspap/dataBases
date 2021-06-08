<?php

$conn = new mysqli(
  $servername = "localhost",
  $username = "root",
  $password = "",
  $database =  "Hotel"
);

if($_GET['q'] == ""){
    echo "YES";
}else{
    echo "NO";
}

$str = "service_description = ?";
$sql = "SELECT * FROM Service_usage WHERE ".$str;
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
// $stmt->store_result();

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

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr><td>".$row["service_description"]."</td><td>".$row["surname"]."</td><td>".$row["name"]."</td><td>".$row["service_charge_datetime"]."</td><td>".$row["description"]."</td><td>".$row["amount"]."</td></tr>";
    }
    echo "</table>";
}

$stmt->close();
$conn->close();

?>
