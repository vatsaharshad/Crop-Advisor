<?php
$servername = "crop.cmotgzvfocad.us-east-2.rds.amazonaws.com";
$username = "root";
$password = "qwertyuiop";
$dbname = "crop";

// Create connection
$conn1 = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn1->connect_error) {
    die("Connection failed: " . $conn1->connect_error);
}
$val = $_GET['location'];
$val1= $_GET['crop'];

$response = array();
$sql="SELECT * from rates WHERE market='$val' and commodity='$val1';";
$r="crop\tmin\tmax\tmean\tdate\n";
$result = $conn1->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

    	array_push($response, $row);


        $r=$r.$row["commodity"]."\t".$row["min"]."\t".$row["max"]."\t".$row["modal"]."\t".$row["date"]."\n";

    }
   //echo $r;
    echo json_encode($response);
}
else
{
    //echo "Sorry\nNo Data Found";
}


$conn1->close();

?>
