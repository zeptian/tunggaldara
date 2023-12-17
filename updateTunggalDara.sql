ALTER TABLE `pasien`
CHANGE `tgl_lahir` `tgl_lahir` date NULL AFTER `jkl`,
CHANGE `latlong` `latlong` varchar(255) COLLATE 'latin1_swedish_ci' NULL AFTER `ortu`,
ADD `created_at` timestamp NULL AFTER `no_kontak`,
ADD `updated_at` timestamp NULL AFTER `created_at`;

ALTER TABLE `kasus`
CHANGE `idk` `idk` varchar(140) COLLATE 'latin1_swedish_ci' NULL AFTER `id`,
CHANGE `idpe` `idpe` varchar(40) COLLATE 'latin1_swedish_ci' NULL AFTER `idp`,
CHANGE `tegak` `tegak` date NULL AFTER `icdx`,
CHANGE `tgl_lp` `tgl_lp` date NULL AFTER `tegak`,
CHANGE `tgl_ct` `tgl_ct` date NULL AFTER `tgl_lp`,
CHANGE `tgl_sk` `tgl_sk` date NULL AFTER `tgl_ct`,
CHANGE `tgl_rs` `tgl_rs` date NULL AFTER `tgl_sk`,
CHANGE `tgl_verifikasi` `tgl_verifikasi` date NULL AFTER `diag_akhir`,
CHANGE `updated_at` `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP AFTER `created_at`;

ALTER TABLE `kasus`
CHANGE `icdx` `icdx` varchar(10) COLLATE 'latin1_swedish_ci' NULL AFTER `jenis`,
CHANGE `rs` `rs` varchar(100) COLLATE 'latin1_swedish_ci' NULL AFTER `tgl_rs`,
CHANGE `lab` `lab` varchar(255) COLLATE 'latin1_swedish_ci' NULL AFTER `rs`,
CHANGE `sumber` `sumber` varchar(10) COLLATE 'latin1_swedish_ci' NULL AFTER `status`,
CHANGE `panas` `panas` char(1) COLLATE 'latin1_swedish_ci' NULL AFTER `sumber`,
CHANGE `uji_rl` `uji_rl` char(1) COLLATE 'latin1_swedish_ci' NULL AFTER `panas`,
CHANGE `gejala` `gejala` varchar(100) COLLATE 'latin1_swedish_ci' NULL AFTER `uji_rl`,
CHANGE `trombosit` `trombosit` int(11) NULL AFTER `gejala`,
CHANGE `ht_awal` `ht_awal` varchar(100) COLLATE 'latin1_swedish_ci' NULL AFTER `trombosit`,
CHANGE `ht_tegak` `ht_tegak` varchar(100) COLLATE 'latin1_swedish_ci' NULL AFTER `ht_awal`,
CHANGE `hb_tegak` `hb_tegak` varchar(100) COLLATE 'latin1_swedish_ci' NULL AFTER `ht_tegak`,
CHANGE `igg` `igg` varchar(100) COLLATE 'latin1_swedish_ci' NULL AFTER `hb_tegak`,
CHANGE `igm` `igm` varchar(100) COLLATE 'latin1_swedish_ci' NULL AFTER `igg`,
CHANGE `ns1` `ns1` varchar(100) COLLATE 'latin1_swedish_ci' NULL AFTER `igm`,
CHANGE `pemeriksa` `pemeriksa` varchar(100) COLLATE 'latin1_swedish_ci' NULL AFTER `ns1`,
CHANGE `diag_akhir` `diag_akhir` varchar(100) COLLATE 'latin1_swedish_ci' NULL AFTER `pemeriksa`,
CHANGE `updated_at` `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP AFTER `created_at`;

ALTER TABLE `kasus`
ADD `trombosit_awal` int(11) NULL AFTER `gejala`,
CHANGE `trombosit` `trombosit_tegak` int(11) NULL AFTER `trombosit_awal`,
ADD `hb_awal` varchar(100) COLLATE 'latin1_swedish_ci' NULL AFTER `ht_tegak`,
CHANGE `updated_at` `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP AFTER `created_at`;