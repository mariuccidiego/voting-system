<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#"><?php echo htmlspecialchars($votazione->titolo); ?>

        <?php

        $start_time = $votazione->inizio_votazione;
        $end_time = $votazione->fine_votazione;

        if($end_time == "0000-00-00 00:00:00"){
            $end_time="3000-00-00 00:00:00";
          }

        // Ottenere l'orario corrente in UTC
        $current_time_utc = new DateTime("now", new DateTimeZone("UTC"));

        // Convertire le date del database in oggetti DateTime
        $start_time_utc = new DateTime($start_time, new DateTimeZone("UTC"));
        $end_time_utc = new DateTime($end_time, new DateTimeZone("UTC"));

        // Controllare se l'orario corrente è tra l'inizio e la fine della votazione
        if ($current_time_utc >= $start_time_utc && $current_time_utc <= $end_time_utc && $start_time != "0000-00-00 00:00:00") {
            ?>
            <span class="badge badge-success ml-2 font-weight-normal">Votazione aperta</span>
        <?php
        }
        ?>
        </a>

    <div class="ml-auto dropdown">
        <a href="#" class="d-flex align-items-center text-white" id="profileDropdown" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <img src="https://via.placeholder.com/50" class="profile-image" alt="Profile Image">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="#">Profilo</a>
            <a class="dropdown-item" href="#">Impostazioni</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
    </div>
</nav>