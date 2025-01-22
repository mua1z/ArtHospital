<?php
session_start();
include 'db_con.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = $_POST['patientName'];
    $patient_id = $_POST['patientID'];
    $phone = $_POST['patientPhone'];
    $dob = $_POST['patientDOB'];

    // Insert patient into the database
    $stmt = $conn->prepare("INSERT INTO patients (full_name, patient_id, phone_number, dob) 
                            VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $patient_name, $patient_id, $phone, $dob);

    if ($stmt->execute()) {
        echo "Patient registered successfully!";
        // Redirect to dashboard or another page if needed
        header("Location: reception_dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
