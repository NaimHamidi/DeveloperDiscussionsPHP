<?php
	require_once 'connect.php';
	unset($_SESSION['SBUser']);
	header('Location: login.php');
?>