<?php

$con = mysqli_connect("localhost", 'root', '', 'campusrecruitment') or die(mysqli_error($con));

mysqli_select_db($con, "campusrecruitment") or die(mysqli_error($con));
