<!-- <?php 
$mysqli = new mysqli(
    "localhost",
    "root",
    "root",
    "impakt360"
);

if ($mysqli->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$client_result = $mysqli->query("SELECT * FROM client WHERE id = 1");

$client_info = $client_result->fetch_assoc();

$view_client1 = $mysqli->query("SELECT * FROM view WHERE client_id = 1");

// echo '<pre>' . var_dump($client_info->fetch_assoc()) . '</pre>';
// echo '<pre>' . var_dump($view_client1) . '</pre>';

$client_info["views"] = [];



for ($row_no = $view_client1->num_rows - 1; $row_no >= 0; $row_no--) {
    $view_client1->data_seek($row_no);
    $row = $view_client1->fetch_assoc();
    $client_info["views"][] = $row;
}

header('Content-type: application/json');
echo json_encode( $client_info );

?>
 -->
