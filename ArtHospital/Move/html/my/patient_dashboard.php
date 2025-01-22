
<?php
session_start();
include 'db_con.php';
/*
// Authentication check
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}*/

// Fetch patient information
$patient_id = $_SESSION['patient_id'];
$stmt = $conn->prepare("SELECT name, email, balance, profile_photo FROM patients WHERE id = ?");
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
$patient = $result->fetch_assoc();

if (!$patient) {
    die("Patient not found.");
}

// Fetch medical history link
$medical_history_url = "medical_history.php";

// Close statement
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="css/patient.css">
</head>
<body>

<div class="header">
    <div class="title">Patient Dashboard</div>
</div>

<!-- Main Content -->
<div class="container">
    <!-- Left Column: UI Sections -->
    <div class="left-column">
        <!-- Profile Section -->
        <div class="section animate-profile">
            <div class="profile-header">
                <img src="photo.jpg" alt="Profile Photo" class="profile-img">
            </div>
            <div class="patient-info">
                <h3>Welcome, [Patient Name]</h3>
                <p>Patient ID: [Patient ID]</p>
                <p>Registered Email: [Patient Email]</p>
            </div>
        </div>

        <!-- Access Medical History Section -->
        <div class="section animate-form" style="background-image: url('medical-history-icon.jpg');">
            <div class="section-header">
                <h2>Access Medical History</h2>
            </div>
            <p>View your past medical records and doctor visits.</p>
            <button class="btn" onclick="location.href='medical_history.php'">View Medical History</button>
        </div>

        
        <!-- Pay Bill Section -->
        <div class="section animate-form" style="background-image: url('pay-bill-icon.jpg');">
            <div class="section-header">
                <h2>Pay Bill</h2>
            </div>
            <p>Your current balance: $[Balance]</p>

            <form action="pay_bill.php" method="post">
                <label for="paymentAmount">Amount to Pay:</label>
                <input type="number" id="paymentAmount" name="paymentAmount" required><br><br>

                <label for="paymentMethod">Payment Method:</label>
                <select name="paymentMethod" id="paymentMethod" required>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Debit Card">Debit Card</option>
                    <option value="PayPal">PayPal</option>
                </select><br><br>

                <button class="btn" type="submit" name="payBill">Pay Bill</button>
            </form>
        </div>
    </div>

    <!-- Right Column: Image Section -->
    <div class="right-column animate-right">
        <img src="photo.jpg" alt="Profile Photo" class="profile-img-right">
       

    </div>
</div>

<script>
function validatePaymentForm() {
    const paymentAmount = document.getElementById('paymentAmount').value;
    const paymentMethod = document.getElementById('paymentMethod').value;

    if (paymentAmount <= 0) {
        alert('Payment amount must be greater than zero.');
        return false;
    }

    if (!paymentMethod) {
        alert('Please select a payment method.');
        return false;
    }

    return true;
}
</script>

</body>
</html>
