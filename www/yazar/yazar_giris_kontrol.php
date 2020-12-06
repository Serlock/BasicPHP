<?php

if ($_POST) {
    require_once('../connection.php');
    $conn = getConnection();
    mysqli_set_charset($conn, 'utf8');

    $giris_k_adi = $_POST["k_adi"];
    $giris_sifre = $_POST["sifre"];

    $query = "SELECT * FROM kullanicilar WHERE k_adi='" . $giris_k_adi . "' AND sifre= '" . $giris_sifre . "'";
    if ($result = $conn->query($query)) {
        $row = mysqli_fetch_assoc($result);

        if ($row > 0) {
            session_start();
            $_SESSION['kullanici_id'] = $row["id"];
            $_SESSION['yetki'] = $row['yetki'];

            if ($row['yetki'] == '2') {
                $result->close();
                header("Location: yazar_sayfa.php");
            } else if ($row['yetki'] == '3') {
                session_start();
                $_SESSION['mesaj'] = "Kullanıcı adı ya da Şifre Hatalı.";
                header("Location: yazar_giris.php");
            }
        } else {
            $result->close();
            session_start();
            $_SESSION['mesaj'] = "Kullanıcı adı ya da Şifre Hatalı.";

            header("Location: yazar_giris.php");
        }
    }
}
