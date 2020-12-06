<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
require_once('../connection.php');
$conn = getConnection();
mysqli_set_charset($conn, 'utf8');

$ex = explode("-", $_GET["id"]);
$id = $ex[0];
$sayfa = $ex[1];

$query = "SELECT * FROM kullanicilar WHERE id='" . $id . "'";
if ($result = $conn->query($query)) {
    $row = mysqli_fetch_assoc($result);

    if ($row > 0) {
        $profil_resim = $row['resim'];
    }
}

$sql = "DELETE FROM kullanicilar WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    if (!unlink($profil_resim)) { } else {
        if ($sayfa == 1) {
                header("Location: admin_sayfa.php");
            } else if ($sayfa == 2) {
            header("Location: admin_yazarlar_sayfa.php");
        } else {
            header("Location: admin_kullanicilar_sayfa.php");
        }
    }
}
mysqli_close($conn);
