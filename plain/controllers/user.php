<?php
namespace Controllers;

include_once "dao/user.php";
use DAO\UserDAO;

class User {
    private $userDAO;

    public function __construct($conn = null) {
        $this->userDAO = new UserDAO($conn);
    }

    public function index() {
        
    }

    public function register() {
        include_once 'views/register.php';
    }
    
    public function doRegister() {
        
        $gambar = $_FILES['gambar']['name'];
        $lokasiGambar = $_FILES['gambar']['tmp_name'];

        $this->userDAO->insert($_POST['username'], $_POST['email'], $_POST['password'], $gambar);

        move_uploaded_file($lokasiGambar, 'C:/xampp/htdocs/plainn/plain/assets/'.$gambar);
        // header('location:/user/showAll');
        if ($this) {
            echo "Berhasil Register dan foto tersimpan";
        }else {
            echo "gagal register";
        }
    }

    public function login() {
        include_once 'views/login.php';
    }

    public function doLogin() {
        $user = $this->userDAO->login($_POST['username'], $_POST['password']);
        if($user == null) {
            header('location:/user/login');
        }
        else {
            include_once 'views/user.php';
        }
    }

    public function showAll() {
        $users = $this->userDAO->getAll();
        include_once 'views/users.php';
    }
}
?>