create database mychat;
use mychat;


--
-- TABLES
--

CREATE TABLE IF NOT EXISTS usuarios (
  Fundo longblob DEFAULT NULL,
  Imagem longblob DEFAULT NULL,
  ID int NOT NULL AUTO_INCREMENT,
  Nick varchar(20) NOT NULL,
  Senha varchar(20) NOT NULL,
  UltimaVez datetime NOT NULL,
  
  CONSTRAINT pk_usuarios PRIMARY KEY (ID, Nick)
) DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS mensagens (
    ID int NOT NULL AUTO_INCREMENT,
    idRemetente int NOT NULL,
    idDestinatario int NOT NULL,
    Conteudo_texto varchar(300) NOT NULL,
    Conteudo_blob longblob NULL,
    
    CONSTRAINT pk_mensagens PRIMARY KEY (ID),
    CONSTRAINT fk_mensagens_1 FOREIGN KEY (idDestinatario) REFERENCES usuarios (ID) ON DELETE CASCADE,
    CONSTRAINT fk_mensagens_2 FOREIGN KEY (idDestinatario) REFERENCES usuarios (ID) ON DELETE CASCADE
) DEFAULT CHARSET=utf8mb4;

--
-- SEEDERS
--
