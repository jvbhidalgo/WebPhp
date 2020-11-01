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




-----------------TABELA REGUSU--------------------

-- Estrutura da tabela `REGUSU`
CREATE TABLE `regusu` (
  `REGID` int(5) NOT NULL,
  `REGIDUSU` int(5) NOT NULL,
  `REGCOMP` varchar(10) NOT NULL,
  `REGVDIA` float NOT NULL
);

ALTER TABLE `regusu`
  ADD PRIMARY KEY (`REGID`),
  ADD KEY `FK_USUARIO` (`REGIDUSU`);

ALTER TABLE `regusu`
  MODIFY `REGID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

ALTER TABLE `regusu`
  ADD CONSTRAINT `FK_USUARIO` FOREIGN KEY (`REGIDUSU`) REFERENCES `usucad` (`USUID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
