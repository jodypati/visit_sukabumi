-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07 Mei 2016 pada 13.42
-- Versi Server: 10.1.10-MariaDB
-- PHP Version: 7.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imunisasi`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getVaccinationSchedule` ()  NO SQL
SELECT users.name parent,children.name children,TIMESTAMPDIFF(MONTH,children.birthday,CURDATE()) age_month, attributes.name imunisasi,reminders.message,users.gcm_id
FROM users,children,attributes,reminders
where users.id=children.user_id and 
reminders.attribute_id = attributes.id and 
reminders.month = TIMESTAMPDIFF(MONTH,children.birthday,CURDATE()) and 
children.id NOT IN (
    select vaccine_histories.child_id 
    from vaccine_histories 
    where vaccine_histories.attribute_id = attributes.id and
    TIMESTAMPDIFF(MONTH,children.birthday,CURDATE()) = TIMESTAMPDIFF(MONTH,children.birthday,vaccine_histories.date)
)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `attributes`
--

CREATE TABLE `attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `attributes`
--

INSERT INTO `attributes` (`id`, `type`, `name`, `created_at`, `updated_at`) VALUES
(1, 'VCN', 'Polio', '2016-04-22 23:44:02', '2016-04-22 23:44:02'),
(2, 'VCN', 'BCG', '2016-04-22 23:52:31', '2016-04-22 23:52:31'),
(3, 'VCN', 'Influenza', '2016-04-27 00:08:51', '2016-04-27 00:08:51'),
(4, 'VCN', 'Hepatitis B', '2016-05-05 00:21:02', '2016-05-05 00:21:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `children`
--

CREATE TABLE `children` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `birthplace` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `FileNameFoto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PathFoto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('L','P') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `children`
--

INSERT INTO `children` (`id`, `user_id`, `birthplace`, `birthday`, `weight`, `height`, `FileNameFoto`, `PathFoto`, `gender`, `created_at`, `updated_at`, `name`) VALUES
(1, 1, 'Bandung', '2016-03-25', '3.00', '20.00', 'C:\\xampp\\tmp\\php7D76.tmp', '/images/children/1461589591.jpg', 'L', '2016-04-22 22:47:58', '2016-04-25 06:06:31', 'Sausa junior'),
(2, 2, 'Bandung', '2016-01-25', '4.00', '17.00', 'C:\\xampp\\tmp\\php6320.tmp', '/images/children/1461589453.jpg', 'P', '2016-04-25 06:04:13', '2016-04-25 06:04:13', 'Fabregas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_100000_create_password_resets_table', 1),
('2016_04_21_043540_create_attributes_table', 1),
('2016_04_21_050239_create_users_table', 1),
('2016_04_21_060544_create_children_table', 1),
('2016_04_21_064724_create_vaccineHistory_table', 1),
('2016_04_21_052853_add_verification_to_users_table', 2),
('2016_04_21_064031_create_reminders_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reminders`
--

CREATE TABLE `reminders` (
  `id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `month` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `reminders`
--

INSERT INTO `reminders` (`id`, `attribute_id`, `message`, `month`, `created_at`, `updated_at`) VALUES
(1, 1, 'Vaksin polio duls lah', 0, '2016-05-05 00:12:08', '2016-05-05 00:12:08'),
(2, 4, 'Vaksin Hepatitis B duls lah', 0, '2016-05-05 00:21:50', '2016-05-05 00:21:50'),
(3, 4, 'Vaksin Hepatitis B duls lah', 1, '2016-05-05 00:22:01', '2016-05-05 00:22:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('L','P') COLLATE utf8_unicode_ci NOT NULL,
  `avatarUrl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `statusInfo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tempatLahir` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tglLahir` date NOT NULL,
  `imgUsrFileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imgUsrFilePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `statusInfoUpAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gcm_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `avatarUrl`, `country`, `state`, `address`, `phone`, `statusInfo`, `tempatLahir`, `tglLahir`, `imgUsrFileName`, `imgUsrFilePath`, `statusInfoUpAt`, `remember_token`, `created_at`, `updated_at`, `verified`, `verification_token`, `gcm_id`) VALUES
(1, 'Sausa Jodypati', 'jodypati@gmail.com', '$2y$10$qOFAnJtNMja5sA4tOPDtle0fhyYDSiD/W5d8HpCEH2J3uePDqIePm', 'L', '', 'Indonesia', 'Jawa Barat', 'PBB F30 Bojongsoang Kab. Bandung', '085647141907', '', 'Surakarta', '1992-03-25', '1461835644.jpg', '/images/parents/1461835644.jpg', '2016-05-07 11:37:46', '92WGxOeIPkZ1qPvEHgYPXtoykbugGjT8DwkZklV4mw5JbjZBTSFMtyWeEnnc', '2016-04-22 02:51:54', '2016-05-07 04:37:46', 0, NULL, ''),
(2, 'Nanda W Perdana', 'nanda@gmail.com', '$2y$10$U5euoH1ewzSrVUdNoLUMZ.5q2k.3tnrOIgyp0lf8HiVcB.2G21gSS', 'L', '', 'Indonesia', 'Jawa Barat', 'Ciganitri', '085647141907', '', 'Cilacap', '1992-04-01', '1461588210.png', '/images/parents/1461588210.png', '2016-04-25 12:51:48', NULL, '2016-04-25 05:43:30', '2016-04-25 05:43:30', 0, NULL, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vaccine_histories`
--

CREATE TABLE `vaccine_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `child_id` int(10) UNSIGNED NOT NULL,
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `vaccine_histories`
--

INSERT INTO `vaccine_histories` (`id`, `child_id`, `attribute_id`, `date`, `place`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '2016-03-25', 'RS DR. Hasan Sadikin', '2016-04-23 00:40:51', '2016-04-23 01:19:50'),
(3, 1, 2, '2016-03-25', 'RS DR. Hasan Sadikin', '2016-04-23 01:32:47', '2016-04-25 08:37:16'),
(8, 1, 4, '2016-03-26', 'RS DR. Hasan Sadikin', '2016-04-23 01:43:32', '2016-05-07 01:35:05'),
(9, 2, 1, '2016-04-25', 'RS DR. Hasan Sadikin', '2016-04-25 08:37:36', '2016-04-25 08:37:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `children_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reminders_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vaccine_histories`
--
ALTER TABLE `vaccine_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vaccinehistory_vaccine_id_foreign` (`attribute_id`),
  ADD KEY `vaccinehistory_child_id_foreign` (`child_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vaccine_histories`
--
ALTER TABLE `vaccine_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `children_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reminders`
--
ALTER TABLE `reminders`
  ADD CONSTRAINT `reminders_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `vaccine_histories`
--
ALTER TABLE `vaccine_histories`
  ADD CONSTRAINT `vaccinehistory_child_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vaccinehistory_vaccine_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
