-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 13, 2022 lúc 06:53 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php_csdl`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `role` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`, `name`, `role`, `created_at`) VALUES
(1, 'admin@gmail.com', 'admin', 'Quản trị', 1, '2022-06-13 16:20:17'),
(2, 'levanc@gmail.com', '123456', 'Lê Văn C', 1, '2022-06-13 16:31:59'),
(3, 'buivand@gmail.com', '123456', 'Bùi Văn B', 2, '2022-06-13 16:33:09'),
(4, 'hung29manh@gmail.com', '123456', 'Hùng', 2, '2022-06-13 21:12:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `level`) VALUES
(1, 'Văn phòng phẩm', 0),
(2, 'Điện tử', 0),
(3, 'Gia dụng', 0),
(4, 'Sách', 1),
(5, 'Phụ kiện học tập', 1),
(6, 'Laptop', 2),
(7, 'Gear', 2),
(8, 'Điện dân dụng', 3),
(9, 'Phụ kiện gia đình', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(2000) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `image`, `quantity`, `description`, `created_at`, `updated_at`, `category_id`, `account_id`) VALUES
(1, 'Giày Vans', 200000, 'https://giaycaosmartmen.com/wp-content/uploads/2020/12/cach-chup-giay-dep-5.jpg', 100, 'Cách chụp giày đẹp sẽ trở nên vô cùng đơn giản khi bạn am hiểu về chúng. Thông qua bước chuẩn bị kỹ lưỡng và lưu ý các yếu tố quan trọng khi chụp hình, bạn sẽ có được những bức hình cực ưng ý. Bài viết dưới đây sẽ hướng dẫn bạn một số cách chụp ảnh giày hoàn hảo từ bố cục đến màu sắc mà không phải ai cũng biết. Cùng Smartmen tìm hiểu ngay nhé', '2022-06-13 21:33:11', '0000-00-00 00:00:00', 1, 4),
(2, 'Giày Vans', 200000, 'https://giaycaosmartmen.com/wp-content/uploads/2020/12/cach-chup-giay-dep-5.jpg', 100, 'Cách chụp giày đẹp sẽ trở nên vô cùng đơn giản khi bạn am hiểu về chúng. Thông qua bước chuẩn bị kỹ lưỡng và lưu ý các yếu tố quan trọng khi chụp hình, bạn sẽ có được những bức hình cực ưng ý. Bài viết dưới đây sẽ hướng dẫn bạn một số cách chụp ảnh giày hoàn hảo từ bố cục đến màu sắc mà không phải ai cũng biết. Cùng Smartmen tìm hiểu ngay nhé', '2022-06-13 21:33:56', '0000-00-00 00:00:00', 1, 4);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category_id`),
  ADD KEY `fk_account` (`account_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_account` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
