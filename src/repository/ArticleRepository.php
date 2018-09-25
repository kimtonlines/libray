<?php

namespace Kimt\Repository;
require_once '../config/container.php';

use ArrayObject;
use PDO;
use Kimt\Model\Article;

class ArticleRepository
{
    private $articles;
    private $db;

    public function __construct()
    {
        $this->articles = new ArrayObject();

        $this->db = new PDO('mysql:host=localhost;dbname=library','root','root');
    }

    public function save(Article $article) {
        
        $sql = $this->db->prepare("INSERT INTO article(libelle, prix, categorie) VALUES(:libelle, :prix, :categorie)");

        $sql->bindValue(':libelle', $article->getLibelle());
        $sql->bindValue(':prix', $article->getPrix());
        $sql->bindValue(':categorie', $article->getCategorie());
        
        $sql->execute();
        
        
    }

    public function findAll() {

        $sql = $this->db->query("SELECT * FROM article");

        while ($row = $sql->fetch()) {
            $article = new Article($row['id'], $row['libelle'], $row['prix'], $row['categorie']);

            $this->articles->append($article);
        }
        return $this->articles;
    }

    public function delete(Article $article) {

        $sql = $this->db->prepare("DELETE FROM article WHERE id = :id ");

        $sql->bindParam('id', $article->getId());
        $sql->execute();

    }

    public function update(Article $article) {


        $sql = $this->db->prepare("UPDATE article SET libelle = :libelle, prix = :prix, categorie = :categorie WHERE id = :id");

        $sql->bindParam('libelle', $article->getLibelle());
        $sql->bindParam('prix', $article->getPrix());
        $sql->bindParam('categorie', $article->getCategorie());
        $sql->bindParam('id', $article->getId());
        $ok = $sql->execute();
        
        if ($ok) {
            echo 'L\'article a été bien modifié !';
        }
        else {
            echo 'Une erreur est survenue lors de la modication de l\'article';
        }
    
    }

    public function findOne($id) {

        $sql = $this->db->prepare('SELECT * FROM article WHERE id = :id');

        $sql->bindValue(':id', $id);
        $sql->execute();

        $row = $sql->fetch();

        $article = new Article($row['id'], $row['libelle'], $row['prix'], $row['categorie']);

        return $article;
      
    }
}