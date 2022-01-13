<?php

$id = $_GET['question_no'];

include "./dbcon/dbcon.php";

$sql_stat = mysqli_query($con, "delete from test where text_id = $id") or die(mysqli_error($con));

if ($sql_stat) {
?>
    <script>
        alert("Question is deleted successfuly");
        document.location = "company_add_test_questions.php";
    </script>
<?php
} else {
?>
    <script>
        alert("Error while deleting question");
        document.location = "company_add_test_questions.php";
    </script>
<?php
}
