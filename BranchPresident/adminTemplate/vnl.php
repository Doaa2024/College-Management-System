<?php
require_once('components/header.php');
require_once('components/sidebar.php');
require_once('components/navbar.php');
require_once('DAL/retrieve.class.php');

$dataRetrieval = new UniversityDataRetrieval();
$obligatoryNewsletters = [];
$optionalNewsletters = [];

$perPage = 3; // Number of newsletters per page

// Handle pagination for obligatory newsletters
$pageObligatory = isset($_GET['pageObligatory']) ? intval($_GET['pageObligatory']) : 1;
$offsetObligatory = ($pageObligatory - 1) * $perPage;
$totalObligatory = $dataRetrieval->countObligatoryNewsletters();
$obligatoryNewsletters = $dataRetrieval->getObligatoryNewsletters($perPage, $offsetObligatory);

// Handle pagination for optional newsletters
$pageOptional = isset($_GET['pageOptional']) ? intval($_GET['pageOptional']) : 1;
$offsetOptional = ($pageOptional - 1) * $perPage;
$totalOptional = $dataRetrieval->countOptionalNewsletters();
$optionalNewsletters = $dataRetrieval->getOptionalNewsletters($perPage, $offsetOptional);

function renderPagination($currentPage, $totalPages, $type)
{
    $pagination = '';
    if ($totalPages > 1) {
        $pagination .= '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';
        for ($i = 1; $i <= $totalPages; $i++) {
            $active = ($i == $currentPage) ? 'active' : '';
            $pagination .= '<li class="page-item ' . $active . '"><a class="page-link" href="?page' . $type . '=' . $i . '">' . $i . '</a></li>';
        }
        $pagination .= '</ul></nav>';
    }
    return $pagination;
}

?>
<style>
    .nav-tabs .nav-link.active {
        color: #fff; /* White text color for better contrast */
        background-color: #007bff; /* Bootstrap primary color */
        border-color: #007bff #007bff #fff; /* Border color to match active background */
    }

    .nav-tabs .nav-link {
        border: 1px solid #dee2e6; /* Default border color for inactive tabs */
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link active" id="obligatory-tab" data-toggle="tab" href="#obligatory" role="tab" aria-controls="obligatory" aria-selected="true">Obligatory Newsletters</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="optional-tab" data-toggle="tab" href="#optional" role="tab" aria-controls="optional" aria-selected="false">Optional Newsletters</a>
                </li>
            </ul>
            <div class="tab-content mt-3" id="myTabContent">
                <!-- Obligatory Newsletters -->
                <div class="tab-pane fade show active" id="obligatory" role="tabpanel" aria-labelledby="obligatory-tab">
                    <div class="row">
                        <?php foreach ($obligatoryNewsletters as $newsletter) { ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-title"><?php echo htmlspecialchars($newsletter['Title']); ?></h5>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <p class="card-text flex-grow-1"><?php echo htmlspecialchars($newsletter['Content']); ?></p>
                                    </div>
                                    <div class="card-footer bg-light text-muted">
                                        <small>Issue Date: <?php echo htmlspecialchars($newsletter['IssueDate']); ?></small><br>
                                        <small>Created At: <?php echo htmlspecialchars($newsletter['CreatedAt']); ?></small><br>
                                        <small>Updated At: <?php echo htmlspecialchars($newsletter['UpdatedAt']); ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php echo renderPagination($pageObligatory, ceil($totalObligatory / $perPage), 'Obligatory'); ?>
                </div>

                <!-- Optional Newsletters -->
                <div class="tab-pane fade" id="optional" role="tabpanel" aria-labelledby="optional-tab">
                    <div class="row">
                        <?php foreach ($optionalNewsletters as $newsletter) { ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-title"><?php echo htmlspecialchars($newsletter['Title']); ?></h5>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <p class="card-text flex-grow-1"><?php echo htmlspecialchars($newsletter['Content']); ?></p>
                                    </div>
                                    <div class="card-footer bg-light text-muted">
                                        <small>Issue Date: <?php echo htmlspecialchars($newsletter['IssueDate']); ?></small><br>
                                        <small>Created At: <?php echo htmlspecialchars($newsletter['CreatedAt']); ?></small><br>
                                        <small>Updated At: <?php echo htmlspecialchars($newsletter['UpdatedAt']); ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php echo renderPagination($pageOptional, ceil($totalOptional / $perPage), 'Optional'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once("components/footer.php"); ?>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<?php require_once("components/scripts.php"); ?>
</body>

</html>