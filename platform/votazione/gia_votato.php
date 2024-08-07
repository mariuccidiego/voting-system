<?php
	session_start();
	session_destroy();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votazione completata</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        setTimeout(function() {
            window.location.href = "login.php?id=<?php if(isset($_GET['id'])){echo $_GET['id'];} ?>";
        }, 5000);
    </script>
</head>
<style>
    body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f0f0f0;
}

.container {
    text-align: center;
    background-color: #ffffff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 90%;
}

.success-icon {
    color: #2ecc71;
    font-size: 3rem;
    margin-bottom: 20px;
}

h1 {
    color: #333333;
    font-size: 1.8rem;
    margin-bottom: 15px;
}

p {
    color: #666666;
    font-size: 1rem;
    margin-bottom: 25px;
}

.button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 1rem;
    color: #ffffff;
    background-color: #3498db;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #2980b9;
}

</style>
<body>
    <div class="container">
        <i class="fas fa-check-circle success-icon"></i>
        <h1>Hai già votato</h1>
        <p>Hai già votato per questa votazione. Sarai reindirizzato alla pagina di login tra 5 secondi.</p>
        <a href="login.php?id=<?php if(isset($_GET['id'])){echo $_GET['id'];} ?>" class="button">Vai alla pagina di login ora</a>
    </div>
</body>
</html>