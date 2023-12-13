<?php
class PostController {
    private $db; // Connexion à la base de données

    public function __construct($connexionDB) {
        $this->db = $connexionDB;
    }

    public function create($postData) {

    }

    public function read($id = null) {

    }

    public function update($id, $postData) {

    }

    public function delete($id) {

    }
}
?>
