<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
require_once('../connection.php');
$conn = getConnection();
mysqli_set_charset($conn, 'utf8');

$ex = explode("-", $_POST["id"]);

$id = $ex[0];
$sayfa = $ex[1];
$yeni_yetki = $_POST["yetki"];


$query = "UPDATE kullanicilar SET yetki='". $yeni_yetki ."' WHERE id='" . $id . "'";
if ($result = $conn->query($query)) {
    if($sayfa == 1)
    {
        header("Location: admin_sayfa.php");
    }
    else if($sayfa == 2){
        header("Location: admin_yazarlar_sayfa.php");
    }
    else{
        header("Location: admin_kullanicilar_sayfa.php");
    }
    
}
mysqli_close($conn);

