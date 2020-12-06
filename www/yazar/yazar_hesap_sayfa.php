<?php
session_start();
$id = $_SESSION['kullanici_id'];

if ($_SESSION['yetki'] != '2') {
    header("Location: yazar_giris.php");
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
    <title>Hesabım - Yazar</title>
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
            width: 65%;
            margin: 100px auto;
        }

        .div_title {
            background: #41d6c3;
            padding: 5px;
        }

        .div_txt {
            margin: 0;
            width: 100%;
            padding-top: 15px;
            padding-bottom: 15px;  
        }

        .lbl {
            font-size: 16px;
        }

        .txt {
            border: 1px solid black;
            width: 100%;
            height: 35px;
        }

        .btn_giris_div {
            margin: 0;
            width: 100%;
            border: 1px solid #fff;
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .btn_giris {
            width: 100%;
            height: 38px;
            background: #41d6c3;
            border: 1px solid #41d6c3;
            font-weight: bold;
            cursor: pointer;
        }

        .form_left{
            width: 65%;
            float: left;
        }

        .div_right{
            float: left;
            width: 34.5%;
            
        }

        .img_div{
            width: 70%;
            margin: 5px auto;
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
                echo '<h2>' . $k_adi . ' | <a href="yazar_hesap_sayfa.php">Hesabım</a></h2>';
                ?>
            </div>
            <div class="header-right">
                <nav>
                    <a href="yazar_sayfa.php">Anasayfa</a>
                    <a href="yazar_sayfa.php">Yazılarım</a>
                    <a href="yazar_yazilar_sayfa.php">Yazılar</a>
                    <a href="yazar_yazi_olustur.php">Yazı Oluştur</a>
                    <a href="cikis.php">Çıkış</a>
                </nav>
            </div>
        </div>
    </header>

    <div class="content">
        <div class="div_title">
            <h2 style="font-size:20px; font-weight:bold">Hesabım</h2><br><br><br>
        </div>
            <form action="yazar_hesap_kontrol.php" class="form_left" accept-charset="utf-8" method="post">
                <input type="hidden" name="islem" value="1">
                <div class="div_txt">
                    <label class="lbl" for="k_adi"><b>Kullanıcı Adı:</b></label><br>
                    <input class="txt" type="text" name="k_adi" autocomplete="off" required>
                </div>

                <div class="div_txt">
                    <label class="lbl" for="adi"><b>Adı:</b></label><br>
                    <input class="txt" type="text" name="adi" autocomplete="off" required>
                </div>

                <div class="div_txt">
                    <label class="lbl" for="soyadi"><b>Soyadı:</b></label><br>
                    <input class="txt" type="text" name="soyadi" autocomplete="off" required>
                </div>

                <div class="div_txt">
                    <label class="lbl" for="sifre"><b>Şifre:</b></label><br>
                    <input class="txt" type="password" name="sifre" autocomplete="off" required>
                </div>
                <div class="btn_giris_div">
                    <button class="btn_giris" type="submit">Güncelle</button>
                </div>
            </form>
        <div class="div_right">
            <div class="img_div">
            <?php 
            if ($profil_resim != null && $profil_resim != "") {
                    echo '<img src="../' . $profil_resim . '" style="border-bottom:1px solid black; margin-bottom:5px" width="100%">';
                } else {
                    echo '<img src="../images/image_profil.png" style="border-bottom:1px solid black; margin-bottom:5px" width="100%">';
                } ?>

                <form action="yazar_hesap_kontrol.php" accept-charset="utf-8" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="islem" value="2">
                    <input type="file" name="resim" style="margin-top:5px; margin-bottom:5px;" required>
                    <button class="btn_giris" type="submit">Değiştir</button>
                </form>
            </div>
        </div>
        <h1 style="clear:both">
            <?php
            if(isset($_SESSION['yazar_guncelleme_mesaj'])){
                echo $_SESSION['yazar_guncelleme_mesaj'];
                $_SESSION['yazar_guncelleme_mesaj'] = null;
            }
            ?>
        </h1>
    </div>
</body>

</html>