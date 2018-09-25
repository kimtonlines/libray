<?php

namespace Kimt\Model;

class Article
{
    private $id;
    private $libelle;
    private $prix;
    private $categorie;
    
    public function __construct($id = null, $libelle = null, $prix = null, $categorie = null)
    {
         $this->id = $id;
         $this->libelle = $libelle;
         $this->prix = $prix;
         $this->categorie = $categorie;        
    }
    
    public function getId() {
        return $this->id;
    }

    public function setLibelle($libelle) {
       
        $this->libelle = $libelle;
    }

    public function getLibelle() {

        return $this->libelle;
    }
    
    public function setPrix($prix) {
        
        $this->prix = $prix;
    }
    
    public function getPrix() {

        return $this->prix;
    }

    public function setCategorie($categorie) {

        $this->categorie = $categorie;
    }

    public function getCategorie() {

        return $this->categorie;
    }
}