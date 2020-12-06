<?php
require_once('../connection.php');
$conn = getConnection();
mysqli_set_charset($conn, 'utf8');

session_start();
$id = $_SESSION['kullanici_id'];
$file = 9;

if ($_POST) {
    $baslik = $_POST["baslik"];
    $sayfa = $_POST["sayfa"];
    $tarih = date('Y-m-d H:i:s');

    if (isset($_FILES["icerik"])) {
        $icerik = $_FILES['icerik'];

        $file_name = $icerik['name'];
        $file_size = $icerik['size'];
        $file_tmp = $icerik['tmp_name'];
        $file_error = $icerik['error'];

        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        $izin = array('txt', 'docx', 'pdf');

        $file_name_yeni = $id . "-yazi-" . uniqid('', true) . '.' . $file_ext;

        if (in_array($file_ext, $izin)) {
            if ($file_error === 0) {
                if ($file_size <= 20971520) {
                    $hedef_klasor = "../contents/" . $file_name_yeni;
                    move_uploaded_file($file_tmp, $hedef_klasor);
                    $file = 1;
                } else {
                    session_start();
                    $_SESSION['yazar_olustur_mesaj'] = 'En fazla 20 MB boyutunda icerik yükleyebilirsiniz.';

                    header("Location: yazar_yazi_olustur.php", true, 301);
                }
            } else {
                session_start();
                $_SESSION['yazar_olustur_mesaj'] = 'icerik yüklenemedi.';

                header("Location: yazar_yazi_olustur.php", true, 301);
            }
        } else {
            session_start();
            $_SESSION['yazar_olustur_mesaj'] = 'Lütfen ".txt", ".pdf" ya da ".docx" uzantılı bir dosya yükleyin.';
            header("Location: yazar_yazi_olustur.php", true, 301);
        }
    } else {
        session_start();
        $_SESSION['yazar_olustur_mesaj'] = 'Yazı Oluşturulamadı.';

        header("Location: yazar_yazi_olustur.php", true, 301);
    }

    if ($file == 1) {
        $query = "INSERT INTO yazilar (baslik, icerik, sayfa_sayisi, tarih, kullanici_id) VALUES ('" . $baslik . "', '" . $hedef_klasor . "', '" . $sayfa . "', '" . $tarih . "', '" . $id . "')";
        if ($result = $conn->query($query)) {
            session_start();
            $_SESSION['yazar_olustur_mesaj'] = 'Yazı Oluşturuldu.';

            header("Location: yazar_yazi_olustur.php", true, 301);
        } else {
            echo mysqli_error($conn);
        }
    }
    else {
        echo "olmadı";
    }
}
