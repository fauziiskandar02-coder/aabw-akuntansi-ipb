-- TiDB & MySQL Dump for aabw
CREATE DATABASE IF NOT EXISTS `aabw`;
USE `aabw`;
SET FOREIGN_KEY_CHECKS = 0;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `user_img` varchar(255) NOT NULL DEFAULT 'avatar-1.png',
  `password_hash` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@aabw.com','admin','Administrator Utama','avatar-1.png','$2y$10$R5WoLDSHTN8UUTTOmxHUeOc7jhnMmYxNkPxOhRhBjMbyg.R/wxRCu',1,'2026-09-23 18:28:41','2026-09-23 18:28:41'),(2,'fauzi@ipb.ac.id','fauzi','Fauzi Iskandar','avatar-1.png','$2y$10$b3ccVRCF0su.o.0qeUUavuCHfYQN5dab5lcMvTW99XEyER95dYaFu',1,'2026-09-23 18:28:41','2026-09-23 18:28:41'),(3,'najwan@gmail.com','najwan','Najwan Pratama','avatar-2.png','$2y$10$44EEU/G6UecWLUSSenx0ienDohpHG29t10UluI28f3kMwuFkDluNu',1,'2026-09-23 18:28:41','2026-09-23 18:28:41');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_groups`
--

DROP TABLE IF EXISTS `auth_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_groups`
--

