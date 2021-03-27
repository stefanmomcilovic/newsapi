<?php
ob_start(); // Turn on output buffering
session_start(); // Session start
date_default_timezone_set("Europe/Belgrade"); // Set Default Time Zone For Website
class DB
{
    public $error_array = array();
    public $con;

    private $dbname = "newsapi"; // Database Name
    private $host = "localhost"; // Host
    private $username = "root"; // Database Login username
    private $password = ""; // Database Login Password

    function __construct()
    {
        // Connection with PDO
        try {
            $this->con = new PDO("mysql:dbname=" . $this->dbname . ";host=" . $this->host . ";", $this->username, $this->password);
            $this->con->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->con;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function query($sql)
    {
        try {
            $query = $this->con->query($sql);
            $rowCount = $query->rowCount();
            $lastId = $this->con->lastInsertId();
            return array("rowCount" => $rowCount, "Query" => $query, "lastId"=> $lastId);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function fetch($sql)
    {
        try {
            $query = $this->con->query($sql);
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $rowCount = $query->rowCount();

            return array("rowCount" => $rowCount, "fetch" => $row);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function fetchAll($sql)
    {
        try {
            $query = $this->con->query($sql);
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            $rowCount = $query->rowCount();

            return array("rowCount" => $rowCount, "fetchAll" => $rows);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function preparedQuery($sql, $data = array(":named_parameter" => "Value of Paramater"))
    {
        try {
            $query = $this->con->prepare($sql);
            foreach ($data as $key => $value) {
                $query->bindValue($key, $value);
            }
            $query->execute();
            $rowCount = $query->rowCount();
            $lastId = $this->con->lastInsertId();
            return array("rowCount" => $rowCount, "Query" => $query, "lastId"=> $lastId);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function preparedQueryFetch($sql, $data = array(":named_parameter" => "Value of Paramater"))
    {
        try {
            $query = $this->con->prepare($sql);
            foreach ($data as $key => $value) {
                $query->bindValue($key, $value);
            }
            $query->execute();
            $fetch = $query->fetch(PDO::FETCH_ASSOC);
            $rowCount = $query->rowCount();

            return array("rowCount" => $rowCount, "fetch" => $fetch);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function preparedQueryFetchAll($sql, $data = array(":named_parameter" => "Value of Paramater"))
    {
        try {
            $query = $this->con->prepare($sql);
            foreach ($data as $key => $value) {
                $query->bindValue($key, $value);
            }
            $query->execute();
            $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
            $rowCount = $query->rowCount();

            return array("rowCount" => $rowCount, "fetchAll" => $fetch);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function dumpData($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }
}

$DB = new DB();

// function fatal_handler()
// {
//     global $DB;

//     $error = error_get_last();

//     if ($error !== NULL) {
//         $DB->dumpData($error);
//     }
// }
// register_shutdown_function("fatal_handler");
