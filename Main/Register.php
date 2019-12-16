<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
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
        <a class="nav-link" href="">Homepage</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Register</a>
      </li>
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
      <input type="text" class="form-control" id="studentID" placeholder="Student ID" name="StuID" >
    </div>
    <div class="form-group">
      <label for="email">Student Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Student Email" name="StuEmail">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Password" name="StuPassword" >
    </div>
    <div class="form-group">
      <label for="group">Select Group:</label>
      <select class="form-control" id="group" name="stuGroup">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>        
      </select>
    </div>
    <button type="submit" class="btn btn-outline-success">Create Account</button>
  </form>
</div>
</script>

</body>
</html>