<html>

<head>
    <title>Kullanıcı Girişi</title>
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

        .k_adi {
            margin: 0 auto;
            width: 585px;
            border: 1px solid #fff;
            padding: 15px
        }

        .sifre {
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
        <form action="yazar_giris_kontrol.php" method="post">
            <div class="giris">
                <h2>Yazar Girişi</h2>
            </div>

            <div>
                <div class="k_adi">
                    <label class="lbl" for="k_adi"><b>Kullanıcı Adı:</b></label><br>
                    <input class="txt" type="text" name="k_adi" autocomplete="off" required>
                </div>

                <div class="sifre">
                    <label class="lbl" for="sifre"><b>Şifre:</b></label><br>
                    <input class="txt" type="password" name="sifre" required>
                </div>
                <div class="btn_giris_div">
                    <button class="btn_giris" type="submit">Giriş</button>
                </div>
                <div class="a_kaydol_div">
                    <a class="a_kaydol" href="yazar_kayit.php">Kaydol</a>
                </div>
                <div class="k_adi">
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