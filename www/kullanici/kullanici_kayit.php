<html>

<head>
    <title>Kayıt Ol - Kullanıcı</title>
    <style>
        body{
            background: url(../images/back.jpeg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        .container {
            font-family: helvetica, arial, serif;
            margin: 0 auto;
            width: 65%;
        }

        .giris {
            border: 1px solid #41d6c3;
            margin: 180px auto 0 auto;
            width: 615px;
            text-align: center;
            background: #41d6c3;
        }

        .textbox_div {
            margin: 0 auto;
            width: 585px;
            border: 1px solid #fff;
            padding: 15px
        }

        .btn_giris_div {
            margin: 0 auto;
            width: 585px;
            border: 1px solid #fff;
            padding: 15px
        }

        .btn_giris {
            width: 100%;
            height: 38px;
            background: #41d6c3;
            border: 1px solid #41d6c3;
            font-weight: bold;
            cursor: pointer;
        }

        .txt {
            width: 585px;
            height: 34px
        }

        .a_kaydol_div{
            margin: 0 auto;
            width: 585px;
            border: 1px solid #fff;
            padding: 15px
        }
        .a_kaydol{
            display: block;
            text-align: center;
            color: black;
            text-decoration: none;
            width: 100%;
            padding-top: 10px;
            height: 28px;
            background: #41d6c3;
            border: 1px solid #41d6c3;
            font-weight: bold;
        }
    </style>
</head>


<body>
    <div class="container">
        <form action="kullanici_kayit_kontrol.php" accept-charset="utf-8" method="post" enctype="multipart/form-data">
            <div class="giris">
                <h2>Kayıt Ol - Kullanıcı</h2>
            </div>

            <div>
                <div class="textbox_div">
                    <label class="lbl" for="k_adi"><b>Kullanıcı Adı:</b></label><br>
                    <input class="txt" type="text" name="k_adi" autocomplete="off" required>
                </div>

                <div class="textbox_div">
                    <label class="lbl" for="adi"><b>Adı:</b></label><br>
                    <input class="txt" type="text" name="adi" autocomplete="off" required>
                </div>

                <div class="textbox_div">
                    <label class="lbl" for="soyadi"><b>Soyadı:</b></label><br>
                    <input class="txt" type="text" name="soyadi" autocomplete="off" required>
                </div>

                <div class="textbox_div">
                    <label class="lbl" for="eposta"><b>E-Posta:</b></label><br>
                    <input class="txt" type="email" name="eposta" autocomplete="off" multiple required>
                </div>

                <div class="textbox_div">
                    <label class="lbl" for="sifre"><b>Şifre:</b></label><br>
                    <input class="txt" type="password" name="sifre" required>
                </div>

                <div class="textbox_div">
                    <label class="lbl" for="resim"><b>Profil Resmi Yükle:</b></label><br>
                    <input class="txt" type="file" name="resim" required>
                </div>

                <div class="btn_giris_div">
                    <button class="btn_giris" type="submit" name="upload">Kaydol</button>
                </div>
                <div class="a_kaydol_div">
                    <a class="a_kaydol" href="kullanici_giris.php">Giriş</a>
                </div>
                <div class="textbox_div">
                    <?php
                    session_start();
                    if(isset($_SESSION['mesaj']) )
                    {
                        echo "<h2>". $_SESSION['mesaj'] ."</h2>";
                        session_destroy();
                    }
                    ?>
                </div>
            </div>
        </form>
        <div style="width:65%; margin: 0 auto">
            <label><a href="../index.php">Geri Dön</a></label> 
        </div>
    </div>
</body>

</html>