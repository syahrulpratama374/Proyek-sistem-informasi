<?php
$DB_NAME = "psi_naspad";
$DB_USER = "root";
$DB_PASS = "";
$DB_SERVER_LOC = "localhost";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = mysqli_connect($DB_SERVER_LOC, $DB_USER, $DB_PASS, $DB_NAME);
    $mode = $_POST['mode']; 
    $respon = array(); $respon['kode'] = '000';
    
    switch($mode) {
        case "insert":
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $kategori = $_POST['kategori'];
            $deskripsi = $_POST['deskripsi']; 
            $imstr = $_POST['image']; 
            $file = $_POST['file']; 
            
            
            $path = "../../storage/app/public/menu_foto/"; 
            
            
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            $foto_db = "menu_foto/" . $file;

            if($imstr == "") {
                $sql = "INSERT INTO menus (nama_menu, harga, kategori, deskripsi, created_at) 
                        VALUES ('$nama', '$harga', '$kategori', '$deskripsi', NOW())";
            } else {
                $sql = "INSERT INTO menus (nama_menu, harga, kategori, deskripsi, foto, created_at) 
                        VALUES ('$nama', '$harga', '$kategori', '$deskripsi', '$foto_db', NOW())";
            }

            if(mysqli_query($conn, $sql)) {
                if($imstr != "") file_put_contents($path.$file, base64_decode($imstr));
                echo json_encode($respon);
            } else {
                $respon['kode'] = "111";
                echo json_encode($respon);
            }
            break;

        case "update":
            $id = $_POST['id'];
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $kategori = $_POST['kategori'];
            $deskripsi = $_POST['deskripsi'];
            $imstr = $_POST['image'];
            $file = $_POST['file'];
            
            $path = "../../storage/app/public/menu_foto/";
            $foto_db = "menu_foto/" . $file;

            if($imstr == "") {
                $sql = "UPDATE menus SET nama_menu='$nama', harga='$harga', kategori='$kategori', deskripsi='$deskripsi', updated_at=NOW() WHERE id='$id'";
            } else {
                file_put_contents($path.$file, base64_decode($imstr));
                $sql = "UPDATE menus SET nama_menu='$nama', harga='$harga', kategori='$kategori', deskripsi='$deskripsi', foto='$foto_db', updated_at=NOW() WHERE id='$id'";
            }
            
            if(mysqli_query($conn, $sql)) echo json_encode($respon);
            else { $respon['kode'] = "111"; echo json_encode($respon); }
            break;

        case "delete":
            $id = $_POST['id'];
            $sql = "DELETE FROM menus WHERE id='$id'";
            if(mysqli_query($conn, $sql)) echo json_encode($respon);
            else { $respon['kode'] = "111"; echo json_encode($respon); }
            break;
    }
}
?>