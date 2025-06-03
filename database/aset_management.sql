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

-- Dumping structure for table aset_management.m_aset
CREATE TABLE IF NOT EXISTS `m_aset` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_aset` varchar(50) NOT NULL,
  `nama_aset` varchar(100) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `tipe` varchar(100) DEFAULT NULL,
  `spesifikasi` text,
  `jumlah` int DEFAULT '1',
  `satuan` varchar(20) DEFAULT 'unit',
  `lokasi_fisik` varchar(100) DEFAULT NULL,
  `ruangan_id` int DEFAULT NULL,
  `tahun_perolehan` year DEFAULT NULL,
  `sumber_dana` varchar(100) DEFAULT NULL,
  `harga_satuan` decimal(12,2) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `keterangan` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table aset_management.m_ruangan
CREATE TABLE IF NOT EXISTS `m_ruangan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_ruangan` varchar(20) NOT NULL,
  `nama_ruangan` varchar(100) NOT NULL,
  `jenis_ruangan` enum('kelas','kantor','laboratorium','perpustakaan','gudang','lainnya') NOT NULL,
  `lantai` int DEFAULT NULL,
  `kapasitas` int DEFAULT NULL,
  `penanggung_jawab` varchar(100) DEFAULT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `deleted_by` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_ruangan` (`kode_ruangan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table aset_management.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `role` enum('admin','kepala_sekolah') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
