<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
session_start();
$id = $_SESSION['kullanici_id'];
if ($_SESSION['yetki'] != '3') {
    header("Location: yazar_giris.php", true, 301);
}

require_once('../connection.php');
$conn = getConnection();
mysqli_set_charset($conn, 'utf8');

$query = "SELECT * FROM kullanicilar WHERE id='" . $id . "'";
if ($result = $conn->query($query)) {
    $row = mysqli_fetch_assoc($result);

    if ($row > 0) {
        $k_adi = $row['k_adi'];
        $profil_resim = $row['resim'];
    }
}
?>

<html>

<head>
    <meta name="viewport" content="width=device-width">
    <title>Ana Sayfa</title>
    <style>
        body {
            width: 65%;
            margin: 0 auto;
            background: url(../images/back.jpeg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        * {
            margin: 0;
            padding: 0;
            border: none;
        }

        html {
            font-family: Helvetica, arial, sans-serif;
            font-size: 12px;
        }

        .clearfix:before,
        .clearfix:after {
            display: table;
            line-height: 0;
            content: "";
        }

        .clearfix:after {
            clear: both;
        }

        .container {
            width: 98%;
            margin: 0 auto;
        }

        header {
            width: 100%;
            height: auto;
            background: #41d6c3;
        }

        .header-left,
        .header-right {
            position: relative;
            color: black;
            float: left;
        }

        .header-left {
            width: 30%;
        }

        .header-right label {
            position: absolute;
            right: 0;
            cursor: pointer;
        }

        .header-right span {
            position: relative;
            background: rgba(255, 255, 255, .3);
        }

        .header-right span:hover {
            background: rgba(255, 255, 255, .6);
        }

        .header-right {
            width: 70%;
            text-align: right;
        }

        h2 {
            font-weight: 300;
            line-height: 40px;
            float: left;
        }

        #img_profil {
            width: 25px;
            height: 25px;
            float: left;
            margin-top: 6px;
            margin-right: 4px;
        }

        a {
            text-decoration: none;
            color: black;
        }

        nav>a {
            position: relative;
            display: inline-block;
            font-size: 13px;
            line-height: 40px;
            padding: 0 2em;
        }

        nav>a:hover {
            background: rgba(255, 255, 255, .9);
            color: black;
        }

        .content {
            margin-top: 100px;
        }

        table {
            width: 100%;
            max-height: 10px;
            border-bottom: 1px solid black;
        }

        thead .tr_table {
            height: 50px;
            background: #41d6c3;
            border: 1px solid #41d6c3;
        }

        .td_table {
            padding: 3px;
            height: 80px;
        }

        .tr_table:hover {
            background: #41d6c3;
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div class="container">
            <div class="header-left">
                <?php
                if ($profil_resim != null && $profil_resim != "") {
                    echo '<img id="img_profil" src="../' . $profil_resim . '">';
                } else {
                    echo '<img id="img_profil" src="../images/image_profil.png">';
                }
                echo '<h2>' . $k_adi . ' | <a href="kullanici_hesap_sayfa.php">Hesabım</a></h2>';
                ?>
            </div>
            <div class="header-right">
                <nav>
                    <a href="kullanici_sayfa.php">Anasayfa</a>
                    <a href="kullanici_sayfa.php">Yazılar</a>
                    <a href="cikis.php">Çıkış</a>
                </nav>
            </div>
        </div>
    </header>

    <div class="content">
        <label style="font-size:16px">Yazılar | </label>

        <?php

        $q = "SELECT * FROM yazilar";

        echo $table_first = "<table>
        <thead>
            <tr class='tr_table'>
                <th>ID</th>
                <th>Başlık</th>
                <th>İçerik</th>
                <th>Sayfa Sayısı</th>
                <th>Tarih</th>
                <th>Kullanıcı Id</th>
            </tr>
        </thead>
        <tbody>";

        if ($kullanicilar = $conn->query(($q))) {
            while ($row = mysqli_fetch_array($kullanicilar)) {
                $kitap_id = $row["id"];
                $baslik = $row["baslik"];
                $icerik = $row["icerik"];
                $sayfa_sayisi = $row["sayfa_sayisi"];
                $tarih = $row["tarih"];
                $kullanici_id = $row["kullanici_id"];
                
                $eski_tarih = strtotime($tarih);  
                $yeni_tarih = strtotime(date('Y-m-d H:i:s'));  

                $fark = abs($eski_tarih - $yeni_tarih);  
                $yil = floor($fark / (365 * 60 * 60 * 24));
                $ay = floor(($fark - $yil * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $gun = floor(($fark - $yil * 365 * 60 * 60 * 24 - $ay * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                $saat = floor(($fark - $yil * 365 * 60 * 60 * 24 - $ay * 30 * 60 * 60 * 24 - $gun * 60 * 60 * 24) / (60 * 60));
                $dakika = floor(($fark - $yil * 365 * 60 * 60 * 24 - $ay * 30 * 60 * 60 * 24 - $gun * 60 * 60 * 24 - $saat * 60 * 60) / 60);
                $saniye = floor(($fark - $yil * 365 * 60 * 60 * 24 - $ay * 30 * 60 * 60 * 24 - $gun * 60 * 60 * 24 - $saat * 60 * 60 - $dakika * 60));

                echo $table_second =
                    "<tr class='tr_table'>
                    <td class='td_table'> $kitap_id </td>
                    <td class='td_table'> $baslik </td>
                    <td class='td_table'><a href='$icerik'>İçeriği Görmek İçin Tıklayın</a></td>
                    <td class='td_table'> $sayfa_sayisi </td>
                    <td class='td_table'>". $gun . " Gün " . $saat . " Saat " . $dakika . " Dakika " . $saniye . " Saniye " ."Önce</td>
                    <td class='td_table'> $kullanici_id</td>
                    
                    </tr>";
                $array[] = $table_second;
            }
        }

        echo $table_third = "</tbody></table>";
        ?>

    </div>
</body>

</html>