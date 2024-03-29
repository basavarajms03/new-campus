<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Students Home | Campus Recruitment</title>
</head>

<body>
    <!-- Nav Bar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><i class="fa fa-university"></i>&nbsp;CR System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="students_ongoing_placements.php">Ongoing Placements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="students_shortlisted_placements.php">Shortlisted Placements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="students_available_tests.php">Available Tests</a>
                </li>
            </ul>
            <span class="navbar-text">
                <?php
                session_start();
                echo $_SESSION['usn'];
                ?>
            </span>
            <span class="navbar-text pl-3">
                <a href="logout.php" style="text-decoration:none;color:rgba(255,255,255,.5)">Logout</a>
            </span>
        </div>
    </nav>
    <!--- Nav Bar End -->
    <!-- Display Added Jobs From Company -->
    <?php
    include "./dbcon/dbcon.php";
    $result = mysqli_query($con, "SELECT j.id,c.company_name,j.designation,j.date, j.salary FROM company_registration c, jobs j, students_registration s
    WHERE c.company_id = j.company_id AND j.GMarks <= s.UgAgg
    AND j.PMarks <= s.PDAgg
    AND j.HMarks <= s.Hagg
    AND j.department = s.department
    AND s.usn = '$_SESSION[usn]' AND j.test = 1") or die(mysqli_error($con));
    ?>

    <table class="table table-striped w-100">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Designation</th>
                <th>Drive Date</th>
                <th>Salary</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_array($result)){
                        $taken_test = mysqli_query($con, "select * from students_test_taken where usn = '$row[0]'") or die(mysqli_error($con));
                        if(mysqli_num_rows($taken_test) > 0){
                            $take_test = "";
                        } else {
                            $take_test = "Take Test";
                        }
                        echo "<tr><td>";
                        echo $row[1];
                        echo "</td><td>";
                        echo $row[2];
                        echo "</td><td>";
                        echo $row[3];
                        echo "</td><td>";
                        echo $row[4];
                        echo "/-</td><td>";
                        echo "<a href='students_take_test_instruction.php?jobid=".$row[0]."'>";
                        echo "$take_test</td></tr>";
                    }
                ?>
            </tbody>
    </table>