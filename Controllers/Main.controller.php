<?php

require_once 'Models/Model.class.php';

class Controller {
    private $model;

    public function __construct() {
        $this->model = new Model();
    }

    public function generateLink($url) {
        $id = $this->model->getId($url);
        if($id) {
            echo URL.$id[0]->id;
        } else {
            $newId = $this->generateId();
            $result = $this->model->createLink($newId, $url);
            if ($result) {
                echo URL.$newId;
            } else {
                throw new Exception('erreur');
            }
        }
    }

    private function generateId() {
        $cara = str_split("abcdefghijklmnopqrstuvwxyz0123456789");
        $result = '';
        foreach (array_rand($cara, 6) as $k) $result .= $cara[$k];
        if($this->model->getLink($result)) {
            $this->generateId();
        } else {
            return $result;
        }
    }

    public function redirectLink($id) {
        $url = $this->model->getLink($id);
        if($url) {
            header("Location: ".(preg_match('/^https?:\/\//',$url[0]->url) ? '' : 'https://').$url[0]->url);
        } else {
            throw new Exception('erreur 404 : Le lien n\'existe pas');
        }
    }
}