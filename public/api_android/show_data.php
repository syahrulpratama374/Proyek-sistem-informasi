<?php
$DB_NAME = "psi_naspad";
$DB_USER = "root";
$DB_PASS = "";
$DB_SERVER_LOC = "localhost";

$conn = mysqli_connect($DB_SERVER_LOC, $DB_USER, $DB_PASS, $DB_NAME);

$nama = isset($_POST['nama']) ? $_POST['nama'] : "";
$server_ip = $_SERVER['HTTP_HOST']; 

$sql = "SELECT id, nama_menu, harga, deskripsi, kategori, 
        CONCAT('http://$server_ip/PSI(naspad)/public/storage/', foto) as url 
        FROM menus 
        WHERE nama_menu LIKE '%$nama%' AND deleted_at IS NULL";

$result = mysqli_query($conn, $sql);
header("Content-type: application/json; charset=UTF-8");
$data_menu = array();

if($result && mysqli_num_rows($result) > 0){
    while($menu = mysqli_fetch_assoc($result)){
        array_push($data_menu, $menu);
    }
}

echo json_encode($data_menu);
?>