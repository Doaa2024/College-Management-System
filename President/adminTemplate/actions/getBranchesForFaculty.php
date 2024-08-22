<?php
include '../DAL/retrieve.class.php'; // Include your data access layer or database connection

if (isset($_POST['facultyID'])) {
    $facultyID = $_POST['facultyID'];

    // Create instance of data retrieval class
    $retrieveInfo = new UniversityDataRetrieval();

    // Fetch all branches and current branches for the given faculty
    $allBranches = $retrieveInfo->getAllBranches();
    $currentBranches = $retrieveInfo->getBranchesForFaculty($facultyID);

    // Create an array of selected branch IDs
    $selectedBranches = [];
    foreach ($currentBranches as $branch) {
        $selectedBranches[] = $branch['BranchID'];
    }

    // Generate HTML table with checkboxes
    echo '<div class="table-responsive">';
    echo '<table class="table table-striped">';
    echo '<thead><tr><th>Select</th><th>Branch ID</th><th>Branch Name</th><th>Location</th></tr></thead>';
    echo '<tbody>';

    foreach ($allBranches as $branch) {
        $isChecked = in_array($branch['BranchID'], $selectedBranches) ? 'checked' : '';
        echo '<tr>';
        echo '<td><input type="checkbox" class="branch-checkbox" value="' . htmlspecialchars($branch['BranchID']) . '" ' . $isChecked . '></td>';
        echo '<td>' . htmlspecialchars($branch['BranchID']) . '</td>';
        echo '<td>' . htmlspecialchars($branch['BranchName']) . '</td>';
        echo '<td>' . htmlspecialchars($branch['Location']) . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>'; // Close the responsive table container
}
