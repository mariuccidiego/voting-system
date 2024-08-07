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
    <?php include 'modals/crea_votazione_modal.php'; ?>
    <?php include 'includes/scripts.php'; ?>
    <?php include 'modals/toast_success.php'; ?>

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
                resultMessage.textContent = `${resultCount} risultat${resultCount > 1 ? 'i' : 'o'} trovat${resultCount > 1 ? 'i' : 'o'}`;
            } else {
                resultMessage.textContent = 'Nessuna elezione trovata con questo nome';
            }
        });
    });

    document.getElementById('create-election-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const startDateInput = document.getElementById('start-date');
        const endDateInput = document.getElementById('end-date');

        // Convert the local date-time to UTC date-time
        const startDate = new Date(startDateInput.value);
        const endDate = new Date(endDateInput.value);

        // Format the dates to ISO 8601 with Z (UTC)
        if(startDateInput.value){
            const startDateUTC = startDate.toISOString();
            startDateInput.value = startDateUTC.substring(0, 19);
        }

        if(endDateInput.value){
            const endDateUTC = endDate.toISOString();
            endDateInput.value = endDateUTC.substring(0, 19);
        }

        event.target.submit();
    });
</script>

</html>