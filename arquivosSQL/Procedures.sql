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
DELIMETER ;
