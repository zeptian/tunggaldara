ALTER TABLE `user`
ADD `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;

ALTER TABLE `pjr`
ADD `created_at` timestamp NULL,
ADD `updated_at` timestamp NULL AFTER `created_at`;

ALTER TABLE `pjn`
ADD `created_at` timestamp NULL AFTER `jml_positif`
ADD `updated_at` timestamp NULL AFTER `created_at`;

ALTER TABLE `pjb`
ADD `created_at` timestamp NULL,
ADD `updated_at` timestamp NULL AFTER `created_at`;

ALTER TABLE `pe`
ADD `user`  VARCHAR(255) NULL AFTER `ketr`,
ADD `created_at` timestamp NULL AFTER `fogging`,
ADD `updated_at` timestamp NULL AFTER `created_at`;


ALTER TABLE `sicentik`
CHANGE `last_update` `updated_at` timestamp NULL AFTER `created_at`;

ALTER TABLE `pjr`
ADD `jml_perangkap` int(11) NULL AFTER `jml_positif`,
ADD `jml_tikus` int(11) NULL AFTER `jml_perangkap`;


DROP TABLE IF EXISTS `lap_pjn`;
CREATE TABLE `lap_pjn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `puskesmas` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu_ke` int(11) NOT NULL,
  `jml_kelurahan` int(11) NOT NULL,
  `jml_kelurahan_melaksanakan` int(11) NOT NULL,
  `lampiran` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `puskesmas` (`puskesmas`),
  CONSTRAINT `lap_pjn_ibfk_1` FOREIGN KEY (`puskesmas`) REFERENCES `puskesmas` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `lap_pjn_lampiran`;
CREATE TABLE `lap_pjn_lampiran` (
  `id` int(11) NOT NULL,
  `lampiran` mediumblob NOT NULL,
  `file_ext` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pjg`;
CREATE TABLE `pjg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `puskesmas` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu_ke` int(11) NOT NULL,
  `jml_rumah` int(11) NOT NULL,
  `jml_positif` int(11) NOT NULL,
  `larvasida` int(11) NOT NULL,
  `jml_penyuluhan` int(11) NOT NULL,
  `lampiran` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `puskesmas` (`puskesmas`),
  CONSTRAINT `pjg_ibfk_1` FOREIGN KEY (`puskesmas`) REFERENCES `puskesmas` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pjg_lampiran`;
CREATE TABLE `pjg_lampiran` (
  `id` int(11) NOT NULL,
  `lampiran` mediumblob NOT NULL,
  `file_ext` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;