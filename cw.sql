-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 28, 2025 lúc 03:17 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cw`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `answers`
--

INSERT INTO `answers` (`answer_id`, `content`, `user_id`, `question_id`, `created_at`) VALUES
(58, 'hello world!', 12, 47, '2025-04-27 07:10:55'),
(59, 'wow', 12, 9, '2025-04-27 20:14:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `modules`
--

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `modules`
--

INSERT INTO `modules` (`module_id`, `module_name`) VALUES
(4, 'Computer Vision'),
(5, 'Software Engineering'),
(6, 'Machine Learning'),
(9, 'Project Management');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` blob DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `questions`
--

INSERT INTO `questions` (`question_id`, `title`, `content`, `image`, `user_id`, `module_id`, `created_at`, `updated_at`) VALUES
(7, 'What is edge detection?', 'I am trying to understand edge detection algorithms.', NULL, 6, 4, '2025-03-06 09:16:14', '2025-03-06 09:16:14'),
(8, 'How to use UML for class diagrams?', 'Can someone explain how to model a class diagram?', NULL, 7, 5, '2025-03-06 09:16:14', '2025-03-06 09:16:14'),
(9, 'What is backpropagation?', 'I need help understanding backpropagation in neural networks.', NULL, 8, 6, '2025-03-06 09:16:14', '2025-03-06 09:16:14'),
(43, 'What is the difference between supervised and unsupervised learning?', 'I am a bit confused about these two types of learning. Can someone explain with examples?', NULL, 6, 6, '2025-04-27 08:46:12', '2025-04-27 08:46:12'),
(44, 'Best practices for Agile project management?', 'What are some tips or best practices for effectively managing software projects using Agile?', NULL, 7, 9, '2025-04-27 08:46:12', '2025-04-27 08:46:12'),
(45, 'How does convolution work in computer vision?', 'I understand that convolution is important for feature extraction, but how exactly does it work?', NULL, 8, 4, '2025-04-27 08:46:12', '2025-04-27 08:46:12'),
(46, 'What are the main phases of the Software Development Life Cycle (SDLC)?', 'Can someone outline the main phases of SDLC and what happens in each phase?', NULL, 11, 5, '2025-04-27 08:46:12', '2025-04-27 08:46:12'),
(47, 'Tips for improving model accuracy in Machine Learning?', 'I trained a model but the accuracy is low. What steps can I take to improve it?', NULL, 12, 6, '2025-04-27 08:46:12', '2025-04-27 08:46:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `created_at`, `role`) VALUES
(6, 'alice', 'alice123@example.com', '$2y$10$bKMRL67slMAL6rqGoD5r4.bjusZRoFiRzminjvZAq6oN163vM7bsi', '2025-03-06 09:14:17', 'user'),
(7, 'bob', 'bob@example.com', '$2y$10$csQ2a0nIMwq6Qp5wcer8u.PsdJe2dgTPS.9B7JElwkY0j7rKyLeee', '2025-03-06 09:14:17', 'user'),
(8, 'charlie', 'charlie@example.com', '$2y$10$csQ2a0nIMwq6Qp5wcer8u.PsdJe2dgTPS.9B7JElwkY0j7rKyLeee', '2025-03-06 09:14:17', 'user'),
(9, 'tai874vn', 'tai874vn@gmail.com', '$2y$10$1wdA4x5969Vw2/pn1AK6Ou7FCTtOZRs1g0HQjTGxaVzGeepaM6m8K', '2025-03-08 08:17:16', 'admin'),
(11, 'tai874vn11', 'tai874vn11@gmail.com', '$2y$10$csQ2a0nIMwq6Qp5wcer8u.PsdJe2dgTPS.9B7JElwkY0j7rKyLeee', '2025-03-11 09:32:32', 'user'),
(12, 'admin123', 'admin123@gmail.com', '$2y$10$DmaCk8XRcn04x6ZBQU7wq.Vw8HDmGWvEopy0R/euoQ2T3cAHcV0gu', '2025-03-31 11:09:24', 'user'),
(13, 'testregis', 'testregis@gmail.com', '$2y$10$vWojgpA/UWrKyKuqQs9uyuUPMyN1seyE.TNm.0q5bXTysZUO1dYuG', '2025-04-01 19:31:34', 'user'),
(15, 'new', 'testnew@gmail.com', '$2y$10$BUvu6sLNVNVZH4WyFmEi.eQGuthziI5BkCLlEFL1hSLWoc2MNybRC', '2025-04-25 16:51:03', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Chỉ mục cho bảng `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`);

--
-- Chỉ mục cho bảng `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`module_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
