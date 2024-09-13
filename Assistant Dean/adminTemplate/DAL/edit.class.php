<?php
require('dal.class.php');

class UserManagement extends DAL
{
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
    public function add_event($title, $description, $location, $start, $end, $event_date, $event_end, $createdBy)
    {
        $sql = "INSERT INTO events (EventName,Description,BranchID,StartTime,EndTime,EventDate,EndDate,CreatedBy) VALUES (?,?,?,?,?,?,?,?)";
        return $this->execute($sql, [$title, $description, $location, $start, $end, $event_date, $event_end, $createdBy]);
    }
    public function update_event($title, $description, $location,$date1,$date2,$time1,$time2,$id)
    {
        $sql = "UPDATE events SET EventName=?,Description=?,BranchID=?,EventDate=?,EndDate=?,StartTime=?,EndTime=? WHERE EventID=?";
        return $this->execute($sql, [$title, $description, $location,$date1,$date2,$time1,$time2,$id]);
    }
    public function remove_courseFromDepartment($TimetableID)
    {
        // Update the existing DepartmentID by appending the new departmentID with a slash
        $sql = "Delete from timetables Where TimetableID=?"; // Check to ensure it does not already exist

        // Execute the query with the departmentID and courseID
        return $this->execute($sql, [$TimetableID]);
    }
    public function delete_event($EventID)
    {
        // Update the existing DepartmentID by appending the new departmentID with a slash
        $sql = "DELETE FROM events WHERE EventID=?"; // Check to ensure it does not already exist

        // Execute the query with the departmentID and courseID
        return $this->execute($sql, [$EventID]);
    }
    public function add_CourseInDepartment($courseID, $departmentID)
    {
        // Update the existing DepartmentID by appending the new departmentID with a slash
        $sql = "UPDATE courses 
                SET DepartmentID = CONCAT(DepartmentID, '/', ?) 
                WHERE CourseID = ? 
                AND FIND_IN_SET(?, REPLACE(DepartmentID, '/', ',')) = 0"; // Check to ensure it does not already exist

        // Execute the query with the departmentID and courseID
        return $this->execute($sql, [$departmentID, $courseID, $departmentID]);
    }
    public function add_Course($courseID, $room_id, $time, $days, $semester, $year)
    {
        // Update the existing DepartmentID by appending the new departmentID with a slash
        $sql = " INSERT INTO timetables (CourseID, RoomID, time, DayOfWeek,Semester,Year) VALUES (?, ?, ?, ?,?,?)"; // Check to ensure it does not already exist

        // Execute the query with the departmentID and courseID
        return $this->execute($sql, [$courseID, $room_id, $time, $days, $semester, $year]);
    }
    public function update_Course($timetableid, $courseID, $room_id, $time, $days, $semester, $year)
    {
        // SQL query to update the existing record based on CourseID, RoomID, Semester, Year, and time
        $sql = "UPDATE timetables 
            SET 
            CourseID=?,
            RoomID = ?, 
                time = ?, 
                DayOfWeek = ?, 
                Semester = ?, 
                Year = ? 
            WHERE TimetableID = ? 
           ";

        // Execute the query with the provided parameters
        return $this->execute($sql, [
            $courseID,
            $room_id, // New RoomID
            $time,    // New Time
            $days,    // New Days of the Week
            $semester, // New Semester
            $year,
            $timetableid   // New Year     // To ensure that the update affects the correct record
        ]);
    }

    public function checkScheduleConflict($semester, $year,  $roomId, $days, $time)
    {
        // Sanitize and prepare the days list
        $days = array_map('trim', $days);


        // Build the SQL query dynamically
        $dayConditions = array_map(function ($day) {
            return "FIND_IN_SET('$day', `DayOfWeek`) > 0";
        }, $days);
        $dayConditionsSql = implode(' OR ', $dayConditions);

        // Construct the final SQL query
        $sql = "SELECT * FROM `timetables`
            WHERE `RoomID` = ?
            AND `Semester` = ?
            AND `Year` = ?
            AND `time` = ?
            AND ($dayConditionsSql)";

        return $this->getData($sql, [$roomId, $semester, $year, $time]);
    }
    public function checkScheduleEditConflict($semester, $year,  $roomId, $days, $time, $timetableid)
    {
        // Sanitize and prepare the days list
        $days = array_map('trim', $days);


        // Build the SQL query dynamically
        $dayConditions = array_map(function ($day) {
            return "FIND_IN_SET('$day', `DayOfWeek`) > 0";
        }, $days);
        $dayConditionsSql = implode(' OR ', $dayConditions);

        // Construct the final SQL query
        $sql = "SELECT * FROM `timetables`
            WHERE `RoomID` = ?
            AND `Semester` = ?
            AND `Year` = ?
            AND `time` = ?
            AND TimetableID !=?
            AND ($dayConditionsSql)";

        return $this->getData($sql, [$roomId, $semester, $year, $time, $timetableid]);
    }
    public function checkScheduleUpdate($semester, $year, $course_id,  $roomId, $days, $time)
    {
        // Construct the final SQL query
        $sql = "SELECT * FROM `timetables`
            WHERE `RoomID` = ?
            AND `Semester` = ?
            AND `Year` = ?
            AND `time` = ?
            AND `CourseID` = ?
            AND 'DayOfWeek'=?";

        return $this->getData($sql, [$roomId, $semester, $year, $time, $course_id, $days]);
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

    public function  getCourseNameCode($id, $coursename, $coursecode)
    {
        $sql = "SELECT CourseName, CourseCode 
FROM courses
WHERE (CourseName = ? OR CourseCode = ?)
  AND CourseID != ?
";
        return $this->getdata($sql, [$coursename, $coursecode, $id]);
    }
    public function  getCourseNameCodeAdd($coursename, $coursecode)
    {
        $sql = "SELECT CourseName, CourseCode 
        FROM courses
        WHERE CourseName=? OR CourseCode=?
";
        return $this->getdata($sql, [$coursename, $coursecode]);
    }
    public function  getCourseInfo($CourseID, $CourseName, $CourseCode, $CourseCredits)
    {
        $sql = "SELECT *
FROM courses
WHERE CourseID=? AND CourseName=? AND CourseCode=? AND Credits=?;
";
        return $this->getdata($sql, [$CourseID, $CourseName, $CourseCode, $CourseCredits]);
    }
    public function updateCourseInfo($id, $coursename, $coursecode, $coursecredits)
    {
        // SQL query to update the user's password in the `users` table
        $sql = "UPDATE courses
                SET CourseName = ?,
                CourseCode=?,
                Credits=?
                WHERE CourseID = ?";

        // Execute the query with the provided parameters
        return $this->execute($sql, [$coursename, $coursecode, $coursecredits, $id]);
    }
}
