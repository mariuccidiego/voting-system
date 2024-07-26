<?php 
    if(!isset($_GET['id']) || trim($_GET['id']) == ''){
		header('location: votazioni.php');
	} 
    
    $votazione_id=$_GET['id'];
    if (Votazione::exists($conn, $votazione_id)) {
        $votazione = Votazione::createFromId($conn, $votazione_id);
    } else {
        header('location: votazioni.php');
    }
?>