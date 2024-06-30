<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All appointment</title>
    <!-- add css -->
     <link rel="stylesheet" href="style.css">

     <style>
           table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 2px solid gray;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
     </style>

</head>
<body>
      <!-- heading -->
      <div class="header_part">
        <a href="index.html"> <h2>Hospital Management System</h2></a>
     </div>
     <h1>All Appointments </h1>

     <!-- form container -->
      <div class="form-container">
        <form action="showAppointment.php" method="get">
            <div>
                <label for="doctor_name">doctor Name</label>
                <input type="text" id="doctor_name" name="doctor_name" placeholder="Enter Doctor's Name">
             </div>

             <div>
                <input class="btn" type="submit" value="Search">
             </div>
        </form>
      </div>

      <?php 
       $connection = mysqli_connect("localhost", "root", "", "hospital-system");
       if(!$connection){
        die("Connection Failed" . mysqli_connect_error());
       }

      //  Retrieve data from database
      $query = "SELECT * FROM appointments";
      if(isset($_GET['doctor_name']) && !empty($_GET['doctor_name'])){
        $doctor_name = mysqli_real_escape_string($connection, $query);
        $query .= " WHERE doctor_name LIKE '%$doctor_name%'";
      }

      $result = mysqli_query($connection, $query);
      if(mysqli_num_rows($result) > 0){
        echo "<table>";
        echo "<tr>
              <th>Patient Id</th>
              <th>Patient Name</th>
              <th>Appointment time</th>
              <th>Phone Number</th>
              <th>Doctor Name</th>
        </tr>";

        // output
        while($row = mysqli_fetch_assoc($result)){
          echo "<tr>
             <td>" . $row['patient_id'] ."</td>
             <td>" . $row['patient_name'] ."</td>
             <td>" . $row['appointment_time'] . "</td>
             <td>" . $row['phone'] ."</td>
             <td>" . $row['doctor_name'] . "</td>
          </tr>";
        }
        echo "</table>";
      }
      else{
        echo "<p> No Appointment Found. </p>";
      }

       mysqli_close($connection);
      ?>
    
</body>
</html>