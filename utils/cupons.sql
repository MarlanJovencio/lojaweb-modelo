CREATE TABLE
    `cupons` (
        `cd_cupom` varchar(15) NOT NULL,
        `dataValidade` date NOT NULL,
        `porcentagem` int (11) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;