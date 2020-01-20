<?php
session_start();
require_once 'Connection.php';
require 'Session.php';
$groupNum = $_SESSION['StudentGroupNum'];
$id = $_SESSION['StudentIDNum'];
$stuSelect = $_POST['selectMember'];

$queryGroupMem = "SELECT * FROM User WHERE UserGroup = '$groupNum' AND UserID != '$id'";
$resultGroupMem = $connect->query($queryGroupMem);

$queryEva = "SELECT * FROM Finalise WHERE StudentFrom = '$id' AND StudentTo = '$stuSelect'";
$resultEva = $connect->query($queryEva);

if (isset($_POST['EvaluateStu'])) {
  if ($resultEva->num_rows == 1) {
      $msg = "<div class='alert alert-danger'><strong>Student Already Evaluated</strong></div>";
    }
    else {
	   $_SESSION['SelectedMem'] = $stuSelect;
	   header("Location: EvaluationPage.php");
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Evaluation</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
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
        <a class="nav-link" href="Logout.php">Logout</a>
      </li>
    </ul>
  </div>  
</nav>
<br>
<div class="container">
  <?php if ($resultGroupMem->num_rows >= 2) { ?>
  <h4><?php echo "Student ID: " . $_SESSION['StudentIDNum']; ?></h4>
  <form method="POST">
  	<div class="form-group">
      <label for="mem">Select Student Member:</label>
      <select class="form-control" id="mem" name="selectMember">
        <?php 
          while ($row = $resultGroupMem->fetch_array()) {
          echo "<option value='". $row['UserID'] ."'>". $row['UserID'] ."</option>";
          }
        ?>  
      </select>
    </div>
    <?php echo $msg ?>
    <div class="text-center"> 
    <button style="padding: 10px 50px 10px 50px;" type="submit" name="EvaluateStu" class="btn btn-outline-success">Evaluate</button>
	</div>
  </form>
<?php 
} else {
  echo "<div style='text-align: center; font-size: 20px;' class='alert alert-danger'><strong>Not Enough Students to Evaluate</strong><br/>Return when more Students Join</div>";
} 
?>
</div>
<br/>
</body>
</html>