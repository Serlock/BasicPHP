<?php

if ($_POST) {
    require_once('../connection.php');
    $conn = getConnection();
    mysqli_set_charset($conn, 'utf8');

    $giris_k_adi = $_POST["k_adi"];
    $giris_sifre = $_POST["sifre"];

    $query = "SELECT * FROM admin WHERE k_adi='" . $giris_k_adi . "' AND sifre= '" . $giris_sifre . "'";
    if ($result = $conn->query($query)) {
        $row = mysqli_fetch_assoc($result);

        if ($row > 0) {
            session_start();
            $_SESSION['admin_id'] = $row["id"];
            $_SESSION['yetki'] = $row['yetki'];

            $result->close();
            header("Location: admin_sayfa.php", true, 301);
        } else {
            $result->close();
            session_start();
            $_SESSION['mesaj'] = "Kullanıcı adı ya da Şifre Hatalı.";

            header("Location: admin_giris.php", true, 301);
        }
    }
}
