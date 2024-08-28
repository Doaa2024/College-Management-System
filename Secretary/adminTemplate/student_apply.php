<?php require_once('components/header.php');

// Require the class file
require('DAL/retrieve.class.php');

// Instantiate the UniversityDataRetrieval class
$universityData = new UniversityDataRetrieval();
$allCampus = $universityData->getCampus();
$allDepartment = $universityData->getDepartment();
$allFaculty = $universityData->getFaculty();
?>
<style>
    h2 {
        color: rgba(72, 139, 199, 1);
        /* Light blue color */
        margin-bottom: 2rem;
        font-family: 'Arial', sans-serif;
        font-size: 2.8rem;
    }

    .form-group label {
        font-weight: bold;
        color: rgba(0, 0, 0, 0.7);
    }

    .form-control {
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        padding: 0.75rem;
        transition: border-color 0.3s, box-shadow 0.3s;
        height: auto;
    }

    .form-control:focus {
        border-color: rgba(72, 139, 199, 0.7);
        /* Light blue color */
        box-shadow: 0 0 0 0.2rem rgba(72, 139, 199, 0.25);
        /* Light blue color */
    }

    .btn-primary1 {
        background-color: rgba(72, 139, 199, 1);
        /* Light blue color */
        border: none;
        border-radius: 40px;
        padding-left: 8rem;
        padding-right: 8rem;
        padding-top: 1rem;
        padding-bottom: 1rem;
        font-size: 20px;
        font-weight: bold;
        transition: background-color 0.3s, box-shadow 0.3s;
        color: white;
        /* White text */
    }

    .btn-primary1:hover {
        background-color: rgba(72, 139, 199, 0.9);
        color: beige;
        /* Slightly darker light blue */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 1200px) {
        .btn-primary1 {
            padding-left: 6rem;
            padding-right: 6rem;
            font-size: 18px;
        }
    }

    @media (max-width: 992px) {
        .btn-primary1 {
            padding-left: 4rem;
            padding-right: 4rem;
            font-size: 16px;
        }
    }

    @media (max-width: 768px) {
        .btn-primary1 {
            padding-left: 3rem;
            padding-right: 3rem;
            padding-top: 0.8rem;
            padding-bottom: 0.8rem;
            font-size: 14px;
        }
    }

    @media (max-width: 576px) {
        .btn-primary1 {
            padding-left: 2rem;
            padding-right: 2rem;
            padding-top: 0.6rem;
            padding-bottom: 0.6rem;
            font-size: 12px;
        }
    }

    .row {
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }
</style>

