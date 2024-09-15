<?php
require('../DAL/retrieve.class.php');

// Create an instance of your data retrieval class
$universityData = new UniversityDataRetrieval();

// Pagination parameters
$items_per_page = isset($_POST['length']) ? (int)$_POST['length'] : 10; // Number of items per page, default to 10
$page = isset($_POST['start']) ? (int)$_POST['start'] / $items_per_page + 1 : 1; // Current page, default to 1
$offset = ($page - 1) * $items_per_page; // Offset for SQL query

// Search parameters
$search_value = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

// Sorting parameters
$order_column = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
$order_dir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc';

try {
    // Fetch paginated and filtered courses from the UniversityDataRetrieval class
    $courses = $universityData->getCourses($offset, $items_per_page, $search_value, $order_column, $order_dir);

    // Get the total number of items from the database
    $total_items = $universityData->getTotalCoursesCount($search_value);

    // Prepare data for DataTables
    $data = [];
    foreach ($courses as $row) {
        $data[] = [
            'CourseName' => htmlspecialchars($row['CourseName']),
            'CourseCode' => htmlspecialchars($row['CourseCode']),
            'Credits' => htmlspecialchars($row['Credits']),
            'CreatedAt' => htmlspecialchars(date('Y-m-d', strtotime($row['CreatedAt']))),
            'UpdatedAt' => htmlspecialchars(date('Y-m-d', strtotime($row['UpdatedAt']))),
            'Actions' => '<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editBranchModal" data-name="' . htmlspecialchars($row['CourseName']) . '" data-code="' . htmlspecialchars($row['CourseCode']) . '" data-credits="' . htmlspecialchars($row['Credits']) . '" data-course="' . htmlspecialchars($row['CourseID']) . '" onclick="fillEditCourseForm(this)"><i class="fas fa-edit"></i></button> <button type="button" class="btn btn-danger btn-sm text-white" onclick="confirmDeleteCourse(\'' . htmlspecialchars($row['CourseID']) . '\')"><i class="fas fa-trash-alt" style="color:white !important"></i></button>'
        ];
    }

    // Return data as JSON
    echo json_encode([
        'draw' => isset($_POST['draw']) ? intval($_POST['draw']) : 1,
        'recordsTotal' => $total_items,
        'recordsFiltered' => $total_items,
        'data' => $data
    ]);
} catch (Exception $e) {
    // Handle any errors
    echo json_encode(['error' => 'Error fetching data: ' . $e->getMessage()]);
}
