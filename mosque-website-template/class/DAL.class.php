<?php

class DAL
{
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "university_db";

    // Private method to establish a database connection
    private function connect()
    {
        // Establish a connection to the database
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check if the connection was successful
        if ($conn->connect_error) {
            // Throw an exception if there is a connection error
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    public function getdata($sql)
    {
        // Get the database connection
        $conn = $this->connect();

        // Execute the SQL query
        $result = $conn->query($sql);

        // Check if the query was successful
        if (!$result) {
            // Throw an exception if there is an error with the query
            throw new Exception("Query failed: " . $conn->error);
        }

        // Fetch all results as an associative array
        $results = $result->fetch_all(MYSQLI_ASSOC);

        // Close the connection
        $conn->close();

        // Return the results
        return $results;
    }

    public function execute($sql)
    {
        // Get the database connection
        $conn = $this->connect();

        // Execute the SQL query
        $result = $conn->query($sql);

        // Check if the query was successful
        if (!$result) {
            // Throw an exception if there is an error with the query
            throw new Exception("Query failed: " . $conn->error);
        }
        // Close the connection


        return $conn->insert_id;
    }
    public function ConnectionDatabase()
    {
        return new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }
    public function data($sql, $params = array())
    {
        $conn = $this->ConnectionDatabase();

        // Check if there are parameters
        if (!empty($params)) {
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                throw new Exception($conn->error);
            }

            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);

            $result = $stmt->execute();

            if ($result === false) {
                throw new Exception($stmt->error);
            }

            $resultSet = $stmt->get_result();
            $results = $resultSet->fetch_all(MYSQLI_ASSOC);

            $stmt->close();
        } else {
            // If there are no parameters, execute the query directly
            $result = $conn->query($sql);

            if ($result === false) {
                throw new Exception($conn->error);
            }

            $results = $result->fetch_all(MYSQLI_ASSOC);
        }

        $conn->close();

        return $results;
    }
    public function movemultiplefiles($file, $i)
    {
        $target_dir = "../assets/img/";
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
