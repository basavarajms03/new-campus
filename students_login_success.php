<?php

session_start();

include "./dbcon/dbcon.php";

$usn = strtoupper($_POST['usn']);
$password = $_POST['password'];

$result = mysqli_query($con, "select * from students_registration where usn = '$usn' and password = '$password'") or die(mysqli_error($con));
$count = mysqli_num_rows($result);

if($count > 0){
    $_SESSION['usn'] = $usn;
    ?>
    <script>
        alert("Login Successful");
        document.location = "students_home.php";
    </script>
    <?php
}else{
    ?>
    <script>
        alert("Sorry! Username or Password wrong");
        document.location = "students_login.php";
    </script>
    <?php
}
