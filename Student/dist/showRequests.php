<?php require_once('components/header.php') ?>
<?php require_once('components/navbar.php') ?>
<?php require_once('DAL/retrieve.class.php');

// Create an instance of the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();

// Retrieve userID from GET, with a default value of 4 if not provided
$studentID = isset($_GET['userID']) ? intval($_GET['userID']) : 4;

// Retrieve FacID from GET, with a default value of 6 if not provided
$facultyID = isset($_GET['FacID']) ? intval($_GET['FacID']) : 6;

// Retrieve data based on the studentID
$att = $universityData->getAttestationsByStudentId($studentID);
$pet = $universityData->getPetitionsByStudentId($studentID);
$fa = $universityData->getFinancialAidsByStudentId($studentID);
$req = $universityData->getRequestsByStudentId($studentID);

?>
<div class="my-3 my-md-5">
    <div class="container">
        <h2 class="text-primary mb-4">Student Data Overview</h2>

        <!-- Combined section for attestations, petitions, and financial aids -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
               <strong>Attestations, Petitions, and Financial Aids</strong>
            </div>
            <div class="card-body">
                <?php if(!empty($att) || !empty($pet) || !empty($fa)): ?>
                    <div class="row">
                        <!-- Attestations -->
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 shadow-sm hover-shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Attestations</h5>
                                    <?php foreach ($att as $attestation): ?>
                                        <div class="alert alert-info p-2 shadow-sm">
                                            <strong>ID:</strong> <?= $attestation['id']; ?><br>
                                            <strong>Date:</strong> <?= $attestation['date']; ?><br>
                                            <strong>Status:</strong> <?= $attestation['status']; ?><br>
                                            <strong>Remarks:</strong> <?= $attestation['remarks']; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Petitions -->
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 shadow-sm hover-shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Petitions</h5>
                                    <?php foreach ($pet as $petition): ?>
                                        <div class="alert alert-warning p-2 shadow-sm">
                                            <strong>ID:</strong> <?= $petition['id']; ?><br>
                                            <strong>Subject:</strong> <?= $petition['subject']; ?><br>
                                            <strong>Description:</strong> <?= $petition['description']; ?><br>
                                            <strong>Status:</strong> <?= $petition['status']; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Financial Aids -->
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 shadow-sm hover-shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Financial Aids</h5>
                                    <?php foreach ($fa as $aid): ?>
                                        <div class="alert alert-success p-2 shadow-sm">
                                            <strong>ID:</strong> <?= $aid['id']; ?><br>
                                            <strong>Aid Amount:</strong> $<?= $aid['aid_amount']; ?><br>
                                            <strong>Created At:</strong> <?= $aid['created_at']; ?><br>
                                            <strong>-</strong>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <p>No attestations, petitions, or financial aids found for this student.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Section for Requests -->
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
               Pending Requests
            </div>
            <div class="card-body">
                <?php if(!empty($req)): ?>
                    <?php foreach ($req as $request): ?>
                        <div class="alert alert-dark p-2 shadow-sm">
                            <strong>Request ID:</strong> <?= $request['id']; ?><br>
                            <strong>Request Type:</strong> <?= $request['request_type']; ?><br>
                            <strong>File Path:</strong> <?= $request['file_path']; ?><br>
                            <strong>Status:</strong> <?= $request['status']; ?><br>
                            <strong>Comments:</strong> <?= $request['comments']; ?><br>
                            <strong>Created At:</strong> <?= $request['created_at']; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No requests found for this student.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="logic.js"></script>

<?php require_once("components/footer.php") ?>
</body>
</html>
