<?php

class DAL
{
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "university_db";

    // Method to get data using prepared statements
    public function getdata($sql, $params = [])
    {
        // Establish a connection to the database
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check if the connection was successful
        if ($conn->connect_error) {
            throw new Exception($conn->connect_error);
        }

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception($conn->error);
        }

        // If there are parameters, bind them
        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Assuming all parameters are strings
            $stmt->bind_param($types, ...$params);
        }

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();
        if ($result === false) {
            throw new Exception($stmt->error);
        }

        // Fetch all results as an associative array
        $results = $result->fetch_all(MYSQLI_ASSOC);

        // Close the statement and connection
        $stmt->close();
        $conn->close();

        return $results;
    }

    // Method to execute a query using prepared statements
    public function execute($sql, $params = [])
    {
        // Establish a connection to the database
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check if the connection was successful
        if ($conn->connect_error) {
            throw new Exception('Connection failed: ' . $conn->connect_error);
        }

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }

        // If there are parameters, bind them
        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Assuming all parameters are strings
            $stmt->bind_param($types, ...$params);
        }

        // Execute the statement
         $stmt->execute();

        // Check for errors
        if ($stmt->error) {
            throw new Exception('Execute failed: ' . $stmt->error);
        }

        // Determine the type of query and return the appropriate result
        $affected_rows = $stmt->affected_rows;

        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Return the result for INSERT queries or the number of affected rows for UPDATE/DELETE
        return $affected_rows > 0;
    }
    public function movemultiplefiles($file, $i)
    {
        $target_dir = "../dataClient/PreviousExams/";
        $target_file = $target_dir . basename($file["name"][$i]);
        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $img_name = str_replace("." . $extension, "", basename($file["name"][$i]));
        $count = 0;
        $image_name = $file["name"][$i];

        while (file_exists($target_file)) {
            $new_image = $img_name . "-" . $count . "." . $extension;
            $image_name = $new_image;
            $target_file = $target_dir . $new_image;
            $count++;
        }

        if (move_uploaded_file($file["tmp_name"][$i], $target_file)) {
            return $image_name;
        } else {
            echo '<p>Failed to move file: ' . $file["name"][$i] . '</p>';
            return false;
        }
    }
   
}
