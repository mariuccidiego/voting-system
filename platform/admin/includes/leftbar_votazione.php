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
        <p class="mb-0"><b>Inizio votazione:</b></p>
        <p id="start-time" class="mb-3 start-time" data-utc="<?php 
        if ($votazione->inizio_votazione == "0000-00-00 00:00:00") {
            echo "NaN";
        } else {
            echo htmlspecialchars($votazione->inizio_votazione);
        }
        ?>"></p>

        <p class="mb-0"><b>Fine votazione:</b></p>
        <p id="end-time" class="mb-3 end-time" data-utc="<?php 
        if ($votazione->fine_votazione == "0000-00-00 00:00:00") {
            echo "NaN";
        } else {
            echo htmlspecialchars($votazione->fine_votazione);
        }
        ?>"></p>
    </div>
    <a href="votazioni.php" class="btn btn-primary" id="indietro"> <i class="fas fa-angle-left"></i>Torna alle
        Votazioni</a>
</div>