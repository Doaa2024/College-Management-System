<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<?php require_once('components/navbar.php'); ?>
<?php require_once('DAL/retrieve.class.php'); ?>
<?php $dataRetrieval = new UniversityDataRetrieval(); ?>

<div class="container-fluid">
    <h1 class="mt-4 mb-4">Create Newsletter</h1>

    <!-- Newsletter Type Selection Form -->
    <div class="card mb-4 border-primary">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Select Newsletter Type</h5>
        </div>
        <div class="card-body">
            <form id="newsletterTypeForm">
                <div class="form-group">
                    <label for="newsletterType">Choose Newsletter Type:</label>
                    <select id="newsletterType" class="form-control" onchange="showForm(this.value)">
                        <option value="">Select...</option>
                        <option value="obligatory">Obligatory Newsletter</option>
                        <option value="optional">Optional Newsletter</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Form to Create a Newsletter -->
    <div id="newsletterForm" class="card border-primary" style="display: none;">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Create Newsletter</h5>
        </div>
        <div class="card-body">
            <form action="submit_newsletter.php" method="post">
                <input type="hidden" id="newsletterTypeHidden" name="newsletterType">
                
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="issueDate">Issue Date:</label>
                    <input type="date" id="issueDate" name="issueDate" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea id="content" name="content" class="form-control" rows="4" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
function showForm(type) {
    var formContainer = document.getElementById('newsletterForm');
    var typeHidden = document.getElementById('newsletterTypeHidden');

    if (type) {
        typeHidden.value = type;
        formContainer.style.display = 'block';
    } else {
        formContainer.style.display = 'none';
    }
}
</script>

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
