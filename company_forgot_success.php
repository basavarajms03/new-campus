<?php

include "./dbcon/dbcon.php";

$emailid = $_POST['emailid'];


$result = mysqli_query($con, "select * from company_registration where email_id = '$emailid'") or die(mysqli_error($con));
$count = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

if($count > 0){
	$to = $emailid;
        $subject  = 'Campus Recruitment - Forgot password';
        $message  = '<font face="verdana"><p style="font-family:verdana">Hi</p>
                <p>Your company username and password as shown below</p>
                <p><b>Company Id</b> &nbsp; : &nbsp; '.$row['company_id'].'<br>
                <b>Password</b> &nbsp; : &nbsp; '.$row['password'].'</p>';
        $headers  = 'From: pverify03@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';
		mail($to, $subject, $message, $headers);
		?>
		<script>
			alert("Your username and password sent to your email");
            document.location = "index.php";
		</script>
		<?php
}else{
	?>
		<script>
			alert("Email id does not exist please register.");
            document.location = "index.php";
		</script>
	<?php
}
?>