LOCK TABLES `auth_groups` WRITE;
/*!40000 ALTER TABLE `auth_groups` DISABLE KEYS */;
INSERT INTO `auth_groups` VALUES (1,'admin','Pengelola Sistem'),(2,'user','Pengguna Umum');
/*!40000 ALTER TABLE `auth_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_groups_users`
--

DROP TABLE IF EXISTS `auth_groups_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_groups_users` (
  `group_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  KEY `auth_groups_users_user_id_foreign` (`user_id`),
  KEY `group_id_user_id` (`group_id`,`user_id`),
  CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_groups_users`
--

LOCK TABLES `auth_groups_users` WRITE;
/*!40000 ALTER TABLE `auth_groups_users` DISABLE KEYS */;
INSERT INTO `auth_groups_users` VALUES (1,1),(1,2),(2,3);
/*!40000 ALTER TABLE `auth_groups_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `akun1s`
--

DROP TABLE IF EXISTS `akun1s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `akun1s` (
  `id_akun1` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `kode_akun1` varchar(6) NOT NULL,
  `nama_akun1` varchar(20) NOT NULL,
  PRIMARY KEY (`id_akun1`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akun1s`
--

LOCK TABLES `akun1s` WRITE;
/*!40000 ALTER TABLE `akun1s` DISABLE KEYS */;
INSERT INTO `akun1s` VALUES (1,'1','Aktiva'),(2,'2','Kewajiban'),(3,'3','Modal'),(4,'4','Pendapatan'),(5,'5','Beban');
/*!40000 ALTER TABLE `akun1s` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `akun2s`
--

DROP TABLE IF EXISTS `akun2s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `akun2s` (
  `id_akun2` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `kode_akun2` int(6) unsigned NOT NULL,
  `nama_akun2` varchar(40) NOT NULL,
  `kode_akun1` int(6) unsigned NOT NULL,
  PRIMARY KEY (`id_akun2`),
  KEY `kode_akun1` (`kode_akun1`),
  CONSTRAINT `akun2s_kode_akun1_foreign` FOREIGN KEY (`kode_akun1`) REFERENCES `akun1s` (`id_akun1`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akun2s`
--

LOCK TABLES `akun2s` WRITE;
/*!40000 ALTER TABLE `akun2s` DISABLE KEYS */;
INSERT INTO `akun2s` VALUES (1,11,'Aktiva Lancar ',1),(2,12,'Aktiva Tetap',1),(3,21,'Utang Jangka Pendek',2),(4,22,'Utang Jangka Panjang',2),(5,31,'Modal Pemilik',3),(6,32,'Prive Pemilik',3),(7,41,'Pendapatan Usaha',4),(8,42,'Pendapatan di Luar Usaha',4),(9,51,'Beban Usaha',5),(10,52,'Beban di Luar Usaha',5);
/*!40000 ALTER TABLE `akun2s` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `akun3s`
--

DROP TABLE IF EXISTS `akun3s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `akun3s` (
  `id_akun3` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `kode_akun3` int(6) unsigned NOT NULL,
  `nama_akun3` varchar(70) NOT NULL,
  `kode_akun1` int(6) unsigned NOT NULL,
  `kode_akun2` int(6) unsigned NOT NULL,
  PRIMARY KEY (`id_akun3`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akun3s`
--

LOCK TABLES `akun3s` WRITE;
/*!40000 ALTER TABLE `akun3s` DISABLE KEYS */;
INSERT INTO `akun3s` VALUES (1,1101,'Kas',1,11),(2,1102,'Piutang Usaha',1,11),(3,1103,'Perlengkapan Kantor',1,11),(4,1104,'Sewa Dibayar di muka',1,11),(5,1105,'Asuransi dibayar di muka',1,11),(6,1201,'Peralatan Kantor',1,12),(7,1202,'Akumulasi Penyusutan P. Kantor',1,12),(8,1203,'Tanah',1,12),(9,2101,'Utang Usaha',2,21),(10,2102,'Utang Gaji',2,21),(11,2103,'Pendapatan diterima di muka',2,21),(12,2201,'Utang Hipotek',2,22),(13,2202,'Utang Obligasi',2,22),(14,3101,'Modal Pemilik',3,31),(15,3102,'Modal Lainnya',3,31),(16,3201,'Prive Tuan Najwan',3,32),(17,3202,'Prive Tuan A',3,32),(18,4101,'Pendapatan Jasa',4,41),(19,4102,'Pendapatan diterima di muka',4,41),(20,4201,'Pendapatan diluar usaha',4,42),(21,4202,'Pendapatan lainnya',4,42),(22,5101,'Beban Gaji Karyawan',5,51),(23,5102,'Beban Iklan',5,51),(24,5103,'Beban Asuransi',5,51),(25,5104,'Beban Telepon',5,51),(26,5105,'Beban Listrik',5,51),(27,5106,'Beban Sewa',5,51),(28,5107,'Beban Penyusutan Peralatan Kantor',5,51),(29,5108,'Beban Perlengkapan Kantor',5,51),(30,5201,'Beban Bunga',5,52);
/*!40000 ALTER TABLE `akun3s` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_status`
--

DROP TABLE IF EXISTS `tbl_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_status` (
  `id_status` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_status`
--

LOCK TABLES `tbl_status` WRITE;
/*!40000 ALTER TABLE `tbl_status` DISABLE KEYS */;
INSERT INTO `tbl_status` VALUES (1,'Penerimaan'),(2,'Pengeluaran'),(3,'Investasi Masuk'),(4,'Investasi Keluar'),(5,'Normal');
/*!40000 ALTER TABLE `tbl_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_transaksi`
--

DROP TABLE IF EXISTS `tbl_transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kwitansi` varchar(4) NOT NULL,
  `tanggal` date NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `ketjurnal` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_transaksi`
--

LOCK TABLES `tbl_transaksi` WRITE;
/*!40000 ALTER TABLE `tbl_transaksi` DISABLE KEYS */;
INSERT INTO `tbl_transaksi` VALUES (16,'0001','2025-12-01','Setoran modal awal Pak Najwan berupa uang tunai, perlengkapan kantor, dan peralatan kantor','Setoran Modal Awal','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(17,'0002','2025-12-02','Pembayaran sewa gedung kantor selama 6 bulan tunai','Pembayaran Sewa Gedung','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(18,'0003','2025-12-03','Pembelian peralatan kantor secara kredit dari Toko Furniture','Pembelian Peralatan Kredit','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(19,'0004','2025-12-03','Penerimaan uang muka dari pelanggan untuk jasa akuntansi yang akan diselesaikan','Penerimaan Pendapatan Diterima Dimuka','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(20,'0005','2025-12-05','Pembayaran premi asuransi perlindungan kantor untuk 1 tahun tunai','Pembayaran Asuransi Dibayar Dimuka','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(21,'0006','2025-12-07','Pembayaran beban promosi dan iklan media sosial tunai','Pembayaran Beban Iklan','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(22,'0007','2025-12-08','Pembayaran sebagian utang usaha atas pembelian peralatan tanggal 3 Desember','Pembayaran Sebagian Utang','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(23,'0008','2025-12-10','Penyelesaian jasa pembukuan akuntansi kepada klien secara kredit','Pendapatan Jasa Kredit','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(24,'0009','2025-12-15','Pembayaran gaji staf akuntansi periode tengah bulan Desember tunai','Pembayaran Beban Gaji','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(25,'0010','2025-12-16','Penerimaan pelunasan piutang usaha dari klien atas jasa tanggal 10 Desember','Pelunasan Piutang Usaha','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(26,'0011','2025-12-17','Penyelesaian jasa audit laporan keuangan secara kredit kepada PT Rekanan','Pendapatan Jasa Kredit','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(27,'0012','2025-12-19','Pembelian tambahan perlengkapan operasional kantor tunai','Pembelian Perlengkapan Kantor','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(28,'0013','2025-12-20','Pembayaran tagihan telepon dan internet kantor bulan Desember tunai','Pembayaran Beban Telepon','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(29,'0014','2025-12-20','Pembayaran tagihan listrik PLN kantor bulan Desember tunai','Pembayaran Beban Listrik','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(30,'0015','2025-12-24','Penerimaan pembayaran sebagian piutang atas jasa tgl 17 Desember dari PT Rekanan','Penerimaan Sebagian Piutang','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(31,'0016','2025-12-30','Pembayaran gaji staf akuntansi periode akhir bulan Desember tunai','Pembayaran Beban Gaji','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(32,'0017','2025-12-30','Penerimaan pelunasan sisa piutang dari PT Rekanan atas jasa tgl 17 Desember','Pelunasan Sisa Piutang','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(33,'0018','2025-12-30','Penyelesaian jasa konsultasi perpajakan kepada klien secara kredit','Pendapatan Jasa Kredit','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL),(34,'0019','2025-12-30','Penarikan uang tunai oleh Tuan Najwan untuk keperluan pribadi','Prive Tuan Najwan','2026-09-30 16:30:49','2026-09-30 16:30:49',NULL);
/*!40000 ALTER TABLE `tbl_transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nilai`
--

DROP TABLE IF EXISTS `tbl_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) unsigned NOT NULL,
  `kode_akun3` int(6) unsigned NOT NULL,
  `debit` float(12,2) NOT NULL DEFAULT 0.00,
  `kredit` float(12,2) NOT NULL DEFAULT 0.00,
  `id_status` int(11) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `id_transaksi` (`id_transaksi`),
  CONSTRAINT `tbl_nilai_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `tbl_transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nilai`
--

LOCK TABLES `tbl_nilai` WRITE;
/*!40000 ALTER TABLE `tbl_nilai` DISABLE KEYS */;
INSERT INTO `tbl_nilai` VALUES (32,16,1101,30000000.00,0.00,3,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(33,16,1103,3000000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(34,16,1201,35000000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(35,16,3101,0.00,68000000.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(36,17,1104,15000000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(37,17,1101,0.00,15000000.00,2,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(38,18,1201,5000000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(39,18,2101,0.00,5000000.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(40,19,1101,2000000.00,0.00,1,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(41,19,2103,0.00,2000000.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(42,20,1105,4200000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(43,20,1101,0.00,4200000.00,2,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(44,21,5102,300000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(45,21,1101,0.00,300000.00,2,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(46,22,2101,2500000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(47,22,1101,0.00,2500000.00,2,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(48,23,1102,5800000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(49,23,4101,0.00,5800000.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(50,24,5101,1250000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(51,24,1101,0.00,1250000.00,2,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(52,25,1101,5800000.00,0.00,1,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(53,25,1102,0.00,5800000.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(54,26,1102,19400000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(55,26,4101,0.00,19400000.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(56,27,1103,1200000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(57,27,1101,0.00,1200000.00,2,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(58,28,5104,350000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(59,28,1101,0.00,350000.00,2,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(60,29,5105,170000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(61,29,1101,0.00,170000.00,2,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(62,30,1101,8000000.00,0.00,1,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(63,30,1102,0.00,8000000.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(64,31,5101,1250000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(65,31,1101,0.00,1250000.00,2,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(66,32,1101,11400000.00,0.00,1,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(67,32,1102,0.00,11400000.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(68,33,1102,3000000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(69,33,4101,0.00,3000000.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(70,34,3201,1200000.00,0.00,5,'2026-09-30 16:30:49','2026-09-30 16:30:49'),(71,34,1101,0.00,1200000.00,4,'2026-09-30 16:30:49','2026-09-30 16:30:49');
/*!40000 ALTER TABLE `tbl_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_penyesuaian`
--

DROP TABLE IF EXISTS `tbl_penyesuaian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_penyesuaian` (
  `id_penyesuaian` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `nilai` float(12,2) NOT NULL DEFAULT 0.00,
  `waktu` int(6) NOT NULL DEFAULT 1,
  `jumlah` float(12,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_penyesuaian`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_penyesuaian`
--

LOCK TABLES `tbl_penyesuaian` WRITE;
/*!40000 ALTER TABLE `tbl_penyesuaian` DISABLE KEYS */;
INSERT INTO `tbl_penyesuaian` VALUES (6,'2025-12-31','Penyesuaian beban sewa tempat kantor bulan Desember (1 bulan terpakai dari total 6 bulan)',15000000.00,6,2500000.00,'2026-09-30 16:30:52','2026-09-30 16:30:52'),(7,'2025-12-31','Penyesuaian beban asuransi perlindungan kantor bulan Desember (1 bulan terpakai dari total 12 bulan)',4200000.00,12,350000.00,'2026-09-30 16:30:52','2026-09-30 16:30:52'),(8,'2025-12-31','Penyesuaian beban penyusutan peralatan kantor untuk bulan Desember',600000.00,1,600000.00,'2026-09-30 16:30:52','2026-09-30 16:30:52'),(9,'2025-12-31','Penyesuaian pemakaian perlengkapan kantor selama bulan Desember (terpakai Rp 1.000.000, tersisa Rp 3.200.000)',1000000.00,1,1000000.00,'2026-09-30 16:30:52','2026-09-30 16:30:52'),(10,'2025-12-31','Penyesuaian pendapatan jasa konsultasi yang telah diselesaikan tetapi belum ditagih/diterima',2500000.00,1,2500000.00,'2026-09-30 16:30:52','2026-09-30 16:30:52');
/*!40000 ALTER TABLE `tbl_penyesuaian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nilai_penyesuaian`
--

DROP TABLE IF EXISTS `tbl_nilai_penyesuaian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_nilai_penyesuaian` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_penyesuaian` int(11) unsigned NOT NULL,
  `kode_akun3` int(6) unsigned NOT NULL,
  `debit` float(12,2) NOT NULL DEFAULT 0.00,
  `kredit` float(12,2) NOT NULL DEFAULT 0.00,
  `id_status` int(11) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_penyesuaian` (`id_penyesuaian`),
  CONSTRAINT `tbl_nilai_penyesuaian_id_penyesuaian_foreign` FOREIGN KEY (`id_penyesuaian`) REFERENCES `tbl_penyesuaian` (`id_penyesuaian`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nilai_penyesuaian`
--

LOCK TABLES `tbl_nilai_penyesuaian` WRITE;
/*!40000 ALTER TABLE `tbl_nilai_penyesuaian` DISABLE KEYS */;
INSERT INTO `tbl_nilai_penyesuaian` VALUES (11,6,5106,2500000.00,0.00,5,'2026-09-30 16:30:52','2026-09-30 16:30:52'),(12,6,1104,0.00,2500000.00,5,'2026-09-30 16:30:52','2026-09-30 16:30:52'),(13,7,5103,350000.00,0.00,5,'2026-09-30 16:30:52','2026-09-30 16:30:52'),(14,7,1105,0.00,350000.00,5,'2026-09-30 16:30:52','2026-09-30 16:30:52'),(15,8,5107,600000.00,0.00,5,'2026-09-30 16:30:52','2026-09-30 16:30:52'),(16,8,1202,0.00,600000.00,5,'2026-09-30 16:30:52','2026-09-30 16:30:52'),(17,9,5108,1000000.00,0.00,5,'2026-09-30 16:30:52','2026-09-30 16:30:52'),(18,9,1103,0.00,1000000.00,5,'2026-09-30 16:30:52','2026-09-30 16:30:52'),(19,10,1102,2500000.00,0.00,5,'2026-09-30 16:30:52','2026-09-30 16:30:52'),(20,10,4101,0.00,2500000.00,5,'2026-09-30 16:30:52','2026-09-30 16:30:52');
/*!40000 ALTER TABLE `tbl_nilai_penyesuaian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contoh`
--

DROP TABLE IF EXISTS `contoh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contoh` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contoh`
--

LOCK TABLES `contoh` WRITE;
/*!40000 ALTER TABLE `contoh` DISABLE KEYS */;
INSERT INTO `contoh` VALUES (1,'Fauzi '),(2,'Beyaaa'),(3,'Bakpauu');
/*!40000 ALTER TABLE `contoh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (3,'2026-08-30-131702','App\\Database\\Migrations\\CreateAkun1','default','App',1789537230,1),(4,'2026-09-16-033232','App\\Database\\Migrations\\CreateAkun2','default','App',1789537230,1),(5,'2026-09-24-000001','App\\Database\\Migrations\\CreateAkun3','default','App',1790187127,2),(6,'2026-09-24-000002','App\\Database\\Migrations\\CreateTransaksi','default','App',1790187535,3),(7,'2026-09-24-000003','App\\Database\\Migrations\\CreatePenyesuaian','default','App',1790187732,4),(8,'2026-09-24-000004','App\\Database\\Migrations\\CreateUsers','default','App',1790188102,5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

SET FOREIGN_KEY_CHECKS = 1;
