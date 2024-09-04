<?php
require('dal.class.php');

class UserManagement extends DAL
{
    public function edit_creditPrice($facultyID, $newCreditFee)
    {
        $sql = "UPDATE faculties SET CreditFee = ? WHERE FacultyID = ?";
        return $this->execute($sql, [$newCreditFee, $facultyID]);
    }

    public function updateRequirements($id, $admission, $documents, $courses, $curriculum, $credit_hours, $major_courses, $major_electives, $core_courses, $general_education, $conclusion)
    {
        // Define the SQL query for updating data with `?` placeholders
        $sql = "UPDATE admissionrequirements 
                SET admission_requirements = ?, 
                    required_documents = ?, 
                    courses= ?, 
                    credit_hours = ?, 
                    curriculum = ?, 
                    core_courses = ?, 
                    major_courses = ?, 
                    major_electives = ?,
                       general_education = ?, 
                    conclusion = ? 
                WHERE id= ?";

        // Prepare parameters
        $params = [
            $admission,
            $documents,
            $courses,
            $credit_hours,
            $curriculum,
            $core_courses,
            $major_courses,
            $major_electives,
            $general_education,
            $conclusion,
            $id
        ];

        // Execute the query
        return $this->execute($sql, $params);
    }


    public function   updateFreshman($fisrt_paragraph, $requirements_list, $last_paragraph, $id)
    {
        $sql = "UPDATE freshman SET FirstParagraph = ?, RequirementsList=?, LastParagraph=? WHERE FreshManID = ?";
        return $this->execute($sql, [$fisrt_paragraph, $requirements_list, $last_paragraph, $id]);
    }
    public function   updateTransfer($fisrt_paragraph, $documents_list, $last_paragraph, $id)
    {
        $sql = "UPDATE transfer SET FirstParaghraph = ?,DocumentsList=?, LastParaghraph=? WHERE TransferID = ?";
        return $this->execute($sql, [$fisrt_paragraph, $documents_list, $last_paragraph, $id]);
    }
    public function       updateProfessorApplication($reviewedBy, $reviewedAt, $status, $id)
    {
        $sql = "UPDATE professorjobapplications SET Status = ?,ReviewedBy=?, ReviewedAt=? WHERE ApplicationID = ?";
        return $this->execute($sql, [$status, $reviewedBy, $reviewedAt, $id]);
    }

    public function   searchEmployeeApplicationByIDAgain($applicationID)
    {
        $sql = "SELECT * FROM professorjobapplications
                WHERE ApplicationID = ? 
               ";

        return $this->getData($sql, [$applicationID]);
    }
    public function   updateSchools($id, $description)
    {
        $sql = "UPDATE schools_home SET Description = ? WHERE schools_id = ?";
        return $this->execute($sql, [$description, $id]);
    }
    public function edit_BranchHead($branchID, $newBranchHeadID)
    {
        $sql = "UPDATE branches SET BranchHeadID = ? WHERE BranchID = ?";
        return $this->execute($sql, [$newBranchHeadID, $branchID]);
    }

    public function edit_facultyHead($facultyID, $newFacultyHeadID)
    {
        $sql = "UPDATE facultyheads SET FacultyHeadID = ? WHERE FacultyID = ?";
        return $this->execute($sql, [$newFacultyHeadID, $facultyID]);
    }

    public function edit_departementHead($departmentID, $newDepartmentHeadID)
    {
        $sql = "UPDATE departmentheads SET DepartmentHeadID = ? WHERE DepartmentID = ?";
        return $this->execute($sql, [$newDepartmentHeadID, $departmentID]);
    }

    public function add_faculty_branch($facultyID, $branchID)
    {

        $sql = "INSERT INTO faculty_branches (FacultyID, BranchID) VALUES (?, ?)";
        $this->execute($sql, [$facultyID, $branchID]);
    }


