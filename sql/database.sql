CREATE DATABASE `test` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `k_adi` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adi` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `soyadi` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sifre` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resim` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `yetki` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `k_adi` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8_unicode_ci DEFAULT NULL,
  `adi` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8_unicode_ci DEFAULT NULL,
  `soyadi` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8_unicode_ci DEFAULT NULL,
  `eposta` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sifre` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8_unicode_ci DEFAULT NULL,
  `resim` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8_unicode_ci DEFAULT NULL,
  `yetki` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `yazilar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslik` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icerik` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sayfa_sayisi` int(11) DEFAULT NULL,
  `tarih` datetime DEFAULT NULL,
  `kullanici_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



