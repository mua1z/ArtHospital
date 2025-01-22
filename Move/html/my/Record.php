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
    $patientName = $_POST['patientName'];
    $age = $_POST['age'];
    $cardNo = $_POST['cardNo'];
    $sex = $_POST['sex'];
    $idNo = $_POST['idNo'];
    $date = $_POST['date'];
    $department = $_POST['department'];
    $description = $_POST['description'];

    // Sanitize and validate the input data here

    $sql = "INSERT INTO medical_history (FULL_NAME, AGE, SEX, CARD_NO, ID_NO, DEPARTMENT, DATE, HISTORY) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param("sissssss", $patientName, $age, $sex, $cardNo, $idNo, $department, $date, $description);

        if ($stmt->execute()) {
            echo '<script>alert("Data inserted successfully!"); window.location.href = "patienthistory.html";</script>';
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