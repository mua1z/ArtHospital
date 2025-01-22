<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "form";

$conn = mysqli_connect($server, $username, $password, $dbname);
if (isset($_POST['submit'])) {
    if (!empty($_POST['fname']) && !empty($_POST['id']) && !empty($_POST['department']) && !empty($_POST['dates']) && !empty($_POST['times'])) {
        $Firstname = $_POST['fname'];
        $Id = $_POST['id'];
        $Department = $_POST['department'];
        $Dates = $_POST['dates'];
        $Timess = $_POST['times'];
 
        $query = "INSERT INTO appointment (Full_Name, Id_No, Department, Dates, Timess) VALUES ('$Firstname', '$Id', '$Department', '$Dates', '$Timess')";

        $run = mysqli_query($conn, $query) or die(mysqli_error($conn));
         }
        }
?>



<!DOCTYPE html>
<html>
  <head>
    <title>Appointment</title>
    <link rel="" href="">
    <link rel="stylesheet" href="css/appointstyle.css">

    <script src="appointschedule.js"></script>
  </head>
<body id="formbody">


    <div class="formbold-main-wrapper">
         
        <div class="formbold-form-wrapper">
          <form action=" " method="POST">
            <div class="formbold-mb-5">
              <label for="name" class="formbold-form-label"> Full Name </label>
              <input
                type="text"
                name="fname"
                id="name"
                placeholder="Full Name"
                class="formbold-form-input"
              />
            </div>
            <div class="formbold-mb-5">
              <label for="Id" class="formbold-form-label">ID</label>
              <input
                type="text"
                name="id"
                id="id"
                placeholder="Enter your ID  "
                class="formbold-form-input"
              />
            </div>
            <div class="formbold-mb-5">
              <label for="email" class="formbold-form-label">Department </label>
              <input
                type="text"
                name="department"
                id="email"
                placeholder="Enter your Address"
                class="formbold-form-input"
              />
            </div>

            <div class="flex flex-wrap formbold--mx-3">
                <div class="w-full sm:w-half formbold-px-3">
                  <div class="formbold-mb-5 w-full">
                    <label for="date" class="formbold-form-label"> Date </label>
                    <input
                      type="date"
                      name="dates"
                      id="date"
                      class="formbold-form-input"
                    />
                  </div>
                </div>
                <div class="w-full sm:w-half formbold-px-3">
                  <div class="formbold-mb-5">
                    <label for="time" class="formbold-form-label"> Time </label>
                    <input
                      type="time"
                      name="times"
                      id="time"
                      class="formbold-form-input"
                    />
                  </div>
                </div>
              </div>

             
                </div>
             

           
            </div>
    
            <div>
             <center> <button name="submit" class="formbold-btn">Book Appointment</button></center>
</div>
          </form>
        </div>
      </div>

           <div id="fd">
            <a href="appointmentschedule.php">See Appointment</a>
          </div>

 
</body>
</html>