DELIMITER $$
CREATE OR REPLACE DEFINER=`root`@`localhost` PROCEDURE `CadastraUsuario` (IN `login`        VARCHAR(24),
                                                                          IN `nome`         VARCHAR(255),
                                                                          IN `email`        VARCHAR(255),
                                                                          IN `telefone`     VARCHAR(20),
                                                                          IN `cep`          VARCHAR(8),
                                                                          IN `rua`          VARCHAR(255),
                                                                          IN `bairro`       VARCHAR(255),
                                                                          IN `cidade`       VARCHAR(255),
                                                                          IN `uf`           VARCHAR(2),
                                                                          IN `numero`       VARCHAR(10),
                                                                          IN `senha`        VARCHAR(20))
                                                                          
  BEGIN
    INSERT INTO USUCAD (USULOGIN,USUNOME,USUMAIL,USUFONE,USUCEP,USURUA,USUBAIRRO,USUCIDA,USUESTA,USUENDN, USUSENHA)
                VALUES (login,nome,email,telefone,cep,rua,bairro,cidade,uf,numero,senha);
  END$$