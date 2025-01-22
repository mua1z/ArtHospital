<?php
session_start();
$conn = new mysqli("localhost", "root", "", "form");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment_id = $_POST['appointmentIDChange'];
    $new_appointment_date = $_POST['newAppointmentDate'];
    $new_appointment_time = $_POST['newAppointmentTime'];

    // Update appointment date and time
    $stmt = $conn->prepare("UPDATE appointments SET appointment_date = ?, appointment_time = ? WHERE id = ?");
    $stmt->bind_param("ssi", $new_appointment_date, $new_appointment_time, $appointment_id);

    if ($stmt->execute()) {
        echo "Appointment updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
