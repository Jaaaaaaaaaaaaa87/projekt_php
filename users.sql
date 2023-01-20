-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Sty 2023, 20:37
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `users`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_ids` int(11) NOT NULL,
  `cart_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_ids`, `cart_total`) VALUES
(1, 11, 2, 234);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `description` varchar(6000) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `name`, `image_url`, `description`, `price`) VALUES
(0, 'Roweruś XD', 'https://www.centrumrowerowe.pl/photo/product/puky-lr-m-2-137946-f-sk7-w780-h554_1.webp', 'Roweruś XD jest jak Rowerek XD, ale nie do końca. Jest też trochę jak Rower XD, ale również nie do końca. Można powiedzieć, że jest pomiędzy nimi, ale też nie do końca.', '21.37'),
(1, 'Rowerek XD', 'https://images.morele.net/i1064/7295040_0_i1064.jpg', 'Rowerek biegowy \"Flaming\" został stworzony z myślą o najmniejszych dzieciach, rozpoczynających dopiero przygodę z rowerkami. Jeździk przeznaczony jest dla maluchów od 12 miesiąca życia, które postawiły już swoje pierwsze kroki.\r\n\r\nJazda na rowerkach biegowych u maluchów wspomaga koordynację ruchową oraz utrzymanie równowagi. Pozwala rozwijać kolejne zdolności takie jak wsiadanie, zsiadanie, odpychania. Sama jazda zapewni długie godziny zabawy!', '213.70'),
(2, 'Rower XD', 'https://www.centrumrowerowe.pl/photo/product/unity-mosca-2-166830-f-sk7-w780-h554_1.webp', 'Unity Mosca to rower damski miejski, który świetnie sprawdzi się podczas codziennych przejazdów po utwardzonych drogach w terenie zabudowanym. Pozwoli Ci uniknąć korków i wygodnie dotrzeć do pracy czy sklepu. Wyposażono go w tylny bagażnik oraz oświetlenie LED zwiększające bezpieczeństwo rowerzystki. Na kierownicy umieszczono także dzwonek, będący obowiązkowym wyposażeniem roweru.', '234.17');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `time_created` datetime NOT NULL,
  `isadmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `time_created`, `isadmin`) VALUES
(9, 'test', 'test@test.test', '098f6bcd4621d373cade4e832627b4f6', '2023-01-19 21:42:57', 0),
(10, 'admin', 'admin@admin.admin', '21232f297a57a5a743894a0e4a801fc3', '2023-01-19 21:54:13', 1),
(11, 'jan', 'jan@jan.jan', 'fa27ef3ef6570e32a79e74deca7c1bc3', '2023-01-20 20:11:32', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
