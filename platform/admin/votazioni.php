<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .container {
        flex: 1;
    }

    .result-message {
        margin-top: 1rem;
        font-size: 1.2rem;
        color: #333;
    }
</style>

<body>
    <?php include 'includes/topbar_lista.php';?>
    <!-- Dashboard Content -->
    <div class="container mt-4">
        <div class="dashboard-header">
            <h1>Le tue votazioni</h1>
            <button class="btn btn-success" data-toggle="modal" data-target="#createElectionModal">
                <i class="fas fa-plus-circle"></i> Crea una nuova Votazione
            </button>
        </div>
        <div class="search-filter">
            <form class="d-flex" role="search" id="cerca-elezioni">
                <input class="form-control me-2" type="search" placeholder="Cerca..." aria-label="Search"
                    id="search-input">
                <button class="btn btn-outline-success" id="submit-cerca" type="submit">Cerca</button>
            </form>
            <select class="form-control" id="filtro-elezioni">
                <option>Filtra per...</option>
                <option>in costruzione</option>
                <option>completata</option>
            </select>
        </div>
        <div id="result-message" class="result-message"></div>
        <?php if (!empty($amministratore->votazioni)): ?>
            <?php foreach ($amministratore->votazioni as $votazione): ?>
                <div class="election-card mt-3"
                    onclick="window.location.href='panoramica.php?id=<?php echo urlencode($votazione->id); ?>'">
                    <div class="election-title">
                        <h5> <?php echo htmlspecialchars($votazione->titolo); ?> <span class="badge badge-building"><i
                                    class="fas fa-tools"></i> In costruzione</span></h5>
                    </div>
                    <div class="election-details">
                        <div class="election-datas">
                            <span><strong>Inizio Votazione:</strong>
                                <?php echo htmlspecialchars($votazione->inizio_votazione); ?></span><br>
                            <span><strong>Fine Votazione:</strong>
                                <?php echo htmlspecialchars($votazione->fine_votazione); ?></span>
                        </div>
                        <i class="fas fa-chevron-right icon"></i>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nessuna votazione trovata per questo amministratore.</p>
        <?php endif; ?>
    </div>
    <?php include 'includes/footer.php'; ?>

    <!-- Modal for Creating Election -->
    <div class="modal fade" id="createElectionModal" tabindex="-1" aria-labelledby="createElectionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createElectionModalLabel">Crea una nuova Votazione</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create-election-form" action="crea_votazione.php" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="start-date" class="form-label">Inizio Votazione</label>
                            <input type="datetime-local" class="form-control" id="start-date" name="start-date">
                        </div>
                        <div class="mb-3">
                            <label for="end-date" class="form-label">Fine Votazione</label>
                            <input type="datetime-local" class="form-control" id="end-date" name="end-date">
                        </div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-success">Crea Votazione</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/scripts.php'; ?>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchForm = document.getElementById('cerca-elezioni');
        const searchInput = document.getElementById('search-input');
        const electionCards = document.querySelectorAll('.election-card');
        const resultMessage = document.getElementById('result-message');

        searchForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting

            const searchTerm = searchInput.value.toLowerCase();
            let resultCount = 0;

            electionCards.forEach(function (card) {
                const title = card.querySelector('.election-title h5').textContent.toLowerCase();
                if (title.includes(searchTerm)) {
                    card.style.display = 'flex'; // Show the card if it matches the search term
                    resultCount++;
                } else {
                    card.style.display = 'none'; // Hide the card if it doesn't match the search term
                }
            });

            if (resultCount > 0) {
                resultMessage.textContent = `${resultCount} risultato${resultCount > 1 ? 'i' : ''} trovato${resultCount > 1 ? 'i' : ''}`;
            } else {
                resultMessage.textContent = 'Nessuna elezione trovata con questo nome';
            }
        });
    });
</script>

</html>