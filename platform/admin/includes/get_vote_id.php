<?php 
    if(!isset($_GET['id']) || trim($_GET['id']) == ''){
		header('location: votazioni.php');
	}     
    
    $votazione_id=$_GET['id'];
    $_SESSION['id_votazione']=$_GET['id'];

    if (!Votazione::exists($conn, $votazione_id)) {
        header('location: votazioni.php');
    }
    $votazione = Votazione::createFromId($conn, $votazione_id);
?>