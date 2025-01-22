<?php
// Include the connection.php file (assuming it contains the database connection code)
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'form';

// Create connection and select DB
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $patientName = isset($_POST['patient_name']) ? $_POST['patient_name'] : '';
    $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $idNumber = isset($_POST['Idnumber']) ? $_POST['Idnumber'] : '';

    // Separate checkbox values
    $bf = isset($_POST['tests']['Bf']) ? $_POST['tests']['Bf'] : '';
    $stool = isset($_POST['stool']) ? $_POST['stool'] : '';
    $widal = isset($_POST['widal']) ? $_POST['widal'] : '';
    $wf = isset($_POST['wf']) ? $_POST['wf'] : '';
    $hplory = isset($_POST['h.plory']) ? $_POST['h.plory'] : '';
    $hcg = isset($_POST['hcg']) ? $_POST['hcg'] : '';
    $BFS = isset($_POST['BFS/RBS']) ? $_POST['BFS/RBS'] : '';
    $Ua = isset($_POST['U/A']) ? $_POST['U/A'] : '';

    $others = isset($_POST['others']) ? $_POST['others'] : '';

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO lab_results (patient_name, sex, age, id_number, tests, others, WIDAL_TEST, PLORY_TEST, BFS, STOOL, WF, HCG, UA) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters and execute the statement
    $stmt->bind_param("ssissssssssss", $patientName, $sex, $age, $idNumber, $bf, $others, $widal, $hplory, $BFS, $stool, $wf, $hcg, $Ua);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Data inserted successfully!');</script>";
    } else {
        echo "<script>alert('Error inserting data: " . $stmt->error . "');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Test</title>
    <link rel="stylesheet" href="css/labreq.css">
</head>
<body>
    <a href="lab_review.php" class="back-link">view requests</a>
    <form class="lab" action="" method="post">
        <fieldset class="fff">
            <legend>Laboratory</legend>

            <label for="patient_name">PATIENT NAME:
                <input type="text" id="patient_name" name="patient_name" />
            </label>
            <label for="sex">SEX:
                <select name="sex" id="sex">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </label><br>
            <label for="age">AGE:
                <input type="number" name="age" id="age" />
            </label>
            <br>
            <label for="Idnumber">ID no
                <input type="text" name="Idnumber" id="Idnumber" />
            </label><br><br><br>
            <hr>

            <div class="tst">
                <h4 style="text-align: center; margin-top: 7px">TESTS</h4><br>
                <div class="check">
                    <div class="one">
                        <label for="Bf">BF:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input type="text" name="Bf" id="Bf" />
                        
                        <label for="stool">Stool:</label>
                        <input type="text" name="stool" id="stool" />
                    </div>

                    <div class="two">
                        <label for="widal">Widal Test:</label>
                        <input type="text" name="widal" id="widal" />
                        
                        <label for="wf">W/F:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input type="text" name="wf" id="wf" />
                    </div>

                    <div class="three">
                        <label for="hplory">H.Pylori Test:</label>
                        <input type="text" name="hplory" id="hplory" />
                        
                        <label for="hcg">HCG:</label>
                        <input type="text" name="hcg" id="hcg" />
                    </div>

                    <div class="four">
                        <label for="BFSRBS">BFS/RBS&nbsp;&nbsp;&nbsp;</label>
                        <input type="text" name="BFSRBS" id="BFSRBS" />
                        
                        <label for="ua">U/A:</label>
                        <input type="text" name="Ua" id="Ua" />
                    </div>
                </div>

                <label for="others">Others:
                    <input type="text" name="others" id="others" />
                </label><br>
                <input type="submit" name="submit" value="Send" />
                <input type="reset" name="reset" value="Clear" />
            </div>

        </fieldset>
    </form>
 