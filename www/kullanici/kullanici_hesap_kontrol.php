<?php
require_once('../connection.php');
$conn = getConnection();
mysqli_set_charset($conn, 'utf8');

session_start();
$id = $_SESSION['kullanici_id'];
$file = 9;

if ($_POST) {
    $islem = $_POST["islem"];
    
    if ($islem == '1') {
        $k_adi = $_POST["k_adi"];
        $adi = $_POST["adi"];
        $soyadi = $_POST["soyadi"];
        $sifre = $_POST["sifre"];

        $query = "UPDATE kullanicilar SET k_adi='" . $k_adi . "', adi='" . $adi . "', soyadi='" . $soyadi . "', sifre='" . $sifre . "' WHERE id='" . $id . "'";
        if ($result = $conn->query($query)) {
            $_SESSION['kullanici_guncelleme_mesaj'] = "Hesap Güncellendi";
            header("Location: kullanici_hesap_sayfa.php");
        }
    } else if ($islem == '2') {
        
        $query = "SELECT resim FROM kullanicilar WHERE id='". $id ."'";
        if ($result = $conn->query($query)) {
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
                    if ($file_error === 0) {
                        if ($file_size <= 2097152) {
                            $hedef_klasor = "../images/" . $file_name_yeni;
                            move_uploaded_file($file_tmp, $hedef_klasor);
                            $file = 1;
                        } else {
                            session_start();
                            $_SESSION['kullanici_guncelleme_mesaj'] = 'En fazla 2 MB boyutunda resim yükleyebilirsiniz.';
    
                            header("Location: kullanici_hesap_sayfa.php");
                        }
                    } else {
                        session_start();
                        $_SESSION['kullanici_guncelleme_mesaj'] = 'Resim yüklenemedi.';
    
                        header("Location: kullanici_hesap_sayfa.php");
                    }
                } else {
                    session_start();
                    $_SESSION['kullanici_guncelleme_mesaj'] = 'Lütfen ".jpg" ya da ".png" uzantılı bir dosya yükleyin.';
    
                    header("Location: kullanici_hesap_sayfa.php");
                }
            }

            if($file == 1){
                $row = mysqli_fetch_assoc($result);
                if($row['resim'] != ""){
                    if (!unlink($row['resim'])){
                    }
                }

                $query = "UPDATE kullanicilar SET resim='" .  $hedef_klasor . "' WHERE id='" . $id . "'";
                if ($result = $conn->query($query)) {
                    $_SESSION['kullanici_guncelleme_mesaj'] = "Resim Güncellendi";
                    header("Location: kullanici_hesap_sayfa.php");
                }
            }
        }
    }
}
