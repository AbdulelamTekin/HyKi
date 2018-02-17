-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 17 Şub 2018, 15:01:15
-- Sunucu sürümü: 5.7.17-log
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `message`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `send_id` int(11) NOT NULL,
  `delete_message` enum('0','1') NOT NULL DEFAULT '0',
  `updateTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages_sub`
--

CREATE TABLE `messages_sub` (
  `sub_id` int(11) NOT NULL,
  `messages_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_subject` varchar(100) NOT NULL,
  `message_text` text NOT NULL,
  `message_seen` enum('0','1') NOT NULL DEFAULT '0',
  `delete_message` enum('0','1') NOT NULL DEFAULT '0',
  `message_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_fullName` varchar(150) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `user_ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_fullName`, `first_name`, `surname`, `user_ip`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'abdulselamtekinn@gmail.com', 'Abdulselam TEKİN', '', '', ''),
(2, 'emir', 'e10adc3949ba59abbe56e057f20f883e', 'emir_keskin@gmail.com', 'Emir Keskin', '', '', ''),
(3, 'azad', 'e10adc3949ba59abbe56e057f20f883e', 'azad@gmail.com', 'Azat Topal', '', '', ''),
(4, 'mehmet', 'e10adc3949ba59abbe56e057f20f883e', 'mehmet_atli@gmail.com', 'Mehmet Atlı', '', '', ''),
(5, 'ruling', 'e10adc3949ba59abbe56e057f20f883e', 'ruling@gmail.com', '', '', '', ''),
(6, 'Hyki', 'e10adc3949ba59abbe56e057f20f883e', 'Hyki@gmail.com', '', 'Hyki', '', '::1');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Tablo için indeksler `messages_sub`
--
ALTER TABLE `messages_sub`
  ADD PRIMARY KEY (`sub_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Tablo için AUTO_INCREMENT değeri `messages_sub`
--
ALTER TABLE `messages_sub`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
