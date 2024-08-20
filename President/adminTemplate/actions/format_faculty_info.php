<?php
require('../DAL/retrieve.class.php');

function getFacultyID()
{
    return isset($_GET['facultyID']) ? intval($_GET['facultyID']) : 0;
}

function formatFacultyInfo($facultyInfo)
{
    $formattedInfo = [];

    if (!empty($facultyInfo)) {
        $formattedInfo['FacultyName'] = htmlspecialchars($facultyInfo[0]['FacultyName']);
        $formattedInfo['CreditFee'] = htmlspecialchars($facultyInfo[0]['CreditFee']);
        $formattedInfo['FacultyHead'] = htmlspecialchars($facultyInfo[0]['FacultyHeadName']);
        $formattedInfo['StudentCount'] = htmlspecialchars($facultyInfo[0]['StudentCount']);
        $formattedInfo['ProfessorCount'] = htmlspecialchars($facultyInfo[0]['ProfessorCount']);

        $formattedInfo['Branches'] = [];
        $formattedInfo['Departments'] = [];

        foreach ($facultyInfo as $row) {
            addBranch($formattedInfo, $row);
            addDepartment($formattedInfo, $row);
            addCourse($formattedInfo, $row);
        }
    }

    return $formattedInfo;
}

function addBranch(&$formattedInfo, $row)
{
    if (!isset($formattedInfo['Branches'][$row['BranchID']])) {
        $formattedInfo['Branches'][$row['BranchID']] = [
            'BranchName' => htmlspecialchars($row['BranchName']),
            'Location' => htmlspecialchars($row['BranchLocation'])
        ];
    }
}

function addDepartment(&$formattedInfo, $row)
{
    if (!isset($formattedInfo['Departments'][$row['DepartmentID']])) {
        $formattedInfo['Departments'][$row['DepartmentID']] = [
            'DepartmentName' => htmlspecialchars($row['DepartmentName']),
            'DepartmentHead' => htmlspecialchars($row['DepartmentHeadName']),
            'Courses' => []
        ];
    }
}

function addCourse(&$formattedInfo, $row)
{
    if ($row['CourseID']) {
        $formattedInfo['Departments'][$row['DepartmentID']]['Courses'][] = [
            'CourseID' => htmlspecialchars($row['CourseID']),
            'CourseName' => htmlspecialchars($row['CourseName']),
            'CourseCode' => htmlspecialchars($row['CourseCode']),
            'Credits' => htmlspecialchars($row['Credits'])
        ];
    }
}

function generateHTML($formattedInfo)
{
    $html = "<div class='container mt-5'>
                <div class='row'>
                    <div class='col-md-12'>
                        <h3 class='text-primary'>{$formattedInfo['FacultyName']}</h3>
                        <p><strong>Credit Fee:</strong> \${$formattedInfo['CreditFee']}</p>
                        <p><strong>Faculty Head:</strong> {$formattedInfo['FacultyHead']}</p>
                        <p><strong>Total Students:</strong> {$formattedInfo['StudentCount']}</p>
                        <p><strong>Total Professors:</strong> {$formattedInfo['ProfessorCount']}</p>
                    </div>
                </div>";

    $html .= "<div class='row'>
                <div class='col-md-6'>
                    <h4 class='text-success'>Branches</h4>
                    <table class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Branch Name</th>
                                <th>Location</th>
                            </tr>
                        </thead>
                        <tbody>";

    foreach ($formattedInfo['Branches'] as $branch) {
        $html .= "<tr>
                    <td>{$branch['BranchName']}</td>
                    <td>{$branch['Location']}</td>
                  </tr>";
    }

    $html .= "</tbody>
            </table>
        </div>";

    $html .= "<div class='col-md-6'>
                <h4 class='text-success'>Departments and Courses</h4>";

    foreach ($formattedInfo['Departments'] as $dept) {
        $html .= "<div class='mb-4'>
                    <h5>{$dept['DepartmentName']}</h5>
                    <p><strong>Department Head:</strong> {$dept['DepartmentHead']}</p>
                    <h6>Courses:</h6>
                    <table class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Course Code</th>
                                <th>Credits</th>
                            </tr>
                        </thead>
                        <tbody>";

        foreach ($dept['Courses'] as $course) {
            $html .= "<tr>
                        <td>{$course['CourseName']}</td>
                        <td>{$course['CourseCode']}</td>
                        <td>{$course['Credits']}</td>
                      </tr>";
        }

        $html .= "</tbody>
                </table>
            </div>";
    }

    $html .= "</div>
            </div>
        </div>";

    return $html;
}

// Main execution
$facultyID = getFacultyID();
$facultyRetrieval = new UniversityDataRetrieval();
$facultyInfo = $facultyRetrieval->getFacultyCompleteInfo($facultyID);

$formattedInfo = formatFacultyInfo($facultyInfo);
$html = generateHTML($formattedInfo);

// Send HTML as the response
header('Content-Type: text/html');
echo $html;
