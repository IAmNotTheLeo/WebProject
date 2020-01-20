<?php
session_start();
require_once 'Connection.php';
require 'Session.php';
$studentOption = $_SESSION['studentSelect'];
$ToStudent = $_POST['studentTo'];
$groupOnly = $_SESSION['groupSelect'];

$queryStuOnly = "SELECT * FROM User WHERE UserGroup = '$groupOnly' AND UserID != '$studentOption'";
$resultStuOnly = $connect->query($queryStuOnly);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="sweetalert2.min.css">
    <script src="sweetalert2.min.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
  .imagetext {
  position: relative;
  text-align: center;
  color: white;
  }
  .centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: rgba(0,0,0,0.6);
  border-radius: 10px;
  padding: 5px;
  }
    </style>
</head>
<body>
	<nav class="navbar bg-dark navbar-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="TutorStudentSelect.php">Return</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Search.php">Search</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Logout.php">Logout</a>
      </li>
    </ul>
  </div>  
</nav>
<br>
<div class="container" style="text-align: center;">
  <div class="card">
    <div class="card-header"><h4>Student</h4></div>
  <div class="card-body">
    <form method="POST">
    <label for="student">Select Student (From):</label>
      <select style="width: 40%; margin: 0 auto;" class="form-control form-control-sm" id="student" name="studentTo">
      <?php
      while ($row = $resultStuOnly->fetch_array()) {
        echo "<option value='". $row['UserID'] ."'>". $row['UserID'] ."</option>";
      }
      ?>
    </select>
  </div>
  <div class="card-body" style="border-top: 1px solid lightgrey;">
  <?php 
  if (isset($_POST['showBtn'])) {
  $queryStudentTo = "SELECT * FROM Finalise WHERE StudentFrom = '$studentOption' AND StudentTo = '$ToStudent'";
  $resultStudentTo = $connect->query($queryStudentTo);

  if ($resultStudentTo->num_rows == 0) {
    echo "No Record Available";
  } else {
  while ($row = $resultStudentTo->fetch_array()) {
    echo "<b>Rating Grade</b><br/>" . $row['Grade'] . "<br/>";
    echo "<b>Feedback</b><br/>" . $row['Feedback'] . "<br/>";
    echo "<b>Image</b><br/>";
    if (empty($row['Image'])) {
    echo "<div class='imagetext'><img style='border-radius: 3px;' width='120' height='100' src='Images/ImageAlt.png' /><div class='centered'><b>No Image</b></div></div>";
    } else {
    echo  "<img style='border-radius: 3px;' width='125' height='80' src='data:". $row['ImageType'] .";base64," .base64_encode($row['Image']). "'/>";
    }
    //https://stackoverflow.com/questions/20556773/php-display-image-blob-from-mysql
    }
  }
}

?>
  </div>
  <div class="card-footer">
    <button style="padding: 5px 35px 5px 35px;" type="submit" name="showBtn" class="btn btn-outline-success">Show</button>
  </div>
</form>
  </div>
</div>
<br/>
</body>
</html>