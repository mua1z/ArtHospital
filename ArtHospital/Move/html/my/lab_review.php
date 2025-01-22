<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab Results</title>
    <link rel="stylesheet" href="lab_result.css">
</head>
<body>

<?php


$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'form';

// Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check if the connection is successful
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Fetch data from the lab_request table
$sql = "SELECT * FROM lab_request";
$result = $db->query($sql);
?>
 <a href="labresult.php" class="back-link">Send Lab Results</a>
   
<div class="table-container">
    <h2>Lab Requests</h2>
    <table>
        <thead>
            <tr>
                <th>PATIENT NAME</th>
                <th>SEX</th>
                <th>AGE</th>
                <th>ID</th>
                <th>Tests</th>
                <th>Others</th>
                <th>Widal Test</th>
                <th>Plory Test</th>
                <th>BFS</th>
                <th>Stool</th>
                <th>WF</th>
                <th>HCG</th>
                <th>UA</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Output data to HTML table
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["patient_name"] . "</td>";
                    echo "<td>" . $row["sex"] . "</td>";
                    echo "<td>" . $row["age"] . "</td>";
                    echo "<td>" . $row["id_number"] . "</td>";
                    echo "<td>" . $row["tests"] . "</td>";
                    echo "<td>" . $row["others"] . "</td>";
                    echo "<td>" . $row["WIDAL_TEST"] . "</td>";
                    echo "<td>" . $row["PLORY_TEST"] . "</td>";
                    echo "<td>" . $row["BFS"] . "</td>";
                    echo "<td>" . $row["STOOL"] . "</td>";
                    echo "<td>" . $row["WF"] . "</td>";
                    echo "<td>" . $row["HCG"] . "</td>";
                    echo "<td>" . $row["UA"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='13'>No records found</td></tr>";
            }

            // Close the connection
            $db->close();
            ?>
        </tbody>
    </table>
</div>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.table-container {
    max-width: 800px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #4CAF50;
    color: white;
}

h2 {
    color: #333;
    text-align: center;
}
.back-link {
    display: inline-block;
    padding: 10px 20px;
    text-decoration: none;
    color: #fff;
    background-color: #4CAF50;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.back-link:hover {
    background-color: #45a049;
}

</style>
</body>
</html>
