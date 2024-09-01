<?php
require_once('../class/apply.class.php');
$apply = new Apply;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Set parameters and execute
    $campus = $_POST['campus'];
    $semester = $_POST['semester'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $place_of_birth = $_POST['place_of_birth'];
    $country_of_birth = $_POST['country_of_birth'];
    $nationality_type = $_POST['nationality_type'];
    $nationality_1 = $_POST['nationality_1'];
    $nationality_2 = $_POST['nationality_2'];
    $record_number = $_POST['record_number'];
    $location = $_POST['location'];
    $lebanese_document_type = $_POST['lebanese_document_type'];
    $lebanese_document_number = $_POST['lebanese_document_number'];
    $passport_number = $_POST['passport_number'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $mother_maiden_name = $_POST['mother_maiden_name'];
    $emergency_contact_person = $_POST['emergency_contact_person'];
    $emergency_contact_phone = $_POST['emergency_contact_phone'];
    $city_area = $_POST['city_area'];
    $street = $_POST['street'];
    $building = $_POST['building'];
    $phone = $_POST['phone'];
    $mobile = $_POST['mobile'];
    $student_occupation = $_POST['student_occupation'];
    $student_company_name = $_POST['student_company_name'];
    $father_occupation = $_POST['father_occupation'];
    $father_company_name = $_POST['father_company_name'];
    $mother_occupation = $_POST['mother_occupation'];
    $mother_company_name = $_POST['mother_company_name'];
    $attended_school = $_POST['attended_school'];
    $school_from_date = $_POST['school_from_date'];
    $school_to_date = $_POST['school_to_date'];
    $diploma_type = $_POST['diploma_type'];
    $school_branch = $_POST['school_branch'];
    $school_year = $_POST['school_year'];
    $candidate_number = $_POST['candidate_number'];
    $country_of_study = $_POST['country_of_study'];
    $certificate_source = $_POST['certificate_source'];
    $gpa_numerator = $_POST['gpa_numerator'];
    $gpa_denominator = $_POST['gpa_denominator'];
    $education_level = $_POST['education_level'];
    $choice_of_program = $_POST['choice_of_program'];
    $chosen_school = $_POST['chosen_school'];
    $chosen_major = $_POST['chosen_major'];
    $application_source = $_POST['application_source'];
    $result = $apply->insertForm(
        $campus,
        $semester,
        $first_name,
        $middle_name,
        $last_name,
        $gender,
        $date_of_birth,
        $place_of_birth,
        $country_of_birth,
        $nationality_type,
        $nationality_1,
        $nationality_2,
        $record_number,
        $location,
        $lebanese_document_type,
        $lebanese_document_number,
        $passport_number,
        $father_name,
        $mother_name,
        $mother_maiden_name,
        $emergency_contact_person,
        $emergency_contact_phone,
        $city_area,
        $street,
        $building,
        $phone,
        $mobile,
        $student_occupation,
        $student_company_name,
        $father_occupation,
        $father_company_name,
        $mother_occupation,
        $mother_company_name,
        $attended_school,
        $school_from_date,
        $school_to_date,
        $diploma_type,
        $school_branch,
        $school_year,
        $candidate_number,
        $country_of_study,
        $certificate_source,
        $gpa_numerator,
        $gpa_denominator,
        $education_level,
        $choice_of_program,
        $chosen_school,
        $chosen_major,
        $application_source
    );
    if ($result) {

        $insertionValue = json_encode($result);

        // Output the URL redirection with PHP variable correctly embedded
        echo '<script>
            // Define the insertion value in JavaScript
            var insertionValue = ' . $insertionValue . ';
            // Redirect to the URL with the encoded parameter
            window.location.href = "http://localhost/mosque-website-template/Home/submission.php?insertion=" + encodeURIComponent(insertionValue);
        </script>';
    } else {
        echo '<p>A technical error have been occured</p>';
    }

        echo '<script>window.location.href="http://localhost/collegeMS/mosque-website-template/mosque-website-template/submission.php" </script>';
    } else {
        echo '<p>An error have been occured</p>';
    }
} else {
    echo '<p>A technical error have been occured</p>';

}
