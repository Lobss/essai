<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(200);
  exit;
}
// On vérifie la méthode
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/index.php';
    include_once '../table/clients.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les produits
    $client = new Clients($db);

    // On récupère les informations envoyées
    $donnees = json_decode(file_get_contents("php://input"));



    if(!empty($donnees->name)){
        // Ici on a reçu les données
        // On hydrate notre objet
        $client->name = $donnees->name;
        $client->logo = $donnees->logo;
        $client->accueil = $donnees->accueil;
        $client->accueil_label = $donnees->accueil_label;
        $client->vv3 = $donnees->vv3;
        $client->vv3_label = $donnees->vv3_label;
        $client->vg = $donnees->vg;
        $client->vg_label = $donnees->vg_label;
        $client->v360 = $donnees->v360;
        $client->v360_label = $donnees->v360_label;

        var_dump($donnees);

        if($client->creer()){
            // Ici la création a fonctionné
            // On envoie un code 201
            http_response_code(201);
            echo json_encode(["message" => "L'ajout a été effectué"]);
        }else{
            // Ici la création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(["message" => "L'ajout n'a pas été effectué"]);

        }
    }
}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
