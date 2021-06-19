<?php

$conn = new mysqli(
	$servername = "localhost",
	$username = "asdf_admin",
	$password = "databases2021",
	$database = "asdf_palace"
);
/*get the parameters given by infoWrtAge.php*/
$age = $_GET['age'];//age requested
$q = $_GET['q'];//query made
/*if statements to see what age was requested*/
if($age=='Young'){
  $start=20;
  $end=40;
}
if($age=='Middle_aged'){
  $start=41;
  $end=60;
}
if($age=='Old'){
  $start=61;
  $end=200;//big enough value to make sure that everyone older than 61 will be included so that every query will have the same format
}
/*if statements to see what query was requested*/
if($q=='q1'){//The question was "What are the most visited spaces?"
  $sql= "SELECT S.name, count(V.space_id) as num
  FROM Space as S
  JOIN Visits as V ON V.space_id = S.space_id
  JOIN Customer as C ON V.nfc_id = C.nfc_id
                      and V.arrival_datetime >= DATE_ADD(CURRENT_DATE, INTERVAL -1 MONTH)
                      and FLOOR(DATEDIFF(CURRENT_DATE, C.date_of_birth)/365.25) BETWEEN ? AND ?
  GROUP BY V.space_id
  ORDER BY num DESC;";
}
if($q=='q2'){//The question was "What are the most frequently used services?"
  echo "hi";
  $sql= "SELECT S.service_description, count(C.nfc_id) as num
  FROM Service as S
  JOIN Service_charge as Sc ON S.service_id = Sc.service_id
  JOIN Customer as C ON C.nfc_id = Sc.nfc_id
                       and Sc.service_charge_datetime >= DATE_ADD(CURRENT_DATE, INTERVAL -1 MONTH)
                       and FLOOR(DATEDIFF(CURRENT_DATE, C.date_of_birth)/365.25) BETWEEN ? AND ?
  GROUP BY S.service_description
  ORDER BY num DESC;";
}
if($q=='q3'){//The question was "What are the services used by the most customers?"
  $sql="SELECT S.service_description, count(distinct C.nfc_id) as num
  FROM Service as S
  JOIN Service_charge as Sc ON S.service_id = Sc.service_id
  JOIN Customer as C ON C.nfc_id = Sc.nfc_id
                       and FLOOR(DATEDIFF(CURRENT_DATE, C.date_of_birth)/365.25) BETWEEN ? AND ?
                       and Sc.service_charge_datetime >= DATE_ADD(CURRENT_DATE, INTERVAL -1 MONTH)
  GROUP BY S.service_description
  ORDER BY num DESC;";
}
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $start,$end);
$stmt->execute();
$result = $stmt->get_result();
if($q=='q1'){
  echo "The most visited spaces are:";
  echo "<table>";
  echo "<tr>";
  echo "<th>Space description</th>";
  echo "<th>Number of visits</th>";
  echo "</tr>";
  if ($result->num_rows > 0) {
  	while ($row = $result->fetch_assoc()){
  		echo "<tr><td>".$row["name"]."</td><td> ".$row["num"]."</td><td> ";
  	}
  	echo "</table>";
  }


}
if($q=='q2'){
  echo "The most frequently used services are:";
  echo "<table>";
  echo "<tr>";
  echo "<th>Service description</th>";
  echo "<th>Number of transactions</th>";
  echo "</tr>";
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
      echo "<tr><td>".$row["service_description"]."</td><td> ".$row["num"]."</td><td> ";
    }
    echo "</table>";
  }

}
if($q=='q3'){
  echo "The services used by the most customers are:";
  echo "<table>";
  echo "<tr>";
  echo "<th>Service description</th>";
  echo "<th>Number of customers</th>";
  echo "</tr>";
  if ($result->num_rows > 0) {
    	while ($row = $result->fetch_assoc()){
    		echo "<tr><td>".$row["service_description"]."</td><td> ".$row["num"]."</td><td> ";
    	}
    	echo "</table>";
    }
}
//echo $result->num_rows;

$stmt->close();
$conn->close();

?>
