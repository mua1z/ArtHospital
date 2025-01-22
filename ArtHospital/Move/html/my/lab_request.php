<?php
// Include the connection.php file (assuming it contains the database connection code)
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'form';

// Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $patientName = $_POST['patient_name'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $idNumber = $_POST['Idnumber'];

    // Handle checkbox values
    $bf = isset($_POST['tests']) ? $_POST['tests'] : 0;
    $stool = isset($_POST['stool']) ? $_POST['stool'] : 0;
    $widal = isset($_POST['widal']) ? $_POST['widal'] : 0;
    $wf = isset($_POST['wf']) ? $_POST['wf'] : 0;
    $hplory = isset($_POST['h.plory']) ? $_POST['h.plory'] : 0;
    $hcg = isset($_POST['hcg']) ? $_POST['hcg'] : 0;
    $BFS = isset($_POST['BFS/RBS']) ? $_POST['BFS/RBS'] : 0;
    $Ua = isset($_POST['U/A']) ? $_POST['U/A'] : 0;

    $others = $_POST['others'];

    // Prepare the SQL statement
    $stmt = $db->prepare("INSERT INTO lab_request (patient_name,sex,age,id_number,tests,others,WIDAL_TEST,PLORY_TEST,BFS,STOOL, WF, HCG, UA) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters and execute the statement
    $stmt->bind_param("ssissssssssss", $patientName, $sex, $age, $idNumber, $bf, $others, $widal, $hplory, $BFS, $stool, $wf, $hcg, $Ua);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        // Display success message using JavaScript alert
        echo '<script>alert("Data inserted successfully!"); window.location.href = "Doctor_dashboard.php";</script>';
    } else {
        // Display error message using JavaScript alert
        echo '<script>alert("Error inserting data: ' . $stmt->error . '");</script>';
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$db->close();
?>
