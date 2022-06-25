/*
SQLyog Ultimate v12.08 (32 bit)
MySQL - 10.1.38-MariaDB : Database - e_klinik
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`e_klinik` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `e_klinik`;

/*Table structure for table `berobat` */

CREATE TABLE `berobat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pasien_id` varchar(50) DEFAULT NULL,
  `tgl_berobat` date DEFAULT NULL,
  `dokter_id` varchar(50) DEFAULT NULL,
  `keluhan` varchar(50) DEFAULT NULL,
  `biaya` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  KEY `no_transaksi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

/*Data for the table `berobat` */

insert  into `berobat`(`id`,`pasien_id`,`tgl_berobat`,`dokter_id`,`keluhan`,`biaya`,`status`) values (38,'49','2022-06-20','3','Sakit Panas demam','20000','Lunas'),(39,'48','2022-06-20','3','Sakit Panas demam','20000','Lunas'),(40,'49','2022-06-20',NULL,'dwada',NULL,'menunggu'),(41,'48','2022-06-20',NULL,'Sakit Panas demam',NULL,'menunggu');

/*Table structure for table `dokter` */

CREATE TABLE `dokter` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nama_dokter` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `dokter` */

insert  into `dokter`(`id`,`nama_dokter`,`no_hp`,`user_id`) values (3,'Deo Abdika1','32324234','accepted');

/*Table structure for table `hpl` */

CREATE TABLE `hpl` (
  `id_hpl` int(11) NOT NULL AUTO_INCREMENT,
  `siklus_haid` varchar(50) DEFAULT NULL,
  `tgl_haid` varchar(50) DEFAULT NULL,
  `pasien_id` varchar(50) DEFAULT NULL,
  `hasil` varchar(50) DEFAULT NULL,
  KEY `id_hpl` (`id_hpl`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `hpl` */

insert  into `hpl`(`id_hpl`,`siklus_haid`,`tgl_haid`,`pasien_id`,`hasil`) values (18,'29','24 June 2022','49','01 April 2023');

/*Table structure for table `pasien` */

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pasien` varchar(50) NOT NULL,
  `tgl_lahir` varchar(20) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `user_id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pasien` */

insert  into `pasien`(`id`,`nama_pasien`,`tgl_lahir`,`alamat`,`user_id`) values (48,'DEO','2022-05-27','Kedanyang','56'),(49,'chumaidi','2022-05-10','Gresik','57');

/*Table structure for table `reservasi` */

CREATE TABLE `reservasi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tgl_reservasi` date NOT NULL,
  `pasien_id` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `reservasi` */

insert  into `reservasi`(`id`,`tgl_reservasi`,`pasien_id`,`status`) values (1,'2022-06-20','49','menunggu'),(2,'2022-06-20','48','menunggu');

/*Table structure for table `user` */

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(10) DEFAULT 'denied',
  `hak_akses` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`status`,`hak_akses`) values (48,'admin','admin','accepted','admin'),(49,'dokter','dokter','accepted','dokter'),(56,'deo','deo','accepted','pasien'),(57,'chum','chum','accepted','pasien');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
