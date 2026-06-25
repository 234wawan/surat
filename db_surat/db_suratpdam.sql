/*
 Navicat Premium Data Transfer

 Source Server         : root
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : db_suratpdam

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 26/06/2026 05:57:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE,
  INDEX `cache_expiration_index`(`expiration` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE,
  INDEX `cache_locks_expiration_index`(`expiration` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for disposisi
-- ----------------------------
DROP TABLE IF EXISTS `disposisi`;
CREATE TABLE `disposisi`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `surat_masuk_id` bigint UNSIGNED NOT NULL,
  `dari` bigint UNSIGNED NOT NULL,
  `kepada` bigint UNSIGNED NOT NULL,
  `instruksi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `instruksi_jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `catatan_direksi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `batas_waktu` date NULL DEFAULT NULL,
  `status` enum('belum','dibaca') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `disposisi_surat_masuk_id_foreign`(`surat_masuk_id` ASC) USING BTREE,
  INDEX `disposisi_dari_foreign`(`dari` ASC) USING BTREE,
  INDEX `disposisi_kepada_foreign`(`kepada` ASC) USING BTREE,
  INDEX `disposisi_parent_id_foreign`(`parent_id` ASC) USING BTREE,
  CONSTRAINT `disposisi_dari_foreign` FOREIGN KEY (`dari`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `disposisi_kepada_foreign` FOREIGN KEY (`kepada`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `disposisi_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `disposisi` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `disposisi_surat_masuk_id_foreign` FOREIGN KEY (`surat_masuk_id`) REFERENCES `surat_masuk` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of disposisi
-- ----------------------------
INSERT INTO `disposisi` VALUES (1, 1, 1, 7, NULL, 'Diteruskan', NULL, '-', NULL, 'dibaca', '2026-05-29 03:41:24', '2026-05-29 04:11:35', NULL);

-- ----------------------------
-- Table structure for disposisi_penerima
-- ----------------------------
DROP TABLE IF EXISTS `disposisi_penerima`;
CREATE TABLE `disposisi_penerima`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `disposisi_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `disposisi_penerima_disposisi_id_foreign`(`disposisi_id` ASC) USING BTREE,
  INDEX `disposisi_penerima_user_id_foreign`(`user_id` ASC) USING BTREE,
  CONSTRAINT `disposisi_penerima_disposisi_id_foreign` FOREIGN KEY (`disposisi_id`) REFERENCES `disposisi` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `disposisi_penerima_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of disposisi_penerima
-- ----------------------------
INSERT INTO `disposisi_penerima` VALUES (1, 1, 9, NULL, NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for jabatan
-- ----------------------------
DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE `jabatan`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jabatan
-- ----------------------------
INSERT INTO `jabatan` VALUES (1, 'Ketua SPI', 'Ketua Satuan Pengawas Internal', '2026-05-29 02:39:12', '2026-05-29 02:39:12');
INSERT INTO `jabatan` VALUES (2, 'Kepala Bagian Administrasi & Keuangan', 'Kabag Adm & Keuangan', '2026-05-29 02:39:12', '2026-05-29 02:39:12');
INSERT INTO `jabatan` VALUES (3, 'Kepala Bagian Produksi & Distribusi', 'Kabag Produksi & Distribusi', '2026-05-29 02:39:12', '2026-05-29 02:39:12');
INSERT INTO `jabatan` VALUES (4, 'Kepala Bagian Perencanaan & Perawatan', 'Kabag Perencanaan & Perawatan', '2026-05-29 02:39:12', '2026-05-29 02:39:12');
INSERT INTO `jabatan` VALUES (5, 'Kepala Cabang', 'Kepala Cabang', '2026-05-29 02:39:12', '2026-05-29 02:39:12');
INSERT INTO `jabatan` VALUES (6, 'Kasubag Hukum & IT', 'Kepala Sub Bagian Hukum & IT', '2026-05-29 02:39:12', '2026-05-29 02:39:12');
INSERT INTO `jabatan` VALUES (7, 'Direksi', 'Direktur / Wakil Direktur', '2026-05-29 02:39:12', '2026-05-29 02:39:12');

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int NULL DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for master_surat
-- ----------------------------
DROP TABLE IF EXISTS `master_surat`;
CREATE TABLE `master_surat`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pola_nomor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `master_surat_kode_unique`(`kode` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of master_surat
-- ----------------------------
INSERT INTO `master_surat` VALUES (1, 'PERDIR', 'Surat Perintah Direktur', 'PERDIR/{no_urut}/PDAM/{bulan_romawi}/{tahun}', 'Surat perintah yang dikeluarkan oleh Direktur', '2026-05-23 11:31:03', '2026-05-25 14:34:12');
INSERT INTO `master_surat` VALUES (2, 'SK', 'Surat Keputusan', 'SK/{no_urut}/PDAM/{bulan_romawi}/{tahun}', 'Surat keputusan direktur tentang kebijakan', '2026-05-23 11:31:03', NULL);
INSERT INTO `master_surat` VALUES (3, 'UMUM', 'Surat Umum', '{no_urut}/PDAM/{bulan_romawi}/{tahun}', 'Surat dinas umum', '2026-05-23 11:31:03', NULL);

-- ----------------------------
-- Table structure for menu_role
-- ----------------------------
DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE `menu_role`  (
  `menu_id` bigint UNSIGNED NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`menu_id`, `role`) USING BTREE,
  CONSTRAINT `menu_role_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_role
-- ----------------------------
INSERT INTO `menu_role` VALUES (1, 'admin');
INSERT INTO `menu_role` VALUES (1, 'staf');
INSERT INTO `menu_role` VALUES (2, 'admin');
INSERT INTO `menu_role` VALUES (2, 'staf');
INSERT INTO `menu_role` VALUES (3, 'admin');
INSERT INTO `menu_role` VALUES (3, 'staf');
INSERT INTO `menu_role` VALUES (4, 'admin');
INSERT INTO `menu_role` VALUES (4, 'staf');
INSERT INTO `menu_role` VALUES (5, 'admin');
INSERT INTO `menu_role` VALUES (6, 'admin');
INSERT INTO `menu_role` VALUES (7, 'admin');
INSERT INTO `menu_role` VALUES (8, 'admin');

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` bigint UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `route_param` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `order` int NOT NULL DEFAULT 0,
  `section` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `menus_parent_id_foreign`(`parent_id` ASC) USING BTREE,
  CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, NULL, 'Dashboard', 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'dashboard', NULL, NULL, 0, 'Menu Utama', 1, '2026-05-29 02:38:56', '2026-05-29 02:38:56');
INSERT INTO `menus` VALUES (2, NULL, 'Surat Masuk', 'M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4', 'surat-masuk.index', NULL, NULL, 1, 'Menu Utama', 1, '2026-05-29 02:38:56', '2026-05-29 02:38:56');
INSERT INTO `menus` VALUES (3, NULL, 'Surat Keluar', 'M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10.07l6.75 4.5M21 10.07l-6.75 4.5', 'surat-keluar.index', NULL, NULL, 2, 'Menu Utama', 1, '2026-05-29 02:38:56', '2026-05-29 02:38:56');
INSERT INTO `menus` VALUES (4, NULL, 'Disposisi', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'disposisi.index', NULL, NULL, 3, 'Menu Utama', 1, '2026-05-29 02:38:56', '2026-05-29 02:38:56');
INSERT INTO `menus` VALUES (5, NULL, 'Master Surat', 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'master-surat.index', NULL, NULL, 0, 'Administrasi', 1, '2026-05-29 02:38:56', '2026-05-29 02:38:56');
INSERT INTO `menus` VALUES (6, NULL, 'Tambah User', 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z', 'register', NULL, NULL, 1, 'Administrasi', 1, '2026-05-29 02:38:56', '2026-05-29 02:38:56');
INSERT INTO `menus` VALUES (7, NULL, 'Jabatan', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'jabatan.index', NULL, NULL, 2, 'Administrasi', 1, '2026-05-29 02:38:56', '2026-05-29 02:38:56');
INSERT INTO `menus` VALUES (8, NULL, 'Menu Management', 'M4 6h16M4 12h16M4 18h16', 'menu.index', NULL, NULL, 3, 'Administrasi', 1, '2026-05-29 02:38:56', '2026-05-29 02:38:56');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (7, '2025_01_01_000001_add_role_to_users_table', 2);
INSERT INTO `migrations` VALUES (8, '2025_01_01_000002_create_surat_masuk_table', 2);
INSERT INTO `migrations` VALUES (9, '2025_01_01_000003_create_surat_keluar_table', 2);
INSERT INTO `migrations` VALUES (10, '2025_01_01_000004_create_disposisi_table', 3);
INSERT INTO `migrations` VALUES (11, '2026_05_23_112740_create_master_surat_table', 4);
INSERT INTO `migrations` VALUES (12, '2026_05_23_112758_add_master_surat_id_to_surat_keluar_table', 4);
INSERT INTO `migrations` VALUES (13, '2026_05_23_113532_add_no_urut_to_surat_keluar_table', 5);
INSERT INTO `migrations` VALUES (14, '2026_05_25_000001_fix_master_surat_pola_nomor', 6);
INSERT INTO `migrations` VALUES (15, '2026_05_29_000001_create_jabatan_table', 7);
INSERT INTO `migrations` VALUES (16, '2026_05_29_000002_create_menus_table', 7);
INSERT INTO `migrations` VALUES (17, '2026_05_29_000003_enhance_disposisi_table', 7);
INSERT INTO `migrations` VALUES (18, '2026_05_29_000004_fix_menu_icon_length', 8);
INSERT INTO `migrations` VALUES (19, '2026_05_29_000005_add_jam_terima_to_surat_masuk', 9);
INSERT INTO `migrations` VALUES (20, '2026_05_29_041646_change_icon_to_text_in_menus', 10);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('BjnvPD874SLI2bM6pebBWyPdnkyWO06oU4Gampiu', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.123.0 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVW1rVXJ0UXF0anZENFdSRnN4M2ZsUU9BOG5lb1NkYXM1Smh1d2JKVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1781192407);
INSERT INTO `sessions` VALUES ('C61Rj0ygIHzLvqj6YPpTo0JqmEc3uXqScB4u58qT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.124.0 Chrome/148.0.7778.97 Electron/42.2.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSW56SlNhdTExNDdldFJWTjNVRGpZU0RYWmp6Z3NYbVM2V01EWVZhVCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1781251636);
INSERT INTO `sessions` VALUES ('t6C4avJqXhiAU4tHRIi8zsS3UWpg7LXKdB6rGGBi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUUzRWlNVXJpZGNOeXhzVTdITVFTTk1pNEN5VE9sRnJBNHdyTjdKbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1781193432);

-- ----------------------------
-- Table structure for surat_keluar
-- ----------------------------
DROP TABLE IF EXISTS `surat_keluar`;
CREATE TABLE `surat_keluar`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_agenda` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_urut` int NULL DEFAULT NULL,
  `no_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tujuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `isi_ringkas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `master_surat_id` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `surat_keluar_no_agenda_unique`(`no_agenda` ASC) USING BTREE,
  INDEX `surat_keluar_user_id_foreign`(`user_id` ASC) USING BTREE,
  INDEX `surat_keluar_master_surat_id_foreign`(`master_surat_id` ASC) USING BTREE,
  CONSTRAINT `surat_keluar_master_surat_id_foreign` FOREIGN KEY (`master_surat_id`) REFERENCES `master_surat` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `surat_keluar_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of surat_keluar
-- ----------------------------
INSERT INTO `surat_keluar` VALUES (1, 'SK-20260525-0001', 1, 'PERDIR/01/V/PDAM/{2026}', '2026-05-25', 'kota', 'jalan', NULL, 'ok bos', 1, '2026-05-25 14:34:40', '2026-05-25 14:34:40', NULL, 1);

-- ----------------------------
-- Table structure for surat_masuk
-- ----------------------------
DROP TABLE IF EXISTS `surat_masuk`;
CREATE TABLE `surat_masuk`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_agenda` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_terima` date NOT NULL,
  `jam_terima` time NULL DEFAULT NULL,
  `pengirim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `perihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `isi_ringkas` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `surat_masuk_no_agenda_unique`(`no_agenda` ASC) USING BTREE,
  INDEX `surat_masuk_user_id_foreign`(`user_id` ASC) USING BTREE,
  CONSTRAINT `surat_masuk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of surat_masuk
-- ----------------------------
INSERT INTO `surat_masuk` VALUES (1, '713', '015 / Penw-bya / PP /  IV / 2026', '2026-04-04', '2026-06-11', '10:00:00', 'CV. Pola Prisma', 'Penawaran Biaya', NULL, 'Penawaran Biaya\r\nStudi Kelayakan (FS)\r\nSPAM Kec. Sayung\r\nKab. Demak Tahun\r\n2026', '-', 1, '2026-05-29 03:19:56', '2026-05-29 03:19:56', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','staf','kabag') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staf',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jabatan_id` bigint UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE,
  INDEX `users_jabatan_id_foreign`(`jabatan_id` ASC) USING BTREE,
  CONSTRAINT `users_jabatan_id_foreign` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Admin PDAM', 'admin@pdam.com', 'admin', NULL, '$2y$12$uTPOUzphqYx2Yq2dyk9mNe5CaR/nAGBaoXxvnkxPh/PKXcYK10r22', NULL, '2026-05-23 11:05:12', '2026-05-23 11:05:12', NULL);
INSERT INTO `users` VALUES (3, 'Rina Marlina', 'ketua_spi@pdam.com', 'staf', NULL, '$2y$12$KCl5/B1g6TcK7/r.3xUn3eyRT2SG2GvpVOgQBL4K.d9f7Mb6S55ra', NULL, '2026-05-29 03:31:12', '2026-05-29 03:31:12', 1);
INSERT INTO `users` VALUES (4, 'Budi Santoso', 'kabag_keuangan@pdam.com', 'kabag', NULL, '$2y$12$Ad7.C7SKELHNQ.f/.uWrXuzYER5Hqu/8YmpauDdcZOQqAxajmAmEK', NULL, '2026-05-29 03:31:12', '2026-05-29 03:31:12', 2);
INSERT INTO `users` VALUES (5, 'Agus Wijaya', 'kabag_produksi@pdam.com', 'kabag', NULL, '$2y$12$VE.xxnQuKeUAKqtSiBryEeSlMer66qEuDtqbmS0r29QNyZWLoUGH.', NULL, '2026-05-29 03:31:12', '2026-05-29 03:31:12', 3);
INSERT INTO `users` VALUES (6, 'Dewi Lestari', 'kabag_perencanaan@pdam.com', 'kabag', NULL, '$2y$12$Ki8rbARKL9cSDLmRDUoVz.Ar2E3aZa.rqQhKF5Odsw9VwDPJ6sp/i', NULL, '2026-05-29 03:31:12', '2026-05-29 03:31:12', 4);
INSERT INTO `users` VALUES (7, 'Hendra Gunawan', 'kepala_cabang@pdam.com', 'kabag', NULL, '$2y$12$edOw4eSvgHlxthUj1pNcpuEJQGGdsW4s3VT8Hzp8f9ELcGPDNdZCy', NULL, '2026-05-29 03:31:12', '2026-05-29 03:31:12', 5);
INSERT INTO `users` VALUES (8, 'Fitriani', 'kasubag_hukum@pdam.com', 'staf', NULL, '$2y$12$em0Nnvb3BXBan4fta9fZMu2iTTT17tJqjIpzCWhDRukCoUyg3MRJe', NULL, '2026-05-29 03:31:12', '2026-05-29 03:31:12', 6);
INSERT INTO `users` VALUES (9, 'Drs. H. Sutrisno', 'direksi@pdam.com', 'admin', NULL, '$2y$12$zjjjm/cQ4L.zTrTk3NNXz.OieUC8QRgHayaR9kVXne8e8kyQjs0x2', NULL, '2026-05-29 03:31:12', '2026-05-29 03:31:12', 7);

SET FOREIGN_KEY_CHECKS = 1;
