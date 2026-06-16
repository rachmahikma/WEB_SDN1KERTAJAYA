-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jun 2026 pada 15.38
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdn1kertajaya`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `achievements`
--

CREATE TABLE `achievements` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpha') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `score` tinyint(4) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `attendance_score` tinyint(4) DEFAULT 0,
  `attitude_score` tinyint(4) DEFAULT 0,
  `extracurricular_score` tinyint(4) DEFAULT 0,
  `final_score` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `grades`
--

INSERT INTO `grades` (`id`, `student_id`, `subject`, `score`, `semester`, `created_at`, `attendance_score`, `attitude_score`, `extracurricular_score`, `final_score`) VALUES
(1, 70, 'MATEMATIKA', 80, '1', '2026-06-05 03:06:03', 80, 80, 80, 80);

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `class` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT 'Aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `students`
--

INSERT INTO `students` (`id`, `nisn`, `name`, `username`, `class`, `status`, `created_at`) VALUES
(3, '242501001', 'AFIZA HILYA FARZANA', 'siswa67', '2', 'Aktif', '2026-06-02 07:54:44'),
(4, '242501002', 'ALBIZAR AFKA', 'siswa66', '2', 'Aktif', '2026-06-02 07:54:44'),
(5, '242501003', 'ALEA ALZAHIRA SALAHUDIN', 'siswa65', '2', 'Aktif', '2026-06-02 07:54:44'),
(6, '242501004', 'ALESHA BALQIS HIBATILLAH', 'siswa64', '2', 'Aktif', '2026-06-02 07:54:44'),
(7, '242501005', 'ALESHA CAHYA SYAFADIRA', 'siswa63', '2', 'Aktif', '2026-06-02 07:54:44'),
(8, '242501006', 'ALMAIRA ATHAYA SOPIAN', 'siswa62', '2', 'Aktif', '2026-06-02 07:54:44'),
(9, '242501007', 'ALMIRA ANINDIA BALQIS', 'siswa61', '2', 'Aktif', '2026-06-02 07:54:44'),
(10, '242501008', 'ALYA ZAHRA RATIFA', 'siswa60', '2', 'Aktif', '2026-06-02 07:54:44'),
(11, '242501009', 'ARESHA NAZLA FAUZIA', 'siswa59', '2', 'Aktif', '2026-06-02 07:54:44'),
(12, '242501010', 'ARMA PUTRANA CHANDRA', 'siswa58', '2', 'Aktif', '2026-06-02 07:54:44'),
(13, '242501011', 'ARSEN VIRENDRA MUZAMILL', 'siswa57', '2', 'Aktif', '2026-06-02 07:54:44'),
(14, '242501012', 'ARSHILA ADREENA PUTRI', 'siswa56', '2', 'Aktif', '2026-06-02 07:54:44'),
(15, '242501013', 'ARVINO KHALIL ARSHAKA', 'siswa55', '2', 'Aktif', '2026-06-02 07:54:44'),
(16, '242501014', 'ASKARA LANGIT BIRU', 'siswa54', '2', 'Aktif', '2026-06-02 07:54:44'),
(17, '242501015', 'ATHAR RIZKY YUDHISTIRA', 'siswa53', '2', 'Aktif', '2026-06-02 07:54:44'),
(18, '242501016', 'AULIA PUTRI ALMAHYRA', 'siswa52', '2', 'Aktif', '2026-06-02 07:54:44'),
(19, '242501017', 'AULIAN ARFAN RAMADHAN', 'siswa51', '2', 'Aktif', '2026-06-02 07:54:44'),
(20, '242501018', 'AZKADINA SYAHIRA CAHYANI', 'siswa50', '2', 'Aktif', '2026-06-02 07:54:44'),
(21, '242501019', 'CANTIKA NEFA OKTAVIANI', 'siswa49', '2', 'Aktif', '2026-06-02 07:54:44'),
(22, '242501020', 'DAMAILA DESANYA', 'siswa48', '2', 'Aktif', '2026-06-02 07:54:44'),
(23, '242501021', 'DAME ROTUA SITINJAK', 'siswa47', '2', 'Aktif', '2026-06-02 07:54:44'),
(24, '242501022', 'DIG ARKANA RUCITA SATYAWANDA', 'siswa46', '2', 'Aktif', '2026-06-02 07:54:44'),
(25, '242501023', 'FAZA MALIK SATRIANDI', 'siswa45', '2', 'Aktif', '2026-06-02 07:54:44'),
(26, '242501024', 'FHIORENZA ZHEA ALMAIRA', 'siswa44', '2', 'Aktif', '2026-06-02 07:54:44'),
(27, '242501025', 'GHANIA AULIA NISA', 'siswa43', '2', 'Aktif', '2026-06-02 07:54:44'),
(28, '242501026', 'GIANI FADLATUZZAHRA', 'siswa42', '2', 'Aktif', '2026-06-02 07:54:44'),
(29, '242501027', 'HAFIZH AL FATIH FIRDAUS', 'siswa41', '2', 'Aktif', '2026-06-02 07:54:44'),
(30, '242501028', 'IZZ SHAQUILLE AMEEKA', 'siswa40', '2', 'Aktif', '2026-06-02 07:54:44'),
(31, '242501029', 'JIHAN OKTAVIANI', 'siswa39', '2', 'Aktif', '2026-06-02 07:54:44'),
(32, '242501030', 'KAINDRA ANRIYAN PUTRA', 'siswa38', '2', 'Aktif', '2026-06-02 07:54:44'),
(33, '242501031', 'KANASYA SABIYA AZMI', 'siswa37', '2', 'Aktif', '2026-06-02 07:54:44'),
(34, '242501032', 'KHUMAIRA QUROTTA AINUN', 'siswa36', '2', 'Aktif', '2026-06-02 07:54:44'),
(35, '242501033', 'KIM BARIQ ABDULLAH', 'siswa35', '2', 'Aktif', '2026-06-02 07:54:44'),
(36, '242501034', 'LASHIRA GABRIELA NOVYANTI', 'siswa34', '2', 'Aktif', '2026-06-02 07:54:44'),
(37, '242501035', 'M DZAKY AMANI SAEPUDIN', 'siswa33', '2', 'Aktif', '2026-06-02 07:54:44'),
(38, '242501036', 'MEISHA NAZHA RAZITHA', 'siswa32', '2', 'Aktif', '2026-06-02 07:54:44'),
(39, '242501037', 'MOCHAMAD HARIRI YUDIKA', 'siswa31', '2', 'Aktif', '2026-06-02 07:54:44'),
(40, '242501038', 'MOCHAMMAD ROYYAN ARCANDRA', 'siswa30', '2', 'Aktif', '2026-06-02 07:54:44'),
(41, '242501039', 'MUHAMAD ARKAN WIJAYA', 'siswa29', '2', 'Aktif', '2026-06-02 07:54:44'),
(42, '242501040', 'MUHAMAD ARVINO NAZRIL ALFARIZI', 'siswa28', '2', 'Aktif', '2026-06-02 07:54:44'),
(43, '242501041', 'MUHAMAD IRFAN', 'siswa27', '2', 'Aktif', '2026-06-02 07:54:44'),
(44, '242501042', 'MUHAMMAD HAFIZH', 'siswa26', '2', 'Aktif', '2026-06-02 07:54:44'),
(45, '242501043', 'MUHAMMAD IRSYAD RUKANDI', 'siswa25', '2', 'Aktif', '2026-06-02 07:54:44'),
(46, '242501044', 'MUHAMMAD NEVAN AL FAHREZY', 'siswa24', '2', 'Aktif', '2026-06-02 07:54:44'),
(47, '242501045', 'MUHAMMAD RIZKI AL AKBAR', 'siswa23', '2', 'Aktif', '2026-06-02 07:54:44'),
(48, '242501046', 'NABILA FITRI RAMADANI', 'siswa22', '2', 'Aktif', '2026-06-02 07:54:44'),
(49, '242501047', 'NAFEEZA NAZMA AZZAHRO', 'siswa21', '2', 'Aktif', '2026-06-02 07:54:44'),
(50, '242501048', 'NAFIZA RAHMANIA', 'siswa20', '2', 'Aktif', '2026-06-02 07:54:44'),
(51, '242501049', 'NAYYARA ABILA QIANA', 'siswa19', '2', 'Aktif', '2026-06-02 07:54:44'),
(52, '242501050', 'NAZWA NABILA SAPUTRI', 'siswa18', '2', 'Aktif', '2026-06-02 07:54:44'),
(53, '242501051', 'QIANA NASTUSHA GHAIDA AFSHEEN', 'siswa17', '2', 'Aktif', '2026-06-02 07:54:44'),
(54, '242501052', 'RAANIYAH AZAHRA KHAIRINA', 'siswa16', '2', 'Aktif', '2026-06-02 07:54:44'),
(55, '242501053', 'RADITYA AL FARIZIQ', 'siswa15', '2', 'Aktif', '2026-06-02 07:54:44'),
(56, '242501054', 'RAESHA SYIFA ADREENA', 'siswa14', '2', 'Aktif', '2026-06-02 07:54:44'),
(57, '242501055', 'RAFFASYA AZKA ARSALAN', 'siswa13', '2', 'Aktif', '2026-06-02 07:54:44'),
(58, '242501056', 'RAFKA FATHIAN ALTHAFF', 'siswa12', '2', 'Aktif', '2026-06-02 07:54:44'),
(59, '242501057', 'RAI ARYAJAYA ISMAIL', 'siswa11', '2', 'Aktif', '2026-06-02 07:54:44'),
(60, '242501058', 'RAISS A NUR AZQIYAA SUGRIYONO', 'siswa10', '2', 'Aktif', '2026-06-02 07:54:44'),
(61, '242501059', 'REISA VITARIA', 'siswa9', '2', 'Aktif', '2026-06-02 07:54:44'),
(62, '242501060', 'SHABIRA MARYAM ZARTHYN', 'siswa8', '2', 'Aktif', '2026-06-02 07:54:44'),
(63, '242501061', 'SHILVIANI NAURA PUTRI', 'siswa7', '2', 'Aktif', '2026-06-02 07:54:44'),
(64, '242501062', 'SYAFIRA NADIYA PUTRI', 'siswa6', '2', 'Aktif', '2026-06-02 07:54:44'),
(65, '242501063', 'TYO KENZIE HAMIZAN', 'siswa5', '2', 'Aktif', '2026-06-02 07:54:44'),
(66, '242501064', 'UMAR DANIYAL WIJAYA', 'siswa4', '2', 'Aktif', '2026-06-02 07:54:44'),
(67, '242501065', 'VIONA ALMAHERA SAFWANA', 'siswa3', '2', 'Aktif', '2026-06-02 07:54:44'),
(68, '242501066', 'YUNAN AL KARIM YUSUF', 'siswa2', '2', 'Aktif', '2026-06-02 07:54:44'),
(69, '242501067', 'ZHIANA NANDARA ARSYTA', 'siswa1', '2', 'Aktif', '2026-06-02 07:54:44'),
(70, '242501068', 'M RAZIQ AL MALIK', 'siswa', '2', 'Aktif', '2026-06-02 07:54:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru','kepala','siswa') NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`, `created_at`) VALUES
(1, 'admin', 'admin123', 'admin', 'Administrator', '2026-06-02 04:07:54'),
(2, 'guru', 'guru123', 'guru', 'Guru Pengajar', '2026-06-02 04:07:54'),
(3, 'kepala', 'kepala123', 'kepala', 'Kepala Sekolah', '2026-06-02 04:07:54'),
(6, 'siswa', '242501068', 'siswa', 'M RAZIQ AL MALIK', '2026-06-15 06:49:36'),
(7, 'siswa1', '242501067', 'siswa', 'ZHIANA NANDARA ARSYTA', '2026-06-15 06:49:36'),
(8, 'siswa2', '242501066', 'siswa', 'YUNAN AL KARIM YUSUF', '2026-06-15 06:49:36'),
(9, 'siswa3', '242501065', 'siswa', 'VIONA ALMAHERA SAFWANA', '2026-06-15 06:49:36'),
(10, 'siswa4', '242501064', 'siswa', 'UMAR DANIYAL WIJAYA', '2026-06-15 06:49:36'),
(11, 'siswa5', '242501063', 'siswa', 'TYO KENZIE HAMIZAN', '2026-06-15 06:49:36'),
(12, 'siswa6', '242501062', 'siswa', 'SYAFIRA NADIYA PUTRI', '2026-06-15 06:49:36'),
(13, 'siswa7', '242501061', 'siswa', 'SHILVIANI NAURA PUTRI', '2026-06-15 06:49:36'),
(14, 'siswa8', '242501060', 'siswa', 'SHABIRA MARYAM ZARTHYN', '2026-06-15 06:49:36'),
(15, 'siswa9', '242501059', 'siswa', 'REISA VITARIA', '2026-06-15 06:49:36'),
(16, 'siswa10', '242501058', 'siswa', 'RAISS A NUR AZQIYAA SUGRIYONO', '2026-06-15 06:49:36'),
(17, 'siswa11', '242501057', 'siswa', 'RAI ARYAJAYA ISMAIL', '2026-06-15 06:49:36'),
(18, 'siswa12', '242501056', 'siswa', 'RAFKA FATHIAN ALTHAFF', '2026-06-15 06:49:36'),
(19, 'siswa13', '242501055', 'siswa', 'RAFFASYA AZKA ARSALAN', '2026-06-15 06:49:36'),
(20, 'siswa14', '242501054', 'siswa', 'RAESHA SYIFA ADREENA', '2026-06-15 06:49:36'),
(21, 'siswa15', '242501053', 'siswa', 'RADITYA AL FARIZIQ', '2026-06-15 06:49:36'),
(22, 'siswa16', '242501052', 'siswa', 'RAANIYAH AZAHRA KHAIRINA', '2026-06-15 06:49:36'),
(23, 'siswa17', '242501051', 'siswa', 'QIANA NASTUSHA GHAIDA AFSHEEN', '2026-06-15 06:49:36'),
(24, 'siswa18', '242501050', 'siswa', 'NAZWA NABILA SAPUTRI', '2026-06-15 06:49:36'),
(25, 'siswa19', '242501049', 'siswa', 'NAYYARA ABILA QIANA', '2026-06-15 06:49:36'),
(26, 'siswa20', '242501048', 'siswa', 'NAFIZA RAHMANIA', '2026-06-15 06:49:36'),
(27, 'siswa21', '242501047', 'siswa', 'NAFEEZA NAZMA AZZAHRO', '2026-06-15 06:49:36'),
(28, 'siswa22', '242501046', 'siswa', 'NABILA FITRI RAMADANI', '2026-06-15 06:49:36'),
(29, 'siswa23', '242501045', 'siswa', 'MUHAMMAD RIZKI AL AKBAR', '2026-06-15 06:49:36'),
(30, 'siswa24', '242501044', 'siswa', 'MUHAMMAD NEVAN AL FAHREZY', '2026-06-15 06:49:36'),
(31, 'siswa25', '242501043', 'siswa', 'MUHAMMAD IRSYAD RUKANDI', '2026-06-15 06:49:36'),
(32, 'siswa26', '242501042', 'siswa', 'MUHAMMAD HAFIZH', '2026-06-15 06:49:36'),
(33, 'siswa27', '242501041', 'siswa', 'MUHAMAD IRFAN', '2026-06-15 06:49:36'),
(34, 'siswa28', '242501040', 'siswa', 'MUHAMAD ARVINO NAZRIL ALFARIZI', '2026-06-15 06:49:36'),
(35, 'siswa29', '242501039', 'siswa', 'MUHAMAD ARKAN WIJAYA', '2026-06-15 06:49:36'),
(36, 'siswa30', '242501038', 'siswa', 'MOCHAMMAD ROYYAN ARCANDRA', '2026-06-15 06:49:36'),
(37, 'siswa31', '242501037', 'siswa', 'MOCHAMAD HARIRI YUDIKA', '2026-06-15 06:49:36'),
(38, 'siswa32', '242501036', 'siswa', 'MEISHA NAZHA RAZITHA', '2026-06-15 06:49:37'),
(39, 'siswa33', '242501035', 'siswa', 'M DZAKY AMANI SAEPUDIN', '2026-06-15 06:49:37'),
(40, 'siswa34', '242501034', 'siswa', 'LASHIRA GABRIELA NOVYANTI', '2026-06-15 06:49:37'),
(41, 'siswa35', '242501033', 'siswa', 'KIM BARIQ ABDULLAH', '2026-06-15 06:49:37'),
(42, 'siswa36', '242501032', 'siswa', 'KHUMAIRA QUROTTA AINUN', '2026-06-15 06:49:37'),
(43, 'siswa37', '242501031', 'siswa', 'KANASYA SABIYA AZMI', '2026-06-15 06:49:37'),
(44, 'siswa38', '242501030', 'siswa', 'KAINDRA ANRIYAN PUTRA', '2026-06-15 06:49:37'),
(45, 'siswa39', '242501029', 'siswa', 'JIHAN OKTAVIANI', '2026-06-15 06:49:37'),
(46, 'siswa40', '242501028', 'siswa', 'IZZ SHAQUILLE AMEEKA', '2026-06-15 06:49:37'),
(47, 'siswa41', '242501027', 'siswa', 'HAFIZH AL FATIH FIRDAUS', '2026-06-15 06:49:37'),
(48, 'siswa42', '242501026', 'siswa', 'GIANI FADLATUZZAHRA', '2026-06-15 06:49:37'),
(49, 'siswa43', '242501025', 'siswa', 'GHANIA AULIA NISA', '2026-06-15 06:49:37'),
(50, 'siswa44', '242501024', 'siswa', 'FHIORENZA ZHEA ALMAIRA', '2026-06-15 06:49:37'),
(51, 'siswa45', '242501023', 'siswa', 'FAZA MALIK SATRIANDI', '2026-06-15 06:49:37'),
(52, 'siswa46', '242501022', 'siswa', 'DIG ARKANA RUCITA SATYAWANDA', '2026-06-15 06:49:37'),
(53, 'siswa47', '242501021', 'siswa', 'DAME ROTUA SITINJAK', '2026-06-15 06:49:37'),
(54, 'siswa48', '242501020', 'siswa', 'DAMAILA DESANYA', '2026-06-15 06:49:37'),
(55, 'siswa49', '242501019', 'siswa', 'CANTIKA NEFA OKTAVIANI', '2026-06-15 06:49:37'),
(56, 'siswa50', '242501018', 'siswa', 'AZKADINA SYAHIRA CAHYANI', '2026-06-15 06:49:37'),
(57, 'siswa51', '242501017', 'siswa', 'AULIAN ARFAN RAMADHAN', '2026-06-15 06:49:37'),
(58, 'siswa52', '242501016', 'siswa', 'AULIA PUTRI ALMAHYRA', '2026-06-15 06:49:37'),
(59, 'siswa53', '242501015', 'siswa', 'ATHAR RIZKY YUDHISTIRA', '2026-06-15 06:49:37'),
(60, 'siswa54', '242501014', 'siswa', 'ASKARA LANGIT BIRU', '2026-06-15 06:49:37'),
(61, 'siswa55', '242501013', 'siswa', 'ARVINO KHALIL ARSHAKA', '2026-06-15 06:49:37'),
(62, 'siswa56', '242501012', 'siswa', 'ARSHILA ADREENA PUTRI', '2026-06-15 06:49:37'),
(63, 'siswa57', '242501011', 'siswa', 'ARSEN VIRENDRA MUZAMILL', '2026-06-15 06:49:37'),
(64, 'siswa58', '242501010', 'siswa', 'ARMA PUTRANA CHANDRA', '2026-06-15 06:49:37'),
(65, 'siswa59', '242501009', 'siswa', 'ARESHA NAZLA FAUZIA', '2026-06-15 06:49:37'),
(66, 'siswa60', '242501008', 'siswa', 'ALYA ZAHRA RATIFA', '2026-06-15 06:49:37'),
(67, 'siswa61', '242501007', 'siswa', 'ALMIRA ANINDIA BALQIS', '2026-06-15 06:49:37'),
(68, 'siswa62', '242501006', 'siswa', 'ALMAIRA ATHAYA SOPIAN', '2026-06-15 06:49:37'),
(69, 'siswa63', '242501005', 'siswa', 'ALESHA CAHYA SYAFADIRA', '2026-06-15 06:49:37'),
(70, 'siswa64', '242501004', 'siswa', 'ALESHA BALQIS HIBATILLAH', '2026-06-15 06:49:37'),
(71, 'siswa65', '242501003', 'siswa', 'ALEA ALZAHIRA SALAHUDIN', '2026-06-15 06:49:37'),
(72, 'siswa66', '242501002', 'siswa', 'ALBIZAR AFKA', '2026-06-15 06:49:37'),
(73, 'siswa67', '242501001', 'siswa', 'AFIZA HILYA FARZANA', '2026-06-15 06:49:37');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indeks untuk tabel `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indeks untuk tabel `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indeks untuk tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `achievements`
--
ALTER TABLE `achievements`
  ADD CONSTRAINT `achievements_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
