<?php
namespace DAO;

include_once 'models/post.php';
use Models\Post;

class PostDAO {
    private $conn;

    public function __construct($conn = null) {
        $this->conn = $conn;
    }

    public function insert($user_id, $content) {
        // Check if $user_id is null, and bind accordingly
        if ($user_id == null) {
            $sql = "insert into posts (content) values(?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $content);
        } else {
            $sql = "insert into posts (user_id, content) values(?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("is", $user_id, $content);
        }
        $stmt->execute();
        $stmt->close();
    }

    public function getAll() {
        $posts = [];
        
        $sql = "SELECT * FROM posts";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $posts[] = new Post($row['id'], $row['content']);
            }
        }

        return $posts;
    }
}