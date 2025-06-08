-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for aset_management
CREATE DATABASE IF NOT EXISTS `aset_management` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `aset_management`;

-- Dumping structure for table aset_management.m_aset
CREATE TABLE IF NOT EXISTS `m_aset` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_aset` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_aset` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `merk` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipe` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `spesifikasi` text COLLATE utf8mb4_general_ci,
  `jumlah` int DEFAULT '1',
  `satuan` varchar(20) COLLATE utf8mb4_general_ci DEFAULT 'unit',
  `lokasi_fisik` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ruangan_id` int DEFAULT NULL,
  `tahun_perolehan` year DEFAULT NULL,
  `sumber_dana` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga_satuan` decimal(12,2) DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_aset` (`kode_aset`),
  KEY `ruangan_id` (`ruangan_id`),
  CONSTRAINT `m_aset_ibfk_1` FOREIGN KEY (`ruangan_id`) REFERENCES `m_ruangan` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table aset_management.m_aset: ~20 rows (approximately)
DELETE FROM `m_aset`;
INSERT INTO `m_aset` (`id`, `kode_aset`, `nama_aset`, `kategori`, `merk`, `tipe`, `spesifikasi`, `jumlah`, `satuan`, `lokasi_fisik`, `ruangan_id`, `tahun_perolehan`, `sumber_dana`, `harga_satuan`, `foto`, `status`, `keterangan`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted`, `deleted_by`) VALUES
	(52, 'AS001', 'Meja Belajar II', 'Furniture', 'IKEA', 'Model A', 'Kayu solid', 10, 'unit', 'Lantai 1', 11, '2023', 'APBD', 500000.00, NULL, 1, 'Meja untuk siswa', '2025-06-06 09:12:50', '2025-06-06 20:54:19', 1, NULL, 1, NULL),
	(53, 'AS002', 'Kursi Belajar 3', 'Furniture', 'IKEA', 'Model B', 'Kursi kayu', 10, 'unit', 'Lantai 1', 11, '2023', 'APBD', 300000.00, NULL, 1, 'Kursi untuk siswa', '2025-06-06 09:12:50', '2025-06-07 04:13:18', 1, NULL, 0, NULL),
	(54, 'AS003', 'Komputer Desktop', 'Elektronik', 'Dell', 'Optiplex 3080', 'Intel i5, 8GB RAM', 5, 'unit', 'Lantai 2', 14, '2024', 'APBD', 8000000.00, NULL, 1, 'Komputer lab', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(55, 'AS004', 'Proyektor', 'Elektronik', 'Epson', 'X12', 'Proyektor LCD', 2, 'unit', 'Lantai 2', 15, '2023', 'APBD', 3500000.00, NULL, 1, 'Proyektor perpustakaan', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(56, 'AS005', 'Rak Buku', 'Furniture', 'Local', 'Model C', 'Rak kayu', 4, 'unit', 'Lantai 2', 15, '2022', 'Sumbangan', 1000000.00, NULL, 1, 'Rak perpustakaan', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(57, 'AS006', 'AC Ruangan', 'Elektronik', 'Samsung', 'Split AC', '1 PK', 3, 'unit', 'Lantai 1', 13, '2024', 'APBD', 4000000.00, NULL, 1, 'AC kantor TU', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(58, 'AS007', 'Lemari Arsip', 'Furniture', 'Local', 'Model D', 'Lemari besi', 2, 'unit', 'Lantai 1', 13, '2023', 'APBD', 1500000.00, NULL, 1, 'Lemari arsip', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(59, 'AS008', 'Meja Guru', 'Furniture', 'IKEA', 'Model E', 'Meja kayu', 5, 'unit', 'Lantai 1', 12, '2023', 'APBD', 600000.00, NULL, 1, 'Meja guru kelas', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(60, 'AS009', 'Kursi Guru', 'Furniture', 'IKEA', 'Model F', 'Kursi kayu', 5, 'unit', 'Lantai 1', 12, '2023', 'APBD', 300000.00, NULL, 1, 'Kursi guru kelas', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(61, 'AS010', 'Laptop Guru', 'Elektronik', 'HP', 'EliteBook', 'Intel i7, 16GB RAM', 3, 'unit', 'Lantai 1', 12, '2024', 'APBD', 12000000.00, NULL, 1, 'Laptop guru', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(62, 'AS011', 'Meja Siswa', 'Furniture', 'IKEA', 'Model G', 'Kayu solid', 15, 'unit', 'Lantai 2', 17, '2023', 'APBD', 450000.00, NULL, 1, 'Meja siswa kelas 2A', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(63, 'AS012', 'Kursi Siswa', 'Furniture', 'IKEA', 'Model H', 'Kursi kayu', 15, 'unit', 'Lantai 2', 17, '2023', 'APBD', 250000.00, NULL, 1, 'Kursi siswa kelas 2A', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(64, 'AS013', 'Papan Tulis', 'Peralatan', 'Local', 'Model I', 'Papan tulis putih', 3, 'unit', 'Lantai 1', 11, '2022', 'APBD', 700000.00, NULL, 1, 'Papan tulis kelas 1A', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(65, 'AS014', 'Printer', 'Elektronik', 'Canon', 'Pixma', 'Printer warna', 2, 'unit', 'Lantai 2', 15, '2023', 'APBD', 2000000.00, NULL, 1, 'Printer perpustakaan', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(66, 'AS015', 'Meja Guru', 'Furniture', 'Local', 'Model J', 'Meja kayu', 4, 'unit', 'Lantai 3', 19, '2023', 'APBD', 550000.00, NULL, 1, 'Meja guru kelas 3A', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(67, 'AS016', 'Kursi Guru', 'Furniture', 'Local', 'Model K', 'Kursi kayu', 4, 'unit', 'Lantai 3', 19, '2023', 'APBD', 350000.00, NULL, 1, 'Kursi guru kelas 3A', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(68, 'AS017', 'Laptop TU', 'Elektronik', 'Asus', 'ZenBook', 'Intel i5, 8GB RAM', 1, 'unit', 'Lantai 1', 13, '2024', 'APBD', 9000000.00, NULL, 1, 'Laptop tata usaha', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(69, 'AS018', 'AC Ruangan', 'Elektronik', 'Panasonic', 'Split AC', '1.5 PK', 2, 'unit', 'Lantai 2', 14, '2023', 'APBD', 4500000.00, NULL, 1, 'AC laboratorium', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(70, 'AS019', 'Kamera CCTV', 'Elektronik', 'Hikvision', 'DS-2CD', 'CCTV keamanan', 4, 'unit', 'Lantai 1', 16, '2023', 'APBD', 1200000.00, NULL, 1, 'CCTV gudang', '2025-06-06 09:12:50', NULL, 1, NULL, 0, NULL),
	(71, 'AS020', 'Meja Kerja', 'Furniture', 'Local', 'Model L', 'Meja kayu', 3, 'unit', 'Lantai 2', 16, '2023', 'APBD', 650000.00, NULL, 1, 'Meja gudang', '2025-06-06 09:12:50', '2025-06-06 20:54:26', 1, NULL, 1, NULL),
	(72, '', 'Meja Belajar II', 'Furniture', 'IKEA', 'Model A', 'Kayu solid', 10, 'unit', 'Lantai 1', 14, '2023', 'APBD', 500000.00, NULL, NULL, NULL, '2025-06-06 20:54:36', '2025-06-06 20:56:10', NULL, NULL, 1, NULL),
	(73, 'AS022', 'Meja Belajar II', 'Furniture', 'IKEA', 'Model A', 'Kayu solid', 10, 'unit', 'Lantai 1', 15, '2023', 'APBD', 500000.00, NULL, NULL, NULL, '2025-06-06 20:57:43', NULL, NULL, NULL, 0, NULL),
	(74, 'AS023', 'Meja Babi', 'Furniture', 'IKEA', 'Model A', 'Kayu solid', 10, 'unit', 'Lantai 1', 14, '2023', 'APBD', 500000.00, NULL, NULL, NULL, '2025-06-06 20:58:07', NULL, NULL, NULL, 0, NULL);

-- Dumping structure for table aset_management.m_mutasi
CREATE TABLE IF NOT EXISTS `m_mutasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `aset_id` int NOT NULL,
  `jumlah` int DEFAULT '1',
  `dari_ruangan_id` int DEFAULT NULL,
  `ke_ruangan_id` int DEFAULT NULL,
  `tanggal_mutasi` date NOT NULL,
  `alasan` text,
  `dokumen_mutasi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aset_id` (`aset_id`),
  KEY `dari_ruangan_id` (`dari_ruangan_id`),
  KEY `ke_ruangan_id` (`ke_ruangan_id`),
  CONSTRAINT `m_mutasi_ibfk_1` FOREIGN KEY (`aset_id`) REFERENCES `m_aset` (`id`) ON DELETE CASCADE,
  CONSTRAINT `m_mutasi_ibfk_2` FOREIGN KEY (`dari_ruangan_id`) REFERENCES `m_ruangan` (`id`),
  CONSTRAINT `m_mutasi_ibfk_3` FOREIGN KEY (`ke_ruangan_id`) REFERENCES `m_ruangan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table aset_management.m_mutasi: ~0 rows (approximately)
DELETE FROM `m_mutasi`;

-- Dumping structure for table aset_management.m_pengadaan
CREATE TABLE IF NOT EXISTS `m_pengadaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_pengadaan` varchar(50) NOT NULL,
  `tanggal_pengadaan` date NOT NULL,
  `aset_id` int DEFAULT NULL,
  `jumlah` int NOT NULL,
  `satuan` varchar(20) DEFAULT 'unit',
  `harga_satuan` decimal(12,2) DEFAULT NULL,
  `total_harga` decimal(12,2) DEFAULT NULL,
  `sumber_dana` varchar(100) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `dokumen_pengadaan` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_pengadaan` (`no_pengadaan`),
  KEY `aset_id` (`aset_id`),
  CONSTRAINT `m_pengadaan_ibfk_1` FOREIGN KEY (`aset_id`) REFERENCES `m_aset` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table aset_management.m_pengadaan: ~0 rows (approximately)
DELETE FROM `m_pengadaan`;

-- Dumping structure for table aset_management.m_ruangan
CREATE TABLE IF NOT EXISTS `m_ruangan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_ruangan` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_ruangan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_ruangan` enum('kelas','kantor','laboratorium','perpustakaan','gudang','lainnya') COLLATE utf8mb4_general_ci NOT NULL,
  `lantai` int DEFAULT NULL,
  `kapasitas` int DEFAULT NULL,
  `penanggung_jawab` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_ruangan` (`kode_ruangan`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table aset_management.m_ruangan: ~10 rows (approximately)
DELETE FROM `m_ruangan`;
INSERT INTO `m_ruangan` (`id`, `kode_ruangan`, `nama_ruangan`, `jenis_ruangan`, `lantai`, `kapasitas`, `penanggung_jawab`, `keterangan`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted`, `deleted_by`) VALUES
	(11, 'R001', 'Kelas 1A B', 'perpustakaan', 1, 30, 'Budi Santoso', 'Ruang kelas utama', '2025-06-03 16:09:48', '2025-06-07 21:58:06', 1, NULL, 0, NULL),
	(12, 'R002', 'Kelas 1B', 'kelas', 1, 32, 'Siti Aminah', 'Ruang kelas cadangan', '2025-06-03 16:09:48', NULL, 1, NULL, 0, NULL),
	(13, 'R003', 'Kantor TU', 'kantor', 1, 5, 'Dewi Puspita', 'Ruang tata usaha', '2025-06-03 16:09:48', NULL, 1, NULL, 0, NULL),
	(14, 'R004', 'Laboratorium Komputer', 'laboratorium', 2, 20, 'Joko Prasetyo', 'Lab komputer utama', '2025-06-03 16:09:48', NULL, 1, NULL, 0, NULL),
	(15, 'R005', 'Perpustakaan Utama', 'perpustakaan', 2, 15, 'Lina Herawati', 'Perpustakaan sekolah', '2025-06-03 16:09:48', NULL, 1, NULL, 0, NULL),
	(16, 'R006', 'Gudang Alat', 'gudang', 0, 10, 'Samsul Hadi', 'Gudang peralatan sekolah', '2025-06-03 16:09:48', NULL, 1, NULL, 0, NULL),
	(17, 'R007', 'Kelas 2A', 'kelas', 2, 30, 'Rina Melati', 'Ruang kelas atas', '2025-06-03 16:09:48', NULL, 1, NULL, 0, NULL),
	(18, 'R008', 'Kelas 2B', 'kelas', 2, 30, 'Tono Rahman', 'Ruang kelas atas 2', '2025-06-03 16:09:48', NULL, 1, NULL, 0, NULL),
	(19, 'R009', 'Kelas 3A', 'kelas', 3, 28, 'Yuni Safitri', 'Kelas tingkat akhir', '2025-06-03 16:09:48', NULL, 1, NULL, 0, NULL),
	(20, 'R010', 'Kelas 3B', 'kelas', 3, 29, 'Arif Nugroho', 'Kelas tambahan tingkat akhir', '2025-06-03 16:09:48', NULL, 1, NULL, 0, NULL);

-- Dumping structure for table aset_management.m_siswa
CREATE TABLE IF NOT EXISTS `m_siswa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `kelas` varchar(20) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `alamat` text,
  `nama_ortu` varchar(100) DEFAULT NULL,
  `no_hp_ortu` varchar(20) DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nis` (`nis`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table aset_management.m_siswa: ~0 rows (approximately)
DELETE FROM `m_siswa`;

-- Dumping structure for table aset_management.t_aset_kerusakan
CREATE TABLE IF NOT EXISTS `t_aset_kerusakan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `aset_id` int NOT NULL,
  `jumlah` int DEFAULT '1',
  `tanggal_kerusakan` date NOT NULL,
  `deskripsi` text,
  `dokumen_kerusakan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aset_id` (`aset_id`),
  CONSTRAINT `t_aset_kerusakan_ibfk_1` FOREIGN KEY (`aset_id`) REFERENCES `m_aset` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table aset_management.t_aset_kerusakan: ~0 rows (approximately)
DELETE FROM `t_aset_kerusakan`;
INSERT INTO `t_aset_kerusakan` (`id`, `aset_id`, `jumlah`, `tanggal_kerusakan`, `deskripsi`, `dokumen_kerusakan`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted`, `deleted_by`) VALUES
	(1, 54, 5, '2025-06-08', 'Ruang kelas utama', 'efc259a77f036d98ffa720f34d63a6e5.png', '2025-06-08 04:07:05', '2025-06-08 04:14:56', 1, NULL, 0, NULL);

-- Dumping structure for table aset_management.t_aset_pemeliharaan
CREATE TABLE IF NOT EXISTS `t_aset_pemeliharaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `aset_id` int NOT NULL,
  `tanggal_pemeliharaan` date NOT NULL,
  `jumlah` int DEFAULT '1',
  `jenis_pemeliharaan` varchar(100) NOT NULL,
  `deskripsi` text,
  `biaya` decimal(12,2) DEFAULT NULL,
  `dokumen_pemeliharaan` varchar(255) DEFAULT NULL,
  `status` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `aset_id` (`aset_id`),
  CONSTRAINT `t_aset_pemeliharaan_ibfk_1` FOREIGN KEY (`aset_id`) REFERENCES `m_aset` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table aset_management.t_aset_pemeliharaan: ~0 rows (approximately)
DELETE FROM `t_aset_pemeliharaan`;

-- Dumping structure for table aset_management.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `role` enum('admin','kepala_sekolah') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table aset_management.users: ~2 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `email`, `no_hp`, `role`, `created_at`, `updated_at`) VALUES
	(1, 'budi', '$2y$10$fdqNMR0csNI.D.QL7FiWW.iTi3OTG.A0Au5H9.VBuzVasz.dtwdAm', 'Budi Setiawan', 'budi@mail.com', '083816014304', 'admin', '2025-06-07 21:03:47', '2025-06-08 04:18:38'),
	(2, 'kepsek', '$2y$10$Dsf6insKmwxUjq5q7FTKp.cGspGa.5OfbpPQYzGGbN67686xCiY.O', 'Kepala Sekolah', 'kepsek@mail.com', '083816014304', 'kepala_sekolah', '2025-06-07 21:24:29', '2025-06-08 04:30:02');

-- Dumping structure for trigger aset_management.before_insert_m_aset
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `before_insert_m_aset` BEFORE INSERT ON `m_aset` FOR EACH ROW BEGIN
    DECLARE total INT;
    DECLARE kodeBaru VARCHAR(10);

    -- Hitung jumlah baris sekarang dan tambah 1
    SELECT COUNT(*) + 1 INTO total FROM m_aset;

    -- Format kode, misalnya AS001, AS002, dst.
    SET kodeBaru = CONCAT('AS', LPAD(total, 3, '0'));

    -- Cek apakah kode_aset sudah diset, kalau belum baru generate otomatis
    IF NEW.kode_aset IS NULL OR NEW.kode_aset = '' THEN
        SET NEW.kode_aset = kodeBaru;
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
