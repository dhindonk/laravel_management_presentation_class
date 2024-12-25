-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 03 Des 2024 pada 21.48
-- Versi server: 10.11.9-MariaDB-cll-lve
-- Versi PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dhiw7225_quiz`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_presentasis`
--

CREATE TABLE `jadwal_presentasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_presentasi` date NOT NULL,
  `waktu_presentasi` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal_presentasis`
--

INSERT INTO `jadwal_presentasis` (`id`, `tanggal_presentasi`, `waktu_presentasi`, `created_at`, `updated_at`) VALUES
(1, '2024-01-01', '08:00:00', '2024-11-22 02:17:02', '2024-11-22 02:17:02'),
(2, '2024-01-01', '10:00:00', '2024-11-22 02:17:02', '2024-11-22 02:17:02'),
(3, '2024-01-01', '13:00:00', '2024-11-22 02:17:02', '2024-11-22 02:17:02'),
(4, '2024-11-27', '12:38:00', '2024-11-22 19:35:54', '2024-11-22 19:35:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `penanggung_jawab` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `penanggung_jawab`, `created_at`, `updated_at`) VALUES
(1, 'IF-A', 'Dosen A', '2024-11-22 02:17:02', '2024-11-22 02:17:02'),
(2, 'IF-B', 'Dosen B', '2024-11-22 02:17:02', '2024-11-22 02:17:02'),
(3, 'IF-C', 'Dosen C', '2024-11-22 02:17:02', '2024-11-22 02:17:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompoks`
--

CREATE TABLE `kelompoks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `judul_proyek` varchar(255) NOT NULL,
  `ketua` varchar(255) NOT NULL,
  `npm_ketua` varchar(255) NOT NULL,
  `anggota` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`anggota`)),
  `npm_anggota` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`npm_anggota`)),
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `jadwal_presentasi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lab_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('Pending','Diterima','Ditolak') NOT NULL DEFAULT 'Pending',
  `selesai` tinyint(1) NOT NULL DEFAULT 0,
  `jadwal_lab_opened` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `penanggung_jawab` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelompoks`
--

INSERT INTO `kelompoks` (`id`, `user_id`, `judul_proyek`, `ketua`, `npm_ketua`, `anggota`, `npm_anggota`, `kelas_id`, `jadwal_presentasi_id`, `lab_id`, `status`, `selesai`, `jadwal_lab_opened`, `created_at`, `updated_at`, `penanggung_jawab`) VALUES
(12, 2, 'Mobile Apps', 'Ketua', '1318', '\"[\\\"FAShaj\\\"]\"', '\"[\\\"19193\\\"]\"', 2, NULL, NULL, 'Diterima', 0, 1, '2024-11-25 05:10:37', '2024-11-25 05:10:45', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `labs`
--

CREATE TABLE `labs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lab` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `labs`
--

INSERT INTO `labs` (`id`, `nama_lab`, `created_at`, `updated_at`) VALUES
(1, 'Lab Data Science', '2024-11-22 02:17:02', '2024-11-22 02:17:02'),
(2, 'Lab Multimedia', '2024-11-22 02:17:02', '2024-11-22 02:17:02'),
(3, 'Lab Sistem Cerdas', '2024-11-22 02:17:02', '2024-11-22 02:17:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_10_15_144655_create_labs_table', 1),
(5, '2024_10_15_145152_create_jadwal_presentasis_table', 1),
(6, '2024_10_15_145153_create_kelas_table', 1),
(7, '2024_10_15_145154_create_kelompoks_table', 1),
(8, '2024_10_15_145239_create_nilais_table', 1),
(9, '2024_10_15_154846_add_penanggung_jawab_to_kelompoks_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilais`
--

CREATE TABLE `nilais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelompok_id` bigint(20) UNSIGNED NOT NULL,
  `nama_penilai` varchar(255) NOT NULL,
  `penilaian_presentasi` int(11) NOT NULL,
  `penilaian_materi` int(11) NOT NULL,
  `penilaian_diskusi` int(11) NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8iwokqOxH0GIG5xYLm0KQcmgRhy8ymMXvTwv9mTi', NULL, '205.210.31.9', 'Expanse, a Palo Alto Networks company, searches across the global IPv4 space multiple times per day to identify customers&#39; presences on the Internet. If you would like to be excluded from our scans, please send IP addresses/domains to: scaninfo@paloaltonetworks.com', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienVIWEttWG9wYjVBSHlhSkc1clpZRkRzMnkzUU9HQ09Fd3E4dnVLbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vZGhpbnN0YWcubXkuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733178492),
