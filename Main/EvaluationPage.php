<?php
session_start();
require_once 'Connection.php';
require 'Session.php';
$selectGrade = $_POST['gradeMark'];
$inputFeedback = $_POST['evaFeedback'];
if (!($_FILES['fileUpload']['type'])) {
} else {
  $uploadImage = addslashes(file_get_contents($_FILES['fileUpload']['tmp_name']));
}
$imageType = $_FILES['fileUpload']['type'];
$evaTO = $_SESSION['SelectedMem'];
$evaFROM = $_SESSION['StudentIDNum'];
$groupNum = $_SESSION['StudentGroupNum'];
$error = array();
$queryEva = "SELECT * FROM Finalise WHERE StudentFrom = '$evaFROM' AND StudentTo = '$evaTO'";
$resultEva = $connect->query($queryEva);

$querySvd = "SELECT * FROM Saved WHERE StudentFrom = '$evaFROM' AND StudentTo = '$evaTO'";
$resultSvd = $connect->query($querySvd);


if (isset($_POST['FinaliseBtn']) || isset($_POST['SaveBtn'])) {
  if ($resultEva->num_rows == 1) {
    $msg = "<div style='text-align: center; font-size: 20px;' class='alert alert-danger'><strong>Student Already Evaluated</strong></div>";
  } else {
  if (empty($selectGrade)) {
    $errorSelect = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Select Grade</strong></div>";
      array_push($error, '1');
  }
  if (empty($inputFeedback)) {
    $errorFeedback = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Feedback Required</strong></div>";
      array_push($error, '2');
  }

  if (!($_FILES['fileUpload']['type'])) {
  
  } 
  else if (!preg_match('/(gif|png|x-png|jpeg|jpg)/', $_FILES['fileUpload']['type'])) {
    $errorImage = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Image File Incompatible</strong></div>";
    array_push($error, '3');
  } 
  else if ($_FILES['fileUpload']['size'] > 16384) {
    $errorImage = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>File Too Large</strong></div>";
    array_push($error, '4');
  }

  if (count($error) == 0) {
    if (isset($_POST['FinaliseBtn'])) {
        $queryFinal = "INSERT INTO Finalise (Grade, Feedback, Image, ImageType, StudentFrom, StudentTo) VALUES ('". $selectGrade ."', '".$inputFeedback ."', '". $uploadImage ."', '". $imageType ."', '". $evaFROM ."', '". $evaTO ."')";
        $connect->query($queryFinal);

        $queryGradeTo = "SELECT * FROM Finalise WHERE StudentTo = '$evaTO'";
        $resultGradeTo = $connect->query($queryGradeTo);

        while ($row = $resultGradeTo->fetch_array()) {
        if ($resultGradeTo->num_rows == 2) {
          $result += $row['Grade'] / 2;
          } else {
            $result = NULL;
          }
        }
        $queryGrade = "UPDATE User SET UserGrade = '$result' WHERE UserID = '$evaTO'";
        $connect->query($queryGrade);
        header("Location: StudentPage.php");
      }
    if (isset($_POST['SaveBtn'])) {
      if ($resultSvd->num_rows == 0) {
        $queryFinal = "INSERT INTO Saved (Grade, Feedback, StudentFrom, StudentTo) VALUES ('". $selectGrade ."', '".$inputFeedback ."', '". $evaFROM ."', '". $evaTO ."')";
        $connect->query($queryFinal);
        header("Location: StudentPage.php");
      } else {
        $queryUpdate = "UPDATE Saved SET Grade = '$selectGrade', Feedback = '$inputFeedback' WHERE StudentFrom = '$evaFROM' AND StudentTo = '$evaTO'";
        $connect->query($queryUpdate);
        header("Location: StudentPage.php");
        }
      }
    }
  }
}

if (isset($_POST['DeleteBtn'])) {
  if ($resultEva->num_rows == 1) {
    $msg = "<div style='text-align: center; font-size: 20px;' class='alert alert-danger'><strong>Student Already Evaluated</strong></div>";
  } else {
  if ($resultSvd->num_rows == 0) {
    $errorImage = "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>No Record to Delete</strong></div>";
  } else {
  $queryDelete = "DELETE FROM Saved WHERE StudentFrom = '$evaFROM' AND StudentTo = '$evaTO'";
  $connect->query($queryDelete);
  header("Location: StudentPage.php");
    }
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
        <a class="nav-link" href="StudentPage.php">Return</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Logout.php">Logout</a>
      </li>
    </ul>
  </div>  
</nav>
<br>
<div class="container">
<?php

while ($row = $resultSvd->fetch_array()){
    $savedGrade = $row['Grade'];
    $savedFeedback = $row['Feedback'];
}
    if ($resultEva->num_rows == 1) {
      $msg = "<div style='text-align: center; font-size: 20px;' class='alert alert-danger'><strong>Student Already Evaluated</strong></div>";
      echo $msg;
    } else {
  ?>
  <h4>Rate Student</h4>
  <form method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="grade">Grade:</label>
      <select class="form-control" id="grade" name="gradeMark">
        <option value="" selected hidden disabled>Select Grade</option>
        <?php
        
          for ($i=1; $i <= 10; $i++) {
            if ($savedGrade == $i) {
              $select = "selected=''";
            } 
            elseif ($selectGrade >= $i && $selectGrade <= $i) {
            $savedGrade = "";
            $select = "selected=''";
              }
            else {
              $select = "";
            }
            echo "<option value='". $i ."' ". $select .">". $i ."</option>";
          }
                    
          ?>
      </select>
    </div>
    <?php echo $errorSelect; ?>
    <div class="form-group">
    <label for="feedback">Feedback: </label>
    <textarea style="resize: none;" rows="10" class="form-control" id="feedback" name="evaFeedback"><?php if (isset($inputFeedback)) { echo $inputFeedback; } else { echo $savedFeedback; } ?></textarea>
  </div>
  <?php echo $errorFeedback; ?>
  <div class="form-group">
    <label for="customFile">Image: </label>
    <div class="custom-file">
    <label class="custom-file-label" for="customFile">Choose Image File</label>
    <input type="file" class="custom-file-input" name="fileUpload" id="customFile">
    <script>
  $(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
  </script>
  </div>
  </div>
  <?php echo $errorImage; ?>
  <div class="text-center">
    <button style="padding: 10px 50px 10px 50px;" type="submit" name="SaveBtn" class="btn btn-outline-primary">Save</button>
    <button style="padding: 10px 50px 10px 50px;" type="submit" name="FinaliseBtn" class="btn btn-outline-success">
    Finalise</button>
    <button style="padding: 10px 50px 10px 50px;" type="submit" name="DeleteBtn" class="btn btn-outline-danger">Delete</button>
</div>
</form>
</div>
<?php } ?>
  <br/>
</body>
</html>