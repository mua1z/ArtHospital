<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "form";
$run = "";

$conn = mysqli_connect($server, $username, $password, $dbname);
if (isset($_POST['submit'])) {

    if (!empty($_POST['fname']) && !empty($_POST['age']) && !empty($_POST['id']) && !empty($_POST['cost']) && !empty($_POST['date']) && !empty($_POST['type'])) {

        $Firstname = $_POST['fname'];
        $age = $_POST['age'];
        $Id = $_POST['id'];
        $cost = $_POST['cost'];
        $date = $_POST['date'];
        $type = $_POST['type'];

        $query = "INSERT INTO medicine (FULL_NAME,AGE,ID,COST,DATE,MEDICINE_TYPE) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssss",$Firstname,$age,$Id,$cost,$date,$type);

        $run = mysqli_stmt_execute($stmt);

        if ($run) {
echo "<script>alert('Data inserted successfully!');</script>";
        } else {
            echo "Form did not submit successfully";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "All fields required";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pharmacy</title>
    <link rel="stylesheet" href="css/phar.css">
    <link rel="stylesheet" href="css/phar1.css">
</head>
<style>
        .logout-link {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            background-color: #3498db;
            color: #fff;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            position: fixed;
            top: 10px;
            right: 10px;
        }

        .logout-link:hover {
            background-color: #2980b9;
        } /* Add the new styles here or include the new.css file */
       
    </style>
<body>

    <div class="main">
    <a href="index.html" class="logout-link">Back to home</a>
        <div class="view">
            <button class="btn" onclick="myFunction2()" id="ur">View Request</button> <br> <br>
        </div>
        <div class="store">
            <button class="bt" id="show-login">Record Data</button>
        </div>

        <div id="vertical-line"></div>
        <h1>ART pharmacy</h1>


        <?php
// Database connection
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'form';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the appointment table
$sql = "SELECT * FROM prescription ORDER BY REF_NO DESC";
$result = $conn->query($sql);
?>

<table class="content-table3" id="popup2">
    <thead>
        <tr>
           
            <th>PATIENT_NAME</th>
            <th>SEX</th>
            <th>AGE</th>
            <th>ID</th>
            <th>PRESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Output data to HTML table
        if ($result->num_rows > 0) {
            $counter = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
               
                echo "<td>" . $row["PATIENT_NAME"] . "</td>";
                echo "<td>" . $row["SEX"] . "</td>";
                echo "<td>" . $row["AGE"] . "</td>";
                echo "<td>" . $row["ID"] . "</td>";
                echo "<td>" . $row["PRESCRIPTION"] . "</td>";
               
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }

        $conn->close();
        ?>
    </tbody>
</table>




<form action="phar.php" method="post">
            <div class="popup">
                <div class="close-btn" onclick="document.querySelector('.popup').classList.remove('active')">&times;</div>
                <div class="form">
                    <h2>patient data</h2>
                    <div class="form-element">
                        <label for="Fname">Full Name</label>
                        <input type="text" name="fname">
                    </div>
                    <div class="form-element">
                        <label for="Age">Age</label>
                        <input type="text" name="age">
                    </div>
                    <div class="form-element">
                        <label for="Id">Id</label>
                        <input type="text" name="id">
                    </div>
                    <div class="form-element">
                        <label for="Cost">Cost</label>
                        <input type="text" name="cost">
                    </div>
                    <div class="form-element">
                        <label for="Date">Date</label>
                        <input type="text" name="date">
                    </div>
                    <div class="form-element">
                        <label for="Type">Medicine Type</label>
                        <input type="text" name="type">
                    </div>
                    <div class="form-element">
                        <button type="submit" name="submit">Submit data</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
   
    
    <script>
        document.getElementById("show-login").addEventListener("click", function(){
            document.querySelector(".popup").classList.add("active");
        });
    </script>


<script>
  function myFunction2() {
var y = document.getElementById("popup2");
if (y.style.display === "none") {
    y.style.display = "block";
    
    
 
}
else{
  y.style.display="none";

}
}

  </script>


</body>
</html>