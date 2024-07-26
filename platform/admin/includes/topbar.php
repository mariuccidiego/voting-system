<nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#"><?php echo htmlspecialchars($votazione->titolo); ?></a>
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