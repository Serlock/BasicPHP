<?php
session_start();
$id = $_SESSION['admin_id'];

if ($_SESSION['yetki'] != '1') {
    header("Location: admin_giris.php", true, 301);
}

require_once('../connection.php');
$conn = getConnection();
mysqli_set_charset($conn, 'utf8');

$query = "SELECT * FROM admin WHERE id='" . $id . "'";
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
    <title>Kullanıcılar</title>
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
                echo '<h2>' . $k_adi . ' | <a href="admin_hesap_sayfa.php">Hesabım</a></h2>';
                ?>
            </div>
            <div class="header-right">
                <nav>
                    <a href="admin_sayfa.php">Anasayfa</a>
                    <a href="admin_yazarlar_sayfa.php">Yazarlar</a>
                    <a href="admin_kullanicilar_sayfa.php">Kullanıcılar</a>
                    <a href="admin_yazilar.php">Yazılar</a>
                    <a href="cikis.php">Çıkış</a>
                </nav>
            </div>
        </div>
    </header>

    <div class="content">
        <label style="font-size:16px">Kullanıcılar | </label>

        <?php

        $q = "SELECT * FROM kullanicilar WHERE yetki = 3";

        echo $table_first = "<table>
        <thead>
            <tr class='tr_table'>
                <th>ID</th>
                <th>Kullanıcı Adı</th>
                <th>Adı</th>
                <th>Soyadı</th>
                <th>E Posta</th>
                <th>Yetki</th>
                <th>Resim</th>
            </tr>
        </thead>
        <tbody>";

        if ($kullanicilar = $conn->query(($q))) {
            while ($row = mysqli_fetch_array($kullanicilar)) {
                $k_id = $row["id"];
                $k_adi = $row["k_adi"];
                $adi = $row["adi"];
                $soyadi = $row["soyadi"];
                $eposta = $row["eposta"];
                $k_resim = $row["resim"];
                $yetki = $row["yetki"];
                if ($yetki == 2) {
                    $yetki = "Yazar";
                } else if ($yetki == 3) {
                    $yetki = "Kullanıcı";
                }

                echo $table_second =
                    "<tr class='tr_table'>
                    <td class='td_table'> $k_id </td>
                    <td class='td_table'> $k_adi </td>
                    <td class='td_table'> $adi </td>
                    <td class='td_table'> $soyadi </td>
                    <td class='td_table'> $eposta </td>
                    <td class='td_table'> $yetki - 
                        <form action='yetki_degistir.php' method='post'><label style='font-size:16px; font-weight:bold; margin:5px 0'>Yetki Değiştir:</label>
                            <select name='yetki' style='width:80px; height:30px' required>
                                <option value='' hidden>Yetki Seç</option>
                                <option value='2'>Yazar</option>
                                <option value='3'>Kullanıcı</option>
                            </select>
                            <input type='hidden' name='id' value='$k_id-3'>
                            <input type='submit' value='Değiştir' style='height:35px; width:75px; cursor:pointer; font-weight:bold'>
                        </form>
                    </td>
                    <td class='td_table'><img src='$k_resim' width='75'></td>
                    <td class='td_table'><a href='kullanici_sil.php?id=$k_id-3' style='text-decoration:underline'>Kullanıcıyı Sil</a></td>
                    </tr>";
                $array[] = $table_second;
            }
        }

        echo $table_third = "</tbody></table>";
        ?>

    </div>
</body>

</html>