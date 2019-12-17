<?php
session_start();
require_once 'Connection.php';
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
  <h4>Rate Student</h4>
  <form method="POST">
    <div class="form-group">
      <label for="grade">Grade</label>
      <select class="form-control" id="grade" name="gradeMark">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>        
      </select>
    </div>
    <div class="form-group">
    <label for="comment">Example textarea</label>
    <textarea style="resize: none;" rows="10" class="form-control" id="comment"></textarea>
  </div>
  <div class="form-group">
    <div class="custom-file">
    <input type="file" class="custom-file-input" id="customFile">
    <label class="custom-file-label" for="customFile">Choose file</label>
  </div>
  </div>
</form>
    <div class="text-center">
    <button style="padding: 10px 50px 10px 50px;" type="submit" name="SaveEvaBtn" class="btn btn-outline-primary">Save</button>
    <button style="padding: 10px 50px 10px 50px;" type="submit" name="FinaliseBtn" class="btn btn-outline-success">
    Evaluate</button>
    <button style="padding: 10px 50px 10px 50px;" type="submit" name="DeleteBtn" class="btn btn-outline-danger">Delete</button>
</div>
<br/>

<script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

</body>
</html>