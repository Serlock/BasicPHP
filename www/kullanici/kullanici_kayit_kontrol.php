<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
require_once('../connection.php');
$conn = getConnection();
mysqli_set_charset($conn, 'utf8');

if ($_POST) {
    $kayit_k_adi = $_POST["k_adi"];
    $kayit_adi = $_POST["adi"];
    $kayit_soyadi = $_POST["soyadi"];
    $kayit_eposta = $_POST["eposta"];
    $kayit_sifre = $_POST["sifre"];
    $kayit_resim = $_FILES["resim"];

    $hata = "";
    if (strpos($kayit_eposta, 'gmail') == false) {
        $hata = 'E-Posta adresi geçersiz. Lütfen bir "gmail" hesabı giriniz.';
        session_start();
        $_SESSION['mesaj'] = $hata;
        header("Location: kullanici_kayit.php");
    }
    if ($hata == "") {
        $query = "SELECT * FROM kullanicilar WHERE k_adi='" . $kayit_k_adi . "'";
        $file = 9;

        if ($result = $conn->query($query)) {
            $row = mysqli_fetch_assoc($result);

            if ($row > 0) {
                session_start();
                $_SESSION['mesaj'] = "Bu kullanıcı adı mevcut. Lütfen başka bir kullanıcı adı seçiniz.";

                $result->close();
                header("Location: kullanici_kayit.php", true, 301);
            } else {
                if (isset($_FILES["resim"])) {
                    $resim = $_FILES['resim'];

                    $file_name = $resim['name'];
                    $file_size = $resim['size'];
                    $file_tmp = $resim['tmp_name'];
                    $file_error = $resim['error'];

                    $file_ext = explode('.', $file_name);
                    $file_ext = strtolower(end($file_ext));

                    $izin = array('jpg', 'png');

                    $file_name_yeni = "kullanici-" . uniqid('', true) . '.' . $file_ext;

                    if (in_array($file_ext, $izin)) {
                        echo "girdi";
                        if ($file_error === 0) {
                            if ($file_size <= 2097152) {
                                $hedef_klasor = "../images/" . $file_name_yeni;
                                move_uploaded_file($file_tmp, $hedef_klasor);
                                $file = 1;
                            } else {
                                session_start();
                                $_SESSION['mesaj'] = 'En fazla 2 MB boyutunda resim yükleyebilirsiniz.';

                                header("Location: kullanici_kayit.php", true, 301);
                            }
                        } else {
                            session_start();
                            $_SESSION['mesaj'] = 'Resim yüklenemedi.';

                            header("Location: kullanici_kayit.php", true, 301);
                        }
                    } else {
                        session_start();
                        $_SESSION['mesaj'] = 'Lütfen ".jpg" ya da ".png" uzantılı bir dosya yükleyin.';

                        header("Location: kullanici_kayit.php", true, 301);
                    }
                }

                if ($file == 1) {
                    $sql = "INSERT INTO kullanicilar (k_adi, adi, soyadi, eposta, sifre, resim, yetki) VALUES ('$kayit_k_adi', '$kayit_adi', '$kayit_soyadi', '$kayit_eposta', '$kayit_sifre', '$hedef_klasor', '3')";
                    if (mysqli_query($conn, $sql)) {
                        session_start();
                        $_SESSION['mesaj'] = 'Kayıt başarılı. Giriş yababilirsiniz. ';

                        header("Location: kullanici_giris.php", true, 301);
                    } else {
                        session_start();
                        $_SESSION['mesaj'] = 'Kayıt yapılamadı.';

                        header("Location: kullanici_kayit.php", true, 301);
                    }
                }

                // Close connection
                mysqli_close($conn);
            }
        }
    }
}
