<?php
class Views{
    // Connexion
    private $connexion;
    private $table = "view";

    // object properties
    public $id;
    public $name;
    public $type;
    public $resource;
    public $client_id;

    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }

    /**
     * Lecture des produits
     *
     * @return void
     */
    public function lireClientViews(){
        // On écrit la requête
        $sql = "SELECT * FROM " . $this->table . " WHERE client_id = ?";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On attache l'id
        $query->bindParam(1, $this->client_id);

        // On exécute la requête
        $query->execute();

        // On retourne le résultat
        return $query;
    }
}
