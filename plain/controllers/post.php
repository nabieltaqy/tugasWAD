<?php
namespace Controllers;

include_once "dao/post.php";
use DAO\PostDAO;

class Post {
    private $postDAO;

    public function __construct($conn = null) {
        $this->postDAO = new PostDAO($conn);
    }

    public function index() {
        $posts = $this->postDAO->getAll();
        include_once 'views/post.php';
    }

    public function doPost() {
        $this->postDAO->insert($_POST['user_id'], $_POST['content']);
        header('location:/post');
    }
}
?>