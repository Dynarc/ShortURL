<?php

class Model {
    private $pdo;

    private function setDB(){
        $this->pdo = new PDO("mysql:host=localhost;dbname=shorturl;charset=utf8", "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }

    private function getDB(){
        if($this->pdo == null){
            $this->setDB();
        }
        return $this->pdo;
    }

    public function getLink($id) {
        $sql = "SELECT * FROM url where id = :id";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ':id' => $id
        ]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getId($url){
        $sql = "SELECT * FROM url where url = :url";
        $req = $this->getDB()->prepare($sql);
        $req->execute([
            ':url' => $url
        ]);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function createLink($id, $url) {
        $sql = "INSERT INTO url(id, url) values (:id, :url)";
        $req = $this->getDB()->prepare($sql);
        $result = $req->execute([
            ":id" => $id,
            ":url" => $url
        ]);
        return $result;
    }
}