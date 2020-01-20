<?php
session_start();
require 'Session.php';
$option = $_POST['tutorOption'];
$search = $_POST['searchInput'];
$radio = $_POST['optradio'];
$_SESSION['selectedOption'] = "";
$_SESSION['searchValue'] = "";
$_SESSION['selectedRadio'] = "";
$cookieSet = setcookie("Search", $search, time() + 86400 * 2); // 2 Day
$cookieIsset = $_COOKIE['Search'];

if (isset($_POST['searchBtn'])) {    
  if ($option == TRUE && !empty($search)) {
      $_SESSION['selectedOption'] = $option;
      $_SESSION['searchValue'] = $search;
      $cookieSet;
      header("Location: ViewSearch.php");
  } else {
    if ($radio == TRUE) {
      $_SESSION['selectedOption'] = $option;
      $_SESSION['searchValue'] = $search;
      $_SESSION['selectedRadio'] = $radio;
      header("Location: ViewSearch.php");
    } else {
    $_SESSION['selectedOption'] = "";
    $_SESSION['searchValue'] = $search;
    header("Location: ViewSearch.php");
    }
  }
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
        <a class="nav-link" href="TutorPage.php">Homepage</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Logout.php">Logout</a>
      </li>
    </ul>
  </div>  
</nav>
<br>
<div class="container">
  <h4>Search:</h4>
  <form method="POST">
  	<div class="form-group">
      <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1"><img width="18" height="18" src="Images/SearchIcon.png"></span>
  </div>
  <input value="<?php if(isset($cookieIsset)) echo $cookieIsset; ?>" name="searchInput" maxlength="9" type="text" class="form-control" placeholder="Search">
</div>
	</div>
<div class="form-group">
  <label for="option">Sort By:</label>
  <select class="form-control" id="option" name="tutorOption">
    <option value="" selected hidden disabled>Select Option</option>
    <option value="ID">ID</option>
    <option value="Grade">Grade</option>
</select>
</div>
<div class="form-group">
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="optradio" value="LowRadio">Low</label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="radio" class="form-check-input" name="optradio" value="HighRadio">High</label>
</div>
</div>
<div class="form-group">
      <button name="searchBtn" style="padding: 10px 50px 10px 50px;" type="submit" class="btn btn-outline-success">Search</button>
    </div>
  </form>
</div>
<br/>
</body>
</html>