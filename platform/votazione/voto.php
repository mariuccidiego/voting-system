<?php include 'includes/session.php'; ?>
<?php include '../admin/includes/header.php'; ?>
<?php

if ($votante->votato) {
  header('location: gia_votato.php');
}
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

    .card-candidato {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        transition: background-color 0.3s ease;
    }

    .form-check-input {
        transform: scale(2);
        margin-top: 0.3rem;
        margin-right: 0.5rem;
    }

    .form-check {
        display: flex;
        align-items: center;
    }

    .invia-voto {
        width: 100%;
        font-size: large;
    }

    .instructions {
        background-color: #e9f5ff;
        border: 1px solid #007bff;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
        color: #007bff;
    }

    .instructions h3 {
        margin-bottom: 15px;
    }

    .instructions ul {
        list-style-type: none;
        padding-left: 0;
    }

    .instructions li {
        background: #ffffff;
        border: 1px solid #bee5eb;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .highlight {
        font-weight: bold;
    }
</style>

<body>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center my-3"><?php echo htmlspecialchars($votazione->titolo); ?></h1>
                <p class="text-center my-3"><?php echo htmlspecialchars($votazione->descrizione); ?></p>

                <div class="instructions">
                    <h3>Istruzioni</h3>
                    <ul>
                        <?php if ($votazione->voto_disgiunto): ?>
                            <li>È consentito il voto <span class="highlight">disgiunto</span>.</li>
                        <?php endif; ?>
                        <?php if ($votazione->voto_pesato): ?>
                            <li>È una votazione pesata e il peso del tuo voto è di <span class="highlight"><?php echo $votante->peso_voto; ?></span></li>
                        <?php endif; ?>
                        <?php if ($votazione->scheda_bianca): ?>
                            <li>È disponibile l'opzione <span class="highlight">scheda bianca</span>.</li>
                        <?php endif; ?>
                        <?php if ($votazione->voto_per_sesso): ?>
                            <li>È una votazione con parità di genere</li>
                        <?php endif; ?>
                        <li>È necessario selezionare almeno <span class="highlight"><?php echo $votazione->min_proposte; ?></span> proposta<?php echo $votazione->min_proposte > 1 ? 'e' : 'a'; ?>.</li>
                        <li>Si possono selezionare fino a <span class="highlight"><?php echo $votazione->max_proposte; ?></span> proposta<?php echo $votazione->max_proposte > 1 ? 'e' : 'a'; ?>.</li>
                    </ul>
                    <p id="remaining-options" class="highlight"></p>
                </div>
            </div>
            <?php if ($votazione->tipo_votazione_id == 1): // Candidato ?>

            <?php elseif ($votazione->tipo_votazione_id == 2): // Sondaggio ?>
                <form id="votazione-form" action="voto_valid.php?id=<?php echo $_GET['id']; ?>" method="POST" class="candidati">
                    <?php if (!empty($votazione->proposte)): ?>
                        <?php foreach ($votazione->proposte as $proposta): ?>
                            <div class="card card-candidato mb-2">
                                <div class="card-body d-flex flex-row align-items-center">
                                    <div class="form-check mr-3">
                                        <input class="form-check-input proposal-checkbox" type="checkbox" name="voti[]"
                                            id="proposta<?php echo $proposta->id; ?>" value="<?php echo $proposta->id; ?>" data-titolo="<?php echo htmlspecialchars($proposta->titolo); ?>">
                                    </div>
                                    <div class="d-flex flex-column w-100">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h4 class="mb-2"><?php echo htmlspecialchars($proposta->titolo); ?></h4>
                                        </div>
                                        <?php if ($proposta->desc_corta != null): ?>
                                            <p class="description mb-1">
                                                <?php echo htmlspecialchars($proposta->desc_corta); ?>
                                            </p>
                                        <?php endif; ?>
                                        <?php if ($proposta->descrizione != null): ?>
                                            <div id="id<?php echo $proposta->id ?>" class="collapse mt-3">
                                                <?php echo htmlspecialchars($proposta->descrizione); ?>
                                            </div>
                                            <a href="#id<?php echo $proposta->id ?>" data-toggle="collapse">Leggi di più</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="text-center my-3">
                            <button type="button" class="btn btn-primary invia-voto" disabled>Invia Voto</button>
                        </div>
                    <?php else: ?>
                        <p>Nessuna proposta</p>
                    <?php endif; ?>
                </form>
            <?php endif; ?>
        </div>
    </div>



    <a href="logout.php"> Elimina</a>
    </div>
    <?php include '../admin/includes/footer.php'; ?>

    <?php include '../admin/includes/scripts.php'; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.proposal-checkbox');
            const remainingOptions = document.getElementById('remaining-options');
            const submitButton = document.querySelector('.invia-voto');
            const minProposte = <?php echo $votazione->min_proposte; ?>;
            const maxProposte = <?php echo $votazione->max_proposte; ?>;
            const schedaBiancaTitle = "Scheda Bianca";

            function updateRemainingOptions() {
                const selectedCount = document.querySelectorAll('.proposal-checkbox:checked').length;
                const isSchedaBiancaSelected = Array.from(checkboxes).some(checkbox => checkbox.checked && checkbox.dataset.titolo === schedaBiancaTitle);

                if (isSchedaBiancaSelected) {
                    remainingOptions.textContent = "Hai selezionato l'opzione 'Scheda Bianca'.";
                    checkboxes.forEach(checkbox => {
                        if (checkbox.dataset.titolo !== schedaBiancaTitle) {
                            checkbox.disabled = true;
                            checkbox.checked = false;
                        }
                    });
                    submitButton.disabled = false;
                } else {
                    checkboxes.forEach(checkbox => {
                        checkbox.disabled = false;
                    });
                    if (selectedCount < minProposte) {
                        remainingOptions.textContent = `Devi ancora selezionare ${minProposte - selectedCount} opzione${minProposte - selectedCount > 1 ? 'i' : 'e'}.`;
                        submitButton.disabled = true;
                    } else if (selectedCount >= minProposte && selectedCount < maxProposte) {
                        remainingOptions.textContent = `Puoi selezionare ancora ${maxProposte - selectedCount} opzione${maxProposte - selectedCount > 1 ? 'i' : 'e'}.`;
                        submitButton.disabled = false;
                    } else if (selectedCount === maxProposte) {
                        remainingOptions.textContent = "Hai selezionato il numero massimo di opzioni.";
                        submitButton.disabled = false;
                    } else {
                        submitButton.disabled = true;
                    }
                }
            }

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', updateRemainingOptions);
            });

            updateRemainingOptions();

            submitButton.addEventListener('click', function(event) {
                if (submitButton.disabled) {
                    alert('Devi selezionare il numero corretto di opzioni prima di inviare il voto.');
                } else {
                    const selectedOptions = Array.from(document.querySelectorAll('.proposal-checkbox:checked')).map(checkbox => checkbox.dataset.titolo);
                    const confirmationMessage = `Hai selezionato le seguenti opzioni:\n\n${selectedOptions.join('\n')}\n\nConfermi l'invio del voto?`;
                    
                    if (confirm(confirmationMessage)) {
                        document.getElementById('votazione-form').submit();
                    }
                }
            });

            document.getElementById('votazione-form').addEventListener('submit', function(event) {
                const selectedCount = document.querySelectorAll('.proposal-checkbox:checked').length;
                const isSchedaBiancaSelected = Array.from(checkboxes).some(checkbox => checkbox.checked && checkbox.dataset.titolo === schedaBiancaTitle);

                if (!isSchedaBiancaSelected && (selectedCount < minProposte || selectedCount > maxProposte)) {
                    event.preventDefault();
                    alert(`Devi selezionare tra ${minProposte} e ${maxProposte} opzioni.`);
                }
            });
        });
    </script>
</body>

</html>