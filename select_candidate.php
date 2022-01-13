<?php

session_start();

include './dbcon/dbcon.php';

if (!empty($_POST['check_list'])) {
    // Loop to store and display values of individual checked checkbox.
    foreach ($_POST['check_list'] as $selected) {
        $id_info = explode(':', $selected);

        echo $id_info[0] . " " . $id_info[1];
        $company_id = $_SESSION['CompanyId'];
        $usn = $id_info[0];
        $JobId = $id_info[1];

        $success = mysqli_query($con, "insert into selected_candidates values('$company_id','$JobId','$usn')") or die(mysqli_error($con));
		
		$students_info = mysqli_query($con, "select email from students_registration where usn = '$usn'") or die(mysqli_error($con));
		$stud_data = mysqli_fetch_array($students_info);
		
		$comp_info = mysqli_query($con, "select company_name from company_registration where company_id = '$company_id'") or die(mysqli_error($con));
		$comp_data = mysqli_fetch_array($comp_info);
		
		$to       = $stud_data['email'];
        $subject  = 'Campus Recruitment';
        $message  = '<font face="verdana"><p style="font-family:verdana">Hi</p>
                <p>You are selected for a <b>Company: '.$comp_data[0]. '</b></p>
                <p>For more information please contact your placement officer.</p>';
        $headers  = 'From: pverify03@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';
		mail($to, $subject, $message, $headers);
		
    }
}

if ($success) {
?>
    <script>
        alert("Students has been selected");
        document.location = 'check_selected_students.php';
    </script>
<?php
} else {
?>
    <script>
        alert("Something went wrong");
        document.location = 'check_selected_students.php';
    </script>
<?php
}
