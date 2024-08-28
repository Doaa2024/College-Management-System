<?php
require_once('DAL.class.php');

class Apply extends DAL
{

    function getCampus()
    {
        $sql = "SELECT BranchName  FROM branches ";

        return $this->getdata($sql);
    }

    function getDepartment()
    {
        $sql = "SELECT DepartmentName FROM departments ";

        return $this->getdata($sql);
    }

    function getFaculty()
    {
        $sql = "SELECT FaculityName FROM faculties";

        return $this->getdata($sql);
    }

    function getAvailableJobs()
    {
        $sql = "SELECT job_title FROM available_jobs";

        return $this->getdata($sql);
    }
    public function insertForm(
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
    ) {
        // Construct the SQL INSERT query
        $sql = "INSERT INTO studentapplications (
                campus, semester, application_date, first_name, middle_name, last_name, gender, date_of_birth, place_of_birth,
                country_of_birth, nationality_type, nationality_1, nationality_2, record_number, location, lebanese_document_type,
                lebanese_document_number, passport_number, father_name, mother_name, mother_maiden_name, emergency_contact_person,
                emergency_contact_phone, city_area, street, building, phone, mobile, student_occupation, student_company_name,
                father_occupation, father_company_name, mother_occupation, mother_company_name, attended_school, school_from_date,
                school_to_date, diploma_type, school_branch, school_year, candidate_number, country_of_study, certificate_source,
                gpa_numerator, gpa_denominator, education_level, choice_of_program, chosen_school, chosen_major, application_source
            ) VALUES (
                '$campus', '$semester', NOW(), '$first_name', '$middle_name', '$last_name', '$gender', '$date_of_birth', '$place_of_birth',
                '$country_of_birth', '$nationality_type', '$nationality_1', '$nationality_2', '$record_number', '$location', '$lebanese_document_type',
                '$lebanese_document_number', '$passport_number', '$father_name', '$mother_name', '$mother_maiden_name', '$emergency_contact_person',
                '$emergency_contact_phone', '$city_area', '$street', '$building', '$phone', '$mobile', '$student_occupation', '$student_company_name',
                '$father_occupation', '$father_company_name', '$mother_occupation', '$mother_company_name', '$attended_school', '$school_from_date',
                '$school_to_date', '$diploma_type', '$school_branch', '$school_year', '$candidate_number', '$country_of_study', '$certificate_source',
                '$gpa_numerator', '$gpa_denominator', '$education_level', '$choice_of_program', '$chosen_school', '$chosen_major', '$application_source'
            )";

        return $this->execute($sql);
    }
    public function insertApplicationJob($position, $comments, $cv_path, $additional_files, $cover_letter)
    {
        $sql = "INSERT INTO `professorjobapplications` (`PositionAppliedFor`,  `CVPath`, `CoverLetterPath`, `AdditionalDocumentsPath`,  `Comments`) VALUES ('$position', '$cv_path', '$cover_letter','$additional_files', '$comments')";
        return $this->execute($sql);
    }
}
