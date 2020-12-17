ALTER TABLE `user`
ADD `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;

ALTER TABLE `pjr`
ADD `created_at` timestamp NULL,
ADD `updated_at` timestamp NULL AFTER `created_at`;

ALTER TABLE `pjn`
CHANGE `submited_at` `created_at` timestamp NULL AFTER `jml_positif`
ADD `updated_at` timestamp NULL AFTER `created_at`;

ALTER TABLE `pjb`
ADD `created_at` timestamp NULL,
ADD `updated_at` timestamp NULL AFTER `created_at`;

ALTER TABLE `pe`
ADD `user`  VARCHAR(255) NULL AFTER `ketr`,
ADD `created_at` timestamp NULL AFTER `fogging`,
ADD `updated_at` timestamp NULL AFTER `created_at`;