<body>


    <!-- Hero Start -->
    <div class="con mt-5" style=" background-color: #ffffff;
        margin-left:5%;
        margin-right:5%;
        padding: 3rem;
        border-radius: 10px;
        border:1px solid  rgba(72, 139, 199, .5);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h2 class="text-center">Student Admission Form</h2>
        <form method="post" action="actions/submit_student.php">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">

                        <label for="first_name">First Name <span style="color:red; font-size:large">*</span></label>

                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="middle_name">Middle Name <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="last_name">Last Name <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                </div>
            </div>

            <div class="row">


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth <span style="color:red; font-size:large">*</span></label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="place_of_birth">Place of Birth <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="country_of_birth">Country of Birth <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="country_of_birth" name="country_of_birth" required>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nationality_type">Nationality Type <span style="color:red; font-size:large">*</span></label>
                        <select class="form-control" id="nationality_type" name="nationality_type" required>
                            <option value="">Select Nationality Type</option>
                            <option value="Lebanese">Lebanese</option>
                            <option value="Foreign">Foreign</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nationality_1">Nationality 1 <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="nationality_1" name="nationality_1" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nationality_2">Nationality 2</label>
                        <input type="text" class="form-control" id="nationality_2" name="nationality_2">
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="campus">Campus <span style="color:red; font-size:large">*</span></label>
                        <select class="form-control" id="campus" name="campus" required>
                            <option value="">Select Campus</option>
                            <?php foreach ($allCampus as $campus): ?>
                                <option value="<?= htmlspecialchars($campus['BranchName']) ?>">
                                    <?= htmlspecialchars($campus['BranchName']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="semester">Semester <span style="color:red; font-size:large">*</span></label>
                        <select class="form-control" id="semester" name="semester" required>
                            <option value="">Select Semester</option>
                            <option value="Fall">Fall</option>
                            <option value="Spring">Spring</option>
                            <option value="Summer">Summer</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="gender">Gender <span style="color:red; font-size:large">*</span></label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="record_number">Record Number <span style="color:red; font-size:large">*</span></label>
                        <input type="number" class="form-control" id="record_number" name="record_number" min="1" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="student_occupation">Student Occupation <span style="color:red; font-size:large">*</span></label>
                        <select class="form-control" id="student_occupation" name="student_occupation" required>
                            <option value="">Select Occupation</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Self Employed">Self Employed</option>
                            <option value="Public Sector">Public Sector</option>
                            <option value="Private Sector">Private Sector</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="student_company_name">Student Company Name </label>
                        <input type="text" class="form-control" id="student_company_name" name="student_company_name">
                    </div>
                </div>



            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="attended_school">Attended School <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="attended_school" name="attended_school" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="school_from_date">School From Date <span style="color:red; font-size:large">*</span></label>
                        <input type="date" class="form-control" id="school_from_date" name="school_from_date" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="school_to_date">School To Date <span style="color:red; font-size:large">*</span></label>
                        <input type="date" class="form-control" id="school_to_date" name="school_to_date" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="diploma_type">Diploma Type <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="diploma_type" name="diploma_type" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="school_branch">School Branch <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="school_branch" name="school_branch" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="school_year">School Year <span style="color:red; font-size:large">*</span></label>
                        <input type="date" class="form-control" id="school_year" name="school_year" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="school_course">School Course <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="school_course" name="school_course" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="candidate_number">Candidate Number <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="candidate_number" name="candidate_number" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="country_of_study">Country of Study <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="country_of_study" name="country_of_study" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="location">Location <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="lebanese_document_type">Lebanese Document Type <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="lebanese_document_type" name="lebanese_document_type" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="lebanese_document_number">Lebanese Document Number <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="lebanese_document_number" name="lebanese_document_number" required>
                    </div>
                </div>
            </div>

            <div class="row">


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="father_name">Father's Name <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="father_name" name="father_name" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="father_occupation">Father's Occupation <span style="color:red; font-size:large">*</span></label>
                        <select class="form-control" id="father_occupation" name="father_occupation" required>
                            <option value="">Select Occupation</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Self Employed">Self Employed</option>
                            <option value="Public Sector">Public Sector</option>
                            <option value="Private Sector">Private Sector</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mother_maiden_name">Father's Company Name</label>
                        <input type="text" class="form-control" id="father_company_name" name="father_company_name">
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mother_name">Mother's Name <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mother_maiden_name">Mother's Maiden Name <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="mother_maiden_name" name="mother_maiden_name" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="father_occupation">Mothers's Occupation <span style="color:red; font-size:large">*</span></label>
                        <select class="form-control" id="mother_occupation" name="mother_occupation" required>
                            <option value="">Select Occupation</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Self Employed">Self Employed</option>
                            <option value="Public Sector">Public Sector</option>
                            <option value="Private Sector">Private Sector</option>
                        </select>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mother_maiden_name">Mother's Company Name</label>
                        <input type="text" class="form-control" id="mother_company_name" name="mother_company_name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="emergency_contact_person">Emergency Contact Person <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="emergency_contact_person" name="emergency_contact_person" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="emergency_contact_phone">Emergency Contact Phone <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="emergency_contact_phone" name="emergency_contact_phone" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="certificate_source">Certificate Source <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="certificate_source" name="certificate_source" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="gpa_numerator">GPA Numerator </label>
                        <input type="number" step="0.01" class="form-control" id="gpa_numerator" name="gpa_numerator" min="0.1">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="gpa_denominator">GPA Denominator</label>
                        <input type="number" step="0.01" class="form-control" id="gpa_denominator" name="gpa_denominator" min="0.1">
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="education_level">Education Level <span style="color:red; font-size:large">*</span></label>
                        <select class="form-control" id="education_level" name="education_level" required>
                            <option value="">Select Level</option>
                            <option value="Undergraduate">Undergraduate</option>
                            <option value="Graduate">Graduate</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="choice_of_program">Choice of Program <span style="color:red; font-size:large">*</span></label>
                        <select class="form-control" id="choice_of_program" name="choice_of_program" required>
                            <option value="">Select Program</option>
                            <option value="Regular">Regular</option>
                            <option value="Transfer">Transfer</option>
                            <option value="Freshman">Freshman</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="chosen_school">Chosen School <span style="color:red; font-size:large">*</span></label>
                        <select class="form-control" id="chosen_school" name="chosen_school" required>
                            <option value="">Select School</option>
                            <?php foreach ($allFaculty as $faculty): ?>
                                <option value="<?= $faculty['FaculityName'] ?>">
                                    <?= $faculty['FaculityName'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="chosen_major">Chosen Major <span style="color:red; font-size:large">*</span></label>
                        <select class="form-control" id="chosen_major" name="chosen_major" required>
                            <option value="">Select Major</option>
                            <?php foreach ($allDepartment as $major): ?>
                                <option value="<?= $major['DepartmentName'] ?>">
                                    <?= $major['DepartmentName'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="application_source">Application Source <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="application_source" name="application_source" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="application_source">Passport Number</label>
                        <input type="number" class="form-control" id="passport_number" name="passport_number" min="1">
                    </div>
                </div>
            </div>



            <!-- Row 5: Additional Information -->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="scholarship_status">Scholarship Status <span style="color:red; font-size:large">*</span></label>
                        <select class="form-control" id="scholarship_status" name="scholarship_status" required>
                            <option value="">Select Status</option>
                            <option value="None">None</option>
                            <option value="Partial">Partial</option>
                            <option value="Full">Full</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="special_needs">Special Needs</label>
                        <input type="text" class="form-control" id="special_needs" name="special_needs">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="additional_info">Additional Information</label>
                        <input class="form-control" id="additional_info" name="additional_info">
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="city_area">City Area <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="city_area" name="city_area" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="street">Street <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="street" name="street" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="building">Building <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="building" name="building" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="floor">Floor <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="floor" name="floor" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="apartment">Apartment <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="apartment" name="apartment" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone">Phone <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email <span style="color:red; font-size:large">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mobile">Mobile <span style="color:red; font-size:large">*</span></label>
                        <input type="text" class="form-control" id="mobile" name="mobile" required>
                    </div>
                </div>

            </div>


            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-primary1">Submit</button>
            </div>
        </form>
    </div>
    <!-- Hero End -->
    <?php require_once('components/footer.php'); ?>
    <?php require_once('components/scripts.php'); ?>
</body>

</html>