<?php
session_start();
$conn = new mysqli("localhost", "root", "", "form");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = $_POST['patientName'];
    $patient_id = $_POST['patientID'];
    $city = $_POST['city'];
    $appointment_date = $_POST['appointmentDate'];
    $appointment_time = $_POST['appointmentTime'];
    $doctor = $_POST['doctor'];

    // Get the patient ID from the database using patient_id (unique)
    $stmt = $conn->prepare("SELECT id FROM patients WHERE patient_id = ?");
    $stmt->bind_param("s", $patient_id);
    $stmt->execute();
    $stmt->bind_result($patient_id_db);
    $stmt->fetch();
    $stmt->close();

    // If patient found, create appointment
    if ($patient_id_db) {
        $stmt = $conn->prepare("INSERT INTO appointments (patient_id, appointment_date, appointment_time, doctor) 
                                VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $patient_id_db, $appointment_date, $appointment_time, $doctor);

        if ($stmt->execute()) {
            echo "Appointment made successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Patient not found!";
    }
}
$conn->close();
?>
