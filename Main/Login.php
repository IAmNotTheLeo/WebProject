<?php 
require_once 'Connection.php';
session_start();
$inputIDLogin = $_POST['StuID'];
$inputPasswordLogin = md5($_POST['StuPassword']);
$cookieSet = setcookie("UserIdentification", $inputIDLogin, time() + 86400);
$cookieIsset = $_COOKIE['UserIdentification'];

if (isset($_POST['LoginInto'])) {
  $queryLogin = "SELECT * FROM User WHERE UserID = '$inputIDLogin' AND UserPassword = '$inputPasswordLogin'";
  $resultLogin = $connect->query($queryLogin);

  if ($resultLogin->num_rows > 0) {

    $row = $resultLogin->fetch_array();

    if ($row['UserID'] != "000000000") {
      $_SESSION['StudentIDNum'] = $row['UserID'];
      $_SESSION['StudentGroupNum'] = $row['UserGroup'];
      $cookieSet;
      header("Location: StudentPage.php");
    } else {
      $cookieSet;
      $_SESSION['TutorIDNum'] = $row['UserID'];
      header("Location: TutorPage.php");
    }

  } else {
    $errorLogin = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Username or Password Incorrect</strong> - Please Enter Valid Login</div>";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
        <a class="nav-link" href="Register.php">Register</a>
      </li>
    </ul>
  </div>  
</nav>
<br>
<div class="container">
  <h2>Login</h2>
  <form method="POST">
    <div class="form-group">
      <label for="studentID">ID:</label>
      <input value="<?php if(isset($inputIDLogin)) echo $inputIDLogin; elseif(isset($cookieIsset)) echo $cookieIsset; ?>" type="tel" class="form-control" maxlength="9" id="studentID" placeholder="ID" name="StuID" >
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Password" name="StuPassword" >
    </div>
    <?php echo $errorLogin; ?>
    <button type="submit" name="LoginInto" class="btn btn-outline-success">Login</button>
  </form>
</div>
<br/>
</body>
</html>