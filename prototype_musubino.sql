-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-27 14:52:03
-- サーバのバージョン： 10.4.22-MariaDB
-- PHP のバージョン: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `prototype_musubino`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table`
--

CREATE TABLE `user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `mail` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `pass` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `user_table`
--

INSERT INTO `user_table` (`id`, `name`, `mail`, `pass`, `is_admin`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '堀口恭司', 'bokuranobjj@gmail.com', '111111', 0, 0, '2022-01-27 01:48:42', '2022-01-27 01:48:42'),
(2, '矢地祐介', 'krazybee@gmail.com', '222222', 0, 0, '2022-01-27 05:14:44', '2022-01-27 05:14:44');

-- --------------------------------------------------------

--
-- テーブルの構造 `will_table`
--

CREATE TABLE `will_table` (
  `id` int(12) NOT NULL,
  `fullcode` varchar(128) COLLATE utf8mb4_bin DEFAULT NULL,
  `dnar` varchar(128) COLLATE utf8mb4_bin DEFAULT NULL,
  `bsc` varchar(128) COLLATE utf8mb4_bin DEFAULT NULL,
  `handsonly` varchar(128) COLLATE utf8mb4_bin DEFAULT NULL,
  `other` varchar(500) COLLATE utf8mb4_bin DEFAULT NULL,
  `date` date NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `evidence` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `will_table`
--

INSERT INTO `will_table` (`id`, `fullcode`, `dnar`, `bsc`, `handsonly`, `other`, `date`, `name`, `evidence`, `created_at`, `updated_at`, `is_deleted`) VALUES
(3, NULL, 'DNAR', 'BSC', NULL, 'デメトリアスジョンソンにリベンジする！！', '2022-01-27', '堀口恭司', 'upload/202201271412591062aa54d94d09be82d862cef227bb2e.mp4', '2022-01-27 22:12:59', '2022-01-27 22:12:59', 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `will_table`
--
ALTER TABLE `will_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `will_table`
--
ALTER TABLE `will_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
