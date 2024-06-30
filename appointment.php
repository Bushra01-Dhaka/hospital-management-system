<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <!-- for css -->
    <style>
    *{
        margin: 0;
        padding: 0;
     }
     body{
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        /* background: linear-gradient(to right, lightseagreen , lightgray); */
     }
     h1{
        padding-top: 50px;
     }
     a{
        text-decoration: none;
        color: white;
     }
     .header_part{
        padding: 20px;
        text-align: center;
        background-color: lightseagreen;
        color: white;
        text-transform: uppercase;
     }
     .form-container{
        width: 600px;
        margin: 0 auto;
        text-align: center;
        padding: 40px;
     }
     .box_container{
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        gap: 50px;
        width: 600px;
     }

     label{
        display: block;
        text-align: start;
        padding:  0 10px;
     }
     input[type="text"],
     input[type="number"],
     input[type="datetime-local"],
     select
     {
         padding: 10px;
         width: 100%;
         margin-bottom: 20px;
         border-radius: 50px;
     }
     .btn{
        width: 100%;
        padding: 16px;
        border: none;
        border-radius: 50px;
        background-color: lightseagreen;
        color: white;
        cursor: pointer;
        box-shadow: 5px;
        font-weight: bold;
     }
     .btn:hover{
        background-color: gray;
     }

    </style>
</head>
<body>
    <!-- heading -->
    <div class="header_part">
       <a href="index.html"> <h2>Hospital Management System</h2></a>
    </div>
    <h1>Make An Appointment</h1>

      

     <?php
        //database connection
        if($_SERVER["REQUEST_METHOD"] == "POST"){
         $connection = mysqli_connect("localhost", "root", "", "hospital-system");
         if(!$connection){
            die("Connection Failed" . mysqli_connect_error());
         }

         //Retrieve from data
         $patient_id = mysqli_real_escape_string($connection, $_POST['patient_id']);
         $patient_name = mysqli_real_escape_string($connection, $_POST['patient_name']);
         $appointment_time = mysqli_real_escape_string($connection, $_POST['appointment_time']);
         $phone = mysqli_real_escape_string($connection, $_POST['phone']);
         $doctor_name = mysqli_real_escape_string($connection, $_POST['doctor_name']);

         //insert into database
         $sql = "INSERT INTO appointments(patient_id, patient_name, appointment_time, phone, doctor_name)
         VALUES ('$patient_id', '$patient_name', '$appointment_time', '$phone', '$doctor_name')";

         if(mysqli_query($connection, $sql)){
            echo "<p>Appointment Added Successfully.</p>";
         }
         else{
            echo "<p>Error: " . mysqli_error($connection) . "</p>";
         }
         mysqli_close($connection);
        }
     ?>












    <!-- form container -->
     <div class="form-container">
       <form action="appointment.php" method="post">

        <div class="box_container">
            <div>
                <label for="patient_id">Patient Id</label>
                <input type="number" name="patient_id" id="patient_id" placeholder="patient id" required>
             </div>
             <div>
               <label for="patient_name">Patient Name</label>
               <input type="text" name="patient_name" id="patient_name" placeholder="patient name" required>
            </div>
        </div>

        <div>
            <label for="appointment_time">Appointment time</label>
            <input type="datetime-local" name="appointment_time" id="appointment_time" placeholder="appointment time" required>
         </div>
         <div>
            <label for="phone">Phone Number</label>
            <input type="number" name="phone" id="phone" placeholder="Phone number" required>
         </div>
         <div>
            <label for="doctor_name">Doctor Name</label>
            <select type="text" name="doctor_name" id="doctor_name">
                <option value="">Select Doctor</option>
                <option value="Dr. Asgar">Dr. Asger</option>
                <option value="Dr. Forhad"> Dr. Forhad</option>
                <option value="Dr. Kobra">Dr. Kobra</option>
            </select>
         </div>

         <div>
            <input class="btn" type="submit" value="Make Appointment">
         </div>



       </form>

     </div>

</body>
</html>