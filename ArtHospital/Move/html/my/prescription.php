<?php
// Database details
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'form';

// Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if($db->connect_error){
  die("Connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientName = $_POST['patient_name'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $idNo = $_POST['Idnumber'];
    $prescription=$_POST['prescription'];
   
  

    // Sanitize and validate the input data here

    $sql = "INSERT INTO prescription(PATIENT_NAME,SEX,AGE,ID,PRESCRIPTION) VALUES (?, ?, ?, ?, ?)";

    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param("ssiss", $patientName, $sex,  $age, $idNo, $prescription);

        if ($stmt->execute()) {
            echo "<script>alert('Records inserted successfully.');</script>";
            header('location: Doctor_dashboard.php');
        } else {
            echo "ERROR: Could not execute query: $sql. " . $db->error;
        }
    } else {
        echo "ERROR: Could not prepare query: $sql. " . $db->error;
    }

    $stmt->close();
    $db->close();
}
?>
