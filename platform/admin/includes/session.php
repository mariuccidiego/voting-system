<?php
	session_start();
	include '../config/database.php';
    include '../models/Amministratore.php';

	if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
		header('location: index.php');
	}

	$username = 'admin'; 
    $amministratore = Amministratore::createFromUsername($conn, $username);
?>