<?php
class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $db_name = 'lost&foundsystem';
    public $conn;

    // Make the connection directly...
    public function __construct()
    {
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
            $sql .= " WHERE $where";
        }

        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param($types, ...$values);
            if ($stmt->execute()) {
                echo $stmt->affected_rows . " rows updated";
            } else {
                echo "Update unsuccessful: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $this->conn->error;
        }
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
            echo $stmt->affected_rows . " rows deleted successfully";
            $stmt->close();
        } else {
            echo "Delete unsuccessful: " . $this->conn->error;
        }
    }

    // Function to select from tables...
    public function select($table, $row = '*', $join = null, $where = null, $order = null, $limit = null)
    {
        $sql = "SELECT $row FROM $table";
        if ($join != null) {
            $sql .= " JOIN $join";
        }
        if ($where != null) {
            $sql .= " WHERE $where";
        }
        if ($order != null) {
            $sql .= " ORDER BY $order";
        }
        if ($limit != null) {
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $start = ($page - 1) * $limit;
            $sql .= " LIMIT $start, $limit";
        }

        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->get_result();
        } else {
            echo "Error fetching data: " . $this->conn->error;
        }
    }
}
