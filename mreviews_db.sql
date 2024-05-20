-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: mai 20, 2024 la 02:26 PM
-- Versiune server: 10.4.28-MariaDB
-- Versiune PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `mreviews_db`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `favorite`
--

CREATE TABLE `favorite` (
  `id` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `image` varchar(5000) NOT NULL,
  `overview` varchar(2000) NOT NULL,
  `voteAverage` varchar(5) NOT NULL,
  `user_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `favorite`
--

INSERT INTO `favorite` (`id`, `title`, `image`, `overview`, `voteAverage`, `user_id`) VALUES
('572802', 'Aquaman and the Lost', 'https://image.tmdb.org/t/p/w500/8xV47NDrjdZDpkVcCFqkdHa3T0C.jpg', 'Black Manta, still driven by the need to avenge his father\'s death and wielding the power of the mythic Black Trident, will stop at nothing to take Aquaman down once and for all. To defeat him, Aquaman must turn to his imprisoned brother Orm, the former King of Atlantis, to forge an unlikely alliance in order to save the world from irreversible destruction.', '6.5', 'qUi7hqf5E76MsOfJrspj'),
('572802', 'Aquaman and the Lost', 'https://image.tmdb.org/t/p/w500/8xV47NDrjdZDpkVcCFqkdHa3T0C.jpg', 'Black Manta, still driven by the need to avenge his father\'s death and wielding the power of the mythic Black Trident, will stop at nothing to take Aquaman down once and for all. To defeat him, Aquaman must turn to his imprisoned brother Orm, the former King of Atlantis, to forge an unlikely alliance in order to save the world from irreversible destruction.', '6.5', '01z7NxZ6u4NlEo7cr7Ik'),
('1071215', 'Thanksgiving', 'https://image.tmdb.org/t/p/w500/f5f3TEVst1nHHyqgn7Z3tlwnBIH.jpg', 'After a Black Friday riot ends in tragedy, a mysterious Thanksgiving-inspired killer terrorizes Plymouth, Massachusetts - the birthplace of the holiday. Picking off residents one by one, what begins as random revenge killings are soon revealed to be part of a larger, sinister holiday plan.', '6.7', '01z7NxZ6u4NlEo7cr7Ik'),
('653346', 'Kingdom of the Plane', 'https://image.tmdb.org/t/p/w500/gKkl37BQuKTanygYQG1pyYgLVgf.jpg', 'Several generations in the future following Caesar\'s reign, apes are now the dominant species and live harmoniously while humans have been reduced to living in the shadows. As a new tyrannical ape leader builds his empire, one young ape undertakes a harrowing journey that will cause him to question all that he has known about the past and to make choices that will define a future for apes and humans alike.', '7.099', 'qUi7hqf5E76MsOfJrspj');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(30) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` varchar(20) NOT NULL,
  `post_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `rating` varchar(1) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `movie_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `reviews`
--

INSERT INTO `reviews` (`id`, `post_id`, `user_id`, `rating`, `title`, `description`, `date`, `movie_title`) VALUES
('gulByK8JzCuqQMIakjrt', '906126', 'qUi7hqf5E76MsOfJrspj', '1', 'bad', 'bad', '2024-01-15', 'Society of the Snow'),
('n5LVwIyKydiauZm7f8BY', '753342', '01z7NxZ6u4NlEo7cr7Ik', '2', 'bad', 'bad', '2024-01-15', 'Napoleon'),
('NfujSOUkwu7ySCY37rEM', '985445', 'qUi7hqf5E76MsOfJrspj', '1', 'bad', 'bad', '2024-05-11', 'Furious and Fast: Th'),
('tbb4Hx24jNEGmyfFnYia', '906126', '01z7NxZ6u4NlEo7cr7Ik', '6', 'good', 'good', '2024-01-15', 'Society of the Snow');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`) VALUES
('01z7NxZ6u4NlEo7cr7Ik', 'darius', 'darius@gmail.com', '$2y$10$JrHwWczTXffJldroA2vx5OJ8D98nP7ECtwvcTXeXeXsgYK8oUtjCG', 'Lz3iVYqbiSEy6pW1E2rx.jpg'),
('APmO01vlqmX5lGZNwsUA', 'coding', 'coding@gmail.com', '$2y$10$1333T0Awz6jsGQ6oKiZgJebivE6lhfsDTiZWKUefb3D.Zhsssd4OO', 'VZ37B93ABaNcrASNQzZo.jpg'),
('qUi7hqf5E76MsOfJrspj', 'user', 'user@gmail.com', '$2y$10$amabDCWNRHxDluoZJe0vT.xVvOaujCmSxYtFLeq0UD.VoR/AmipHq', 'Xo9Dyyvhium1WQD8Jn3w.png'),
('xNTOzXcUCeOhw6VpjBdy', 'danut', 'danut@gmail.com', '$2y$10$jSxfhDU21J/6dJ7W2qCIiev1NphJ2sdfL5NwI7msC9LQCkjeKGTiy', 'c5vdh3UDwe3t5pPbjoq0.jpg');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
