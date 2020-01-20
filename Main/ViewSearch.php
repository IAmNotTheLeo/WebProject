<?php
session_start();
require_once 'Connection.php';
require 'Session.php';
$option = $_SESSION['selectedOption'];
$search = $_SESSION['searchValue'];
$radio = $_SESSION['selectedRadio'];
$tutorID = "000000000";
$orderBy = "";
//https://www.geeksforgeeks.org/php-pagination-set-2/ - Pagination

if (empty($search) && $radio == "LowRadio" && $option == "ID") {
  $orderBy = "ORDER BY UserID ASC";
} elseif (empty($search) && $radio == "HighRadio" && $option == "ID"){
  $orderBy = "ORDER BY UserID DESC";
} elseif (empty($search) && $radio == "LowRadio" && $option == "Grade") {
  $orderBy = "ORDER BY UserGrade ASC";
} elseif (empty($search) && $radio == "HighRadio" && $option == "Grade") {
  $orderBy = "ORDER BY UserGrade DESC";
}

$dataPerPage = 3;
if (isset($_GET["paginationPage"])) {  
  $pageNumber  = $_GET["paginationPage"];
}  
else {  
  $pageNumber = 1;  
}   
    $startPage = ($pageNumber - 1) * $dataPerPage;   
    if (empty($search && $option) || empty($search || $option)) {
      $queryPagin = "SELECT * FROM User WHERE UserID != '$tutorID' $orderBy LIMIT $startPage, $dataPerPage";   
      $resultPagin = $connect->query($queryPagin); 
    }
    else if ($option == "Grade") {
      $queryPagin = "SELECT * FROM User WHERE UserID != '$tutorID' AND UserGrade LIKE '$search%' ORDER BY UserGrade ASC LIMIT $startPage, $dataPerPage";   
      $resultPagin = $connect->query($queryPagin); 
    } 
    else if ($option == "ID") {
      $queryPagin = "SELECT * FROM User WHERE UserID != '$tutorID' AND UserID = '$search'";   
      $resultPagin = $connect->query($queryPagin);
    }

     
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
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
        <a class="nav-link" href="Search.php">Search</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Logout.php">Logout</a>
      </li>
    </ul>
  </div>  
</nav>

<br/>
<div class="container">
  <?php  if($resultPagin->num_rows > 0) { ?>
  <table class="table" style="text-align: center; table-layout: fixed;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" style="border-right: 1px grey solid;">Student ID</th>
      <th scope="col">Grade</th>
    </tr>
  </thead>
  <tbody>
<script>
function leadZero(str, max) {
  str = str.toString();
  if (str.length < max) {
    return leadZero("0" + str, max);
  } else {
    return str;
  }
}
  function submitForm(id) {
  document.getElementById('idSelect').value = leadZero(id, 9);
  document.forms['form'].submit();
}
</script>

<?php while ($row = $resultPagin->fetch_array()) {  ?>
  <tr>
    <form method="POST" name="form">
    <input type="hidden" id="idSelect" name="studentID">
    <?php $Studentid = $row['UserID']; ?>
    <td><?php echo "<a href=javascript:submitForm($Studentid);>" . $row['UserID'] . "</a>"; ?></td>
  </form>
    <td><?php 
    if ($row['UserGrade'] == NULL) {
      echo "Yet to be Graded";
    } else {
      echo $row['UserGrade']; 
    }
    ?></td>
  </tr>
  <?php }; ?>

  </tbody>
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">

<?php 
if (empty($search && $option) || empty($search || $option)) {
 $queryPagin = "SELECT * FROM User WHERE UserID != '$tutorID'";
}
  else if ($option == "Grade") {
  $queryPagin = "SELECT * FROM User WHERE UserID != '$tutorID' AND UserGrade LIKE '$search%'";
} else if ($option == "ID") {
  $queryPagin = "SELECT * FROM User WHERE UserID != '$tutorID' AND UserID = '$search'";
}
$resultPagin = $connect->query($queryPagin);   
$totalRecords = $resultPagin->num_rows;      
$totalPages = ceil($totalRecords / $dataPerPage);

for ($i = 1; $i <= $totalPages; $i++) { 
  if($i == $pageNumber) 
    echo "<li class='page-item active'><a class='page-link' href='ViewSearch.php?paginationPage=".$i."'>".$i."</a></li>"; 
  else
    echo "<li class='page-item '><a class='page-link' href='ViewSearch.php?paginationPage=".$i."'>".$i."</a></li>";  
}   
?>
</ul>
</nav>
<?php  
if (isset($_POST['studentID'])) {
  $idSelect = $_POST['studentID'];
  $queryDisplayProfile = "SELECT UserID, UserEmail, UserGroup,UserGrade FROM User WHERE UserID = '$idSelect'";
  $resultDisplayProfile = $connect->query($queryDisplayProfile);
?>
<div class="card" style="width: 18rem; margin: 0 auto; margin-top: -2%;">
  <img class="card-img-top" src="Images/Sample.jpg" width="286" height="180" alt="Student">
  <div class="card-body">
    <h5 class="card-title">Student Profile</h5>
    <p class="card-text">
      <?php
      while ($row = $resultDisplayProfile->fetch_array()) {
        echo "<b>ID: </b>" . $row['UserID'] . "<br/>";
        echo "<b>Email: </b>" . $row['UserEmail'] . "<br/>";
        echo "<b>Group: </b>" . $row['UserGroup'] . "<br/>";
        if ($row['UserGrade'] == NULL) {
          echo "<b>Grade: </b>Yet to be Graded<br/>";
        } else {
          echo "<b>Grade: </b>" . $row['UserGrade'] . "<br/>";
        }
      }
      ?>
    </p>
  </div>
</div>
<?php } ?>
<?php } else { ?>
  <div style="text-align: center; font-size: 20px;" class="alert alert-danger"><strong>No Record Available</strong></div>
  <button type="button" onclick="window.location.href='Search.php'" class="btn btn-outline-primary">Back</button>
<?php } ?>

</div>
</body>
</html>