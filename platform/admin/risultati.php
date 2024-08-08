<?php include 'includes/session.php'; ?>
<?php include 'includes/get_vote_id.php'; ?>
<?php include 'includes/header.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<body>
    <?php include 'includes/leftbar_votazione.php'; ?>

    <!-- Contenuto della Pagina -->
    <div class="right-site">
        <?php include 'includes/topbar.php'; ?>

        <!-- Contenuto Principale -->
        <div class="content">
            <div class="container mt-4">
                <h1>Risultati</h1>
                <p>Qui va il contenuto della pagina.</p>
                <?php

                function formatNumber($number) {
                    // Formatta il numero con due decimali, poi rimuove gli zeri e il punto decimale se non necessari
                    return rtrim(rtrim(number_format($number, 3, '.', ''), '0'), '.');
                }

                if ($votazione->tipo_votazione_id == 1) {

                } elseif ($votazione->tipo_votazione_id == 2) {

                    if ($votazione->voto_pesato) {
                        $sql = "SELECT p.id AS proposta_id, p.titolo AS titolo_proposta, 
                                    COUNT(vp.id) AS numero_voti,
                                    SUM(v.peso_voto / subquery.voti_totali) AS voti_pesati
                                FROM voto_proposta vp
                                JOIN proposta p ON vp.proposta_id = p.id
                                JOIN votante v ON vp.votante_id = v.id
                                JOIN (
                                    SELECT votante_id, COUNT(proposta_id) as voti_totali
                                    FROM voto_proposta
                                    WHERE votazione_id = ?
                                    GROUP BY votante_id
                                ) subquery ON subquery.votante_id = vp.votante_id
                                WHERE vp.votazione_id = ?
                                GROUP BY p.id, p.titolo
                                ORDER BY voti_pesati DESC";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("ii", $votazione->id, $votazione->id);
                    } else {
                        $sql = "SELECT p.id AS proposta_id, p.titolo AS titolo_proposta, 
                                    COUNT(vp.id) AS numero_voti
                                FROM voto_proposta vp
                                JOIN proposta p ON vp.proposta_id = p.id
                                WHERE vp.votazione_id = ?
                                GROUP BY p.id, p.titolo
                                ORDER BY numero_voti DESC";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $votazione->id);
                    }


                    $stmt->execute();
                    $result = $stmt->get_result();

                    $titolo_proposte = [];
                    $numero_voti = [];
                    $voti_pesati = [];

                    while ($row = $result->fetch_assoc()) {
                        $titolo_proposte[] = $row['titolo_proposta'];
                        $numero_voti[] = $row['numero_voti'];
                        if ($votazione->voto_pesato) {
                            $voti_pesati[] = $row['voti_pesati'];
                        }
                    }
                    $stmt->close();



                    $sql_votanti = "SELECT * FROM votante WHERE votazione_id = '$votazione->id'";
                    $result_votanti = $conn->query($sql_votanti);

                    $votanti_hanno_votato = [];
                    $votanti_non_hanno_votato = [];

                    while ($row = $result_votanti->fetch_assoc()) {
                        $votante = new Votante($conn);
                        $votante->assignProperties($row);

                        if ($votante->votato) {
                            $votanti_hanno_votato[] = $votante;
                        } else {
                            $votanti_non_hanno_votato[] = $votante;
                        }
                    }

                    $sql = "SELECT * FROM voto_proposta WHERE votazione_id = '$votazione->id'";
                    $result = $conn->query($sql);

                    $n_voti = $result->num_rows;

                    $date_voti = array();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $date_voti[] = $row["data_ora"];
                        }
                    }


                    if (
                        !(
                            $current_time_utc >= $start_time_utc
                            && $current_time_utc <= $end_time_utc
                            && $start_time != "0000-00-00 00:00:00") && $n_voti > 0
                    ) {
                        ?>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Tabella Risultati</h5>
                                        <table id="risultati_table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Proposta</th>
                                                    <th>Numero Voti</th>
                                                    <?php if ($votazione->voto_pesato): ?>
                                                        <th>Voti Pesati</th>
                                                        <th>% (Voto Pesato)</th>
                                                    <?php else: ?>
                                                        <th>% (Numero Voti)</th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($titolo_proposte as $index => $proposta): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($proposta); ?></td>
                                                    <td><?php echo htmlspecialchars($numero_voti[$index]); ?></td>
                                                    <?php if ($votazione->voto_pesato): ?>
                                                        <td><?php echo htmlspecialchars(formatNumber($voti_pesati[$index])); ?></td>
                                                        <td><?php echo round(($voti_pesati[$index] / array_sum($voti_pesati)) * 100, 2) . ' %'; ?></td>
                                                    <?php else: ?>
                                                        <td><?php echo round(($numero_voti[$index] / array_sum($numero_voti)) * 100, 2) . ' %'; ?></td>
                                                    <?php endif; ?>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Grafico Risultati</h5>
                                        <canvas id="risultati_chart" width="400" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                            <script>
                            var risultati_ctx = document.getElementById('risultati_chart').getContext('2d');
                            var risultati_chart = new Chart(risultati_ctx, {
                                type: 'bar',
                                data: {
                                    labels: <?php echo json_encode($titolo_proposte); ?>,
                                    datasets: [{
                                        label: '<?php echo $votazione->voto_pesato ? "Voti Pesati" : "Numero Voti"; ?>',
                                        data: <?php echo json_encode($votazione->voto_pesato ? $voti_pesati : $numero_voti); ?>,
                                        
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                            </script>
                            </script>

                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Affluenza</h5>
                                        <canvas id="affluenza_chart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <script>
                                var affluenza_chx = document.getElementById("affluenza_chart").getContext("2d");
                                var affluenza_chart = new Chart(affluenza_chx, {
                                    type: 'pie',
                                    data: {
                                        labels: ["votato", "non votato"],
                                        datasets: [{
                                            label: "Elettori",
                                            data: [<?php echo count($votanti_hanno_votato); ?>, <?php echo count($votanti_non_hanno_votato); ?>],
                                            hoverOffset: 5
                                        }],
                                    },
                                    options: {
                                        responsive: true,
                                    },
                                });
                            </script>
                        </div>

                        <?php
                    } else {
                        if ($n_voti > 0) {
                            ?>
                            <div class="alert alert-warning mb-3" role="alert">
                                La votazione è in corso, non puoi vedere i risultati quando la votazione è aperta, una volta conclusa troverai qui i risultati.
                            </div>
                            <?php
                        }
                    }

                    if ($n_voti > 0 || (
                        $current_time_utc >= $start_time_utc
                        && $current_time_utc <= $end_time_utc
                        && $start_time != "0000-00-00 00:00:00")) {
                        ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Elettori Che Hanno Votato</h5>
                                        <table id="votato_table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nome Utente</th>
                                                    <th>Nome</th>
                                                    <th>Cognome</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($votanti_hanno_votato as $votante): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($votante->username); ?></td>
                                                        <td><?php echo htmlspecialchars($votante->nome); ?></td>
                                                        <td><?php echo htmlspecialchars($votante->cognome); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Elettori Che Non Hanno Votato</h5>
                                        <table id="non_votato_table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nome Utente</th>
                                                    <th>Nome</th>
                                                    <th>Cognome</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($votanti_non_hanno_votato as $votante): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($votante->username); ?></td>
                                                        <td><?php echo htmlspecialchars($votante->nome); ?></td>
                                                        <td><?php echo htmlspecialchars($votante->cognome); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Voti per data</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php

                    }else{
                        ?>
                        <div class="alert alert-warning" role="alert">
                            La votazione non è ancora iniziata. Potrai vedere chi ha votato una volta iniziata la votazione,
                            invece i risultati solo alla fine.
                        </div>
                        <?php
                    }

                }
                ?>


            </div>
        </div>
    </div>
    <?php include 'modals/toast_success.php'; ?>

    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/page_active.php'; ?>
</body>
<script>
    $(document).ready(function () {
        $('#risultati_table').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/2.1.2/i18n/it-IT.json"
            }
        });
        $('#votato_table').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/2.1.2/i18n/it-IT.json"
            }
        });
        $('#non_votato_table').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/2.1.2/i18n/it-IT.json"
            }
        });
    });
</script>
</html>