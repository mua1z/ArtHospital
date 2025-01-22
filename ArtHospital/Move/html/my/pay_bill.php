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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_SESSION['patient_id'];
    $amount = floatval($_POST['paymentAmount']);
    $method = $_POST['paymentMethod'];

    // Validate input
    if ($amount <= 0) {
        die("Invalid payment amount.");
    }

    // Process payment
    $stmt = $conn->prepare("INSERT INTO payments (patient_id, amount_paid, payment_method, payment_date) 
                            VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("ids", $patient_id, $amount, $method);

    if ($stmt->execute()) {
        // Update balance
        $update_stmt = $conn->prepare("UPDATE patients SET balance = balance - ? WHERE id = ?");
        $update_stmt->bind_param("di", $amount, $patient_id);
        $update_stmt->execute();
        $update_stmt->close();

        echo "Payment successful!";
    } else {
        echo "Payment failed: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
