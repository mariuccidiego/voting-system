<!-- Barra Laterale -->
<div class="sidebar d-flex flex-column">
        <div class="sidebar-logo">
            <img src="../resources/logo_vote.png" class="site-logo" alt="site logo">
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link sidebar-link" href="panoramica.php?id=<?php echo urlencode($votazione->id); ?>">
                    <i class="fas fa-home"></i>
                    Panoramica
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link" href="impostazioni.php?id=<?php echo urlencode($votazione->id); ?>">
                    <i class="fas fa-cog"></i>
                    Impostazioni
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link" href="scheda_voto.php?id=<?php echo urlencode($votazione->id); ?>">
                    <i class="fas fa-check-circle"></i>
                    Voto
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link" href="elettori.php?id=<?php echo urlencode($votazione->id); ?>">
                    <i class="fas fa-users"></i>
                    Elettori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-link" href="risultati.php?id=<?php echo urlencode($votazione->id); ?>">
                    <i class="fas fa-chart-bar"></i>
                    Risultati
                </a>
            </li>
        </ul>
        <div class="voting-times mt-auto">
            <p><b>Inizio votazione:</b><br> <?php echo htmlspecialchars($votazione->inizio_votazione); ?></p>
            <p><b>Fine votazione:</b> <br> <?php echo htmlspecialchars($votazione->fine_votazione); ?></p>
        </div>
        <a href="votazioni.php" class="btn btn-primary" id="indietro"> <i class="fas fa-angle-left"></i>Torna alle Votazioni</a>
    </div>