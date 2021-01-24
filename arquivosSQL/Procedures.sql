DELIMITER //
CREATE OR REPLACE PROCEDURE `CadastraPessoa` (IN `TIPOID`        int(5),
                                                                          IN `NOMECLI`         VARCHAR(255),
                                                                          IN `CLICEP`        VARCHAR(8),
                                                                          IN `CLIRUA`     VARCHAR(255),
                                                                          IN `CLIBAIRRO`          VARCHAR(255),
                                                                          IN `CLICIDA`          VARCHAR(255),
                                                                          IN `CLIESTA`       VARCHAR(255),
                                                                          IN `CLIENDE`       VARCHAR(255))
                                                                          
  BEGIN
    INSERT INTO CLIENTES (TIPOID,NOMECLI,CLICEP,CLIRUA,CLIBAIRRO,CLICIDA,CLIESTA,CLIENDE)
                VALUES (TIPOID,NOMECLI,CLICEP,CLIRUA,CLIBAIRRO,CLICIDA,CLIESTA,CLIENDE);
  END//
DELIMITER ;


DELIMITER //
CREATE OR REPLACE PROCEDURE `atualizaPessoa` (IN `TIPOID`        int(5),
                                                                          IN `NOMECLI`       VARCHAR(255),
                                                                          IN `CLICEP`        VARCHAR(8),
                                                                          IN `CLIRUA`        VARCHAR(255),
                                                                          IN `CLIBAIRRO`     VARCHAR(255),
                                                                          IN `CLICIDA`       VARCHAR(255),
                                                                          IN `CLIESTA`       VARCHAR(255),
                                                                          IN `CLIENDE`       VARCHAR(255).
                                                                          IN `IDCLI`         INT(5))
                                                                          
  BEGIN
    UPDATE  CLIENTES SET TIPOID = TIPOID ,NOMECLI = NOMECLI,CLICEP = CLICEP ,
                       CLIRUA = CLIRUA,CLIBAIRRO = CLIBAIRRO ,CLICIDA = CLICIDA,CLIESTA = CLIESTA,CLIENDE = CLIENDE
                 WHERE IDCLI = IDCLI;
  END//
DELIMITER ;
