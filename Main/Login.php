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
        <a class="nav-link" href="#">Homepage</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Register.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Login</a>
      </li>    
    </ul>
  </div>  
</nav>
<br>

<div class="container">
  <h2>Login</h2>
  <form method="POST">
    <div class="form-group">
      <label for="studentID">Student ID:</label>
      <input type="text" class="form-control" id="studentID" placeholder="Student ID" name="StuID" >
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Password" name="pswd" >
    </div>
    <button type="submit" class="btn btn-outline-success">Login</button>
  </form>
</div>
</script>

</body>
</html>