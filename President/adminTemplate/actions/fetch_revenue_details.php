<?php
// Ensure the file is included correctly and session is started if necessary
require('../dal/retrieve.class.php');

// Check if the POST request contains the branchID parameter
if (isset($_POST['branchID'])) {
    $branchID = $_POST['branchID'];

    // Instantiate the BranchRevenueRetrieval class
    $revenueRetrieval = new UniversityDataRetrieval();

    // Get the revenue details for the specified branch
    $revenueDetails = $revenueRetrieval->getBranchRevenueDetails($branchID);

    // Check if revenue details were retrieved
    if (!empty($revenueDetails)) {
        // Build the HTML for the revenue details
        $html = '<table class="table table-bordered" >
                    <thead >
                        <tr >
                            <th>Revenue ID</th>
                            <th>Branch Name</th>
                            <th>Source Name</th>
                            <th>Amount</th>
                            <th>Revenue Date</th>
                        </tr>
                    </thead>
                    <tbody>';

        // Loop through the revenue details and build table rows
        foreach ($revenueDetails as $revenue) {
            $html .= '<tr>
                        <td>' . htmlspecialchars($revenue['revenue_id']) . '</td>
                        <td>' . htmlspecialchars($revenue['BranchName']) . '</td>
                        <td>' . htmlspecialchars($revenue['source_name']) . '</td>
                        <td>' . htmlspecialchars($revenue['amount']) . '</td>
                        <td>' . htmlspecialchars($revenue['revenue_date']) . '</td>
                      </tr>';
        }

        $html .= '</tbody></table>';

        // Return the HTML content as the response
        echo $html;
    } else {
        // If no revenue details are found, return an error message
        echo '<p>No revenue details found for this branch.</p>';
    }
} else {
    // If branchID is not set, return an error message
    echo '<p>Invalid request. Branch ID is missing.</p>';
}
