-- Banco de dados: `primat`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usucad`
--

CREATE TABLE `usucad` (
  `USUID` int(5) NOT NULL,
  `USULOGIN` varchar(24) NOT NULL,
  `USUNOME` varchar(255) NOT NULL,
  `USUMAIL` varchar(255) NOT NULL,
  `USUFONE` varchar(20) NOT NULL,
  `USUCEP` varchar(8) NOT NULL,
  `USURUA` varchar(255) NOT NULL,
  `USUBAIRRO` varchar(255) NOT NULL,
  `USUCIDA` varchar(255) NOT NULL,
  `USUESTA` varchar(2) NOT NULL,
  `USUENDN` varchar(10) NOT NULL,
  `USUSENHA` varchar(20) NOT NULL
)

--
-- Índices para tabela `usucad`
--
ALTER TABLE `usucad`
  ADD PRIMARY KEY (`USUID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usucad`
--
ALTER TABLE `usucad`
  MODIFY `USUID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
