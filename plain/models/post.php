<?php
namespace Models;

class Post {
    private $id;
    private $content;

    public function __construct($id, $content) {
        $this->id = $id;
        $this->content = $content;
    }

    public function getId() {
        return $this->id;
    }

    public function getContent() {
        return $this->content;
    }
}
?>