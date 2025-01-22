<?php
session_start();
$conn = new mysqli("localhost", "root", "", "form");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Authentication check
if (!isset($_SESSION['patient_id'])) {
    header("Location: login.php");
    exit();
}

$patient_id = $_SESSION['patient_id'];

// Fetch patient's personal details
$stmt = $conn->prepare("SELECT full_name, age, sex, card_no, id_no, city, date, history FROM medical_history WHERE id = ?");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
$patient_info = $result->fetch_assoc();

// Fetch medical history
$history_stmt = $conn->prepare("SELECT visit_date, doctor_name, diagnosis, prescriptions FROM medical_history WHERE patient_id = ?");
$history_stmt->bind_param("i", $patient_id);
$history_stmt->execute();
$history_result = $history_stmt->get_result();

$history = [];
while ($row = $history_result->fetch_assoc()) {
    $history[] = $row;
}

// Close statements
$stmt->close();
$history_stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical History</title>
</head>
<body>
    <h1>Patient Profile</h1>
    <?php if ($patient_info): ?>
        <p><strong>Full Name:</strong> <?= htmlspecialchars($patient_info['full_name']) ?></p>
        <p><strong>Age:</strong> <?= htmlspecialchars($patient_info['age']) ?></p>
        <p><strong>Sex:</strong> <?= htmlspecialchars($patient_info['sex']) ?></p>
        <p><strong>Card Number:</strong> <?= htmlspecialchars($patient_info['card_no']) ?></p>
        <p><strong>ID Number:</strong> <?= htmlspecialchars($patient_info['id_no']) ?></p>
        <p><strong>City:</strong> <?= htmlspecialchars($patient_info['city']) ?></p>
        <p><strong>Record Date:</strong> <?= htmlspecialchars($patient_info['date']) ?></p>
        <p><strong>Medical History:</strong> <?= nl2br(htmlspecialchars($patient_info['history'])) ?></p>
    <?php else: ?>
        <p>No patient information found.</p>
    <?php endif; ?>

    <h2>Medical History</h2>
    <?php if (!empty($history)): ?>
        <ul>
            <?php foreach ($history as $record): ?>
                <li>
                    <strong>Date:</strong> <?= htmlspecialchars($record['visit_date']) ?><br>
                    <strong>Doctor:</strong> <?= htmlspecialchars($record['doctor_name']) ?><br>
                    <strong>Diagnosis:</strong> <?= htmlspecialchars($record['diagnosis']) ?><br>
                    <strong>Prescriptions:</strong> <?= htmlspecialchars($record['prescriptions']) ?><br>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No medical history found.</p>
    <?php endif; ?>
</body>
</html>
