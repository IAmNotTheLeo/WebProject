<?php 

require_once 'Connection.php';
session_start();

$inputID = $_POST['StuID'];
$inputEmail = $_POST['StuEmail'];
$inputPassword = $_POST['StuPassword'];
$selectedGroup = $_POST['stuGroup'];
$inputCaptcha = $_POST['StuCAPTCHA'];
$error = array();
$captchaCorrect = str_replace(' ','', $_SESSION['CAPTCHA']);

if(isset($_POST['CreateAccount'])){
    $queryExist = "SELECT * FROM UserTable WHERE UserID = '". $inputID ."'";
    $resultExist = $connect->query($queryExist);

    $queryGroupLimit = "SELECT * FROM UserTable WHERE UserGroup = '". $selectedGroup ."'";
    $resultGroupLimit = $connect->query($queryGroupLimit);

    if (empty($inputID) || trim($inputID) == '') {
      $errorID = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Student ID Required</strong></div>";
      array_push($error, '1');

    }
     else if (!is_numeric($inputID)) {
      $errorID = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Numbers Only</strong></div>";
      array_push($error, '2');
    } 
     else if (strlen($inputID) != 9){
      $errorID = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>9 Numbers are Required</strong></div>";
      array_push($error, '3');
    } else if ($resultExist->num_rows == 1){
      $errorID = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Student Already Exist</strong></div>";
      array_push($error, '3');
    }
    if (empty($inputEmail) || trim($inputEmail) == '') {
       $errorEmail = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Email Required</strong></div>";
       array_push($error, '4');
     } 
     else if (!preg_match("/[a-z0-9._%+-]+@gre.ac.uk/",$inputEmail)) {
      $errorEmail = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Email Invalid e.g. 'example@gre.ac.uk'</strong></div>";
      array_push($error, '5');
 
    }
    if (empty($inputPassword) || trim($inputPassword) == '') {
       $errorPass = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Password Required</strong></div>";
       array_push($error, '6');
     } 
     else if (strlen($inputPassword) < 8) {
      $errorPass = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>8 Characters Minimum for Password</strong></div>";
      array_push($error, '7');
    }

    if ($resultGroupLimit->num_rows == 3) {
      $errorGroup = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Group is Full</strong> - Select another Group</div>";
      array_push($error, '8');
    }

    if (empty($inputCaptcha) || trim($inputCaptcha) == '') {
        $errorCAP = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>CAPTCHA Required</strong></div>";
        array_push($error, '9');
    }
    else if($inputCaptcha != $captchaCorrect){
        $errorCAP = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>CAPTCHA Wrong</strong></div>";
        array_push($error, '10');
    }

    if (count($error) == 0) {
      $queryCreate = "INSERT INTO UserTable (UserID, UserEmail, UserPassword, UserGroup, UserLevel) VALUES ('". $inputID ."', '". $inputEmail ."', '". md5($inputPassword) ."', '". $selectedGroup ."', 'Student')";
      $connect->query($queryCreate);
      $msg = "<script>Swal.fire({icon: 'success',title: 'Account Created',allowOutsideClick: false,confirmButtonText: 'Proceed',}).then((result) => {if (result.value) {location.href = 'Login.php';}})</script>";
      
      //$msg = "<script>alert('Account Created'); window.location.href='Login.php';</script>";

// THIS IS THE ALERT YOU WOULD NEED - THE ONE COMMMENTED OUT

    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="sweetalert2.min.css">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="sweetalert2.min.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
<body>
	<nav class="navbar bg-dark navbar-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" href="Login.php">Login</a>
      </li>    
    </ul>
  </div>  
</nav>
<br>

<div class="container">
  <h2>Registration</h2>
  <form method="POST">
    <div class="form-group">
      <label for="studentID">Student ID:</label>
      <input value="<?php if(isset($inputID)) echo $inputID; ?>" type="text" class="form-control" id="studentID" placeholder="ID" maxlength="9" name="StuID">
    </div>
    <?php echo $errorID; ?>
    <div class="form-group">
      <label for="email">Student Email:</label>
      <input value="<?php if(isset($inputEmail )) echo $inputEmail ; ?>" type="email" class="form-control" id="email" placeholder="Email" name="StuEmail">
    </div>
    <?php echo $errorEmail; ?>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Password" name="StuPassword"/>
    </div>
    <?php echo $errorPass; ?>
    <div class="form-group">
      <?php $group = range(1, 10); ?>
      <label for="group">Select Group:</label>
      <select class="form-control" id="group" name="stuGroup">
        <option value="" hidden selected disabled>Select Group</option>
        <?php foreach ($group as $selectedOne) { 
          if ($selectedOne == $selectedGroup) {
            $select = "selected='selected'";
          }
          else { 
          $select = ""; 
          }
          echo "<option value='". $selectedOne ."' ". $select ." >". "Group " . $selectedOne ."</option>";
          }
          ?>     
      </select>
    </div>
    <?php echo $errorGroup; ?>
      <div class="form-group">
          CAPTCHA:
          <br/>
          <label><img src="Captcha.php" /></label>
          <input type="text" class="form-control" placeholder="CAPTCHA" name="StuCAPTCHA">
      </div>
      <?php echo $errorCAP; ?>
    <button type="submit" class="btn btn-outline-success" name="CreateAccount">Create Account</button>
  </form>
    <br/>
</div>
<?php echo $msg; ?>
</body>
</html>