    public function remove_faculty($facultyID)
    {
        $sql = "DELETE FROM faculties WHERE FacultyID = ?";
        return $this->execute($sql, [$facultyID]);
    }

    public function add_department($departmentName)
    {
        $sql = "INSERT INTO departments (DepartmentName) VALUES (?)";
        return $this->execute($sql, [$departmentName]);
    }

    public function remove_department($departmentID)
    {
        $sql = "DELETE FROM departments WHERE DepartmentID = ?";
        return $this->execute($sql, [$departmentID]);
    }

    public function add_user($username, $password, $email, $role, $branchID = null, $facultyID = null, $departmentID = null)
    {
        $sql = "INSERT INTO users (Username, Password, Email, Role, BranchID, FacultyID, DepartmentID, Status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, 'Active')";
        return $this->execute($sql, [$username, $password, $email, $role, $branchID, $facultyID, $departmentID]);
    }

    public function remove_user($userID)
    {
        $sql = "UPDATE users SET Status = 'Inactive' WHERE UserID = ?";
        return $this->execute($sql, [$userID]);
    }
    public function remove_job($jobID)
    {
        // Remove a branch by setting its status to 'Inactive' or by deleting it
        $sql = "delete from available_jobs WHERE job_id = ?";
        return $this->execute($sql, [$jobID]);
    }
    public function register_student($username, $email, $role, $branchID, $facultyID, $departmentID, $password)
    {
        $sql = "INSERT INTO users (UserName, Email,Role,BranchID,FacultyID, DepartmentID, Password) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        return $this->execute($sql, [
            $username,
            $email,
            $role,
            $branchID,
            $facultyID,
            $departmentID,
            $password,

        ]);
    }
    public function register_employee($username, $email, $role, $branchID, $facultyID, $password)
    {
        $sql = "INSERT INTO users (UserName, Email,Role,BranchID,FacultyID, Password) 
                VALUES (?, ?, ?, ?, ?, ?)";
        return $this->execute($sql, [
            $username,
            $email,
            $role,
            $branchID,
            $facultyID,

            $password,

        ]);
    }
    public function getFacultyByID($FacultyName)
    {
        $sql = "SELECT  FacultyID FROM faculties 
                WHERE  FaculityName= ? 
                ";

        return $this->getData($sql, [$FacultyName]);
    }
    public function getDepartmentByID($departmentName)
    {
        $sql = "SELECT DepartmentID FROM departments 
                WHERE  DepartmentName= ? 
                ";

        return $this->getData($sql, [$departmentName]);
    }
    public function getBranchByID($branchName)
    {
        $sql = "SELECT BranchID FROM branches
                WHERE  BranchName= ? 
                ";

        return $this->getData($sql, [$branchName]);
    }
    public function updateStudentApplicationStatus($applicationID)
    {
        $sql = "Update studentapplications Set Status='Approved' where application_id=?
                ";

        return $this->execute($sql, [$applicationID]);
    }
    public function addjob($jobTitle, $facultyId, $jobDescription, $requiredQualifications, $applicationDeadline, $jobLocation, $jobType, $salaryRange, $jobStatus)
    {
        $sql = "INSERT INTO available_jobs (job_title, faculty_iD, job_description, required_qualifications, application_deadline, job_location, job_type, salary_range, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        return $this->execute($sql, [
            $jobTitle,
            $facultyId,
            $jobDescription,
            $requiredQualifications,
            $applicationDeadline,
            $jobLocation,
            $jobType,
            $salaryRange,
            $jobStatus
        ]);
    }

    public function   maxID()
    {
        $sql = "    SELECT MAX(UserID) AS last_id FROM users 
               ";

        return $this->getData($sql, []);
    }
    public function   maxApplicationID()
    {
        $sql = "    SELECT MAX(application_id) AS last_id FROM studentapplications
               ";

        return $this->getData($sql, []);
    }

    public function edit_job($jobID, $jobTitle, $facultyId, $jobDescription, $requiredQualifications, $applicationDeadline, $jobLocation, $jobType, $salaryRange, $jobStatus)
    {
        $sql = "UPDATE available_jobs 
                SET job_title = ?, faculty_id = ?, job_description = ?, required_qualifications = ?, application_deadline = ?, job_location = ?, job_type = ?, salary_range = ?, status = ?
                WHERE job_id = ?";
        return $this->execute($sql, [$jobTitle, $facultyId, $jobDescription, $requiredQualifications, $applicationDeadline, $jobLocation, $jobType, $salaryRange, $jobStatus, $jobID]);
    }
    public function updateEmployeeInfo($id, $role, $status, $branchId, $facultyId)
    {
        // SQL query to update user information in the `users` table
        $sql = "UPDATE users 
                SET Role = ?, Status = ?, BranchID= ?, FacultyID= ?
                WHERE UserID = ?";

        // Execute the query with the provided parameters
        return $this->execute($sql, [$role, $status, $branchId, $facultyId, $id]);
    }
    public function updateStudentInfo($id, $departmentID, $status, $branchId, $facultyId)
    {
        // SQL query to update user information in the `users` table
        $sql = "UPDATE users 
                SET DepartmentID = ?, Status = ?, BranchID= ?, FacultyID= ?
                WHERE UserID = ?";

        // Execute the query with the provided parameters
        return $this->execute($sql, [$departmentID, $status, $branchId, $facultyId, $id]);
    }
    public function updateUserPassword($id, $hashedPassword)
    {
        // SQL query to update the user's password in the `users` table
        $sql = "UPDATE users 
                SET Password = ?
                WHERE UserID = ?";

        // Execute the query with the provided parameters
        return $this->execute($sql, [$hashedPassword, $id]);
    }

    public function updateFacultyCreditFee($facultyID, $newCreditFee)
    {
        $sql = "UPDATE faculties SET CreditFee = ? WHERE FacultyID = ?";
        $params = [$newCreditFee, $facultyID];

        // Use the execute method to run the update query
        return $this->execute($sql, $params);
    }
    public function updateFacultyHead($facultyID, $newHeadUserID)
    {
        $sql = "UPDATE facultyheads SET FacultyHeadID = ? WHERE FacultyID = ?";
        $params = [$newHeadUserID, $facultyID];

        return $this->execute($sql, $params);
    }
    public function updateFacultyBranch($facultyID, $newBranchID)
    {
        $sql = "UPDATE faculties SET BranchID = ? WHERE FacultyID = ?";
        $params = [$newBranchID, $facultyID];

        return $this->execute($sql, $params);
    }
    public function updateDepartmentHead($departmentID, $newHeadUserID)
    {
        $sql = "UPDATE departmentheads SET DepartmentHeadID = ? WHERE DepartmentID = ?";
        $params = [$newHeadUserID, $departmentID];

        return $this->execute($sql, $params);
    }
    public function updateDepartmentName($departmentID, $newDepartmentName)
    {
        $sql = "UPDATE departments SET DepartmentName = ? WHERE DepartmentID = ?";
        $params = [$newDepartmentName, $departmentID];

        return $this->execute($sql, $params);
    }
    public function clearFacultyBranches($facultyID)
    {
        // SQL query to remove all branches associated with the given faculty
        $sql = "DELETE FROM faculties WHERE FacultyID = ?";

        // Execute the query with the provided faculty ID
        return $this->execute($sql, [$facultyID]);
    }

    function removeBranches($facultyID)
    {
        // Prepare the SQL statement to delete branches
        $sql = "DELETE FROM faculty_branches WHERE facultyID = ?";
        return $this->execute($sql, [$facultyID]);
    }
    public function getBranchesForFaculty($facultyID)
    {
        $sql = "
        SELECT BranchID FROM faculty_branches WHERE FacultyID = ?
    ";

        $results = $this->getdata($sql, [$facultyID]);

        // Extract branch IDs from the results
        return array_map(function ($row) {
            return $row['BranchID'];
        }, $results);
    }
    public function updateHomeInfo($type, $title1, $title2, $description, $details, $id)
    {
        // Define the SQL query for updating data with `?` placeholders
        $sql = "UPDATE home SET Type = ?, Title1 = ?, Title2 = ?, Description = ?, Details = ? WHERE temp_id = ?";

        // Prepare parameters
        $params = [$type, $title1, $title2, $description, $details, $id];

        // Execute the query
        return $this->execute($sql, $params);
    }
    public function updateAboutInfo($welcomeStatement, $presidentMessage, $history, $schoolsList, $curriculum, $id)
    {
        // Define the SQL query for updating data with `?` placeholders
        $sql = "UPDATE about
                SET WelcomeStatement = ?,
                    PresidentMessage = ?,
                    History = ?,
                    SchoolsList = ?,
                    Curriculum = ?
                WHERE id = ?";

        // Prepare parameters
        $params = [$welcomeStatement, $presidentMessage, $history, $schoolsList, $curriculum, $id];

        // Execute the query
        return $this->execute($sql, $params);
    }
    public function updateMoreInfo($name, $welcomeStatement, $phoneNumber, $instagram, $facebook, $twitter, $linkedin, $email, $location)
    {
        // Define the SQL query for updating data with `?` placeholders
        $sql = "UPDATE moreinfo 
                SET welcomeStatement = ?, 
                    PhoneNumber = ?, 
                    Instagram = ?, 
                    Facebook = ?, 
                    Twitter = ?, 
                    Linkedin = ?, 
                    Email = ?, 
                    Location = ? 
                WHERE Name = ?";

        // Prepare parameters
        $params = [
            $welcomeStatement,
            $phoneNumber,
            $instagram,
            $facebook,
            $twitter,
            $linkedin,
            $email,
            $location,
            $name
        ];

        // Execute the query
        return $this->execute($sql, $params);
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
    public function insertOptionalNewsletter($title, $issueDate, $content, $createdBy)
    {
        $sql = "INSERT INTO optionalnewsletter (Title, IssueDate, Content, CreatedBy) VALUES (?, ?, ?, ?)";
        $this->execute($sql, [$title, $issueDate, $content, $createdBy]);
    }

    public function insertObligatoryNewsletter($title, $issueDate, $content, $createdBy)
    {
        $sql = "INSERT INTO obligatorynewsletter (Title, IssueDate, Content, CreatedBy) VALUES (?, ?, ?, ?)";
        $this->execute($sql, [$title, $issueDate, $content, $createdBy]);
    }
    public function getStudentByID($studentID)
    {
        $sql = "SELECT * FROM student_documents
                WHERE  student_id= ? 
                ";

        return $this->getData($sql, [$studentID]);
    }
    public function insertOrUpdateDocument($studentID, $documentName) {
        $sql = "INSERT INTO student_documents (student_id, document_name, is_present) 
                VALUES (?, ?, 1)
                ON DUPLICATE KEY UPDATE is_present = 1";
        return $this->execute($sql, [$studentID, $documentName]);
    }

    // Method to update the document status to not present (0)
    public function updateDocumentStatus($studentID, $documentName, $status) {
        $sql = "UPDATE student_documents 
                SET is_present = ? 
                WHERE student_id = ? 
                AND document_name = ?";
        return $this->execute($sql, [$status, $studentID, $documentName]);
    }

    // Method to get existing documents for a student
    public function getDocumentsByStudentID($studentID) {
        $sql = "SELECT document_name, is_present FROM student_documents WHERE student_id = ?";
        return $this->getData($sql, [$studentID]);
    }

    // Method to update documents that are not present
    public function updateMissingDocuments($studentID, $documentNames) {
        foreach ($documentNames as $documentName) {
            $this->updateDocumentStatus($studentID, $documentName, 0); // Set as not present
        }

    // Method to insert or update document presence
    }
    
}
