<?php
	session_start();
	include '../config/database.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if(isset($_POST['username']) && isset($_POST['password'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
	
			$sql = "SELECT * FROM amministratore WHERE username = '$username'";
			$query = $conn->query($sql);
	
			if($query->num_rows < 1){
				$_SESSION['error'] = 'Non abbiamo trovato un account con questo username';
			}
			else{
				$row = $query->fetch_assoc();
				if($password== $row['pwd']){
					$_SESSION['admin'] = $row['username'];
				}
				else{
					$_SESSION['error'] = 'Username o Password sbagliati';
				}
			}
			
		}
		else{
			$_SESSION['error'] = 'Inserisci prima le credenziali';
		}
	}

	header('location: login.php');

?>