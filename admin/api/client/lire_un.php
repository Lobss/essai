<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  http_response_code(200);
  exit;
}
// On vérifie que la méthode utilisée est correcte
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On inclut les fichiers de configuration et d'accès aux données
    include_once '../config/index.php';
    include_once '../table/clients.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnection();

    // On instancie les produits
    $client = new Clients($db);


    //die('coucou');


    $client_id = $_GET["clientId"];


    if(!empty($client_id)){
        $client->id = $client_id;

        // On récupère le produit
        $client->lireUn();

        // On vérifie si le produit existe
        if($client->id != null){

            $prod = [
                "id" => $client->id,
                "name" => $client->name,
                "logo" => $client->logo,
                "accueil" => $client->accueil,
                "accueil_label" => $client->accueil_label,
                "vv3" => $client->vv3,
                "vv3_label" => $client->vv3_label,
                "vg" => $client->vg,
                "vg_label" => $client->vg_label,
                "v360" => $client->v360,
                "v360_label" => $client->v360_label,
            ];


            // On envoie le code réponse 200 OK
            http_response_code(200);

            // On encode en json et on envoie
            echo json_encode($prod);
        }else{
            // 404 Not found
            http_response_code(404);

            echo json_encode(array("message" => "Le produit n'existe pas."));
        }

    }
}else{
    // On gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
