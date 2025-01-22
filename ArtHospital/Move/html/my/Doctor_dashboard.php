<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Docter page</title>
    <link rel="stylesheet" href="css/doc.css">
</head>
<body>
    <div class="header">
        <div class="doctor">Doctor

        </div>
        
    </div>



    <br> <br>

    <div class="container">
        <div class="leftcont">
            
        <center>
  <div class="srch">
    <form action="" method="post" style="display: flex; align-items: center;" onsubmit="event.preventDefault(); myFunction();">
      
        <input type="search" id="search" name="search" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width:350px;" placeholder="Search" > 
        <button type="submit" style="background-color: #009879; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">
      <i class="fa fa-search" style="font-size: 16px;"></i>
    </button>
      </form>      
    </div>          
 </center>  
 <br>

    <div class="popup" id="popup">
          
        </div>

              <?php



include 'db_con.php';

// Fetch data from the appointment table
$sql = "SELECT * FROM appointment";
$result = $conn->query($sql);
?>
<?php


echo '<table class="content-table3" id="popup2">';
echo '<caption><h2>Appointment</h2></caption>';
echo '<thead>';
echo '<tr>';
echo '<th>No</th>';
echo '<th>Full Name</th>';
echo '<th>Id No</th>
<th>Department</th>
<th>Dates</th>
<th>Timess</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';


if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
                echo "<td>" . $row["No"] . "</td>";
                echo "<td>" . $row["Full_Name"] . "</td>";
                echo "<td>" . $row["Id_No"] . "</td>";
                echo "<td>" . $row["Department"] . "</td>";
                echo "<td>" . $row["Dates"] . "</td>";
                echo "<td>" . $row["Timess"] . "</td>";
                echo "</tr>";
  }
} else {
  echo '<tr><td colspan="6">No records found</td></tr>';
}


echo '</tbody>';
echo '</table>';

?>
      


             

              <?php
   

   include 'db_con.php';
    
    
    // Fetch data from the appointment table
    $sql = "SELECT * FROM lab_results";
    $result = $conn->query($sql);
    ?>
    
    <table class="content-table4" id="popup4">
                <!-- Table content -->
                <caption><h2>Lab Report</h2></caption>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Sex</th>
                        <th>Age</th>
                        <th>ID Number</th>
                        <th>Tests</th>
                        <th>Others</th>
                        <th>Widal Test</th>
                        <th>Plory Test</th>
                        <th>BFS</th>
                        <th>Stool</th>
                        <th>WF</th>
                        <th>HCG</th>
                        <th>UA</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch data from the lab_result table
                    $sql = "SELECT * FROM lab_results";
                    $result = $conn->query($sql);

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
                            echo "<td>" . $row["timestamp"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='14'>No records found</td></tr>";
                    }

                    // Close the result set
                    $result->close();
                    ?>
                </tbody>
            </table>
        </div>
        
        
        
           <div class="rightcont">

           <button cls="btn "><a href="labreq.html">Request to Lab</a></button><br>
           <button cls="btn "  onclick="myFunction4()"  id="disp">View report</button><br>
           <button onclick="myFunction2()" cls="btn " id="viweapt">View Appointment</button><br>
           <button  cls="btn"><a href="pharmpre.html">prescribe</a></button><br>
           <button cls="btn "><a href="patienthistory.html">Record history</a></button><br>




        </div>

<style>
    a{
            text-decoration: none;
            color: white;
        }
        a:hover{
            color: #ba7878;
        }
</style>

    </div>
      

    




    <script>
        function myFunction() {
      var x = document.getElementById("popup");
      if (x.style.display = "none") {
          x.style.display = "block";
      }
  }
  
        </script>

<script>
  function myFunction2() {
var y = document.getElementById("popup2");
if (y.style.display === "none") {
    y.style.display = "block";
    document.getElementById('viewapt').innerHTML = "Hide Apointment";
}
else{
  y.style.display="none";

}
}

  </script>


<script>
  function myFunction4() {
var y = document.getElementById("popup4");
if (y.style.display === "none") {
    y.style.display = "block";
    
}
else{
  y.style.display="none";

}
}

  </script>



<script>
      function myFunction() {
    var searchValue = document.getElementById('search').value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "searchhistory.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            document.getElementById('popup').innerHTML = this.responseText;
            document.getElementById('popup').style.display = 'block';


        }
    }
    xhr.send("search=" + searchValue);
}

    </script>





</body>
</html>