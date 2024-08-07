<?php
session_start();
include '../config/database.php';
include '../models/Votazione.php';

if (!isset($_GET['id']) || trim($_GET['id']) == '') {
    header('location: error_id.php');
}

$votazione_id = $_GET['id'];

if (!Votazione::exists($conn, $votazione_id)) {
    header('location: error_id.php');
    die;
}

$votazione = Votazione::createFromId($conn, $votazione_id);
?>
<?php include '../admin/includes/header.php'; ?>
<?php
?>
<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .container {
        flex: 1;
        width: 90%;
    }

    .tessera {
        text-align: center;
        background-color: #ffffff;
        padding: 40px;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .success-icon {
        color: #2ecc71;
        font-size: 3rem;
        margin-bottom: 20px;
    }
</style>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center my-3"><?php echo htmlspecialchars($votazione->titolo); ?></h1>
                <p class="text-center my-3"><?php echo htmlspecialchars($votazione->descrizione); ?></p>

                <div class="tessera">
                    <i class="fas fa-thumbs-up success-icon"></i>
                    <h1>Grazie per aver votato!</h1>
                    <p>Il tuo voto è stato registrato con successo. Sarai reindirizzato alla pagina di login tra 5 secondi.</p>
                    <a href="login.php?id=<?php if(isset($_GET['id'])){echo $_GET['id'];} ?>" class="btn btn-primary">Vai alla pagina di login ora</a>
                </div>
            </div>
        </div>
    </div>
    <?php include '../admin/includes/footer.php'; ?>

    <?php include '../admin/includes/scripts.php'; ?>
</body>
<script>
        setTimeout(function() {
            window.location.href = "login.php?id=<?php if(isset($_GET['id'])){echo $_GET['id'];} ?>";
        }, 5000);
    </script>
</script>
</html>