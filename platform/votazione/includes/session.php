<?php
	session_start();
	include '../config/database.php';
    include '../models/Votazione.php';

	if(!isset($_GET['id']) || trim($_GET['id']) == ''){
		header('location: error_id.php');
	}

    $votazione_id=$_GET['id'];
    
    if (!Votazione::exists($conn, $votazione_id)) {
        header('location: error_id.php');
    }

    if(!isset($_SESSION['votante']) || trim($_SESSION['votante']) == ''){
		header('location: login.php?id=' . $_GET['id']);
	}

    $votazione = Votazione::createFromId($conn, $votazione_id);

    $votante = new Votante($conn);
    $votante->readFromUser($_SESSION['votante']);
?>