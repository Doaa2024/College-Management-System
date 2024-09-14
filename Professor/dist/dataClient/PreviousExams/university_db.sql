-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2024 at 01:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `AttendanceID` int(11) NOT NULL,
  `EnrollmentID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Status` enum('Present','Absent','Late') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `BranchID` int(11) NOT NULL,
  `BranchName` varchar(255) NOT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branchmajors`
--

CREATE TABLE `branchmajors` (
  `BranchMajorID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `BranchID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courseprerequisites`
--

CREATE TABLE `courseprerequisites` (
  `PrerequisiteID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `PrerequisiteCourseID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(255) NOT NULL,
  `CourseCode` varchar(50) NOT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `Credits` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `PreviousExams` text DEFAULT NULL,
  `GCRlinks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departmentheads`
--

CREATE TABLE `departmentheads` (
  `DepartmentHeadID` int(11) NOT NULL,
  `DepartmentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `DepartmentID` int(11) NOT NULL,
  `DepartmentName` varchar(255) NOT NULL,
  `FacultyID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documentrequirements`
--

CREATE TABLE `documentrequirements` (
  `RequirementID` int(11) NOT NULL,
  `DocumentTypeID` int(11) DEFAULT NULL,
  `RequiredQuantity` int(11) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documenttypes`
--

CREATE TABLE `documenttypes` (
  `DocumentTypeID` int(11) NOT NULL,
  `Description` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `DocumentTypeName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `EnrollmentID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `Role` enum('Student','Professor') DEFAULT NULL,
  `Semester` varchar(50) DEFAULT NULL,
  `Year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `EvaluationID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `ProfessorID` int(11) DEFAULT NULL,
  `EvaluationDate` date DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(11) NOT NULL,
  `EventName` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `EventDate` date DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `RoomID` int(11) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `FacultyID` int(11) NOT NULL,
  `FaculityName` varchar(255) NOT NULL,
  `BranchID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CreditFee` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facultyheads`
--

CREATE TABLE `facultyheads` (
  `FacultyHeadID` int(11) NOT NULL,
  `FacultyID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `GradeID` int(11) NOT NULL,
  `EnrollmentID` int(11) DEFAULT NULL,
  `Grade` decimal(5,2) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gradestructures`
--

CREATE TABLE `gradestructures` (
  `GradeStructureID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `AssessmentType` varchar(100) DEFAULT NULL,
  `Weight` decimal(5,2) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `NewsID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Content` text DEFAULT NULL,
  `PublishedDate` date DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newslettersubscriptions`
--

CREATE TABLE `newslettersubscriptions` (
  `SubscriptionID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `OptionalNewsLetterID` int(11) DEFAULT NULL,
  `SubscriptionDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `obligatorynewsletter`
--

CREATE TABLE `obligatorynewsletter` (
  `NewsLetterID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `IssueDate` date DEFAULT NULL,
  `Content` text DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `optionalnewsletter`
--

CREATE TABLE `optionalnewsletter` (
  `OptionalNewsLetterID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `IssueDate` date DEFAULT NULL,
  `Content` text DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `FeeID` int(11) DEFAULT NULL,
  `AmountPaid` decimal(10,2) DEFAULT NULL,
  `PaymentDate` date DEFAULT NULL,
  `PaymentMethod` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professorjobapplications`
--

CREATE TABLE `professorjobapplications` (
  `ApplicationID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `PositionAppliedFor` varchar(255) NOT NULL,
  `ApplicationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` enum('Pending','Approved','Rejected','Under Review') DEFAULT 'Pending',
  `CVPath` varchar(255) NOT NULL,
  `CoverLetterPath` varchar(255) DEFAULT NULL,
  `AdditionalDocumentsPath` varchar(255) DEFAULT NULL,
  `ReviewedBy` int(11) DEFAULT NULL,
  `ReviewedAt` timestamp NULL DEFAULT NULL,
  `Comments` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `RoomID` int(11) NOT NULL,
  `RoomName` varchar(255) NOT NULL,
  `Capacity` int(11) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentapplications`
--

CREATE TABLE `studentapplications` (
  `application_id` int(11) NOT NULL,
  `campus` varchar(100) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `country_of_birth` varchar(100) DEFAULT NULL,
  `nationality_type` enum('Lebanese','Foreign') DEFAULT NULL,
  `nationality_1` varchar(100) DEFAULT NULL,
  `nationality_2` varchar(100) DEFAULT NULL,
  `record_number` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `lebanese_document_type` varchar(50) DEFAULT NULL,
  `lebanese_document_number` varchar(50) DEFAULT NULL,
  `passport_number` varchar(50) DEFAULT NULL,
  `father_name` varchar(200) DEFAULT NULL,
  `mother_name` varchar(200) DEFAULT NULL,
  `mother_maiden_name` varchar(100) DEFAULT NULL,
  `emergency_contact_person` varchar(200) DEFAULT NULL,
  `emergency_contact_phone` varchar(20) DEFAULT NULL,
  `city_area` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `building` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `student_occupation` enum('Unemployed','Self Employed','Public Sector','Private Sector') DEFAULT NULL,
  `student_company_name` varchar(200) DEFAULT NULL,
  `father_occupation` enum('Unemployed','Self Employed','Public Sector','Private Sector') DEFAULT NULL,
  `father_company_name` varchar(200) DEFAULT NULL,
  `mother_occupation` enum('Unemployed','Self Employed','Public Sector','Private Sector') DEFAULT NULL,
  `mother_company_name` varchar(200) DEFAULT NULL,
  `attended_school` varchar(200) DEFAULT NULL,
  `school_from_date` date DEFAULT NULL,
  `school_to_date` date DEFAULT NULL,
  `diploma_type` varchar(100) DEFAULT NULL,
  `school_branch` varchar(100) DEFAULT NULL,
  `school_year` int(11) DEFAULT NULL,
  `school_course` varchar(100) DEFAULT NULL,
  `candidate_number` varchar(50) DEFAULT NULL,
  `country_of_study` varchar(100) DEFAULT NULL,
  `certificate_source` varchar(200) DEFAULT NULL,
  `gpa_numerator` decimal(3,2) DEFAULT NULL,
  `gpa_denominator` decimal(3,2) DEFAULT NULL,
  `education_level` enum('Undergraduate','Graduate') DEFAULT NULL,
  `choice_of_program` enum('Regular','Transfer','Freshman') DEFAULT NULL,
  `chosen_school` varchar(200) DEFAULT NULL,
  `chosen_major` varchar(100) DEFAULT NULL,
  `application_source` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentdocuments`
--

CREATE TABLE `studentdocuments` (
  `StudentDocumentID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `DocumentTypeID` int(11) DEFAULT NULL,
  `DocumentPath` varchar(255) DEFAULT NULL,
  `SubmissionDate` date DEFAULT NULL,
  `Status` enum('Pending','Approved','Rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentfees`
--

CREATE TABLE `studentfees` (
  `FeeID` int(11) NOT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `FeeType` varchar(100) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  `Status` enum('Paid','Unpaid') DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `TimetableID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `ProfessorID` int(11) DEFAULT NULL,
  `DayOfWeek` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `EndTime` time DEFAULT NULL,
  `RoomID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Role` enum('Student','Professor','Admin') DEFAULT NULL,
  `BranchID` int(11) DEFAULT NULL,
  `FacultyID` int(11) DEFAULT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` enum('Active','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`AttendanceID`),
  ADD KEY `EnrollmentID` (`EnrollmentID`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`BranchID`);

--
-- Indexes for table `branchmajors`
--
ALTER TABLE `branchmajors`
  ADD PRIMARY KEY (`BranchMajorID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `BranchID` (`BranchID`);

--
-- Indexes for table `courseprerequisites`
--
ALTER TABLE `courseprerequisites`
  ADD PRIMARY KEY (`PrerequisiteID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `PrerequisiteCourseID` (`PrerequisiteCourseID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`),
  ADD KEY `DepartmentID` (`DepartmentID`);

--
-- Indexes for table `departmentheads`
--
ALTER TABLE `departmentheads`
  ADD PRIMARY KEY (`DepartmentHeadID`),
  ADD KEY `DepartmentID` (`DepartmentID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`DepartmentID`),
  ADD KEY `FacultyID` (`FacultyID`);

--
-- Indexes for table `documentrequirements`
--
ALTER TABLE `documentrequirements`
  ADD PRIMARY KEY (`RequirementID`),
  ADD KEY `DocumentTypeID` (`DocumentTypeID`);

--
-- Indexes for table `documenttypes`
--
ALTER TABLE `documenttypes`
  ADD PRIMARY KEY (`DocumentTypeID`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`EnrollmentID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CourseID` (`CourseID`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`EvaluationID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `ProfessorID` (`ProfessorID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `RoomID` (`RoomID`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`FacultyID`),
  ADD KEY `BranchID` (`BranchID`);

--
-- Indexes for table `facultyheads`
--
ALTER TABLE `facultyheads`
  ADD PRIMARY KEY (`FacultyHeadID`),
  ADD KEY `FacultyID` (`FacultyID`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`GradeID`),
  ADD KEY `EnrollmentID` (`EnrollmentID`);

--
-- Indexes for table `gradestructures`
--
ALTER TABLE `gradestructures`
  ADD PRIMARY KEY (`GradeStructureID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `DepartmentID` (`DepartmentID`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`NewsID`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `newslettersubscriptions`
--
ALTER TABLE `newslettersubscriptions`
  ADD PRIMARY KEY (`SubscriptionID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `OptionalNewsLetterID` (`OptionalNewsLetterID`);

--
-- Indexes for table `obligatorynewsletter`
--
ALTER TABLE `obligatorynewsletter`
  ADD PRIMARY KEY (`NewsLetterID`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `optionalnewsletter`
--
ALTER TABLE `optionalnewsletter`
  ADD PRIMARY KEY (`OptionalNewsLetterID`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `FeeID` (`FeeID`);

--
-- Indexes for table `professorjobapplications`
--
ALTER TABLE `professorjobapplications`
  ADD PRIMARY KEY (`ApplicationID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ReviewedBy` (`ReviewedBy`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`RoomID`);

--
-- Indexes for table `studentapplications`
--
ALTER TABLE `studentapplications`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `studentdocuments`
--
ALTER TABLE `studentdocuments`
  ADD PRIMARY KEY (`StudentDocumentID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `DocumentTypeID` (`DocumentTypeID`);

--
-- Indexes for table `studentfees`
--
ALTER TABLE `studentfees`
  ADD PRIMARY KEY (`FeeID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`TimetableID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `ProfessorID` (`ProfessorID`),
  ADD KEY `RoomID` (`RoomID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `BranchID` (`BranchID`),
  ADD KEY `FacultyID` (`FacultyID`),
  ADD KEY `DepartmentID` (`DepartmentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `BranchID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branchmajors`
--
ALTER TABLE `branchmajors`
  MODIFY `BranchMajorID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courseprerequisites`
--
ALTER TABLE `courseprerequisites`
  MODIFY `PrerequisiteID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documentrequirements`
--
ALTER TABLE `documentrequirements`
  MODIFY `RequirementID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documenttypes`
--
ALTER TABLE `documenttypes`
  MODIFY `DocumentTypeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `EnrollmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `EvaluationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `FacultyID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `GradeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gradestructures`
--
ALTER TABLE `gradestructures`
  MODIFY `GradeStructureID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `NewsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newslettersubscriptions`
--
ALTER TABLE `newslettersubscriptions`
  MODIFY `SubscriptionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obligatorynewsletter`
--
ALTER TABLE `obligatorynewsletter`
  MODIFY `NewsLetterID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `optionalnewsletter`
--
ALTER TABLE `optionalnewsletter`
  MODIFY `OptionalNewsLetterID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professorjobapplications`
--
ALTER TABLE `professorjobapplications`
  MODIFY `ApplicationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentapplications`
--
ALTER TABLE `studentapplications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentdocuments`
--
ALTER TABLE `studentdocuments`
  MODIFY `StudentDocumentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentfees`
--
ALTER TABLE `studentfees`
  MODIFY `FeeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `TimetableID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`EnrollmentID`) REFERENCES `enrollments` (`EnrollmentID`);

--
-- Constraints for table `branchmajors`
--
ALTER TABLE `branchmajors`
  ADD CONSTRAINT `branchmajors_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `branchmajors_ibfk_2` FOREIGN KEY (`BranchID`) REFERENCES `branches` (`BranchID`);

--
-- Constraints for table `courseprerequisites`
--
ALTER TABLE `courseprerequisites`
  ADD CONSTRAINT `courseprerequisites_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `courseprerequisites_ibfk_2` FOREIGN KEY (`PrerequisiteCourseID`) REFERENCES `courses` (`CourseID`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`);

--
-- Constraints for table `departmentheads`
--
ALTER TABLE `departmentheads`
  ADD CONSTRAINT `departmentheads_ibfk_1` FOREIGN KEY (`DepartmentHeadID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `departmentheads_ibfk_2` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`);

--
-- Constraints for table `documentrequirements`
--
ALTER TABLE `documentrequirements`
  ADD CONSTRAINT `documentrequirements_ibfk_1` FOREIGN KEY (`DocumentTypeID`) REFERENCES `documenttypes` (`DocumentTypeID`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`);

--
-- Constraints for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `evaluations_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `evaluations_ibfk_3` FOREIGN KEY (`ProfessorID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`),
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `faculties`
--
ALTER TABLE `faculties`
  ADD CONSTRAINT `faculties_ibfk_1` FOREIGN KEY (`BranchID`) REFERENCES `branches` (`BranchID`);

--
-- Constraints for table `facultyheads`
--
ALTER TABLE `facultyheads`
  ADD CONSTRAINT `facultyheads_ibfk_1` FOREIGN KEY (`FacultyHeadID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `facultyheads_ibfk_2` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`EnrollmentID`) REFERENCES `enrollments` (`EnrollmentID`);

--
-- Constraints for table `gradestructures`
--
ALTER TABLE `gradestructures`
  ADD CONSTRAINT `gradestructures_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `gradestructures_ibfk_2` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`),
  ADD CONSTRAINT `gradestructures_ibfk_3` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `newslettersubscriptions`
--
ALTER TABLE `newslettersubscriptions`
  ADD CONSTRAINT `newslettersubscriptions_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `newslettersubscriptions_ibfk_2` FOREIGN KEY (`OptionalNewsLetterID`) REFERENCES `optionalnewsletter` (`OptionalNewsLetterID`);

--
-- Constraints for table `obligatorynewsletter`
--
ALTER TABLE `obligatorynewsletter`
  ADD CONSTRAINT `obligatorynewsletter_ibfk_1` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `optionalnewsletter`
--
ALTER TABLE `optionalnewsletter`
  ADD CONSTRAINT `optionalnewsletter_ibfk_1` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`FeeID`) REFERENCES `studentfees` (`FeeID`);

--
-- Constraints for table `professorjobapplications`
--
ALTER TABLE `professorjobapplications`
  ADD CONSTRAINT `professorjobapplications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `professorjobapplications_ibfk_2` FOREIGN KEY (`ReviewedBy`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `studentdocuments`
--
ALTER TABLE `studentdocuments`
  ADD CONSTRAINT `studentdocuments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `studentdocuments_ibfk_2` FOREIGN KEY (`DocumentTypeID`) REFERENCES `documenttypes` (`DocumentTypeID`);

--
-- Constraints for table `studentfees`
--
ALTER TABLE `studentfees`
  ADD CONSTRAINT `studentfees_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `timetables`
--
ALTER TABLE `timetables`
  ADD CONSTRAINT `timetables_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `timetables_ibfk_2` FOREIGN KEY (`ProfessorID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `timetables_ibfk_3` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`BranchID`) REFERENCES `branches` (`BranchID`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
