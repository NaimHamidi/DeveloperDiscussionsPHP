<?php

	$db = mysqli_connect('127.0.0.1','root','','developerdiscussionsdbphp');
	
	if(mysqli_connect_errno()){
		echo 'Database connection failed : ' . mysqli_connect_error();
		die();
	}

	session_start();
	
	function login($user_id){
		$_SESSION['SBUser'] = $user_id;
		
		header('Location: index.php');
	}
	
	function is_logged_in(){
		if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0){
			return true;
		}
		return false;
	}
	
	function login_error_redirect($url = 'login.php'){
		header('Location:' .$url);
	}
	
	if(isset($_SESSION['SBUser'])){
		$user_id = $_SESSION['SBUser'];
		$query = $db->query("SELECT * FROM users WHERE id = '$user_id'");
		$user_data = mysqli_fetch_assoc($query);
		
	}
	
	

?>