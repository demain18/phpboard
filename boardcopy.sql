-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 20-01-31 06:51
-- 서버 버전: 10.3.16-MariaDB
-- PHP 버전: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `boardcopy`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `auth`
--

CREATE TABLE `auth` (
  `id_key` int(11) NOT NULL,
  `nickname` text NOT NULL,
  `id` text NOT NULL,
  `pw` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='user auth database';

--
-- 테이블의 덤프 데이터 `auth`
--

INSERT INTO `auth` (`id_key`, `nickname`, `id`, `pw`) VALUES
(1, '관리자', '1234', '03AC674216F3E15C761EE1A5E255F067953623C8B388B4459E13F978D7C846F4'),
(2, '테스터', 'test', '9F86D081884C7D659A2FEAA0C55AD015A3BF4F1B2B0B822CD15D6C15B0F00A08');

-- --------------------------------------------------------

--
-- 테이블 구조 `comment`
--

CREATE TABLE `comment` (
  `id_key` int(11) NOT NULL,
  `id_key_join` int(11) NOT NULL,
  `uploader_id` text NOT NULL,
  `uploader_nickname` text NOT NULL,
  `time` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `comment`
--

INSERT INTO `comment` (`id_key`, `id_key_join`, `uploader_id`, `uploader_nickname`, `time`, `description`) VALUES
(1, 0, '1234', '관리자', '2019-12-03 14:58:17', '테스트'),
(2, 3, '1234', '관리자', '2019-12-03 15:13:27', '하이요'),
(3, 3, '1234', '관리자', '2019-12-03 15:14:25', '하이하이'),
(10, 12, 'test', '테스터', '2019-12-03 17:08:36', '모든일의 기본은 노력입니다, 노력이 받쳐주어야만 능력을 발휘할수있습니다. 당신이 가려는 길에 행운이 따르기를 빕니다.'),
(11, 12, '1234', '관리자', '2019-12-03 17:09:07', '테스터>감사합니다, 매일 노력하는 삶을 살기위해 온힘을 다하겠습니다.'),
(12, 12, '1234', '관리자', '2019-12-03 17:11:27', '테스트'),
(13, 3, '1234', '관리자', '2019-12-03 17:12:30', '트레이서 모스트 3850+ 딜러 지원합니다'),
(14, 9, 'test', '테스터', '2019-12-04 10:00:45', '아 이제 오류가 해결됬네요 빠른수정 감사합니다^^'),
(16, 14, 'test', '테스터', '2019-12-04 10:13:12', '테스트'),
(17, 9, 'test', '테스터', '2019-12-04 10:20:21', 'ㄳ'),
(18, 12, 'test', '테스터', '2019-12-04 10:20:39', '힘내세요'),
(19, 12, '1234', '관리자', '2019-12-08 11:12:06', 'ㅁㄴㅇㄹ');

-- --------------------------------------------------------

--
-- 테이블 구조 `posts`
--

CREATE TABLE `posts` (
  `id_key` int(11) NOT NULL,
  `uploader_id` text NOT NULL,
  `uploader_nickname` text NOT NULL,
  `time` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ckeditor uploaded database table';

--
-- 테이블의 덤프 데이터 `posts`
--

INSERT INTO `posts` (`id_key`, `uploader_id`, `uploader_nickname`, `time`, `title`, `description`) VALUES
(3, '1234', '관리자', '2019-11-18 10:39:44', '오버워치 4400+ 스크림 팀 모집중', '<p>선착순 10명 딜러 구합니다</p>\r\n'),
(9, 'test', '테스터', '2019-11-20 09:21:50', '이 게시판 오류가 조금 있는거 같은데요?', '<p>본문을 작성하는 데 있어서 오류가 발생했습니다 도와주세요</p>\r\n'),
(12, '1234', '관리자', '2019-12-03 13:10:33', '힘내자', '<p>절망하지 말고 매순간 1분 1초를 아껴서 최선을다해서 사는것만이</p>\r\n\r\n<p>내가 할수 있는일의 최선이다.</p>\r\n\r\n\r\n');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id_key`);

--
-- 테이블의 인덱스 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_key`);

--
-- 테이블의 인덱스 `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_key`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `auth`
--
ALTER TABLE `auth`
  MODIFY `id_key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id_key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 테이블의 AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id_key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
