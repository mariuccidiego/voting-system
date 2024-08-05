<?php include 'includes/session.php'; ?>
<?php include 'includes/get_vote_id.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
        .badge {
            font-size: 16px;
            margin-right: 5px;
        }
    </style>
<body>
    <?php include 'includes/leftbar_votazione.php'; ?>

    <!-- Contenuto della Pagina -->
    <div class="right-site">
        <?php include 'includes/topbar.php'; ?>

        <!-- Contenuto Principale -->
        <div class="container">
            <!-- Account Verification Required -->
            <div class="alert alert-warning" role="alert">
                <strong>Account Verification Required</strong>
                <p>Your account email address needs to be verified before this election can be launched. Please check
                    your email <strong>theinsidetheproject@gmail.com</strong> and click on the link to verify your email
                    address.</p>
                <a href="#" class="btn btn-warning">Resend Verification Email</a>
            </div>

            <!-- Election Details -->
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Election Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Start Date</strong></p>
                            <p>Jul 11, 2024, 7:00:00 PM</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>End Date</strong></p>
                            <p>Jul 21, 2024, 6:00:00 PM</p>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <div class="badge bg-orange">2 Voters</div>
                        </div>
                        <div class="col-md-4">
                            <div class="badge bg-pink">2 Ballot Questions</div>
                        </div>
                        <div class="col-md-4">
                            <div class="badge bg-purple">6 Options</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Election URLs -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Election URLs</h5>
                    <div class="mb-3">
                        <label for="electionURL" class="form-label">Election URL</label>
                        <input type="text" class="form-control" id="electionURL"
                            value="https://vote.electionrunner.com/election/PpVD1" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="shortURL" class="form-label">Short URL</label>
                        <input type="text" class="form-control" id="shortURL" value="" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="previewURL" class="form-label">Preview URL</label>
                        <input type="text" class="form-control" id="previewURL"
                            value="https://vote.electionrunner.com/preview/PpVD1/Alvp3uEXGbnKBTqV" readonly>
                    </div>
                    <div>
                        <a href="#">Click here to set up your organization's subdomain</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'modals/toast_success.php'; ?>

    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/page_active.php'; ?>

</body>

</html>