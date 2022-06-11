DROP TABLE IF EXISTS `#__tuf_metadata`;

CREATE TABLE IF NOT EXISTS `#__tuf_metadata` (
   `id` int unsigned NOT NULL AUTO_INCREMENT,
   `extension_id` int unsigned NOT NULL,
   `root_json` text NULL,
   `snapshot_json` text NULL,
   `targets_json` text NULL,
   `timestamp_json` text NULL,
   `mirror_json` text NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

INSERT INTO `#__tuf_metadata` (`id`, `extension_id`, `root_json`) VALUES
(1, 77, '{thing-x: "hello Im a #key"}');
