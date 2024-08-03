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
}


if (isset($_SESSION['votante'])) {
  header('location:voto.php?id=' . $_GET['id']);
}

$votazione = Votazione::createFromId($conn, $votazione_id);

?>
<?php include '../admin/includes/header.php'; ?>
<style>
  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  .container {
    flex: 1;
  }
</style>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="text-center m-3">
        <img src="../resources/logo_vote.png" class="site-logo" alt="site logo">
      </div>
      <div class="col-md-6">
        <div class="card mt-2">
          <div class="card-header text-center">
            <h2>Login</h2>
          </div>
          <div class="card-body">
            <form action="login_auth.php" method="POST">
              <div class="mb-3">
                <label for="username" class="form-label">Nome utente</label>
                <input type="text" class="form-control" name="username" id="username"
                  placeholder="Inserisci nome utente" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password"
                  placeholder="Inserisci password" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Accedi alla piattaforma</button>
            </form>
            <?php
            if (isset($_SESSION['error'])) {
              echo '
						<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
						' . $_SESSION["error"] . '
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div>
					';
              unset($_SESSION['error']);
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include '../admin/includes/footer.php'; ?>

  <?php include '../admin/includes/scripts.php'; ?>
</body>

</html>