<?php
class Clients{
    // Connexion
    private $connexion;
    private $table = "client";

    // object properties
    public $id;
    public $name;
    public $logo;

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
    public function lire(){
        // On écrit la requête
        //$sql="SELECT * FROM . $this->table . WHERE id = :id";
        $sql= "SELECT * FROM client";

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On exécute la requête
        $query->execute();

        // On retourne le résultat
        return $query;
    }

    /**
     * Créer un produit
     *
     * @return void
     */
    public function creer(){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO " . $this->table . " SET name=:name, logo=:logo, accueil=:accueil, accueil_label=:accueil_label, vv3=:vv3, vv3_label=:vv3_label, vg=:vg, vg_label=:vg_label, v360=:v360, v360_label=:v360_label";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->logo=htmlspecialchars(strip_tags($this->logo));
        $this->accueil=htmlspecialchars(strip_tags($this->accueil));
        $this->accueil_label=htmlspecialchars(strip_tags($this->accueil_label));
        $this->vv3=htmlspecialchars(strip_tags($this->vv3));
        $this->vv3_label=htmlspecialchars(strip_tags($this->vv3_label));
        $this->vg=htmlspecialchars(strip_tags($this->vg));
        $this->vg_label=htmlspecialchars(strip_tags($this->vg_label));
        $this->v360=htmlspecialchars(strip_tags($this->v360));
        $this->v360_label=htmlspecialchars(strip_tags($this->v360_label));

        // Ajout des données protégées
        $query->bindParam(":name", $this->name);
        $query->bindParam(":logo", $this->logo);
        $query->bindParam(":accueil", $this->accueil);
        $query->bindParam(":accueil_label", $this->accueil_label);
        $query->bindParam(":vv3", $this->vv3);
        $query->bindParam(":vv3_label", $this->vv3_label);
        $query->bindParam(":vg", $this->vg);
        $query->bindParam(":vg_label", $this->vg_label);
        $query->bindParam(":v360", $this->v360);
        $query->bindParam(":v360_label", $this->v360_label);

        // Exécution de la requête
        if($query->execute()){
            return true;
        }
        return false;
    }

    /**
     * Lire un client
     *
     * @return void
     */
    public function lireUn(){
        // On écrit la requête
        //$sql = "SELECT c.nom as categories_nom, p.id, p.nom, p.description, p.prix, p.categories_id, p.created_at FROM " . $this->table . " p LEFT JOIN categories c ON p.categories_id = c.id WHERE p.id = ? LIMIT 0,1";
        //die($this->id);
        $sql = "SELECT * FROM " . $this->table . " WHERE id = ?";



        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On attache l'id
        $query->bindParam(1, $this->id);

        // On exécute la requête
        $query->execute();

        // on récupère la ligne
        $row = $query->fetch(PDO::FETCH_ASSOC);


        // On hydrate l'objet
        $this->name = $row['name'];
        $this->logo = $row['logo'];
        $this->accueil = $row['accueil'];
        $this->accueil_label = $row['accueil_label'];
        $this->vv3 = $row['vv3'];
        $this->vv3_label = $row['vv3_label'];
        $this->vg = $row['vg'];
        $this->vg_label = $row['vg_label'];
        $this->v360 = $row['v360'];
        $this->v360_label = $row['v360_label'];

    }

    /**
     * Supprimer un produit
     *
     * @return void
     */
    public function supprimer(){
        // On écrit la requête
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On sécurise les données
        $this->id=htmlspecialchars(strip_tags($this->id));

        // On attache l'id
        $query->bindParam(1, $this->id);

        // On exécute la requête
        if($query->execute()){
            return true;
        }

        return false;
    }

    /**
     * Mettre à jour un produit
     *
     * @return void
     */
    public function modifier(){
        // On écrit la requête
        $sql = "UPDATE " . $this->table . "SET name = :name, logo = :logo WHERE id = :id";

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On sécurise les données
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->logo=htmlspecialchars(strip_tags($this->logo));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // On attache les variables
        $query->bindParam(':name', $this->name);
        $query->bindParam(':logo', $this->logo);
        $query->bindParam(':id', $this->id);

        // On exécute
        if($query->execute()){
            return true;
        }

        return false;
    }

}
