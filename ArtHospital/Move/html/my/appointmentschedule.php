<?php

include 'db_con.php';

// Initialize the $result variable
$result = null;

// Fetch appointments only when the search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $searchKeyword = $_GET['search'];
    $query = "SELECT * FROM appointment WHERE Id_No = '$searchKeyword'";
    $result = mysqli_query($conn, $query);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Schedule</title>
    <link rel="stylesheet" type="text/css" href="css/appointview.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        #schedule-container {
            margin-top: 20px;
        }

        .search-form {
            margin-top: 10px;
            text-align: center;
        }

        .search-input {
            padding: 8px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-btn {
            padding: 8px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .appointment-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Appointment Schedule</h1>

    <div class="info">
        <div class="image">
            <img src="studentviewa.jpg" alt="" width="200px" height="100px">
        </div>
        <div class="text">
            <p>Welcome to our Appointment Page! Here, you can easily schedule and manage your appointments in a convenient and user-friendly manner. Our intuitive interface allows you to book appointments with just a few clicks, ensuring a seamless experience for both new and existing patients.</p>
        </div>
    </div>

    <!-- Search Form -->
    <div class="search-form">
        <form action="appointmentschedule.php" method="GET">
            <input type="text" id="search" name="search" class="search-input" placeholder="Search by ID">
            <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <!-- Display search results or default results -->
    <div id="schedule-container">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='appointment-item'>{$row['No']} - {$row['Full_Name']} - {$row['Id_No']} - {$row['Department']} - {$row['Dates']} - {$row['Timess']}</div>";
                // You can customize the output based on your needs
            }
        } elseif ($result && mysqli_num_rows($result) == 0) {
            echo "<p>No appointments found.</p>";
        }
        ?>
    </div>

    <style>
    .from-link {
        display: inline-block;
        padding: 8px 16px;
        text-decoration: none;
        background-color: #4caf50;
        color: white;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .from-link:hover {
        background-color: #45a049;
    }
</style>

<!-- Replace the button with the styled link -->
<center><a href="patientappoint.php" class="from-link">Change Appointment</a></center>

    
    <script src="appointschedule.js"></script>
</body>
</html>
