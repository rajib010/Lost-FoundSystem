<?php

if (file_exists('../../vendor/autoload.php')) {
    require_once('../../vendor/autoload.php');
} else if (file_exists('../../../vendor/autoload.php')) {
    require_once('../../../vendor/autoload.php');
} else {
    require_once('../vendor/autoload.php');
}

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
class Database
{
    private $host;
    private $user;
    private $password;
    private $db_name;
    public $conn;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
        $this->db_name = $_ENV['DB_NAME'];

        // Establish the database connection
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    // Function for inserting into tables...
    public function insert($table, $params)
    {
        $columns = implode(', ', array_keys($params));
        $placeholders = implode(', ', array_fill(0, count($params), '?'));

        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $types = '';
            $values = array();

            foreach ($params as $key => $value) {
                if ($key == 'profile') {
                    $types .= 'b';
                } elseif ($key == 'user_type') {
                    $types .= 'i';
                } elseif ($key == 'phone_number') {
                    $types .= 's';
                } elseif ($key == 'password') {
                    $value = password_hash($value, PASSWORD_DEFAULT);
                    $types .= 's';
                } else {
                    $types .= 's';
                }
                $values[] = $value;
            }

            $stmt->bind_param($types, ...$values);

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                echo "Error inserting data: " . $stmt->error;
                $stmt->close();
                return false;
            }
        } else {
            echo "Error preparing statement: " . $this->conn->error;
            return false;
        }
    }

    // Function to update tables...
    public function update($table, $params = array(), $where = null)
    {
        $args = array();
        $types = '';
        $values = array();

        foreach ($params as $key => $value) {
            $args[] = "$key = ?";
            if ($key == 'profile') {
                $types .= 'b';
            } elseif ($key == 'user_type') {
                $types .= 'i';
            } elseif ($key == 'phone_number') {
                $types .= 's';
            } elseif ($key == 'password') {
                $value = password_hash($value, PASSWORD_DEFAULT);
                $types .= 's';
            } else {
                $types .= 's';
            }
            $values[] = $value;
        }

        $sql = "UPDATE $table SET " . implode(', ', $args);
        if ($where != null) {
            $sql .= " WHERE " . $where;
        }

        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param($types, ...$values);
            if ($stmt->execute()) {
                return true;
            } else {
                echo "Update unsuccessful: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $this->conn->error;
        }

        return false;
    }


    // Function to delete from tables...
    public function delete($table, $where = null)
    {
        $sql = "DELETE FROM $table";
        if ($where != null) {
            $sql .= " WHERE $where";
        }

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->execute();
            $stmt->close();
            return true;
        } else {
            echo "Delete unsuccessful: " . $this->conn->error;
        }
    }

    // Function to select from tables...
    public function select($table, $row = '*', $join = null, $where = null, $order = null, $limit = null, $groupBy = null)
    {
        // Constructing the SQL query
        $sql = "SELECT $row FROM $table";

        // Adding JOIN clause
        if ($join != null) {
            $sql .= " JOIN $join";
        }

        //Adding GROUPBY clause
        if ($groupBy !== null) {
            $sql .= " GROUP BY $groupBy";
        }

        // Adding WHERE clause
        if ($where != null) {
            $sql .= " WHERE $where";
        }

        // Adding ORDER BY clause
        if ($order != null) {
            $sql .= " ORDER BY $order";
        }

        // Adding LIMIT clause for pagination
        if ($limit != null) {
            if ($limit <= 0) {
                $limit = ' 0 , 8';
            }
            $sql .= " LIMIT $limit";
        }

        //echo $sql

        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            echo "SQL Error: " . $this->conn->error;
            return false;
        }

        if ($stmt->execute()) {
            return $stmt->get_result();
        } else {
            echo "Error executing query: " . $this->conn->error;
            return false;
        }
    }
}
