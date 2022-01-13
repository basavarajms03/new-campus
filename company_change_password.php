<?php

session_start();

$company_id = $_SESSION['CompanyId'];
$new_pass = $_POST['new_pass'];

include "./dbcon/dbcon.php";

$update = mysqli_query($con, "update company_registration set password = '$new_pass' where company_id = '$company_id'") or die(mysqli_error($con));
if($update){
    ?>
    <script>
        alert("Password changes successfully");
        document.location = "company_profile.php";
    </script>
    <?php
}else{
    ?>
    <script>
        alert("Password changes successfully");
        document.location = "company_profile.php";
    </script>
    <?php    
}