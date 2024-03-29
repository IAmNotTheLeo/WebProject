<?php
session_start();
require_once 'Connection.php';
require 'Session.php';
$selectGroup = $_POST['TutorSelect'];
if (isset($_POST['groupBtn'])) {
if (empty($selectGroup)) {
    $errorSelect = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Select Group</strong></div>";
  } else {
    $_SESSION['groupSelect'] = $selectGroup;
    header("Location: TutorStudentSelect.php");
  }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Tutor</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="sweetalert2.min.css">
    <script src="sweetalert2.min.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar bg-dark navbar-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
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
<div class="container">
  <form method="POST">
  <h4>Tutor: </h4>
  <div class="form-group">
    
      <label for="group">Select Group:</label>
      <select class="form-control" id="group" name="TutorSelect">
        <option value="" hidden selected disabled>Select Group</option>
        <?php 
        // Will only display group that are available
        for ($i=1; $i <= 10; $i++) { 
            $queryGroupLimit = "SELECT * FROM User WHERE UserGroup = '". $i ."'";
            $resultGroupLimit = $connect->query($queryGroupLimit);
            if ($resultGroupLimit->num_rows >= 2) {
              echo "<option value='". $i ."' ".$select ." >". "Group " . $i ."</option>";
            } 
          } 
        ?>     
      </select>
    </div>
    <?php echo $errorSelect; ?>
    <div class="form-group">
      <button style="padding: 10px 50px 10px 50px;" type="submit" name="groupBtn" class="btn btn-outline-success">Proceed</button>
    </div>
</form>
</div>
<br/>
</body>
</html>