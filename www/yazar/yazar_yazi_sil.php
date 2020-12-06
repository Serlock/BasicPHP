<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
require_once('../connection.php');
$conn = getConnection();
mysqli_set_charset($conn, 'utf8');

$id = $_GET["id"];

$query = "SELECT * FROM yazilar WHERE id='" . $id . "'";
if ($result = $conn->query($query)) {
    $row = mysqli_fetch_assoc($result);

    if ($row > 0) {
        $dosya = $row['icerik'];
    }
}

$sql = "DELETE FROM yazilar WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    if (!unlink($dosya)) { } else {
        
            header("Location: yazar_sayfa.php");
        
    }
}
mysqli_close($conn);
