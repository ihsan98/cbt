-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2021 at 01:28 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siro`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `pm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `password`, `is_active`, `date_created`, `avatar`, `role`, `pm`) VALUES
(12, 'Ngademin', 'admsio.id@gmail.com', '$2y$10$MHzvxSyALIs9ZFOZhcswfeEXqsAg67YrDtP6ofhdfJp.JoThOLvVq', 1, 1620345149, 'default.jpg', 1, 'Whoareyou?');

-- --------------------------------------------------------

--
-- Table structure for table `chat_materi`
--

CREATE TABLE `chat_materi` (
  `id_chat_materi` int(11) NOT NULL,
  `materi` varchar(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `text` longtext NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat_tugas`
--

CREATE TABLE `chat_tugas` (
  `id_chat_tugas` int(11) NOT NULL,
  `tugas` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `text` longtext NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penilaian`
--

CREATE TABLE `detail_penilaian` (
  `id_detail_penilaian` int(11) NOT NULL,
  `id_penilaian` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `id_jawaban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `essay_detail`
--

CREATE TABLE `essay_detail` (
  `id_essay_detail` int(11) NOT NULL,
  `kode_ujian` varchar(100) NOT NULL,
  `soal` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `essay_siswa`
--

CREATE TABLE `essay_siswa` (
  `id_essay_siswa` int(11) NOT NULL,
  `essay_id` int(11) NOT NULL,
  `ujian` varchar(100) NOT NULL,
  `siswa` int(11) NOT NULL,
  `jawaban` longtext DEFAULT NULL,
  `score` int(11) NOT NULL,
  `sudah_dikerjakan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id_file` int(11) NOT NULL,
  `kode_file` varchar(100) NOT NULL,
  `nama_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `guru_kelas` varchar(255) DEFAULT NULL,
  `guru_mapel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `email`, `password`, `role`, `is_active`, `date_created`, `avatar`, `guru_kelas`, `guru_mapel`) VALUES
(14, 'Hartono', 'hartono@gmail.com', '$2y$10$O2JE5Qc8K1USoZohzdBBEudfPtV70YKA3Jm4G0EDMGgK1lEfsQzn2', 3, 1, 1623746688, 'default.jpg', NULL, NULL),
(15, 'ihsan', 'ihsan11.id@gmail.com', '$2y$10$8BFqpR5c95urikaG9h7DW.ZSyDTzxfIT/PH6uqir02sleNQfmg.rG', 3, 1, 1623751493, 'default.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guru_kelas`
--

CREATE TABLE `guru_kelas` (
  `id_guru_kelas` int(11) NOT NULL,
  `guru` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru_kelas`
--

INSERT INTO `guru_kelas` (`id_guru_kelas`, `guru`, `kelas`, `nama_kelas`) VALUES
(14, 13, 10, 'XII IPA 1'),
(15, 15, 12, 'Sistem Operasi 7 A'),
(16, 14, 13, 'Sistem Operasi 7 B');

-- --------------------------------------------------------

--
-- Table structure for table `guru_mapel`
--

CREATE TABLE `guru_mapel` (
  `id_guru_mapel` int(11) NOT NULL,
  `guru` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `nama_mapel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru_mapel`
--

INSERT INTO `guru_mapel` (`id_guru_mapel`, `guru`, `mapel`, `nama_mapel`) VALUES
(11, 13, 4, 'FIsika Peminatan'),
(12, 15, 6, 'Model Transportasi'),
(13, 15, 8, 'Transportasi - Stepping Stone'),
(14, 14, 7, 'Transportasi - MODI'),
(15, 14, 9, 'Transportasi - VAM');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `judul_jawaban` varchar(100) NOT NULL,
  `status_jawaban` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_pertanyaan`, `judul_jawaban`, `status_jawaban`) VALUES
(1, 1, 'Soekarno', 1),
(2, 1, 'Bung Hatta', 0),
(3, 2, 'Megawati', 0),
(4, 2, 'Bung Harto', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(12, 'Sistem Operasi 7 A'),
(13, 'Sistem Operasi 7 B');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`) VALUES
(6, 'Model Transportasi'),
(7, 'Transportasi - MODI'),
(8, 'Transportasi - Stepping Stone'),
(9, 'Transportasi - VAM');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `kode_materi` varchar(100) NOT NULL,
  `nama_materi` varchar(255) NOT NULL,
  `guru` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `text_materi` longtext NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `kode_materi`, `nama_materi`, `guru`, `mapel`, `kelas`, `text_materi`, `date_created`) VALUES
(34, 'xozynIFR', 'Transportasi - Stepping Stone #1', 15, 8, 12, 'Ini adalah materi Stepping Stone. #1 Silahkan dipeklajari dan Dikerjakan Untuk soal nya.', 1623896271),
(35, 'xozynIFR', 'Transportasi - Stepping Stone #1', 15, 8, 12, 'Ini adalah materi Stepping Stone. #1 Silahkan dipeklajari dan Dikerjakan Untuk soal nya.', 1623896279);

-- --------------------------------------------------------

--
-- Table structure for table `materi_siswa`
--

CREATE TABLE `materi_siswa` (
  `id_materi_siswa` int(11) NOT NULL,
  `materi` varchar(100) NOT NULL,
  `kelas` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `siswa` int(11) NOT NULL,
  `dilihat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materi_siswa`
--

INSERT INTO `materi_siswa` (`id_materi_siswa`, `materi`, `kelas`, `mapel`, `siswa`, `dilihat`) VALUES
(16, 'xozynIFR', 12, 8, 1214, 0),
(18, 'xozynIFR', 12, 8, 1214, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_materi` int(11) NOT NULL,
  `id_video` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `tanggal_pengerjaan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `id_video` int(11) NOT NULL,
  `judul_pertanyaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `id_video`, `judul_pertanyaan`) VALUES
(1, 1, 'Siapakah presiden RI ke 1?'),
(2, 1, 'Siapakah presiden RI ke 2?');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `no_induk_siswa` varchar(100) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `kelas` int(11) NOT NULL,
  `role` int(1) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `no_induk_siswa`, `nama_siswa`, `email`, `password`, `jenis_kelamin`, `kelas`, `role`, `is_active`, `date_created`, `avatar`) VALUES
(1213, '12345', 'Fadil Pratama', 'gemail@gmail.com', '$2y$10$uBB92v7P1AFK98nGpfyDbuUyzL7WYA4zsVB1V7YGNvfWDPMseWqV2', 'Laki - Laki', 12, 2, 1, 1623345853, 'default.jpg'),
(1214, '16532561', 'Hasan', 'hasan@gmail.com', '$2y$10$qKA5KVyMFe2BFK8LwOnT5.X0AeNRiLYOOZUhUntz3gjx77ckRZ3Wa', 'Laki - Laki', 12, 2, 1, 1623712914, 'default.jpg'),
(1215, '16532563', 'ihsan', 'gemail.com.gemail@gmail.com', '$2y$10$GvrnT2/mloJbU/tPgK0PduO.9X92yHw8Xb8AhuLwLlZcUl4jGQRFu', 'Laki - Laki', 13, 2, 1, 1623724345, 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `kode_tugas` varchar(100) NOT NULL,
  `kelas` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `guru` int(11) NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `date_created` int(11) NOT NULL,
  `due_date` varchar(255) NOT NULL,
  `date_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tugas_siswa`
--

CREATE TABLE `tugas_siswa` (
  `id_tugas_siswa` int(11) NOT NULL,
  `tugas` varchar(100) NOT NULL,
  `siswa` int(11) NOT NULL,
  `text_siswa` longtext DEFAULT NULL,
  `file_siswa` varchar(100) DEFAULT NULL,
  `date_send` int(11) DEFAULT NULL,
  `is_telat` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `catatan_guru` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL,
  `kode_ujian` varchar(100) NOT NULL,
  `nama_ujian` varchar(255) NOT NULL,
  `guru` int(11) NOT NULL,
  `kelas` int(11) NOT NULL,
  `mapel` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `waktu_mulai` varchar(100) NOT NULL,
  `waktu_berakhir` varchar(100) NOT NULL,
  `jenis_ujian` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ujian_detail`
--

CREATE TABLE `ujian_detail` (
  `id_detail_ujian` int(11) NOT NULL,
  `kode_ujian` varchar(100) NOT NULL,
  `nama_soal` longtext NOT NULL,
  `pg_1` varchar(100) NOT NULL,
  `pg_2` varchar(100) NOT NULL,
  `pg_3` varchar(100) NOT NULL,
  `pg_4` varchar(100) NOT NULL,
  `jawaban` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ujian_siswa`
--

CREATE TABLE `ujian_siswa` (
  `id_ujian_siswa` int(11) NOT NULL,
  `ujian_id` int(11) NOT NULL,
  `ujian` varchar(100) NOT NULL,
  `siswa` int(11) NOT NULL,
  `jawaban` varchar(100) DEFAULT NULL,
  `benar` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id_user_token` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id_user_token`, `email`, `token`, `date_created`) VALUES
(13, 'gemail@gmail.com', 'WfSvBg6TK2pNXJ5ocQauj8tHePhGyC3m', 1623345853),
(14, 'hasan@gmail.com', '5Xp8TBfVcGZPawkQemIJ49bNDnYLH1y3', 1623712914);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id_video` int(11) NOT NULL,
  `id_materi` int(11) NOT NULL,
  `judul_video` varchar(100) NOT NULL,
  `kode_video` varchar(30) NOT NULL,
  `deskripsi_video` text NOT NULL,
  `waktu_kuis` int(11) NOT NULL COMMENT 'Detik pertanyaan akan muncul.',
  `terakhir_diperbarui` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id_video`, `id_materi`, `judul_video`, `kode_video`, `deskripsi_video`, `waktu_kuis`, `terakhir_diperbarui`) VALUES
(1, 34, 'Transportasi dari titik A ke B', '6PvkRXR_FiE', 'PADEPOKAN NUR DZAT SEJATI.\r\nAdalah majlis dzikir solawat SIRRI ALLADUNNI.\r\nDiasuh oleh Gus SAMSUDIN.', 10, '2021-06-20 08:47:46');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_video`
-- (See below for the actual view)
--
CREATE TABLE `v_video` (
`id_video` int(11)
,`id_materi` int(11)
,`kode_materi` varchar(100)
,`nama_materi` varchar(255)
,`id_guru` int(11)
,`nama_guru` varchar(100)
,`avatar` varchar(255)
,`mapel` int(11)
,`kelas` int(11)
,`text_materi` longtext
,`date_created` int(11)
,`judul_video` varchar(100)
,`kode_video` varchar(30)
,`deskripsi_video` text
,`waktu_kuis` int(11)
,`terakhir_diperbarui` timestamp
);

-- --------------------------------------------------------

--
-- Structure for view `v_video`
--
DROP TABLE IF EXISTS `v_video`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_video`  AS SELECT `v`.`id_video` AS `id_video`, `m`.`id_materi` AS `id_materi`, `m`.`kode_materi` AS `kode_materi`, `m`.`nama_materi` AS `nama_materi`, `g`.`id_guru` AS `id_guru`, `g`.`nama_guru` AS `nama_guru`, `g`.`avatar` AS `avatar`, `m`.`mapel` AS `mapel`, `m`.`kelas` AS `kelas`, `m`.`text_materi` AS `text_materi`, `m`.`date_created` AS `date_created`, `v`.`judul_video` AS `judul_video`, `v`.`kode_video` AS `kode_video`, `v`.`deskripsi_video` AS `deskripsi_video`, `v`.`waktu_kuis` AS `waktu_kuis`, `v`.`terakhir_diperbarui` AS `terakhir_diperbarui` FROM ((`video` `v` join `materi` `m`) join `guru` `g`) WHERE `v`.`id_materi` = `m`.`id_materi` AND `m`.`guru` = `g`.`id_guru` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `chat_materi`
--
ALTER TABLE `chat_materi`
  ADD PRIMARY KEY (`id_chat_materi`);

--
-- Indexes for table `chat_tugas`
--
ALTER TABLE `chat_tugas`
  ADD PRIMARY KEY (`id_chat_tugas`);

--
-- Indexes for table `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD PRIMARY KEY (`id_detail_penilaian`),
  ADD KEY `id_penilaian` (`id_penilaian`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`),
  ADD KEY `id_jawaban` (`id_jawaban`);

--
-- Indexes for table `essay_detail`
--
ALTER TABLE `essay_detail`
  ADD PRIMARY KEY (`id_essay_detail`);

--
-- Indexes for table `essay_siswa`
--
ALTER TABLE `essay_siswa`
  ADD PRIMARY KEY (`id_essay_siswa`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  ADD PRIMARY KEY (`id_guru_kelas`);

--
-- Indexes for table `guru_mapel`
--
ALTER TABLE `guru_mapel`
  ADD PRIMARY KEY (`id_guru_mapel`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `materi_siswa`
--
ALTER TABLE `materi_siswa`
  ADD PRIMARY KEY (`id_materi_siswa`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_materi` (`id_materi`),
  ADD KEY `id_video` (`id_video`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_video` (`id_video`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indexes for table `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  ADD PRIMARY KEY (`id_tugas_siswa`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indexes for table `ujian_detail`
--
ALTER TABLE `ujian_detail`
  ADD PRIMARY KEY (`id_detail_ujian`);

--
-- Indexes for table `ujian_siswa`
--
ALTER TABLE `ujian_siswa`
  ADD PRIMARY KEY (`id_ujian_siswa`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_user_token`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`),
  ADD KEY `id_materi` (`id_materi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `chat_materi`
--
ALTER TABLE `chat_materi`
  MODIFY `id_chat_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `chat_tugas`
--
ALTER TABLE `chat_tugas`
  MODIFY `id_chat_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  MODIFY `id_detail_penilaian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `essay_detail`
--
ALTER TABLE `essay_detail`
  MODIFY `id_essay_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `essay_siswa`
--
ALTER TABLE `essay_siswa`
  MODIFY `id_essay_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `guru_kelas`
--
ALTER TABLE `guru_kelas`
  MODIFY `id_guru_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `guru_mapel`
--
ALTER TABLE `guru_mapel`
  MODIFY `id_guru_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `materi_siswa`
--
ALTER TABLE `materi_siswa`
  MODIFY `id_materi_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1216;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  MODIFY `id_tugas_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ujian_detail`
--
ALTER TABLE `ujian_detail`
  MODIFY `id_detail_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `ujian_siswa`
--
ALTER TABLE `ujian_siswa`
  MODIFY `id_ujian_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_user_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penilaian`
--
ALTER TABLE `detail_penilaian`
  ADD CONSTRAINT `detail_penilaian_ibfk_1` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_penilaian_ibfk_2` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_penilaian_ibfk_3` FOREIGN KEY (`id_jawaban`) REFERENCES `jawaban` (`id_jawaban`) ON DELETE CASCADE;

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_video`) REFERENCES `video` (`id_video`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE;

--
-- Constraints for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`id_video`) REFERENCES `video` (`id_video`) ON DELETE CASCADE;

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
