<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle delete action
    if (isset($_POST['deleteUser'])) {
        $userId = $_POST['userId'];
        $sqlDelete = "DELETE FROM users WHERE Id = '$userId'";
        
        if ($conn->query($sqlDelete) === TRUE) {
            echo "User deleted successfully!";
        } else {
            echo "Error deleting user: " . $conn->error;
        }
    }

    // Handle edit action
    if (isset($_POST['editUser'])) {
        $userId = $_POST['userId'];
        $newFirstname = $_POST['newFirstname'];
        $newPassword = $_POST['newPassword'];
        $newId = $_POST['newId'];

        $sqlEdit = "UPDATE users SET Firstname = '$newFirstname', Password = '$newPassword', Id = '$newId' WHERE Id = '$userId'";

        if ($conn->query($sqlEdit) === TRUE) {
            echo "User information updated successfully!";
        } else {
            echo "Error updating user information: " . $conn->error;
        }
    }
}

function getLoggedInUser() {
    // Check if the 'user' key is set in the session
    if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
    } else {
        return null; // No user is logged in
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Control</title>
    <link rel="stylesheet" href="css/admin.css">
    


  
</head>
<body>

<div class="head">

<h1>Admin Page</h1>

</div>









<!-- Search Form -->
<form action="account_control.php" method="GET" class="form1">
   
    <input type="text" id="userId" name="userId"  placeholder="Serach user by Id" required>
    <input type="submit" value="Search">
</form>

<?php
// Display search results
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['userId'])) {
    $userId = $_GET['userId'];

    $sqlSearch = "SELECT * FROM users WHERE Id = '$userId'";
    $result = $conn->query($sqlSearch);

    if ($result->num_rows > 0) {
        echo "<table>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['Firstname']}</td>
                    <td>{$row['Lastname']}</td>
                    <td>
                        <form action=\"account_control.php\" method=\"POST\">
                            <input type=\"hidden\" name=\"userId\" value=\"{$row['Id']}\">
                            <input type=\"submit\" name=\"deleteUser\" value=\"Delete\">
                        </form>
                    </td>
                    <td>
                        <form action=\"account_control.php\" method=\"POST\">
                            <input type=\"hidden\" name=\"userId\" value=\"{$row['Id']}\">
                            <label for=\"newFirstname\">Edit First Name:</label>
                            <input type=\"text\" id=\"newFirstname\" name=\"newFirstname\" value=\"{$row['Firstname']}\"><br>
                            <label for=\"newPassword\">Edit Password:</label>
                            <input type=\"password\" id=\"newPassword\" name=\"newPassword\"><br>
                            <label for=\"newId\">Edit ID:</label>
                            <input type=\"text\" id=\"newId\" name=\"newId\" value=\"{$row['Id']}\"><br>
                            <input type=\"submit\" name=\"editUser\" value=\"Edit\">
                        </form>
                    </td>
                  </tr>";
            // Add other fields as needed
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
}

$conn->close();
?>
<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "form";
$run = "";

$conn = mysqli_connect($server, $username, $password, $dbname);

if (isset($_POST['submit'])) {
    if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['id']) && !empty($_POST['password']) && !empty($_POST['role'])) {
        $Firstname = $_POST['fname'];
        $Lastname = $_POST['lname'];
        $Id = $_POST['id'];
        $Password = $_POST['password'];
        $type = $_POST['role'];

        // Check if the ID is already registered
        $checkQuery = "SELECT * FROM users WHERE Id='$Id'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
          $errorsignup="ID number already registered.";
        } else {
            $query = "INSERT INTO users (Firstname, Lastname, Id, Password, Type) VALUES ('$Firstname', '$Lastname', '$Id', '$Password', '$type')";
            $run = mysqli_query($conn, $query) or die(mysqli_error($conn));

            if ($run) {
                header("location:adminsuc.html");
            } else {
                echo "Form did not submit successfully.";
            }
        }
    } else {
        echo "All fields required.";
    }
}
?>





<div class="cont">
    <form action="" method="post">
        <h2>Add User</h2><br>

        <?php if (!empty($errorsignup)) : ?>
            <div style="color: red;"><?php echo $errorsignup; ?></div>
        <?php endif; ?>

        <div class="ins">
            <input type="text" placeholder="First Name" name="fname">
            <input type="text" placeholder="Last Name" name="lname">
            <input type="text" placeholder="Enter your Id" name="id">
            <input type="password" placeholder="Enter your password" name="password"><br><br>

            <label for="role">Select type</label>
            <select name="role" id="role">
                <option value="Doctor">Doctor</option>
                <option value="Admin">Admin</option>
                <option value="Pharmacist">Pharmacist</option>
                <option value="Reception">Reception</option>
                <option value="Laboratory">Laboratory</option>
            </select>
            <br> <br>
        
        </div>

        <button class="btn" type="submit" name="submit">
          Add User
        </button>

      
    </form>
</div>
      
</body>
</html>

