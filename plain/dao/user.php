<?php
namespace DAO;

include_once 'models/user.php';
use Models\User;

class UserDAO {
    private $conn;

    public function __construct($conn = null) {
        $this->conn = $conn;
    }

    // public function insert($username, $email, $password, $gambar) {
    //     $sql = "INSERT INTO users (username, email, password, gambar) VALUES (?, ?, ?, ?)";
    //     $stmt = $this->conn->prepare($sql);
        
    //     if ($stmt) {
    //         $stmt->bindParam(1, $username, PDO::PARAM_STR);
    //         $stmt->bindParam(2, $email, PDO::PARAM_STR);
    //         $stmt->bindParam(3, $password, PDO::PARAM_STR);
    //         $stmt->bindParam(4, $gambar, PDO::PARAM_LOB);
    
    //         if ($stmt->execute()) {
    //             return true; // Data berhasil dimasukkan ke database
    //         } else {
    //             return false; // Gagal memasukkan data
    //         }
    //     }
    //     return false; // Gagal membuat pernyataan SQL
    // }
    

    public function insert($username, $email, $password, $gambar) {
        $sql = "insert into users (username, email, password, gambar) values(?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $password, $gambar);
        
        $stmt->execute();
        
        $stmt->close();
    }

    public function getAll() {
        $users = [];
        
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $users[] = new User($row['id'], $row['username']);
            }
        }

        return $users;
    }

    public function login($username, $password) {
        $user = null;
        
        $sql = "SELECT * FROM users where username = '$username' and password='$password'";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $user = new User($row['id'], $row['username']);
                break;
            }
        }

        return $user;
    }
}