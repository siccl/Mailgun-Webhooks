SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
CREATE TABLE `EmailsReports` (
  `id` int(11) NOT NULL,
  `Type` varchar(15) NOT NULL,
  `Recipient` varchar(250) NOT NULL,
  `Domain` varchar(100) NOT NULL,
  `messageHeaders` text NOT NULL,
  `moreData` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `EmailsReports`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `EmailsReports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;