# pdo-comment
**Comment system for news using PDO and Ajax**

### Instalação
```bash
git clone https://github.com/Teloschet/pdo-comment.git comment
cd comment
```

### Banco de dados
```sql

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `comment` (
  `id` int(50) NOT NULL,
  `name` varchar(300) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `comment` (`id`, `name`, `comment`) VALUES
(1, 'Teloschet', 'teste de comentários');

ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `comment`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;
```

##### That's all. Enjoy.

### Change log
##### v 1.0.0
