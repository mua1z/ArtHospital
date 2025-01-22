<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "form";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = htmlspecialchars($_POST['fristname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $user_id = htmlspecialchars($_POST['id']);
    $password = htmlspecialchars($_POST['password']); // Store as plain text per the table's design
    $role = htmlspecialchars($_POST['role']);

    // Check if the user already exists
    $checkUserQuery = $conn->prepare("SELECT Id FROM users WHERE Id = ?");
    $checkUserQuery->bind_param("s", $user_id);
    $checkUserQuery->execute();
    $checkUserQuery->store_result();

    if ($checkUserQuery->num_rows > 0) {
        echo "User already exists with this ID.";
        $checkUserQuery->close();
        $conn->close();
        exit;
    }
    $checkUserQuery->close();

    // Insert the new user into the database
    $insertQuery = $conn->prepare("INSERT INTO users (Firstname, Lastname, Id, Password, Type) VALUES (?, ?, ?, ?, ?)");
    $insertQuery->bind_param("sssss", $firstname, $lastname, $user_id, $password, $role);

    if ($insertQuery->execute()) {
        echo "Signup successful! ";
        header('location: login.php');
    } else {
        echo "Error: " . $insertQuery->error;
    }

    $insertQuery->close();
}

// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="css/loginsignup.css">
</head>
<body>
    
    <Header>
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">ART</h2>
            </div>
            <div class="menu-icon">&#9776;</div>
            <div class="menu">
                <ul>
                    <li><a href="index.html">HOME</a></li>
                    <li><a href="service.html">SERVICE</a></li>
                    <li><a href="about.html">ABOUT US</a></li>
                    <li><a href="Contact.html">CONTACT</a></li>
                    <li><a href="login.php"  class="btn btn-login">Log in</a></li>
                    <li><a href="signup.php"  class="btn btn-signup">Sign up</a></li>
                </ul>
            </div>
        </div>
    </Header>
    <div class="signup">
       
        <div class="signup-form" id="signupForm">
            <h2>Let's Get Started!</h2>
            <p>Add your details to continue</p>
            <form action="signup.php" method="post">
            <input type="text" placeholder="First Name" name="fristname" required>
                <input type="text" placeholder="Last Name" name="lastname" required>
                <input type="text" placeholder="Enter your ID" name="id" required>
                <input type="password" placeholder="Create Password" name="password" required>
                
                <label for="role" name="role">Select type</label>
                <select name="role" id="signup-role">
                    <option value="Doctor">Doctor</option>
                    <option value="Admin">Admin</option>
                    <option value="Pharmacist">Pharmacist</option>
                    <option value="Reception">Reception</option>
                    <option value="Labratory">Labratory</option>
                    <option value="Nurse">Nurse</option>
                    <option value="Patient">patient</option>
                </select>
                <button type="submit" name="submit">Sign Up</button>
                <p>Already have an account</p>
                <p><a href="login.php">Log in</a> &nbsp; here</p>
            </form>
        </div>
    </div>
    <script src="menuicon.js">    
    </script>


</body>
</html>
