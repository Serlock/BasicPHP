<html>

<head>
    <title>Giriş Yap</title>
    <style>
        .container {
            font-family: helvetica, arial, serif;
            margin: 0 auto;
            width: 65%;
        }

        .giris {
            border: 1px solid #41d6c3;
            margin: 180px auto 15px auto;
            width: 615px;
            text-align: center;
            background: #41d6c3;
        }

        .div_giris {
            margin: 0 auto;
            width: 585px;
            border: 1px solid #fff;
            padding: 15px
        }

        .link{
            display: block;
            text-align: center;
            padding-top: 15px;
            height: 28px;
            background: #41d6c3;
            color: black;
            font-weight: bold;
            font-size: 16px;
            text-decoration: none;
            opacity: 0.7;
        }
        .link:hover{
            opacity: 1;
        }

        body{
            background: url(images/back.jpeg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

    </style>
</head>


<body>
    <div class="container">
        <form action="admin_giris_kontrol.php" accept-charset="utf-8" method="post">
            <div class="giris">
                <h2>Giriş Yap</h2>
            </div>

            <div>
                <div class="div_giris">
                    <a href="admin/admin_giris.php" class="link">Admin Girişi</a>
                </div>

                <div class="div_giris">
                    <a href="yazar/yazar_giris.php" class="link">Yazar Girişi</a>
                </div>

                <div class="div_giris">
                    <a href="kullanici/kullanici_giris.php" class="link">Kullanıcı Girişi</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>