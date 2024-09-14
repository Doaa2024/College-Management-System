<?php require_once('components/header.php') ?>
<?php require_once('components/navbar.php') ?>
<?php require_once('DAL/retrieve.class.php');

// Create an instance of the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();

// Retrieve userID from GET, with a default value of 3 if not provided
$userID = isset($_GET['userID']) ? intval($_GET['userID']) : 3;

// Retrieve the selected semester and year from the POST request, or use default values
$selectedSemester = isset($_POST['semester']) ? $_POST['semester'] : 'Fall';
$selectedYear = isset($_POST['year']) ? intval($_POST['year']) : 2024;

// Fetch the total credits and fees for the student based on the selected semester and year
$payments = $universityData->getTotalCreditsAndFees($userID, $selectedSemester, $selectedYear);

// Function to divide the total fee across the months for the selected semester
function generatePaymentSchedule($totalFees, $semester) {
    $schedule = [];
    
    switch ($semester) {
        case 'Fall':
            // Fall has 4 months (Oct, Nov, Dec, Jan)
            $months = ['October', 'November', 'December', 'January'];
            break;
        case 'Spring':
            // Spring has 4 months (Feb, Mar, Apr, May)
            $months = ['February', 'March', 'April', 'May'];
            break;
        case 'Summer':
            // Summer has 1 month (July)
            $months = ['July'];
            break;
        default:
            $months = [];
    }

    // Calculate the payment per month
    $paymentPerMonth = $totalFees / count($months);

    // Generate payment schedule
    foreach ($months as $index => $month) {
        $schedule[] = [
            'PaymentNumber' => $index + 1, // Payment #1, #2, ...
            'Month' => $month,
            'Amount' => number_format($paymentPerMonth, 2)
        ];
    }

    return $schedule;
}

// Get the total fee from the result and generate the payment schedule
$totalFees = !empty($payments) ? $payments[0]['TotalFees'] : 0;
$paymentSchedule = generatePaymentSchedule($totalFees, $selectedSemester);
?>

<div class="my-3 my-md-5" >
    <div class="container">
        <!-- Form for selecting semester and year -->
        <form method="POST" class="form-inline mb-4 shadow-sm p-3 bg-white rounded" style="box-shadow: 0 1px 4px rgba(0, 0, 255, 0.2);">
            <div class="form-group mr-3">
                <label for="semester" class="mr-2">Select Semester:</label>
                <select class="form-control" id="semester" name="semester">
                    <option value="Fall" <?php echo $selectedSemester == 'Fall' ? 'selected' : ''; ?>>Fall</option>
                    <option value="Spring" <?php echo $selectedSemester == 'Spring' ? 'selected' : ''; ?>>Spring</option>
                    <option value="Summer" <?php echo $selectedSemester == 'Summer' ? 'selected' : ''; ?>>Summer</option>
                </select>
            </div>
            <div class="form-group mr-3" >
                <label for="year" class="mr-2">Select Year:</label>
                <select class="form-control" id="year" name="year">
                    <?php for ($year = 2020; $year <= 2025; $year++) { ?>
                        <option value="<?php echo $year; ?>" <?php echo $selectedYear == $year ? 'selected' : ''; ?>>
                            <?php echo $year; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary shadow">Filter</button>
        </form>

        <!-- Displaying the result -->
        <?php if (!empty($payments)) { ?>
            <div class="card mb-4 border-primary shadow-sm" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
                <div class="card-body">
                    <h5 class="card-title text-primary">Student: <?php echo htmlspecialchars($payments[0]['Username']); ?></h5>
                    <p class="card-text">Total Credits: <?php echo htmlspecialchars($payments[0]['TotalCredits']); ?></p>
                    <p class="card-text">Total Fees: <span class="text-primary">$<?php echo htmlspecialchars($payments[0]['TotalFees']); ?></span></p>
                </div>
            </div>

            <!-- Payment Schedule -->
            <div class="card border-primary shadow-sm" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
                <div class="card-body">
                    <h5 class="card-title text-primary">Payment Schedule for <?php echo htmlspecialchars($selectedSemester) . " " . htmlspecialchars($selectedYear); ?></h5>
                    <table class="table table-bordered table-hover shadow-sm" style="box-shadow: 0 4px 8px rgba(0, 0, 255, 0.2);">
                        <thead class="thead-primary">
                            <tr class="bg-primary text-white">
                                <th class="text-white">Payment #</th>
                                <th class="text-white">Month</th>
                                <th class="text-white">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($paymentSchedule as $payment) { ?>
                                <tr>
                                    <td><?php echo $payment['PaymentNumber']; ?></td>
                                    <td><?php echo $payment['Month']; ?></td>
                                    <td><span class="text-primary">$<?php echo $payment['Amount']; ?></span></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } else { ?>
            <p class="text-danger">No data found for the selected semester and year.</p>
        <?php } ?>
    </div>
</div>

<script src="logic.js"></script>
<?php require_once("components/footer.php") ?>
</body>
</html>
