-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 10:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `WelcomeStatement` text NOT NULL,
  `Image1` varchar(100) NOT NULL,
  `PresidentMessage` text NOT NULL,
  `Image2` varchar(100) NOT NULL,
  `History` text NOT NULL,
  `SchoolsList` text NOT NULL,
  `Curriculum` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`WelcomeStatement`, `Image1`, `PresidentMessage`, `Image2`, `History`, `SchoolsList`, `Curriculum`, `id`) VALUES
('\r\nWelcome to  DAU, a place where we believe together we can accomplish a better future. We invite you to explore the diverse and prominent community of students, staff, faculty, and administrators that make up what DAU truly is.', '', 'Tomorrow, more than ever, everyone has realized that the only constant is change, that uncertainty is here to stay and that no one can say for sure what the future holds. It is by espousing an agile culture and keeping these elements in mind with unwavering determination that all DAU stakeholders will face the future and move forward with all their ambitions.\r\n\r\nLet me emphasize here that there is no short road to any place worth going because only a serious approach can guarantee a fruitful and prosperous result. In making sure that the DAU’s core business of teaching-learning, research and community engagement could continue, we shall continue to adapt to the new normal, explore new ways of doing things, expand our horizons and evolve to become even more than we were before.\r\n\r\nAs educators and learners, we must help our students to acquire the knowledge, skill, sensibility and attitudes to hold their heads high and speak with clear voices and succeed in the world. Thus, our task as educators is not just about making knowledge resources accessible to our students, but also figuring out how to encourage them to probe deeply into a subject, read and think widely, and to never settle for any easy answers.\r\n\r\nThe University is so privileged and fortunate to have a strong community of faculty, staff and administrators dedicated and committed to our students. This truly speaks to their tenacity and belief in carrying out DAU’s mission. I would like to express my sincere appreciation to each and every one for their remarkable contributions, support and guidance.\r\n\r\nWe feel proud of what DAU has accomplished and am highly optimistic in our collective abilities to make successful commitments, both at this time of extraordinary challenges, and in the years to come.\r\n', '', '\r\nThe Lebanese International University (DAU) is a private, non-protfit, independent institution of higher education governed by an autonomous Board of Trustees (Link to BOT). The University was established in 2001 under the name of Bekaa University in accordance with decree 5294 on April 9, 2001. The University is recognized by the Lebanese State as a private Higher Education Institution in Lebanon, according to the law of Higher Education Organizations in Lebanon. The University name was renamed the DAU, in accordance with decree 14592 on June 14, 2005.\r\nWith the slogan, “Education for All” which has been endorsed since inception and through the triad of Quality Education, Affordability, and Accessibility, DAU is a career-oriented institution whose overarching purpose is to democratize and empower learners in higher education.\r\nThe University has seen significant change over the years since its Founding. In order to bring the University and the nine campuses(link to campuses) together more fully as one community, several major new initiatives are at work on key campus improvements.', 'DAU has five schools and a Freshman Program:\r\n1.School of Business\r\n2.School of Engineering\r\n3.School of Arts and Science\r\n4.School of Education\r\n5.School of Pharmacy', 'The University is currently offering over 65 majors leading to Bachelors, and Master Degrees.\r\nType of Curriculum\r\nDAU is committed to practice modern instructional practices that emphasize active learning and teacher-student and student-teacher interaction, as well as allowing students to learn by doing and pushing them to discover answers and solutions themselves. Memorization is deemphasized (except for disciplines such as language and elementary mathematics, in which it is necessary) in favor of the development of critical thinking. In addition, education will focus not just on the aggressive acquisition of knowledge but also on the creation of new knowledge. What is more, the educational process strives to encourage interdisciplinary thinking as well as basic theory development and testing as a means of sorting truth from fiction.\r\nLIU operates on an academic semester system and on credit hours curriculum modeled on American system. The curriculum affords students’ freedom in choice as to what is convenient to his/her major of interest within the frame of an integrated academic system. It also facilitates the student’s transfer from one university into another, or in continuation of higher studies in any foreign university. The English Language is the language of teaching and communication at DAU and is an inseparable requirement of the education curriculum.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admissionrequirements`
--

CREATE TABLE `admissionrequirements` (
  `id` int(11) NOT NULL,
  `admission_requirements` text DEFAULT NULL,
  `required_documents` text DEFAULT NULL,
  `courses` text DEFAULT NULL,
  `curriculum` text DEFAULT NULL,
  `credit_hours` text DEFAULT NULL,
  `major_courses` text DEFAULT NULL,
  `major_electives` text DEFAULT NULL,
  `core_courses` text DEFAULT NULL,
  `general_education` text DEFAULT NULL,
  `conclusion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admissionrequirements`
--

INSERT INTO `admissionrequirements` (`id`, `admission_requirements`, `required_documents`, `courses`, `curriculum`, `credit_hours`, `major_courses`, `major_electives`, `core_courses`, `general_education`, `conclusion`) VALUES
(1, 'To ensure you meet the admission criteria for our university, please review the following requirements and guidelines. Ensure you have all the necessary documents and meet the outlined prerequisites before applying.', 'Official Transcripts from Previous Institutions\r\n Completed Application Form, Personal Statement or Essay\r\n Letter(s) of Recommendation\r\n Proof of English Proficiency (if applicable)\r\n Copy of Passport or ID\r\nApplication Fee Payment', 'Our courses are meticulously designed to deliver a comprehensive and in-depth education in your chosen field of study. Each course is crafted to provide students with a broad spectrum of knowledge, from foundational theories to advanced practices. By enrolling in our programs, you will gain access to a rich variety of subjects that are essential for mastering the core principles and cutting-edge advancements in your field. These courses are delivered by experienced instructors and incorporate the latest industry trends and research, ensuring that you are well-prepared for both academic and professional success.', 'The curriculum at our institution is thoughtfully structured to offer a balanced and holistic educational experience. It integrates core courses that cover essential topics in your major, elective courses that allow for exploration of supplementary interests, and general education requirements that ensure a well-rounded academic foundation. This approach not only deepens your expertise in your chosen field but also enhances your critical thinking, problem-solving, and communication skills. Our curriculum is regularly reviewed and updated to reflect current trends and standards, ensuring that it remains relevant and rigorous.', 'Credit hours are a measure of the amount of work and time required for each course, reflecting the number of hours spent in classroom instruction as well as the additional time spent on assignments, readings, and projects. Each course is assigned a specific number of credit hours based on its complexity and workload. It is crucial for students to understand and fulfill the total credit hour requirements for their degree program to ensure timely graduation. Adequate planning and consultation with academic advisors can help in managing these requirements effectively and aligning them with your academic and career goals.', 'Major courses are central to your degree program and focus on delivering specialized knowledge and skills related to your field of study. These courses are designed to provide you with a deep understanding of the key concepts, methodologies, and practices pertinent to your major. They often include advanced topics and practical applications that are critical for achieving proficiency and expertise in your area of interest. Engaging in these courses will prepare you for professional challenges and opportunities, equipping you with the tools needed to excel in your chosen career path.', 'Major electives offer students the flexibility to tailor their education by selecting courses that complement their primary field of study. These electives allow you to explore additional areas of interest within your major, giving you the opportunity to specialize further or gain a broader perspectiveBy choosing electives that align with your career aspirations and personal interests, you can enhance your academic experience and develop a unique skill set that distinguishes you in the job market. Electives are an essential part of our curriculum, providing students with the autonomy to shape their educational journey.', 'Core courses are fundamental to your degree program and are designed to impart the essential knowledge and skills required for your field of study. These courses form the backbone of your academic training, covering critical areas that are necessary for a comprehensive understanding of your subject. Core courses ensure that all students acquire a solid foundation and grasp the key concepts and techniques that are integral to their discipline. They are carefully selected to provide a balanced and thorough education, preparing students for more advanced study and professional practice.', 'General education courses are designed to provide a broad educational foundation that complements your specialized studies. These courses aim to develop well-rounded individuals by focusing on fundamental skills such as critical thinking, effective communication, and quantitative reasoning. They cover a range of subjects, including humanities, social sciences, and natural sciences, which help to cultivate a diverse and informed perspective. General education requirements ensure that students receive a comprehensive education that prepares them for a variety of intellectual and professional challenges beyond their major field of study.', 'Make sure you have reviewed all requirements and have gathered the necessary documents before applying. If you have any questions or need assistance, please reach out to our admissions office. We look forward to receiving your application and wish you success in your academic journey!');

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
-- Table structure for table `attestations`
--

CREATE TABLE `attestations` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attestations`
--

INSERT INTO `attestations` (`id`, `student_id`, `faculty_id`, `date`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(24, 4, 3, '2024-04-05', 'Approved', 'Faculty review in progress', '2024-08-24 20:20:15', '2024-09-14 11:44:16'),
(25, 5, 2, '2024-05-12', 'Pending', 'All criteria met', '2024-08-24 20:20:15', '2024-08-27 09:49:24'),
(26, 6, 2, '2024-06-20', 'Approved', 'Application rejected due to incorrect information', '2024-08-24 20:20:15', '2024-08-27 06:22:56'),
(27, 7, 3, '2024-07-22', 'Pending', 'Awaiting faculty head approval', '2024-08-24 20:20:15', '2024-08-24 20:20:15'),
(28, 8, 2, '2024-08-02', 'Approved', 'Approved by faculty board', '2024-08-24 20:20:15', '2024-08-24 20:20:15'),
(29, 9, 3, '2024-08-18', 'Pending', 'Faculty decision pending', '2024-08-24 20:20:15', '2024-08-24 20:20:15'),
(43, 4, 2, '2024-09-14', 'approved', 'Automatically approved', '2024-09-14 11:46:16', '2024-09-14 11:46:16'),
(44, 4, 2, '2024-09-14', 'approved', 'nothign', '2024-09-14 18:28:23', '2024-09-14 18:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `available_jobs`
--

CREATE TABLE `available_jobs` (
  `job_id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `job_description` text DEFAULT NULL,
  `required_qualifications` text DEFAULT NULL,
  `application_deadline` date DEFAULT NULL,
  `job_location` varchar(255) DEFAULT NULL,
  `job_type` enum('Full-Time','Part-Time','Contract','Temporary') NOT NULL,
  `salary_range` varchar(100) DEFAULT NULL,
  `status` enum('Pending','Occupied') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `available_jobs`
--

INSERT INTO `available_jobs` (`job_id`, `job_title`, `department_id`, `faculty_id`, `job_description`, `required_qualifications`, `application_deadline`, `job_location`, `job_type`, `salary_range`, `status`, `created_at`, `updated_at`, `branch_id`) VALUES
(3, 'Assistant Professor of Computer Science', 5, 3, 'Teach undergraduate and graduate courses in Computer Science. Conduct research and publish findings.', 'Ph.D. in Computer Science or related field.\r\n Experience in teaching and research.', '2024-12-01', 'Campus A, Building 5', 'Full-Time', '$60,000 - $80,000', 'Pending', '2024-08-22 05:52:10', '2024-08-25 10:44:26', 2),
(4, 'Administrative Coordinator', 5, 3, 'Coordinate administrative activities, manage schedules, and provide support to faculty members.', 'Bachelor\'s degree in Business Administration or related field. \r\nStrong organizational skills.', '2024-10-15', 'Campus B, Administrative Office', 'Part-Time', '$25,000 - $35,000', 'Pending', '2024-08-22 05:52:10', '2024-08-25 10:44:30', 11),
(5, 'Research Assistant in Chemistry', 5, 2, 'Assist with research projects in the Chemistry department. Conduct experiments and analyze data.', 'Master\'s degree in Chemistry or related field. \r\nLaboratory experience required.', '2024-11-30', 'Campus C, Chemistry Lab', 'Contract', '$30,000 - $40,000', 'Occupied', '2024-08-22 05:52:10', '2024-08-25 10:44:37', 2),
(6, 'Student Services Advisor', 5, 4, 'Provide guidance and support to students regarding academic and personal matters. Manage student records.', 'Bachelor\'s degree in Counseling or related field. \r\nExperience in student services preferred.', '2024-11-01', 'Campus D, Student Services Center', 'Temporary', '$40,000 - $50,000', 'Pending', '2024-08-22 05:52:10', '2024-08-25 10:44:40', 3);

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

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`BranchID`, `BranchName`, `Location`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'Main Campus', 'New York', '2024-08-18 17:50:46', '2024-08-18 17:50:46'),
(2, 'Downtown Campus', 'Chicago', '2024-08-18 17:50:46', '2024-08-18 17:50:46'),
(3, 'West Coast Campus', 'Los Angeles', '2024-08-18 17:50:46', '2024-08-18 17:50:46'),
(9, 'jem3aQANa90', 'qana', '2024-08-19 19:35:21', '2024-08-19 19:35:21'),
(10, 'efwef', 'wfef', '2024-08-19 19:35:25', '2024-08-19 19:35:25'),
(11, 'efwef', 'efwefewf', '2024-08-19 19:35:29', '2024-08-19 19:35:29'),
(14, 'ergere', 'rgregregsdfdfsd', '2024-08-22 20:58:35', '2024-08-27 10:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `branches_heads`
--

CREATE TABLE `branches_heads` (
  `BranchHeadID` int(11) NOT NULL,
  `BranchID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches_heads`
--

INSERT INTO `branches_heads` (`BranchHeadID`, `BranchID`, `UserID`) VALUES
(1, 2, 1),
(2, 1, 10),
(3, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `branchmajors`
--

CREATE TABLE `branchmajors` (
  `BranchMajorID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `BranchID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branchmajors`
--

INSERT INTO `branchmajors` (`BranchMajorID`, `CourseID`, `BranchID`) VALUES
(5, 105, 3);

-- --------------------------------------------------------

--
-- Table structure for table `branch_revenues`
--

CREATE TABLE `branch_revenues` (
  `revenue_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `revenue_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch_revenues`
--

INSERT INTO `branch_revenues` (`revenue_id`, `branch_id`, `source_id`, `amount`, `revenue_date`) VALUES
(1, 1, 1, 500000.00, '2024-01-01'),
(2, 1, 2, 250000.00, '2024-01-15'),
(3, 2, 1, 300000.00, '2024-01-01'),
(4, 2, 2, 150000.00, '2024-01-15'),
(5, 3, 1, 400000.00, '2024-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `courseprerequisites`
--

CREATE TABLE `courseprerequisites` (
  `PrerequisiteID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `PrerequisiteCourseID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courseprerequisites`
--

INSERT INTO `courseprerequisites` (`PrerequisiteID`, `CourseID`, `PrerequisiteCourseID`) VALUES
(18, 107, 106),
(24, 114, 111),
(45, 115, 113),
(46, 115, 112),
(49, 112, 110),
(50, 109, 105),
(51, 107, 109);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(255) NOT NULL,
  `CourseCode` varchar(50) NOT NULL,
  `DepartmentID` varchar(255) NOT NULL,
  `Credits` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CourseAdmin` varchar(255) DEFAULT NULL,
  `GCRLink` varchar(300) DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `CourseName`, `CourseCode`, `DepartmentID`, `Credits`, `CreatedAt`, `UpdatedAt`, `CourseAdmin`, `GCRLink`, `semester`, `year`) VALUES
(105, 'Principles of Economics', 'ECON101', '10/1/12/6/7', 3, '2024-08-18 18:00:31', '2024-09-17 09:08:07', NULL, 'fdvfvdsc', 'Fall', 1),
(106, 'Introduction to Thermodynamics', 'ME101', '9', 3, '2023-08-22 09:00:00', '2024-09-16 11:51:21', NULL, NULL, 'Fall', 1),
(107, 'Shakespeare Studies', 'ENG201', '10/12/9', 3, '2022-08-22 09:01:00', '2024-09-21 19:32:02', NULL, NULL, 'Fall', 3),
(108, 'Child Development', 'EDU101', '9', 3, '2021-08-22 09:02:00', '2024-09-16 11:51:22', NULL, NULL, 'Fall', 2),
(109, 'Introduction to Neuroscience', 'NEUR101', '10/7', 4, '2020-08-22 09:03:00', '2024-09-17 08:53:04', NULL, NULL, 'Fall', 2),
(110, 'Data Structures and Algorithms', 'CS201', '10/6', 4, '2019-08-22 09:04:00', '2024-09-21 13:09:27', NULL, NULL, 'Fall', 1),
(111, 'Cognitive Psychology', 'PSY202', '9/7', 3, '2018-08-22 09:05:00', '2024-09-26 16:30:51', NULL, NULL, 'Fall', 1),
(112, 'Oil Painting Techniques', 'ART301', '10/6', 3, '2018-08-22 09:06:00', '2024-09-17 09:35:57', NULL, NULL, 'Spring', 1),
(113, 'Climate Change and Society', 'ENV201', '10/12/6/7', 3, '2022-08-22 09:07:00', '2024-09-21 13:13:18', NULL, NULL, 'Fall', 2),
(114, 'Pharmaceutical Chemistry', 'PHARM301', '10/6/7', 4, '2022-08-22 09:08:00', '2024-09-21 13:13:22', NULL, NULL, 'Fall', 3),
(115, 'Sustainable Urban Design', 'ARCH201', '10/6', 3, '2023-08-22 09:09:00', '2024-09-17 08:53:01', NULL, NULL, 'Spring', 3);

-- --------------------------------------------------------

--
-- Table structure for table `departmentheads`
--

CREATE TABLE `departmentheads` (
  `DepartmentHeadID` int(11) NOT NULL,
  `DepartmentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departmentheads`
--

INSERT INTO `departmentheads` (`DepartmentHeadID`, `DepartmentID`) VALUES
(2, 5),
(6, 6),
(11, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(2, 5),
(14, 14),
(15, 15);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `DepartmentID` int(11) NOT NULL,
  `DepartmentName` varchar(255) NOT NULL,
  `FacultyID` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`DepartmentID`, `DepartmentName`, `FacultyID`, `CreatedAt`, `UpdatedAt`) VALUES
(5, 'dfsdfdfsdfsd', 2, '2024-08-18 17:52:30', '2024-08-27 10:00:58'),
(6, 'Mechanical Engineering', 5, '2024-08-22 08:00:00', '2024-08-22 08:00:00'),
(7, 'English Literature', 5, '2024-08-22 08:01:00', '2024-08-26 21:19:14'),
(8, 'Elementary Education', 7, '2024-08-22 08:02:00', '2024-08-22 08:02:00'),
(9, 'Neurology', 9, '2024-08-22 08:03:00', '2024-09-16 11:15:06'),
(10, 'Software Engineering', 9, '2024-08-22 08:04:00', '2024-08-22 08:04:00'),
(11, 'Psychology', 10, '2024-08-22 08:05:00', '2024-08-22 08:05:00'),
(12, 'Painting', 9, '2024-08-22 08:06:00', '2024-09-16 09:34:05'),
(13, 'Environmental Science', 12, '2024-08-22 08:07:00', '2024-08-22 08:07:00'),
(14, 'gerg', 13, '2024-08-22 08:08:00', '2024-08-22 20:59:25'),
(15, 'Urban Planning', 14, '2024-08-22 08:09:00', '2024-08-22 08:09:00'),
(16, 'testowef', 11, '2024-08-26 20:32:41', '2024-08-26 21:19:07'),
(17, 'testowe', 11, '2024-08-26 20:32:56', '2024-08-26 21:19:02'),
(18, 'testowewq', 13, '2024-08-26 20:34:12', '2024-08-26 21:11:11'),
(19, 'feewfe', 4, '2024-08-26 21:02:32', '2024-08-26 21:25:34'),
(20, 'fewwefewdewd', 13, '2024-08-26 21:25:47', '2024-08-26 21:25:47'),
(21, 'qwdwq', 4, '2024-08-26 21:34:48', '2024-08-27 09:51:38'),
(25, 'sadsadsdfs', 4, '2024-08-27 10:06:40', '2024-08-27 10:06:40');

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

--
-- Dumping data for table `documentrequirements`
--

INSERT INTO `documentrequirements` (`RequirementID`, `DocumentTypeID`, `RequiredQuantity`, `Description`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 1, 1, 'Official high school transcript', '2024-08-18 18:21:32', '2024-08-18 18:21:32'),
(2, 2, 1, 'Proof of identification', '2024-08-18 18:21:32', '2024-08-18 18:21:32'),
(3, 3, 2, 'Letters of recommendation', '2024-08-18 18:21:32', '2024-08-18 18:21:32'),
(4, 4, 1, 'Immunization records', '2024-08-18 18:21:32', '2024-08-18 18:21:32'),
(5, 5, 1, 'English proficiency test results', '2024-08-18 18:21:32', '2024-08-18 18:21:32');

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

--
-- Dumping data for table `documenttypes`
--

INSERT INTO `documenttypes` (`DocumentTypeID`, `Description`, `CreatedAt`, `UpdatedAt`, `DocumentTypeName`) VALUES
(1, 'Official academic transcript from previous institution', '2024-08-18 18:21:18', '2024-08-18 18:21:18', 'Academic Transcript'),
(2, 'Government-issued photo identification', '2024-08-18 18:21:18', '2024-08-18 18:21:18', 'Photo ID'),
(3, 'Proof of residence', '2024-08-18 18:21:18', '2024-08-18 18:21:18', 'Proof of Address'),
(4, 'English language proficiency test results', '2024-08-18 18:21:18', '2024-08-18 18:21:18', 'Language Proficiency'),
(5, 'Letter of recommendation from academic or professional reference', '2024-08-18 18:21:18', '2024-08-18 18:21:18', 'Recommendation Letter');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `EnrollmentID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `Role` enum('Student','Professor') DEFAULT NULL,
  `TimeTableID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`EnrollmentID`, `UserID`, `CourseID`, `Role`, `TimeTableID`) VALUES
(60, 3, 105, 'Student', 1),
(61, 3, 106, 'Student', 2),
(66, 3, 111, 'Student', 15);

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

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`EvaluationID`, `CourseID`, `StudentID`, `ProfessorID`, `EvaluationDate`, `Rating`, `Comments`) VALUES
(6, 105, 1, 6, '2023-08-30', 5, 'Excellent course with clear explanations.'),
(7, 106, 2, 7, '2023-08-30', 4, 'Good content, but needs more interactive sessions.'),
(8, 107, 3, 6, '2023-08-30', 3, 'Content was okay, but the pace was too fast.'),
(9, 108, 16, 7, '2023-08-30', 4, 'Well-structured course with practical examples.'),
(10, 109, 17, 6, '2023-08-30', 5, 'Amazing experience. Highly recommend!'),
(11, 110, 18, 7, '2023-08-30', 4, 'The course was useful but could be more engaging.'),
(12, 111, 19, 6, '2023-08-30', 3, 'Some topics were too complex for my level.'),
(13, 112, 20, 7, '2023-08-30', 5, 'The professor was very knowledgeable and approachable.'),
(14, 113, 21, 6, '2023-08-30', 4, 'Good course, though some areas need more depth.'),
(15, 114, 22, 7, '2023-08-30', 3, 'Content was too advanced and hard to follow.'),
(16, 115, 23, 6, '2023-08-30', 5, 'Fantastic course. Learned a lot of new skills.'),
(17, 105, 24, 7, '2023-08-30', 4, 'Great material, but the pace could be improved.'),
(18, 106, 25, 6, '2023-08-30', 3, 'The course was helpful but could use more examples.'),
(19, 107, 26, 7, '2023-08-30', 4, 'Well-taught course with practical applications.'),
(20, 108, 27, 6, '2023-08-30', 5, 'Exceptional content and teaching. Highly valuable.'),
(21, 109, 28, 7, '2023-08-30', 4, 'Good course, but some topics were too fast.'),
(22, 110, 29, 6, '2023-08-30', 3, 'Content was relevant but lacked engagement.'),
(23, 111, 30, 7, '2023-08-30', 4, 'Valuable course with practical examples.'),
(24, 112, 31, 6, '2023-08-30', 5, 'Fantastic course. Great professor.'),
(25, 113, 32, 7, '2023-08-30', 3, 'The course was okay but not very interactive.'),
(26, 114, 33, 6, '2023-08-30', 4, 'Good course, but could benefit from more exercises.'),
(27, 115, 34, 7, '2023-08-30', 5, 'Excellent course with thorough coverage of the topic.'),
(28, 105, 3, 6, '2024-09-13', 2, 'ui');

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
  `BranchID` int(11) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `EndDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `EventName`, `Description`, `EventDate`, `StartTime`, `EndTime`, `BranchID`, `CreatedBy`, `CreatedAt`, `EndDate`) VALUES
(1, 'Freshman Orientation', 'Welcome event for new students. This orientation includes an overview of university services, campus tours, and ice-breaking activities. It’s an opportunity for freshmen to meet their peers and get acquainted with university life.', '2024-09-01', '09:00:00', '12:00:00', NULL, NULL, '2024-08-01 17:00:00', '2024-09-26'),
(2, 'Midterm Exam Review', 'A review session designed to help students prepare for midterm exams. Faculty will provide a summary of key concepts and answer any questions students may have. It’s an excellent chance to clarify doubts and strengthen understanding.', '2024-10-15', '14:00:00', '16:00:00', NULL, NULL, '2024-09-15 19:00:00', '2024-09-26'),
(3, 'Career Fair', 'Networking event featuring a variety of potential employers. Students can interact with company representatives, learn about job opportunities, and gain insights into different career paths. It’s a great opportunity to build professional connections.', '2024-11-05', '10:00:00', '15:00:00', NULL, NULL, '2024-10-01 18:00:00', '2024-09-26'),
(4, 'Guest Lecture: AI Innovations', 'A special lecture on the latest advancements in artificial intelligence. The guest speaker will discuss current trends, emerging technologies, and future implications of AI. Students will gain valuable insights into this rapidly evolving field.', '2024-11-20', '13:00:00', '15:00:00', NULL, NULL, '2024-10-15 20:00:00', '2024-09-26'),
(5, 'Semester End Party', 'A celebration marking the end of the semester. Join us for an evening of festivities, including music, dancing, and refreshments. It’s a time to relax and celebrate the achievements of the past semester with friends and classmates.', '2024-12-15', '18:00:00', '22:00:00', NULL, NULL, '2024-11-01 21:00:00', '2024-09-26'),
(6, 'AI Symposium', 'Annual symposium on Artificial Intelligence advancements', '2024-10-10', '09:00:00', '17:00:00', 1, 4, '2024-08-18 18:31:46', '2024-09-26'),
(7, 'Career Fair', 'University-wide career fair with industry representatives', '2024-11-15', '10:00:00', '16:00:00', 2, 1, '2024-08-18 18:31:46', '2024-09-26'),
(8, 'Research Presentation Day', 'Students present their research projects', '2024-12-05', '13:00:00', '18:00:00', 3, 5, '2024-08-18 18:31:46', '2024-09-26'),
(9, 'Alumni Networking Event', 'Networking event for alumni and current students', '2025-02-20', '18:00:00', '21:00:00', 3, 1, '2024-08-18 18:31:46', '2024-09-26'),
(10, 'Spring Concert', 'Annual spring concert featuring student performances', '2025-04-15', '19:00:00', '22:00:00', 1, 3, '2024-08-18 18:31:46', '2024-09-26');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `FacultyID` int(11) NOT NULL,
  `FaculityName` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CreditFee` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`FacultyID`, `FaculityName`, `CreatedAt`, `UpdatedAt`, `CreditFee`) VALUES
(2, 'Faculty of Business and Economics', '2024-08-18 17:51:35', '2024-08-22 12:12:18', 285.00),
(3, 'Faculty of Health Sciences', '2024-08-18 17:51:35', '2024-08-21 06:34:11', 300.00),
(4, 'Faculty of Law', '2024-08-18 17:51:35', '2024-08-21 06:24:43', 350.00),
(5, 'Faculty of Engineering', '2024-08-22 07:00:00', '2024-08-22 07:00:00', 320.00),
(6, 'Faculty of Arts and Sciences', '2024-08-22 07:01:00', '2024-08-22 07:01:00', 275.00),
(7, 'Faculty of Education', '2024-08-22 07:02:00', '2024-08-22 07:02:00', 265.00),
(8, 'Faculty of Medicine', '2024-08-22 07:03:00', '2024-08-22 07:03:00', 400.00),
(9, 'Faculty of Computer Science', '2024-08-22 07:04:00', '2024-08-22 07:04:00', 310.00),
(10, 'Faculty of Social Sciences', '2024-08-22 07:05:00', '2024-08-22 07:05:00', 270.00),
(11, 'Faculty of Fine Arts', '2024-08-22 07:06:00', '2024-08-22 07:06:00', 290.00),
(12, 'Faculty of Environmental Studies', '2024-08-22 07:07:00', '2024-08-22 07:07:00', 280.00),
(13, 'Faculty of Pharmacy', '2024-08-22 07:08:00', '2024-08-22 07:08:00', 350.00),
(14, 'Faculty of Architecture', '2024-08-22 07:09:00', '2024-08-22 07:09:00', 330.00),
(15, 'Faculty of Arts and Humanities', '2024-08-26 15:30:00', '2024-08-26 15:30:00', 444.00),
(17, 'Faculty of Science and Technology', '2024-08-26 15:30:45', '2024-08-26 15:30:45', 444.00),
(18, 'feseefefes', '2024-08-27 11:20:01', '2024-08-27 11:20:01', 100.00),
(19, 'afsdfas', '2024-08-27 11:36:47', '2024-08-27 11:36:47', 60.00),
(20, 'wfa', '2024-08-27 11:41:55', '2024-08-27 11:41:55', 40.00),
(21, 'grrgrsgrsgrsgrgsrgr', '2024-08-28 06:25:05', '2024-08-28 06:25:05', 60.00),
(22, 'grrgrsgrsgrsgrgsrgrpty', '2024-08-28 06:30:21', '2024-08-28 06:30:21', 40.00),
(23, 'feseefefestr', '2024-08-28 06:39:43', '2024-08-28 06:39:43', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `facultyheads`
--

CREATE TABLE `facultyheads` (
  `FacultyHeadID` int(11) NOT NULL,
  `FacultyID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facultyheads`
--

INSERT INTO `facultyheads` (`FacultyHeadID`, `FacultyID`) VALUES
(13, 2),
(4, 3),
(5, 4),
(15, 7),
(10, 9),
(2, 10),
(7, 12),
(8, 15),
(1, 23);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_branches`
--

CREATE TABLE `faculty_branches` (
  `FacultyID` int(11) NOT NULL,
  `BranchID` int(11) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_branches`
--

INSERT INTO `faculty_branches` (`FacultyID`, `BranchID`, `CreatedAt`, `UpdatedAt`) VALUES
(2, 3, '2024-08-27 10:04:44', '2024-08-27 10:04:44'),
(2, 10, '2024-08-27 10:04:44', '2024-08-27 10:04:44'),
(2, 11, '2024-08-27 10:04:44', '2024-08-27 10:04:44'),
(3, 1, '2024-08-21 09:42:23', '2024-08-25 15:59:45'),
(3, 3, '2024-08-21 09:42:23', '2024-08-21 09:42:23'),
(4, 1, '2024-08-26 21:13:47', '2024-08-26 21:13:47'),
(5, 1, '2024-08-22 21:09:48', '2024-09-17 06:29:25'),
(5, 9, '2024-08-22 21:09:48', '2024-09-17 06:29:31'),
(6, 3, '2024-08-22 21:09:48', '2024-08-22 21:09:48'),
(9, 1, '2024-08-27 06:24:41', '2024-09-21 19:37:08'),
(11, 11, '2024-08-27 06:24:41', '2024-08-27 06:24:41'),
(13, 1, '2024-08-22 20:58:52', '2024-08-25 15:59:56'),
(13, 9, '2024-08-22 20:58:52', '2024-08-22 20:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `financial_aids`
--

CREATE TABLE `financial_aids` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `aid_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `financial_aids`
--

INSERT INTO `financial_aids` (`id`, `student_id`, `aid_amount`, `created_at`, `updated_at`) VALUES
(1, 4, 1530.00, '2024-08-24 20:44:01', '2024-09-14 18:27:10'),
(2, 17, 2000.00, '2024-08-24 20:44:01', '2024-08-24 20:44:01'),
(3, 18, 500.00, '2024-08-24 20:44:01', '2024-08-24 20:44:01'),
(4, 19, 1000.00, '2024-08-24 20:44:01', '2024-08-24 20:44:01'),
(5, 20, 750.00, '2024-08-24 20:44:01', '2024-08-24 20:44:01'),
(6, 21, 1200.00, '2024-08-24 20:44:01', '2024-08-24 20:44:01');

-- --------------------------------------------------------

--
-- Table structure for table `freshman`
--

CREATE TABLE `freshman` (
  `FreshManID` int(11) NOT NULL,
  `FirstParagraph` text NOT NULL,
  `RequirementsList` text NOT NULL,
  `LastParagraph` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `freshman`
--

INSERT INTO `freshman` (`FreshManID`, `FirstParagraph`, `RequirementsList`, `LastParagraph`) VALUES
(1, '\r\nTo complete the freshman program each student must complete at least 30 credits in Freshman Arts, Freshman Sciences, or Freshman Engineering. The difference between each freshman program depends on which major the student would like to pursue after completion of freshman program.\r\nThe curriculum of the freshman program is based on the requirements of the Ministry of Education. Students who should complete the freshman program should also complete the SAT I and SAT II to receive accreditation by the ministry. When evaluating the student\'s SAT scores, the Admissions Office will combine the SAT I and SAT II quality points. The SAT quality points for Freshman Arts are 2150 and for Freshman Sciences and Freshman Engineering are 2300, but may be subject to change according to the Ministry of Education. If the student has completed the Lebanese baccalaureate or its equivalence, he or she cannot enroll in the freshman program. Once the student completes the freshman year, he/she gets to enroll in a specific major at the sophomore level based on his/her average or GPA.', 'High School Diploma\nSAT/ACT Scores\nLetters of Recommendation\nPersonal Statement\nCompleted Application Form', 'We look forward to welcoming you to our campus. Prepare for a transformative experience that will equip you with the knowledge and skills necessary for your future career. Apply now and take the first step toward your academic success.');

-- --------------------------------------------------------

--
-- Table structure for table `gradestructures`
--

CREATE TABLE `gradestructures` (
  `GradeStructureID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `AssessmentType` varchar(100) DEFAULT NULL,
  `Weight` decimal(5,2) DEFAULT NULL,
  `CreatedBy` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gradestructures`
--

INSERT INTO `gradestructures` (`GradeStructureID`, `CourseID`, `AssessmentType`, `Weight`, `CreatedBy`, `CreatedAt`, `UpdatedAt`) VALUES
(6, 105, 'Assignment', 25.00, 1, '2024-09-03 07:32:23', '2024-09-03 07:33:13'),
(7, 105, 'Midterm', 35.00, 1, '2024-09-03 07:32:47', '2024-09-03 07:33:17'),
(8, 105, 'Final', 40.00, 1, '2024-09-03 07:33:06', '2024-09-03 10:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `Type` varchar(100) NOT NULL,
  `Title1` varchar(100) NOT NULL,
  `Title2` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Details` text NOT NULL,
  `Image` varchar(100) NOT NULL,
  `temp_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`Type`, `Title1`, `Title2`, `Description`, `Details`, `Image`, `temp_id`) VALUES
('About DAU', 'Your Future Start With DAU', 'Your success is our priority, so we always aim to provide the highest quality for your education car', 'We always look forward.', 'We seek to brighten your future.', '', 1),
('About DAU', 'Quality Education', 'Progress Development', 'Affordable Fees', 'Easy Apply', '', 2),
('Details', 'Undergraduate/Graduate', '', 'Discover diverse programs designed to help you excel in your chosen field. Our academic pathways offer a balance of theory and practical experience.', '', '', 3),
('Details', 'Transfer Applicant', '', 'Continue your academic journey by transferring to our institution. We ensure your credits and experience are fully recognized and valued.', '', '', 4),
('Details', 'Freshman Applicant', '', 'Begin your journey with us in a welcoming and inclusive environment. Build a strong foundation for your future studies with our programs.', '', '', 5),
('Details', 'Tuition Fees', '', 'Understand our competitive tuition fees with clear, transparent rates. Financial aid options are available to make your education affordable.', '', '', 6),
('Details', 'Accreditation', '', 'Our institution is fully accredited by recognized bodies globally. We uphold high standards to provide you with a valuable education.', '', '', 7),
('Details', 'Campus Life', '', 'Experience a vibrant campus life filled with growth opportunities. Our activities and facilities cater to a wide range of interests.', '', '', 8),
('Goals', ' Enhance Academic Excellence', '', 'Elevate educational quality through rigorous standards, innovative teaching, and faculty support. Focus on improving curricula and research. Aim to produce well-prepared, professional graduates.', '', '', 9),
('Goals', 'Foster Inclusive Community Engagement', '', 'Promote diversity and inclusion by valuing all individuals and supporting underrepresented groups. Implement initiatives to encourage cross-cultural understanding and community involvement. ', '', '', 10),
('Goals', 'Advance Sustainable Practices', '', 'Integrate environmentally friendly practices into campus operations and curricula. Reduce the carbon footprint and promote resource sustainability.', '', '', 11),
('Our Team', 'Anamul Hasan', 'President', 'The University President is a visionary leader dedicated to fostering academic excellence, inclusivity, and innovation. With a commitment to student success and community engagement, they guide the university toward growth and global impact. Their leadership ensures a dynamic and supportive environment for all.\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 'anamulhasan@gmail.com', '', 12),
('Our Team ', 'Alaa Naser', 'Doctor', 'alaanaser_dau@gmail.com', '', '', 13),
('Our Team', 'Alice Jamal', 'Branch-Head', 'alicejamal@gmail.com', '', '', 14),
('Our Team', 'Sami Jamel', 'Doctor', 'samijamel@gmail.com', '', '', 15),
('Majors', 'Major', 'Computer Science', 'Explore algorithms, software development, and drive technological innovation.', '', '', 16),
('Majors', 'Major', 'Environmental Science', 'Understand sustainability, conservation, and protect our planet.', '', '', 17),
('Majors', 'Major', 'Communication Engineering', 'Focus on wireless networks, signal processing, and enhancing global communication systems.', '', '', 18),
('Majors', 'Major', 'Computer Engineering', 'Study the integration of hardware and software, optimizing computing technology.', '', '', 19);

-- --------------------------------------------------------

--
-- Table structure for table `moreinfo`
--

CREATE TABLE `moreinfo` (
  `Name` varchar(255) NOT NULL,
  `welcomeStatement` varchar(100) NOT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Instagram` varchar(255) DEFAULT NULL,
  `Facebook` varchar(255) DEFAULT NULL,
  `Twitter` varchar(255) DEFAULT NULL,
  `Linkedin` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moreinfo`
--

INSERT INTO `moreinfo` (`Name`, `welcomeStatement`, `PhoneNumber`, `Instagram`, `Facebook`, `Twitter`, `Linkedin`, `Email`, `Location`) VALUES
('DAU', 'Where Education Born!', '+9617991778', 'https://www.instagram.com/', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.linkedin.com/in/', 'dau@gmail.com', 'California-MainStreet');

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

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`NewsID`, `Title`, `Content`, `PublishedDate`, `CreatedBy`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'DAU Ranks Top 10 in National Survey', 'DAU has been ranked among the top 10 universities in the country...', '2024-08-20', 1, '2024-08-18 18:25:57', '2024-08-18 18:25:57'),
(2, 'New Research Grant Awarded', 'The Science Department has been awarded a $5 million research grant...', '2024-08-22', 2, '2024-08-18 18:25:57', '2024-08-18 18:25:57'),
(3, 'Upcoming Career Fair', 'DAU will host its annual career fair next month, featuring over 100 companies...', '2024-08-25', 3, '2024-08-18 18:25:57', '2024-08-18 18:25:57'),
(4, 'Alumni Donation Funds New Library Wing', 'A generous donation from alumnus John Doe will fund a new library wing...', '2024-08-28', 1, '2024-08-18 18:25:57', '2024-08-18 18:25:57'),
(5, 'DAU Launches New Online Masters Program', 'DAU is proud to announce the launch of its new online Masters in Data Science...', '2024-08-30', 2, '2024-08-18 18:25:57', '2024-08-18 18:25:57');

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

--
-- Dumping data for table `newslettersubscriptions`
--

INSERT INTO `newslettersubscriptions` (`SubscriptionID`, `UserID`, `OptionalNewsLetterID`, `SubscriptionDate`) VALUES
(1, 3, 1, '2024-08-01'),
(2, 4, 2, '2024-08-02'),
(3, 5, 1, '2024-08-03'),
(4, 6, 3, '2024-08-04'),
(5, 7, 2, '2024-08-05');

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

--
-- Dumping data for table `obligatorynewsletter`
--

INSERT INTO `obligatorynewsletter` (`NewsLetterID`, `Title`, `IssueDate`, `Content`, `CreatedBy`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'Monthly University Update', '2024-09-01', 'This months highlights include...', 1, '2024-08-18 18:25:04', '2024-08-18 18:25:04'),
(2, 'Academic Calendar Changes', '2024-09-15', 'Please note the following changes to the academic calendar...', 2, '2024-08-18 18:25:04', '2024-08-18 18:25:04'),
(3, 'Campus Safety Bulletin', '2024-09-30', 'Important safety information for all students and staff...', 3, '2024-08-18 18:25:04', '2024-08-18 18:25:04'),
(4, 'test', '2024-08-07', 'Nothing, this is a test ', 1, '2024-08-25 17:26:46', '2024-08-25 17:26:46'),
(5, 'vdsvsdvdsvdsvdsdv', '2024-08-23', 'dvsdvdsvsdvdsvdsvdsvsd', 10, '2024-08-27 08:48:51', '2024-08-27 08:48:51'),
(6, 'wefweewfwf', '2024-08-12', 'wefewfewfewfewfew', 10, '2024-08-27 08:49:55', '2024-08-27 08:49:55'),
(7, 'sdfefsdfsdfsdfsdf', '2024-08-08', 'sdfdfdfdsfdsfdffdsfsdfdsfsd', 10, '2024-08-27 09:54:41', '2024-08-27 09:54:41'),
(11, 'sdv', '2024-10-05', 'fdvfvf', 3, '2024-09-26 15:54:09', '2024-09-26 15:54:09'),
(12, 'ygvy', '2024-09-12', 'gyugyvuogoygigyu', 10, '2024-09-26 16:14:57', '2024-09-26 16:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `office_hours`
--

CREATE TABLE `office_hours` (
  `OfficeHourID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DayOfWeek` enum('Monday','Tuesday','Wednesday','Thursday') NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `office_hours`
--

INSERT INTO `office_hours` (`OfficeHourID`, `UserID`, `DayOfWeek`, `StartTime`, `EndTime`) VALUES
(1, 6, 'Monday', '09:28:00', '11:00:00'),
(3, 6, 'Wednesday', '10:00:00', '12:00:00'),
(5, 7, 'Monday', '11:00:00', '13:00:00'),
(6, 7, 'Tuesday', '09:00:00', '11:00:00'),
(7, 7, 'Wednesday', '14:00:00', '16:00:00'),
(8, 7, 'Thursday', '10:00:00', '12:00:00'),
(11, 6, 'Thursday', '17:08:00', '19:09:00'),
(12, 6, 'Tuesday', '20:11:00', '21:11:00'),
(17, 6, 'Tuesday', '18:24:00', '20:30:00'),
(18, 6, 'Monday', '22:50:00', '23:50:00');

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

--
-- Dumping data for table `optionalnewsletter`
--

INSERT INTO `optionalnewsletter` (`OptionalNewsLetterID`, `Title`, `IssueDate`, `Content`, `CreatedBy`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'Alumni Spotlight', '2024-09-05', 'This month we feature alumnus Jane Smith, CEO of Tech Innovations...', 1, '2024-08-18 18:23:56', '2024-08-18 18:23:56'),
(2, 'Research Roundup', '2024-09-20', 'Exciting new research from our faculty members...', 2, '2024-08-18 18:23:56', '2024-08-18 18:23:56'),
(3, 'Student Life Newsletter', '2024-09-25', 'Upcoming events and activities on campus...', 3, '2024-08-18 18:23:56', '2024-08-18 18:23:56');

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

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `FeeID`, `AmountPaid`, `PaymentDate`, `PaymentMethod`) VALUES
(1, 1, 5000.00, '2024-08-15', 'Credit Card'),
(2, 2, 4500.00, '2024-08-16', 'Bank Transfer'),
(3, 3, 5500.00, '2024-08-17', 'PayPal'),
(4, 4, 4800.00, '2024-08-18', 'Debit Card'),
(5, 5, 5200.00, '2024-08-19', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `petitions`
--

CREATE TABLE `petitions` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petitions`
--

INSERT INTO `petitions` (`id`, `student_id`, `faculty_id`, `subject`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 'Grade Appeal', 'Appealing grade for final exam', 'Approved', '2024-08-24 20:39:33', '2024-09-14 18:26:52'),
(2, 17, 2, 'Course Exemption', 'Requesting exemption from course XYZ', 'Pending', '2024-08-24 20:39:33', '2024-08-26 19:14:18'),
(3, 18, 3, 'Transfer Credit', 'Request to transfer credits denied', 'Rejected', '2024-08-24 20:39:33', '2024-08-24 20:39:33'),
(4, 19, 4, 'Grade Appeal', 'Requesting grade review for project assignment', 'Pending', '2024-08-24 20:39:33', '2024-08-24 20:39:33'),
(5, 20, 5, 'Course Exemption', 'Exemption from course ABC approved', 'Approved', '2024-08-24 20:39:33', '2024-08-24 20:39:33'),
(6, 21, 6, 'Transfer Credit', 'Insufficient documentation for credit transfer', 'Rejected', '2024-08-24 20:39:33', '2024-08-24 20:39:33'),
(7, 22, 7, 'Grade Appeal', 'Faculty decision pending for grade appeal', 'Pending', '2024-08-24 20:39:33', '2024-08-24 20:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `previousexams`
--

CREATE TABLE `previousexams` (
  `id` int(11) NOT NULL,
  `courseID` int(11) DEFAULT NULL,
  `previousExamPath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `previousexams`
--

INSERT INTO `previousexams` (`id`, `courseID`, `previousExamPath`) VALUES
(9, 105, 'professor_schedule (13).pdf'),
(10, 105, 'branchmajors.sql'),
(14, 105, 'university_db.sql');

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
  `ReviewedAt` date DEFAULT NULL,
  `Comments` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professorjobapplications`
--

INSERT INTO `professorjobapplications` (`ApplicationID`, `UserID`, `PositionAppliedFor`, `ApplicationDate`, `Status`, `CVPath`, `CoverLetterPath`, `AdditionalDocumentsPath`, `ReviewedBy`, `ReviewedAt`, `Comments`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 6, 'Assistant Professor of Computer Science', '2024-06-30 21:00:00', 'Under Review', '/cvs/user20_cv.pdf', '/cover_letters/user20_cl.pdf', '/additional_docs/user20_docs.pdf', 1, '2024-07-15', 'Strong candidate, schedule for interview', '2024-08-18 18:27:49', '2024-08-18 18:27:49'),
(2, 7, 'Associate Professor of Economics', '2024-07-01 21:00:00', 'Approved', '/cvs/user21_cv.pdf', '/cover_letters/user21_cl.pdf', '/additional_docs/user21_docs.pdf', 2, '2024-07-16', 'Excellent qualifications, approved for hire', '2024-08-18 18:27:49', '2024-08-18 18:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `request_type` enum('attestation','petition','financial_aid') NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `faculty_id` int(11) DEFAULT NULL,
  `comments` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `student_id`, `request_type`, `file_path`, `status`, `created_at`, `updated_at`, `faculty_id`, `comments`) VALUES
(1, 4, 'attestation', 'pp', 'Approved', '2024-09-14 11:44:49', '2024-09-14 18:28:23', 2, 'nothign'),
(2, 3, 'petition', '', 'pending', '2024-09-14 13:47:14', '2024-09-14 13:47:14', 13, 'cdcd'),
(3, 3, 'attestation', '', 'pending', '2024-09-14 14:12:33', '2024-09-14 14:12:33', 13, 'dscdsc'),
(4, 3, 'petition', NULL, 'pending', '2024-09-14 17:53:04', '2024-09-14 17:53:04', 13, 'dsv'),
(5, 3, 'petition', '', 'pending', '2024-09-14 17:56:25', '2024-09-14 17:56:25', 13, 'sd'),
(6, 3, 'petition', 'branchmajors (1).sql', 'pending', '2024-09-14 18:04:43', '2024-09-14 18:04:43', 13, 'dfbd');

--
-- Triggers `requests`
--
DELIMITER $$
CREATE TRIGGER `insert_to_attestations` AFTER UPDATE ON `requests` FOR EACH ROW BEGIN
  IF NEW.status = 'approved' AND NEW.request_type = 'attestation' THEN
    INSERT INTO attestations (student_id, faculty_id, date, status, remarks, created_at, updated_at)
    VALUES (NEW.student_id, NEW.faculty_id, CURDATE(), 'approved', new.comments, NOW(), NOW());
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_to_financial_aids` AFTER UPDATE ON `requests` FOR EACH ROW BEGIN
  IF NEW.status = 'approved' AND NEW.request_type = 'financial_aid' THEN
    INSERT INTO financial_aids (student_id, aid_amount, created_at, updated_at)
    VALUES (NEW.student_id, 5000.00, NOW(), NOW());  -- Default aid amount
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_to_petitions` AFTER UPDATE ON `requests` FOR EACH ROW BEGIN
  IF NEW.status = 'approved' AND NEW.request_type = 'petition' THEN
    INSERT INTO petitions (student_id, faculty_id, subject, description, status, created_at, updated_at)
    VALUES (NEW.student_id, NEW.faculty_id, 'Auto Petition', new.comments, 'approved', NOW(), NOW());
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `revenue_sources`
--

CREATE TABLE `revenue_sources` (
  `source_id` int(11) NOT NULL,
  `source_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `revenue_sources`
--

INSERT INTO `revenue_sources` (`source_id`, `source_name`) VALUES
(1, 'Tuition Fees'),
(2, 'Research Grants'),
(3, 'Donations'),
(4, 'Auxiliary Services'),
(5, 'Endowment Income');

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
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BranchID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`RoomID`, `RoomName`, `Capacity`, `Location`, `CreatedAt`, `UpdatedAt`, `BranchID`) VALUES
(1, 'Lecture Hall A', 200, 'Main Building, 1st Floor', '2024-08-18 18:28:15', '2024-08-25 12:16:47', 1),
(2, 'Lab 101', 30, 'Science Building, 2nd Floor', '2024-08-18 18:28:15', '2024-08-25 12:16:50', 2),
(3, 'Seminar Room 1', 50, 'Arts Building, 3rd Floor', '2024-08-18 18:28:15', '2024-08-25 12:16:54', 2),
(4, 'Auditorium', 500, 'Student Center', '2024-08-18 18:28:15', '2024-08-25 12:16:57', 1),
(5, 'Classroom 201', 40, 'Engineering Building, 2nd Floor', '2024-08-18 18:28:15', '2024-08-25 12:17:01', 1),
(6, 'peep', 234, 'ferf', '2024-08-25 15:50:22', '2024-08-25 15:50:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `schools_home`
--

CREATE TABLE `schools_home` (
  `schools_id` int(11) NOT NULL,
  `Schools` varchar(255) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schools_home`
--

INSERT INTO `schools_home` (`schools_id`, `Schools`, `Description`) VALUES
(15, 'Faculty of Arts and Sciences', 'The Faculty of Arts and Sciences is a vibrant hub for interdisciplinary education, offering a wide range of programs in humanities, social sciences, and natural sciences. The faculty fosters critical inquiry, intellectual growth, and cultural understanding, empowering students to become well-rounded thinkers. With a focus on research and experiential learning, the faculty prepares graduates for diverse career paths and advanced studies.\r\n'),
(16, 'Faculty of Business and Economics', 'The Faculty of Business and Economics provides a comprehensive education in business management, finance, and economic theory. Students gain practical skills through internships, case studies, and simulations, preparing them for leadership roles in the global economy. The faculty’s curriculum is designed to instill ethical decision-making, strategic thinking, and entrepreneurial spirit.'),
(17, 'Faculty of Computer Science', 'The Faculty of Computer Science is at the forefront of technological innovation, offering cutting-edge programs in software development, artificial intelligence, and cybersecurity. Students are trained in both theoretical foundations and practical applications, with opportunities to engage in research, coding challenges, and industry partnerships. The faculty prepares students to drive the future of technology.'),
(18, 'Faculty of Education', 'The Faculty of Education is dedicated to developing the next generation of educators, with programs that emphasize pedagogical theory, classroom management, and educational psychology. Students engage in teaching practicums and community outreach, gaining real-world experience in diverse educational settings. The faculty is committed to fostering inclusive and effective learning environments.'),
(19, 'Faculty of Engineering', 'The Faculty of Engineering offers a rigorous curriculum in fields such as civil, mechanical, electrical, and chemical engineering. Students engage in hands-on projects, research, and internships that bridge theory with practice. The faculty is known for its commitment to innovation, sustainability, and problem-solving, preparing engineers to tackle the complex challenges of the 21st century.'),
(20, 'Faculty of Environmental Studies', 'The Faculty of Environmental Studies provides an interdisciplinary approach to understanding and addressing environmental challenges. Programs focus on sustainability, conservation, and environmental policy, with a strong emphasis on fieldwork and research. The faculty prepares students to become leaders in environmental stewardship and advocates for a sustainable future.'),
(21, 'Faculty of Fine Arts', 'The Faculty of Fine Arts nurtures creativity and artistic expression through programs in visual arts, music, theater, and dance. Students are encouraged to explore their artistic potential through studio work, performances, and exhibitions. The faculty provides a supportive environment for creative experimentation and critical engagement with contemporary art practices.'),
(22, 'Faculty of Health Sciences', 'The Faculty of Health Sciences offers comprehensive programs in public health, nursing, and allied health professions. Students gain hands-on experience in clinical settings and research labs, preparing them for careers in healthcare and health policy. The faculty emphasizes interdisciplinary collaboration and the promotion of health and well-being in communities.'),
(23, 'Faculty of Law', 'The Faculty of Law provides a rigorous education in legal theory, practice, and ethics. Students engage in moot courts, legal clinics, and internships that provide real-world experience in various areas of law. The faculty is committed to developing legal professionals who are skilled advocates, critical thinkers, and champions of justice.'),
(24, 'Faculty of Medicine', 'The Faculty of Medicine offers a comprehensive medical education that combines clinical practice, research, and community service. Students engage in hands-on training in hospitals and clinics, learning from experienced healthcare professionals. The faculty is dedicated to preparing the next generation of doctors and healthcare leaders committed to improving patient care.'),
(25, 'Faculty of Pharmacy', 'The Faculty of Pharmacy provides a thorough education in pharmaceutical sciences, emphasizing the development of safe and effective medications. Students engage in research, clinical rotations, and community outreach to gain a deep understanding of drug therapy management. The faculty prepares pharmacists who are critical thinkers and compassionate healthcare providers.'),
(26, 'Faculty of Social Sciences', 'The Faculty of Social Sciences offers diverse programs in sociology, psychology, political science, and anthropology. Students explore the complexities of human behavior, social structures, and cultural dynamics through research, fieldwork, and internships. The faculty prepares graduates to address social issues and contribute to the betterment of society.');

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

--
-- Dumping data for table `studentapplications`
--

INSERT INTO `studentapplications` (`application_id`, `campus`, `semester`, `application_date`, `first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `place_of_birth`, `country_of_birth`, `nationality_type`, `nationality_1`, `nationality_2`, `record_number`, `location`, `lebanese_document_type`, `lebanese_document_number`, `passport_number`, `father_name`, `mother_name`, `mother_maiden_name`, `emergency_contact_person`, `emergency_contact_phone`, `city_area`, `street`, `building`, `phone`, `mobile`, `student_occupation`, `student_company_name`, `father_occupation`, `father_company_name`, `mother_occupation`, `mother_company_name`, `attended_school`, `school_from_date`, `school_to_date`, `diploma_type`, `school_branch`, `school_year`, `school_course`, `candidate_number`, `country_of_study`, `certificate_source`, `gpa_numerator`, `gpa_denominator`, `education_level`, `choice_of_program`, `chosen_school`, `chosen_major`, `application_source`) VALUES
(1, 'Main Campus', 'Fall 2024', '2024-08-18 18:28:39', 'John', NULL, 'Doe', 'Male', '2006-05-15', NULL, NULL, 'Lebanese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Undergraduate', 'Regular', 'School of Engineering', 'Computer Science', NULL),
(2, 'Downtown Campus', 'Fall 2024', '2024-08-18 18:28:39', 'Jane', NULL, 'Smith', 'Female', '2006-08-20', NULL, NULL, 'Foreign', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Undergraduate', 'Transfer', 'School of Business', 'Finance', NULL),
(3, 'Main Campus', 'Spring 2025', '2024-08-18 18:28:39', 'Ali', NULL, 'Hassan', 'Male', '2005-11-10', NULL, NULL, 'Lebanese', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Undergraduate', 'Freshman', 'School of Arts and Science', 'Psychology', NULL);

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

--
-- Dumping data for table `studentdocuments`
--

INSERT INTO `studentdocuments` (`StudentDocumentID`, `UserID`, `DocumentTypeID`, `DocumentPath`, `SubmissionDate`, `Status`) VALUES
(1, 3, 1, '/documents/user3_transcript.pdf', '2024-07-01', 'Approved'),
(2, 4, 2, '/documents/user4_id.pdf', '2024-07-02', 'Pending'),
(3, 5, 3, '/documents/user5_recommendation.pdf', '2024-07-03', 'Approved');

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

--
-- Dumping data for table `studentfees`
--

INSERT INTO `studentfees` (`FeeID`, `StudentID`, `FeeType`, `Amount`, `DueDate`, `Status`, `CreatedAt`) VALUES
(1, 3, 'Tuition', 5000.00, '2024-09-01', 'Paid', '2024-08-18 18:29:24'),
(2, 4, 'Tuition', 4500.00, '2024-09-01', 'Unpaid', '2024-08-18 18:29:24'),
(3, 5, 'Tuition', 5500.00, '2024-09-01', 'Paid', '2024-08-18 18:29:24'),
(4, 6, 'Dormitory', 2000.00, '2024-09-01', 'Unpaid', '2024-08-18 18:29:24'),
(5, 7, 'Lab Fee', 500.00, '2024-09-01', 'Paid', '2024-08-18 18:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `student_course_progress`
--

CREATE TABLE `student_course_progress` (
  `ProgressID` int(11) NOT NULL,
  `EnrollmentID` int(11) DEFAULT NULL,
  `YearTaken` int(11) DEFAULT NULL,
  `SemesterTaken` enum('Fall','Spring','Summer') DEFAULT NULL,
  `Grade` varchar(5) DEFAULT NULL,
  `Status` enum('Completed','Failed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_course_progress`
--

INSERT INTO `student_course_progress` (`ProgressID`, `EnrollmentID`, `YearTaken`, `SemesterTaken`, `Grade`, `Status`) VALUES
(4, 60, 2024, 'Fall', '85', 'Completed'),
(5, 61, 2024, 'Spring', '66', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `student_documents`
--

CREATE TABLE `student_documents` (
  `student_id` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `is_present` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_documents`
--

INSERT INTO `student_documents` (`student_id`, `document_name`, `is_present`) VALUES
(3, 'Completed Application Form', 1),
(3, 'High School Diploma\r\n', 1),
(3, 'Letters of Recommendation\r\n', 1),
(3, 'Personal Statement\r\n', 0),
(3, 'SAT/ACT Scores\r\n', 0),
(17, ' Completed Application Form, Personal Statement or Essay\r\n', 0),
(17, ' Proof of English Proficiency (if applicable)\r\n', 1),
(17, 'Official Transcripts from Previous Institutions\r\n', 0),
(25, ' Completed Application Form, Personal Statement or Essay\r\n', 1),
(25, 'Official Transcripts from Previous Institutions\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_gpa`
--

CREATE TABLE `student_gpa` (
  `student_id` int(11) NOT NULL,
  `gpa` decimal(3,2) NOT NULL CHECK (`gpa` between 0.00 and 4.00)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_gpa`
--

INSERT INTO `student_gpa` (`student_id`, `gpa`) VALUES
(3, 3.50),
(4, 3.80),
(5, 3.20),
(15, 3.60),
(16, 3.60),
(46, 4.00),
(47, 4.00);

-- --------------------------------------------------------

--
-- Table structure for table `student_grades`
--

CREATE TABLE `student_grades` (
  `StudentGradeID` int(11) NOT NULL,
  `GradeStructureID` int(11) DEFAULT NULL,
  `EnrollmentID` int(11) DEFAULT NULL,
  `Grade` decimal(5,2) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `TimetableID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `ProfessorID` int(11) DEFAULT NULL,
  `DayOfWeek` varchar(100) DEFAULT NULL,
  `RoomID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `Semester` enum('Fall','Spring','Summer') NOT NULL,
  `Year` year(4) NOT NULL,
  `time` enum('8:00-9:15','9:30-10:45','11:00-12:15','12:30-13:45','14:00-15:15','15:30-16:45') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`TimetableID`, `CourseID`, `ProfessorID`, `DayOfWeek`, `RoomID`, `CreatedAt`, `Semester`, `Year`, `time`) VALUES
(1, 105, 6, 'M,W,TH', 1, '2024-09-01 16:21:12', 'Fall', '2024', '11:00-12:15'),
(2, 106, 6, 'W,TH', 2, '2024-09-01 16:21:12', 'Spring', '2024', '8:00-9:15'),
(3, 107, 6, 'F,S', 3, '2024-09-01 16:21:12', 'Spring', '2024', '12:30-13:45'),
(4, 108, 6, 'M,W', 4, '2024-09-01 16:21:12', 'Spring', '2024', '14:00-15:15'),
(5, 109, 6, 'M,W,TH,F', 5, '2024-09-01 16:21:12', 'Fall', '2023', '9:30-10:45'),
(6, 105, 6, 'M,W,TH,F', 5, '2024-09-01 16:55:42', 'Fall', '2024', '15:30-16:45'),
(7, 108, 6, 'M,W', 1, '2024-09-07 10:23:25', 'Fall', '2025', '14:00-15:15'),
(8, 106, 6, 'M,W', 1, '2024-09-08 07:00:00', 'Fall', '2024', '8:00-9:15'),
(9, 106, NULL, 'T,TH', 2, '2024-09-08 07:10:00', 'Spring', '2024', '9:30-10:45'),
(10, 107, NULL, 'W,F', 3, '2024-09-08 07:20:00', 'Summer', '2025', '12:30-13:45'),
(11, 108, NULL, 'M,W,TH', 4, '2024-09-08 07:30:00', 'Spring', '2025', '11:00-12:15'),
(12, 109, NULL, 'T,TH', 5, '2024-09-08 07:40:00', 'Spring', '2025', '15:30-16:45'),
(13, 106, NULL, 'W,T', 5, '2024-09-21 19:37:30', 'Fall', '2024', '12:30-13:45'),
(14, 111, 6, 'TH', 5, '2024-09-21 19:39:46', 'Fall', '2024', '9:30-10:45'),
(15, 108, 6, 'T,TH', 5, '2024-09-21 20:19:39', 'Fall', '2024', '14:00-15:15'),
(16, 112, NULL, 'M,W,T', 1, '2024-09-22 10:25:26', 'Spring', '2024', '14:00-15:15'),
(17, 115, 2, 'M,T', 6, '2024-09-22 10:25:26', 'Spring', '2024', '15:30-16:45'),
(18, 106, NULL, 'W', 1, '2024-09-26 14:25:24', 'Fall', '2023', '8:00-9:15'),
(19, 106, NULL, 'T', 1, '2024-09-26 14:25:45', 'Fall', '2024', '8:00-9:15');

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `CompletedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `task`, `completed`, `CreatedAt`, `CompletedAt`) VALUES
(116, 'ferujuyj', 0, '2024-09-08 07:55:05', '2024-09-10 11:56:33'),
(123, 'ssdd', 0, '2024-09-10 10:56:54', '2024-09-10 11:56:54'),
(124, 'cscs', 0, '2024-09-10 10:57:30', '2024-09-10 11:57:30');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `TransferID` int(11) NOT NULL,
  `FirstParaghraph` text NOT NULL,
  `DocumentsList` text NOT NULL,
  `LastParaghraph` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`TransferID`, `FirstParaghraph`, `DocumentsList`, `LastParaghraph`) VALUES
(1, 'We are excited to help you with your university transfer process. To ensure a smooth transition, please prepare the following documents. If you have any questions or need assistance, feel free to contact our support team.', 'Official Transcripts from Current University\r\nCompleted Transfer Application Form\r\nPersonal Statement or Letter of Intent\r\nLetter(s) of Recommendation\r\nProof of English Proficiency (if applicable)\r\nCopy of Passport or ID\r\nApplication Fee (if applicable)', 'Once you have gathered all the required documents, you can proceed with your application. Make sure all documents are complete and submitted on time to avoid any delays in the transfer process. We wish you the best of luck with your transfer and hope you enjoy your new academic journey!\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Role` enum('Student','Freshman','Professor','Branch Head','President','Secretary','Dean','Assistant Dean') DEFAULT NULL,
  `BranchID` int(11) DEFAULT NULL,
  `FacultyID` int(11) DEFAULT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` enum('Active','Inactive','Financial Block','Daman Block','Missing Documents Block') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `Role`, `BranchID`, `FacultyID`, `DepartmentID`, `CreatedAt`, `UpdatedAt`, `Status`) VALUES
(1, 'admin', '$2y$10$encrypted_password', 'admin@dau.edu', '', 1, 14, 13, '2024-08-18 17:55:48', '2024-08-25 11:05:07', 'Active'),
(2, 'president', '$2y$10$encrypted_password', 'president@dau.edu', 'President', 1, 9, 13, '2024-08-18 17:55:48', '2024-08-25 11:05:12', 'Active'),
(3, 'student3', '$2y$10$Jbg2C11xF3tMkmmkgX/lPOS6Bv6fQFLYxkW1d2bCcgmzxcbgBOEf2', 'student1@dau.edu', 'Student', 1, 5, 9, '2024-08-18 17:55:48', '2024-09-21 16:17:40', 'Active'),
(4, 'student2', '$2y$10$encrypted_password', 'student2@dau.edu', 'Student', 2, 5, 9, '2024-08-18 17:55:48', '2024-08-25 11:05:30', 'Active'),
(5, 'student5', '$2y$10$Jbg2C11xF3tMkmmkgX/lPOS6Bv6fQFLYxkW1d2bCcgmzxcbgBOEf2', 'student3@dau.edu', 'Student', 3, 5, 9, '2024-08-18 17:55:48', '2024-09-21 16:16:52', 'Active'),
(6, 'professor1', '$2y$10$encrypted_password', 'professor1@dau.edu', 'Professor', 1, 5, 12, '2024-08-18 17:55:48', '2024-08-25 11:05:41', 'Active'),
(7, 'professor2', '$2y$10$encrypted_password', 'professor2@dau.edu', 'Professor', 2, 5, 8, '2024-08-18 17:55:48', '2024-08-25 11:05:45', 'Active'),
(8, 'secretary1', '$2y$10$encrypted_password', 'secretary1@dau.edu', '', 1, 5, 8, '2024-08-18 17:55:48', '2024-08-25 11:05:48', 'Active'),
(9, 'secretary2', '$2y$10$encrypted_password', 'secretary2@dau.edu', '', 2, 5, 8, '2024-08-18 17:55:48', '2024-08-25 11:05:51', 'Active'),
(10, 'dean1', '$2y$10$Icm94WhpHyN5FkXwlaa8YOlr6dE4EXRjFLKTWoPQTL53PLd2OJzJu', 'dean1@dau.edu', 'Dean', 1, 9, 8, '2024-08-18 17:55:48', '2024-09-17 07:00:55', 'Active'),
(11, 'dean2', '$2y$10$encrypted_password', 'dean2@dau.edu', '', 2, 4, 8, '2024-08-18 17:55:48', '2024-08-25 11:05:54', 'Active'),
(12, 'assistantdean1', '$2y$10b$encrypted_password', 'assistantdean1@dau.edu', '', 1, 4, 8, '2024-08-18 17:55:48', '2024-08-25 11:05:56', 'Active'),
(13, 'assistantdean2', '$2y$10$encrypted_password', 'assistantdean2@dau.edu', '', 2, 4, 13, '2024-08-18 17:55:48', '2024-08-25 11:06:01', 'Active'),
(14, 'branchhead1', '$2y$10$encrypted_password', 'branchhead1@dau.edu', '', 1, 4, 7, '2024-08-18 17:55:48', '2024-08-25 11:06:06', 'Active'),
(15, 'branchhead2', '$2y$10$encrypted_password', 'branchhead2@dau.edu', '', 2, 4, 7, '2024-08-18 17:55:48', '2024-08-25 11:06:10', 'Active'),
(16, 'student4', '$2y$10$encrypted_password', 'student4@dau.edu', 'Student', 1, 4, 7, '2024-08-19 07:00:00', '2024-08-25 11:06:11', 'Active'),
(17, 'student5', '$2y$10$encrypted_password', 'student5@dau.edu', 'Student', 2, 4, 7, '2024-08-19 07:05:00', '2024-08-25 11:06:13', 'Active'),
(18, 'student6', '$2y$10$encrypted_password', 'student6@dau.edu', 'Student', 3, 4, 7, '2024-08-19 07:10:00', '2024-08-25 11:06:15', 'Active'),
(19, 'student7', '$2y$10$encrypted_password', 'student7@dau.edu', 'Student', 1, 4, 7, '2024-08-19 07:15:00', '2024-08-25 11:06:19', 'Active'),
(20, 'student8', '$2y$10$encrypted_password', 'student8@dau.edu', 'Student', 2, 4, 7, '2024-08-19 07:20:00', '2024-08-25 11:06:16', 'Active'),
(21, 'student9', '$2y$10$encrypted_password', 'student9@dau.edu', 'Student', 3, 4, 7, '2024-08-19 07:25:00', '2024-08-25 11:06:22', 'Active'),
(22, 'student10', '$2y$10$encrypted_password', 'student10@dau.edu', 'Student', 1, 8, 7, '2024-08-19 07:30:00', '2024-08-25 11:06:24', 'Active'),
(23, 'student11', '$2y$10$encrypted_password', 'student11@dau.edu', 'Student', 2, 8, 7, '2024-08-19 07:35:00', '2024-08-25 11:06:27', 'Active'),
(24, 'student12', '$2y$10$encrypted_password', 'student12@dau.edu', 'Student', 3, 8, 7, '2024-08-19 07:40:00', '2024-08-25 11:06:29', 'Active'),
(25, 'student13', '$2y$10$encrypted_password', 'student13@dau.edu', 'Student', 1, 8, 7, '2024-08-19 07:45:00', '2024-08-25 11:06:32', 'Active'),
(26, 'student14', '$2y$10$encrypted_password', 'student14@dau.edu', 'Student', 2, 8, 7, '2024-08-19 07:50:00', '2024-08-25 11:06:35', 'Active'),
(27, 'student15', '$2y$10$encrypted_password', 'student15@dau.edu', 'Student', 3, 8, 9, '2024-08-19 07:55:00', '2024-08-25 11:06:40', 'Active'),
(28, 'student16', '$2y$10$encrypted_password', 'student16@dau.edu', 'Student', 1, 8, 9, '2024-08-19 08:00:00', '2024-08-25 11:06:44', 'Active'),
(29, 'student17', '$2y$10$encrypted_password', 'student17@dau.edu', 'Student', 2, 8, 9, '2024-08-19 08:05:00', '2024-08-25 11:06:47', 'Active'),
(30, 'student18', '$2y$10$encrypted_password', 'student18@dau.edu', 'Student', 3, 8, 9, '2024-08-19 08:10:00', '2024-08-25 11:06:48', 'Active'),
(31, 'student19', '$2y$10$encrypted_password', 'student19@dau.edu', 'Student', 1, 8, 9, '2024-08-19 08:15:00', '2024-08-25 11:06:53', 'Active'),
(32, 'student20', '$2y$10$encrypted_password', 'student20@dau.edu', 'Student', 1, 5, 9, '2024-08-19 08:20:00', '2024-09-17 06:30:11', 'Active'),
(33, 'student21', '$2y$10$encrypted_password', 'student21@dau.edu', 'Student', 3, 8, 9, '2024-08-19 08:25:00', '2024-08-25 11:07:00', 'Active'),
(34, 'student22', '$2y$10$encrypted_password', 'student22@dau.edu', 'Student', 9, 5, 9, '2024-08-19 08:30:00', '2024-09-17 06:30:29', 'Active'),
(35, 'student23', '$2y$10$encrypted_password', 'student23@dau.edu', 'Student', 2, 2, 9, '2024-08-19 08:35:00', '2024-08-25 11:07:04', 'Active'),
(36, 'student24', '$2y$10$encrypted_password', 'student24@dau.edu', 'Student', 3, 2, 9, '2024-08-19 08:40:00', '2024-08-25 11:07:06', 'Active'),
(37, 'student25', '$2y$10$encrypted_password', 'student25@dau.edu', 'Student', 1, 5, 9, '2024-08-19 08:45:00', '2024-09-17 06:26:35', 'Active'),
(38, 'student26', '$2y$10$encrypted_password', 'student26@dau.edu', 'Student', 2, 2, 9, '2024-08-19 08:50:00', '2024-08-25 11:07:11', 'Active'),
(39, 'student27', '$2y$10$encrypted_password', 'student27@dau.edu', 'Student', 3, 5, 5, '2024-08-19 08:55:00', '2024-09-17 06:26:31', 'Active'),
(40, 'student28', '$2y$10$encrypted_password', 'student28@dau.edu', 'Student', 1, 2, 5, '2024-08-19 09:00:00', '2024-08-25 11:07:23', 'Active'),
(41, 'student29', '$2y$10$encrypted_password', 'student29@dau.edu', 'Student', 2, 5, 5, '2024-08-19 09:05:00', '2024-09-17 06:26:06', 'Active'),
(42, 'student30', '$2y$10$encrypted_password', 'student30@dau.edu', 'Student', 3, 5, 5, '2024-08-19 09:10:00', '2024-09-17 06:26:41', 'Active'),
(43, 'student31', '$2y$10$encrypted_password', 'student31@dau.edu', 'Student', 1, 5, 5, '2024-08-19 09:15:00', '2024-09-17 06:26:02', 'Active'),
(44, 'student32', '$2y$10$encrypted_password', 'student32@dau.edu', 'Student', 2, 2, 5, '2024-08-19 09:20:00', '2024-08-25 11:07:37', 'Active'),
(45, 'student33', '$2y$10$encrypted_password', 'student33@dau.edu', 'Student', 3, 5, 5, '2024-08-19 09:25:00', '2024-09-17 06:25:42', 'Active'),
(46, '43t3', 'ttt', 'sleimana181@email.com', 'Student', 11, 5, 10, '2024-08-25 09:43:30', '2024-08-25 09:43:30', 'Active'),
(47, 'ewfe', 'fefw', 'few@email.com', 'Student', 10, 3, 6, '2024-08-25 10:00:28', '2024-08-25 10:00:28', 'Active'),
(48, 'efew', 'efwef', 'wefe@email.com', 'Professor', 11, 6, 10, '2024-08-25 10:00:28', '2024-08-25 10:00:28', NULL);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after_student_insert` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    -- Check if the new user's role is 'Student'
    IF NEW.Role = 'Student' THEN
        INSERT INTO student_gpa (student_id, gpa)
        VALUES (NEW.UserID, 4.00);
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`AttendanceID`),
  ADD KEY `EnrollmentID` (`EnrollmentID`);

--
-- Indexes for table `attestations`
--
ALTER TABLE `attestations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `available_jobs`
--
ALTER TABLE `available_jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `available_jobs_ibfk_1` (`department_id`),
  ADD KEY `available_jobs_ibfk_2` (`faculty_id`),
  ADD KEY `fk_branch_id` (`branch_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`BranchID`);

--
-- Indexes for table `branches_heads`
--
ALTER TABLE `branches_heads`
  ADD PRIMARY KEY (`BranchHeadID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `BranchID` (`BranchID`);

--
-- Indexes for table `branchmajors`
--
ALTER TABLE `branchmajors`
  ADD PRIMARY KEY (`BranchMajorID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `BranchID` (`BranchID`);

--
-- Indexes for table `branch_revenues`
--
ALTER TABLE `branch_revenues`
  ADD PRIMARY KEY (`revenue_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `source_id` (`source_id`);

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
  ADD KEY `fk_course_admin` (`CourseAdmin`);

--
-- Indexes for table `departmentheads`
--
ALTER TABLE `departmentheads`
  ADD KEY `DepartmentID` (`DepartmentID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`DepartmentID`,`FacultyID`) USING BTREE,
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
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `FK_Enrollments_TimeTableID` (`TimeTableID`);

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
  ADD KEY `RoomID` (`BranchID`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`FacultyID`),
  ADD UNIQUE KEY `Schools` (`FaculityName`) USING BTREE;

--
-- Indexes for table `facultyheads`
--
ALTER TABLE `facultyheads`
  ADD PRIMARY KEY (`FacultyHeadID`),
  ADD KEY `FacultyID` (`FacultyID`);

--
-- Indexes for table `faculty_branches`
--
ALTER TABLE `faculty_branches`
  ADD PRIMARY KEY (`FacultyID`,`BranchID`),
  ADD KEY `FacultyID` (`FacultyID`),
  ADD KEY `BranchID` (`BranchID`);

--
-- Indexes for table `financial_aids`
--
ALTER TABLE `financial_aids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `gradestructures`
--
ALTER TABLE `gradestructures`
  ADD PRIMARY KEY (`GradeStructureID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `moreinfo`
--
ALTER TABLE `moreinfo`
  ADD UNIQUE KEY `Email` (`Email`);

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
-- Indexes for table `office_hours`
--
ALTER TABLE `office_hours`
  ADD PRIMARY KEY (`OfficeHourID`),
  ADD KEY `FK_UserID` (`UserID`);

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
-- Indexes for table `petitions`
--
ALTER TABLE `petitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `previousexams`
--
ALTER TABLE `previousexams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `professorjobapplications`
--
ALTER TABLE `professorjobapplications`
  ADD PRIMARY KEY (`ApplicationID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ReviewedBy` (`ReviewedBy`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `revenue_sources`
--
ALTER TABLE `revenue_sources`
  ADD PRIMARY KEY (`source_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`RoomID`),
  ADD KEY `fk_branch` (`BranchID`);

--
-- Indexes for table `schools_home`
--
ALTER TABLE `schools_home`
  ADD KEY `idx_schools` (`Schools`);

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
-- Indexes for table `student_course_progress`
--
ALTER TABLE `student_course_progress`
  ADD PRIMARY KEY (`ProgressID`),
  ADD KEY `EnrollmentID` (`EnrollmentID`);

--
-- Indexes for table `student_documents`
--
ALTER TABLE `student_documents`
  ADD PRIMARY KEY (`student_id`,`document_name`);

--
-- Indexes for table `student_gpa`
--
ALTER TABLE `student_gpa`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD PRIMARY KEY (`StudentGradeID`),
  ADD KEY `GradeStructureID` (`GradeStructureID`),
  ADD KEY `EnrollmentID` (`EnrollmentID`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`TimetableID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `ProfessorID` (`ProfessorID`),
  ADD KEY `RoomID` (`RoomID`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `BranchID` (`BranchID`),
  ADD KEY `FacultyID` (`FacultyID`),
  ADD KEY `DepartmentID` (`DepartmentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `attestations`
--
ALTER TABLE `attestations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `BranchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `branches_heads`
--
ALTER TABLE `branches_heads`
  MODIFY `BranchHeadID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `branchmajors`
--
ALTER TABLE `branchmajors`
  MODIFY `BranchMajorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `branch_revenues`
--
ALTER TABLE `branch_revenues`
  MODIFY `revenue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courseprerequisites`
--
ALTER TABLE `courseprerequisites`
  MODIFY `PrerequisiteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `documentrequirements`
--
ALTER TABLE `documentrequirements`
  MODIFY `RequirementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `documenttypes`
--
ALTER TABLE `documenttypes`
  MODIFY `DocumentTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `EnrollmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `EvaluationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `FacultyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `financial_aids`
--
ALTER TABLE `financial_aids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gradestructures`
--
ALTER TABLE `gradestructures`
  MODIFY `GradeStructureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `temp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `NewsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `newslettersubscriptions`
--
ALTER TABLE `newslettersubscriptions`
  MODIFY `SubscriptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `obligatorynewsletter`
--
ALTER TABLE `obligatorynewsletter`
  MODIFY `NewsLetterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `office_hours`
--
ALTER TABLE `office_hours`
  MODIFY `OfficeHourID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `optionalnewsletter`
--
ALTER TABLE `optionalnewsletter`
  MODIFY `OptionalNewsLetterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `petitions`
--
ALTER TABLE `petitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `previousexams`
--
ALTER TABLE `previousexams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `professorjobapplications`
--
ALTER TABLE `professorjobapplications`
  MODIFY `ApplicationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `revenue_sources`
--
ALTER TABLE `revenue_sources`
  MODIFY `source_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `studentapplications`
--
ALTER TABLE `studentapplications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studentdocuments`
--
ALTER TABLE `studentdocuments`
  MODIFY `StudentDocumentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `studentfees`
--
ALTER TABLE `studentfees`
  MODIFY `FeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_course_progress`
--
ALTER TABLE `student_course_progress`
  MODIFY `ProgressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_grades`
--
ALTER TABLE `student_grades`
  MODIFY `StudentGradeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `TimetableID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`EnrollmentID`) REFERENCES `enrollments` (`EnrollmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attestations`
--
ALTER TABLE `attestations`
  ADD CONSTRAINT `attestations_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attestations_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`FacultyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `available_jobs`
--
ALTER TABLE `available_jobs`
  ADD CONSTRAINT `available_jobs_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`DepartmentID`),
  ADD CONSTRAINT `available_jobs_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`FacultyID`),
  ADD CONSTRAINT `fk_branch_id` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`BranchID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branches_heads`
--
ALTER TABLE `branches_heads`
  ADD CONSTRAINT `branches_heads_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `branches_heads_ibfk_2` FOREIGN KEY (`BranchID`) REFERENCES `branches` (`BranchID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branchmajors`
--
ALTER TABLE `branchmajors`
  ADD CONSTRAINT `branchmajors_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `branchmajors_ibfk_2` FOREIGN KEY (`BranchID`) REFERENCES `branches` (`BranchID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `branch_revenues`
--
ALTER TABLE `branch_revenues`
  ADD CONSTRAINT `branch_revenues_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`BranchID`),
  ADD CONSTRAINT `branch_revenues_ibfk_2` FOREIGN KEY (`source_id`) REFERENCES `revenue_sources` (`source_id`);

--
-- Constraints for table `courseprerequisites`
--
ALTER TABLE `courseprerequisites`
  ADD CONSTRAINT `courseprerequisites_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courseprerequisites_ibfk_2` FOREIGN KEY (`PrerequisiteCourseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_course_admin` FOREIGN KEY (`CourseAdmin`) REFERENCES `users` (`Email`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `departmentheads`
--
ALTER TABLE `departmentheads`
  ADD CONSTRAINT `departmentheads_ibfk_1` FOREIGN KEY (`DepartmentHeadID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `departmentheads_ibfk_2` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `documentrequirements`
--
ALTER TABLE `documentrequirements`
  ADD CONSTRAINT `documentrequirements_ibfk_1` FOREIGN KEY (`DocumentTypeID`) REFERENCES `documenttypes` (`DocumentTypeID`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `FK_Enrollments_TimeTableID` FOREIGN KEY (`TimeTableID`) REFERENCES `timetables` (`TimetableID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluations_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `users` (`UserID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluations_ibfk_3` FOREIGN KEY (`ProfessorID`) REFERENCES `users` (`UserID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `event_branches` FOREIGN KEY (`BranchID`) REFERENCES `branches` (`BranchID`),
  ADD CONSTRAINT `events_ibfk_3` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `facultyheads`
--
ALTER TABLE `facultyheads`
  ADD CONSTRAINT `facultyheads_ibfk_1` FOREIGN KEY (`FacultyHeadID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `facultyheads_ibfk_2` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `faculty_branches`
--
ALTER TABLE `faculty_branches`
  ADD CONSTRAINT `faculty_branches_ibfk_1` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `faculty_branches_ibfk_2` FOREIGN KEY (`BranchID`) REFERENCES `branches` (`BranchID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `financial_aids`
--
ALTER TABLE `financial_aids`
  ADD CONSTRAINT `financial_aids_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gradestructures`
--
ALTER TABLE `gradestructures`
  ADD CONSTRAINT `gradestructures_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gradestructures_ibfk_3` FOREIGN KEY (`CreatedBy`) REFERENCES `users` (`UserID`) ON DELETE SET NULL ON UPDATE CASCADE;

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
-- Constraints for table `office_hours`
--
ALTER TABLE `office_hours`
  ADD CONSTRAINT `FK_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

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
-- Constraints for table `petitions`
--
ALTER TABLE `petitions`
  ADD CONSTRAINT `petitions_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `petitions_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`FacultyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `previousexams`
--
ALTER TABLE `previousexams`
  ADD CONSTRAINT `previousexams_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `professorjobapplications`
--
ALTER TABLE `professorjobapplications`
  ADD CONSTRAINT `professorjobapplications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `professorjobapplications_ibfk_2` FOREIGN KEY (`ReviewedBy`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_branch` FOREIGN KEY (`BranchID`) REFERENCES `branches` (`BranchID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schools_home`
--
ALTER TABLE `schools_home`
  ADD CONSTRAINT `fk_schools_facultyname` FOREIGN KEY (`Schools`) REFERENCES `faculties` (`FaculityName`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `student_course_progress`
--
ALTER TABLE `student_course_progress`
  ADD CONSTRAINT `student_course_progress_ibfk_1` FOREIGN KEY (`EnrollmentID`) REFERENCES `enrollments` (`EnrollmentID`);

--
-- Constraints for table `student_gpa`
--
ALTER TABLE `student_gpa`
  ADD CONSTRAINT `student_gpa_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD CONSTRAINT `student_grades_ibfk_1` FOREIGN KEY (`GradeStructureID`) REFERENCES `gradestructures` (`GradeStructureID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_grades_ibfk_2` FOREIGN KEY (`EnrollmentID`) REFERENCES `enrollments` (`EnrollmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timetables`
--
ALTER TABLE `timetables`
  ADD CONSTRAINT `timetables_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `timetables_ibfk_2` FOREIGN KEY (`ProfessorID`) REFERENCES `users` (`UserID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `timetables_ibfk_3` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`BranchID`) REFERENCES `branches` (`BranchID`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`FacultyID`) REFERENCES `faculties` (`FacultyID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
