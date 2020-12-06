<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
session_start();
$id = $_SESSION['kullanici_id'];
if($_SESSION['yetki'] != '2'){
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
    <title>Yazı Oluştur</title>
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

        .content {
            width: 65%;
            margin: 100px auto;
        }

        .div_title {
            background: #41d6c3;
            padding: 5px;
        }

        .div_txt {
            margin: auto;
            width: 65%;
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
            margin: 0 auto;
            width: 65%;
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
            <h2 style="font-size:20px; font-weight:bold">Yazı Oluştur</h2><br><br><br>
        </div>
            <form action="yazar_yazi_kontrol.php" accept-charset="utf-8"enctype="multipart/form-data" method="post">
                <div class="div_txt">
                    <label class="lbl" for="baslik"><b>Başlık:</b></label><br>
                    <input class="txt" type="text" name="baslik" autocomplete="off" required>
                </div>

                <div class="div_txt">
                    <label class="lbl" for="sayfa"><b>Sayfa Sayısı:</b></label><br>
                    <input class="txt" type="number" name="sayfa" autocomplete="off" required>
                </div>

                <div class="div_txt">
                    <label class="lbl" for="icerik"><b>İçerik:</b></label><br>
                    <input class="txt" type="file" name="icerik" autocomplete="off" required>
                </div>
                <div class="btn_giris_div">
                    <button class="btn_giris" type="submit">Oluştur</button>
                </div>
            </form>
        <h1 style="clear:both">
            <?php
            if(isset($_SESSION['yazar_olustur_mesaj'])){
                echo $_SESSION['yazar_olustur_mesaj'];
                $_SESSION['yazar_olustur_mesaj'] = null;
            }
            ?>
        </h1>
    </div>
</body>

</html>