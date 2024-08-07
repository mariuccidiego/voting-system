<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votazione non disponibile</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

.info-icon {
    color: #3498db;
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
        <i class="fas fa-info-circle info-icon"></i>
        <h1>Votazione non disponibile</h1>
        <p>La votazione che stai cercando è chiusa o non è ancora iniziata.</p>
        <a href="index.html" class="button">Torna alla pagina principale</a>
    </div>
</body>
</html>