('CEE38zTgd7Lhk1yqNCOq1vDm13bJLz2UVmyEaMjr', NULL, '217.114.43.197', 'python-requests/2.32.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMkc3ZHBXWEFKYm1ORjBCelh3cUsyd2FnaHB2UVUyaFNlaUhHajRnRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9kaGluc3RhZy5teS5pZC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733144468),
('EnUcu1CBc42DphyBwcChKUitZWUHeCz4XzJambaF', NULL, '114.10.76.214', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaU12MTJOaDVxNGJJek5ZZFZKWmhyV3ZFQmNWRFBGVlFualhXVFhTcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vZGhpbnN0YWcubXkuaWQvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733230641),
('Hr4rKU7UC9pmsimzuFRow7RJN98KrRCeCpfWgKsD', NULL, '103.247.9.9', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSUFhU3FPcHl2R2F3NFd1QlA4RXpXeEQ2VFpYQmV1V0RLRVFMS3d5UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9kaGluc3RhZy5teS5pZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733176619),
('kX71K7WXHwivM5YO3yCIUzm5jtNN2umrCA4upVep', NULL, '103.247.9.9', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUDV3TmxBZ2ZBdTVCSkJNWUxtZWg3dDBiMXZGQ0lmYjNxU2tIbkFBMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9kaGluc3RhZy5teS5pZC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733176619),
('w1om0s7qsvobuo4ZqHgM80rVTZYS6tgR5RG2743B', NULL, '113.233.227.123', 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E; QQBrowser/7.0.3698.400)', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZXJ6SWxoUUdpYXZxdzdoRFUyblhvazhPQ3FYUHVxQ2hJWE9IRndNTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1733110432);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','mahasiswa') NOT NULL DEFAULT 'mahasiswa',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$12$ff1gNnmBbwVDEle1nzkPEOhiMqVeSlszNzEit83xgbrUNDDAl0Os2', 'admin', NULL, '2024-11-22 02:17:01', '2024-11-22 02:17:01'),
(2, 'Mahasiswa', 'mahasiswa@gmail.com', NULL, '$2y$12$NfsbQumTLaBzfR4WiKs.tuVRTkL5oBa0bFb2o6RT4PawyCXICJ5Dm', 'mahasiswa', NULL, '2024-11-22 02:17:02', '2024-11-22 02:17:02'),
(3, 'Ucup', 'ucup@gmail.com', NULL, '$2y$12$bJyCAcKRamzx6lbdkkupFOzbnijZAHsIEszEIyhI5nIq3yr0RTp4i', 'mahasiswa', NULL, '2024-11-22 02:17:32', '2024-11-22 02:17:32'),
(4, 'Muhammad Arsal', 'cobaya@gmail.com', NULL, '$2y$12$oW3Hac1G74TJvVyOUjCW4efQ2Dekbf.dwHbgqbGN4UAXsTuoxkzrm', 'mahasiswa', NULL, '2024-11-24 23:46:18', '2024-11-24 23:46:18'),
(5, 'Dhin', 'dhin@gmail.com', NULL, '$2y$12$UVs5s9f8JlIVnR2lud5fKec99BkXR1KDjN0afVV5vfVwxfwyvo40C', 'mahasiswa', NULL, '2024-11-25 03:41:49', '2024-11-25 03:41:49');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jadwal_presentasis`
--
ALTER TABLE `jadwal_presentasis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelompoks`
--
ALTER TABLE `kelompoks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelompoks_user_id_foreign` (`user_id`),
  ADD KEY `kelompoks_kelas_id_foreign` (`kelas_id`),
  ADD KEY `kelompoks_jadwal_presentasi_id_foreign` (`jadwal_presentasi_id`),
  ADD KEY `kelompoks_lab_id_foreign` (`lab_id`);

--
-- Indeks untuk tabel `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `labs_nama_lab_unique` (`nama_lab`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilais`
--
ALTER TABLE `nilais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilais_kelompok_id_foreign` (`kelompok_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal_presentasis`
--
ALTER TABLE `jadwal_presentasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kelompoks`
--
ALTER TABLE `kelompoks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `labs`
--
ALTER TABLE `labs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `nilais`
--
ALTER TABLE `nilais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kelompoks`
--
ALTER TABLE `kelompoks`
  ADD CONSTRAINT `kelompoks_jadwal_presentasi_id_foreign` FOREIGN KEY (`jadwal_presentasi_id`) REFERENCES `jadwal_presentasis` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kelompoks_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `kelompoks_lab_id_foreign` FOREIGN KEY (`lab_id`) REFERENCES `labs` (`id`),
  ADD CONSTRAINT `kelompoks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `nilais`
--
ALTER TABLE `nilais`
  ADD CONSTRAINT `nilais_kelompok_id_foreign` FOREIGN KEY (`kelompok_id`) REFERENCES `kelompoks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
