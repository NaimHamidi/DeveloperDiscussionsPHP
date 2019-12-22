<?php
	require_once 'connect.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
	if(is_logged_in()){
		login_error_redirect();
	}
?>

<?php
	if(isset($_POST['register'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordconfirm = $_POST['password-confirm'];
		if($_POST['name'] != '' && $_POST['email'] && $_POST['password'] && $_POST['password-confirm']){
			if($password == $passwordconfirm){
				$hashedpass = password_hash($password, PASSWORD_DEFAULT);
				$sql = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$hashedpass')";
				$db->query($sql);
				header('Location: login.php');
			}
		}
	}
?>


<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form method="POST" action="register.php" name="registerForm" onsubmit="return validateForm()">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password-confirm">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input class="btn btn-primary" name="register" value="Register" type="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	function validateForm() {
	  var x = document.forms["registerForm"]["name"].value;
	  if (x == "") {
		alert("Name must be filled out");
		return false;
	  }
	  var y = document.forms["registerForm"]["email"].value;
	  if (y == "") {
		alert("E-mail must be filled out");
		return false;
	  }
	  var y = document.forms["registerForm"]["password"].value;
	  if (y == "") {
		alert("Password must be filled out");
		return false;
	  }
	  var y = document.forms["registerForm"]["password-confirm"].value;
	  if (y == "") {
		alert("Password-Confirm must be filled out");
		return false;
	  }
	}
</script>