<?php
	require_once 'connect.php';
	include 'includes/head.php';
	include 'includes/navigation.php';
?>

<?php
	
	if(isset($_POST['login'])){
		
		$email = $_POST['email'];
		$email = trim($email);
		$password = $_POST['password'];
		$password = trim($password);
		
		$query = $db->query("SELECT * FROM users WHERE email = '$email'");
		$user = mysqli_fetch_assoc($query);
		$userCount = mysqli_num_rows($query);
		
		if(!password_verify($password, $user['password'])){
			header('Location: index.php');
		}else{
			$user_id = $user['id'];
			login($user_id);
		}
		
		
		
		
	}
?>

<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form method="POST" name="loginform" action="login.php" onsubmit="return validateForm()">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

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

                        <div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<input name="login" class="btn btn-sm btn-primary" type="submit" value="Login">
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
	  var x = document.forms["loginform"]["email"].value;
	  if (x == "") {
		alert("Email must be filled out");
		return false;
	  }
	  var y = document.forms["loginform"]["password"].value;
	  if (y == "") {
		alert("Password must be filled out");
		return false;
	  }
	}
</script>