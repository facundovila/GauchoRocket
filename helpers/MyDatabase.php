<?php

class MyDatabase{
    private mysqli $database;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->database = new mysqli($servername, $username,$password, $dbname,$port);

        if ($this->database->connect_error) {
            die("Connection failed: " . $this->database->connect_error);
        }
    }

    public function __destruct() {
        // mysqli_close($this->database);
        $this->database->close();
    }

    public function query($sql): array {
        $databaseResult = mysqli_query($this->database, $sql);

        if (mysqli_num_rows($databaseResult) <= 0)
            return [];

        return mysqli_fetch_all($databaseResult,MYSQLI_ASSOC);
    }

    public function execute($sql){
        mysqli_query($this->database, $sql);
    }
    
    public function executeQueryParams($params, $query) {
        $stmt = $this->database->prepare($query);

        $types = "";
        foreach ($params as $p) {
            $types .= match (gettype($p)) {
                "string" => "s",
                "integer" => "i",
                "boolean" => "b",
                "double" => "d",
                // ...
            };
        }

        $stmt->bind_param($types,...$params);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result) {
                if (is_bool($result)) {
                    return [];
                } else {
                    return $result->fetch_all(MYSQLI_ASSOC);
                }
            } else {
                return [];
            }
        } else {
            return [];
        }
    }
}