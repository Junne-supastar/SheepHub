SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE DATABASE IF NOT EXISTS `sheephub`;
USE `sheephub`;

-- =====================
-- TABELA USUÁRIO
-- =====================

CREATE TABLE niveis_usuario (
    id_nivelusu INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    descricao VARCHAR(255)
);

INSERT INTO niveis_usuario (nome, descricao) VALUES
('Administrador', 'Controle total do sistema'),
('Líder', 'Administra a igreja'),
('Líder de comunidade', 'Gerencia comunidades específicas'),
('Membro', 'Usuário regular da igreja'),
('Visitante', 'Apenas visualiza informações públicas');


-- =====================
-- mudar nome status
-- verificar hierarquia
-- ajeitar chaves estrangeiras
-- ver se da para deixar o cep com char ou varchar ao invés de int
-- ajeitar a quantidade de caracteres nos varchar (nosso banco não precisa ficar tão pesado)
-- =====================
CREATE TABLE status (
    id_status INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    descricao VARCHAR(255)
);

INSERT INTO status (nome, descricao) VALUES
('Ativo', 'Item em uso normal'),
('Inativo', 'Item desativado temporariamente'),
('Pendente', 'Aguardando confirmação'),
('Excluído', 'Removido logicamente do sistema');

CREATE TABLE IF NOT EXISTS usuario (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `id_status` int,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(30),
  `nivel` VARCHAR(1),
  PRIMARY KEY (`idusuario`)
) ENGINE = InnoDB;

-- =====================
-- TABELA PERFIL
-- =====================

CREATE TABLE IF NOT EXISTS localidade (
  `cep` INT NOT NULL,
   logradouro varchar(60), 
   bairro varchar(40) ,
   cidade varchar(30),
   uf char(2),
  PRIMARY KEY (`cep`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS perfil (
  `idperfil` INT NOT NULL AUTO_INCREMENT,
  `idusuario` INT NOT NULL,
  `cep` INT NOT NULL,
  `foto_perfil` VARCHAR(255),
  `data_criacao` DATE,
  `atividade` BOOLEAN,
   PRIMARY KEY (idperfil),
  INDEX (idusuario),
  CONSTRAINT fk_perfil_usuario FOREIGN KEY (idusuario)
    REFERENCES usuario (idusuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_perfil_status FOREIGN KEY (id_status)
    REFERENCES status(id_status)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
	CONSTRAINT fk_perfil_localidade FOREIGN KEY (cep)
    REFERENCES localidade(cep)
    ON DELETE SET NULL
    ON UPDATE CASCADE
) ENGINE = InnoDB;

INSERT INTO usuario (atividade, email, senha, telefone, nivel)
VALUES (1, 'juli@gmail.com', '123', '21333', '1');

-- =====================
-- TABELA IGREJA
-- =====================


CREATE TABLE IF NOT EXISTS igreja (
  `idigreja` INT NOT NULL AUTO_INCREMENT,
  `cep` INT NOT NULL,
  `idperfil` INT NOT NULL,
  `numero` VARCHAR(3),
  `cnpj` VARCHAR(50),
  `complemento` VARCHAR(50),
  `denominacao` VARCHAR(45),
  `telefone` VARCHAR(45),
  PRIMARY KEY (`idigreja`),
  INDEX `fk_igreja_perfil1_idx` (`perfil_idperfil` ASC),
  CONSTRAINT `fk_igreja_perfil1`
    FOREIGN KEY (`perfil_idperfil`)
    REFERENCES `sheephub`.`perfil` (`idperfil`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA MEMBRO
-- =====================
CREATE TABLE IF NOT EXISTS membro (
  `idmembro` INT NOT NULL AUTO_INCREMENT,
  `usuario_idusuario` INT NOT NULL,
  PRIMARY KEY (`idmembro`),
  INDEX `fk_membro_usuario_idx` (`usuario_idusuario` ASC),
  CONSTRAINT `fk_membro_usuario`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `sheephub`.`usuario` (`idusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA COMENTARIO
-- =====================
CREATE TABLE IF NOT EXISTS comentario (
  `idcomentario` INT NOT NULL AUTO_INCREMENT,
  `usuario_idusuario` INT NOT NULL,
  `data_comentario` DATE,
  `conteudo` TEXT,
  PRIMARY KEY (`idcomentario`),
  INDEX `fk_comentario_usuario1_idx` (`usuario_idusuario` ASC),
  CONSTRAINT `fk_comentario_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `sheephub`.`usuario` (`idusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA CURTIDA_COMENTARIO
-- =====================
CREATE TABLE IF NOT EXISTS curtida_comentario (
  `comentario_idcomentario` INT NOT NULL,
  `usuario_idusuario` INT NOT NULL,
  `data_curtida` DATE,
  PRIMARY KEY (`comentario_idcomentario`, `usuario_idusuario`),
  CONSTRAINT `fk_curtida_comentario_comentario1`
    FOREIGN KEY (`comentario_idcomentario`)
    REFERENCES `sheephub`.`comentario` (`idcomentario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_curtida_comentario_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `sheephub`.`usuario` (`idusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA MENSAGEM
-- =====================
CREATE TABLE IF NOT EXISTS mensagem (
  `idmensagem` INT NOT NULL AUTO_INCREMENT,
  `destinatario` VARCHAR(100),
  `remetente` VARCHAR(100),
  `data_mensagem` DATE,
  `usuario_idusuario` INT NOT NULL,
  `conteudo` TEXT,
  `arquivo` VARCHAR(255),
  PRIMARY KEY (`idmensagem`),
  INDEX `fk_mensagem_usuario1_idx` (`usuario_idusuario` ASC),
  CONSTRAINT `fk_mensagem_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `sheephub`.`usuario` (`idusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA LOCALIDADE
-- =====================


-- =====================
-- TABELA POSTAGEM
-- =====================
CREATE TABLE IF NOT EXISTS postagem (
  `idpostagem` INT NOT NULL AUTO_INCREMENT,
  `conteudo` TEXT,
  `arquivo` VARCHAR(255),
  `data_postagem` DATETIME,
  PRIMARY KEY (`idpostagem`)
) ENGINE = InnoDB;

-- =====================
-- TABELA CURTIDA_POST
-- =====================
CREATE TABLE IF NOT EXISTS curtida_post (
  `usuario_idusuario` INT NOT NULL,
  `postagem_idpostagem` INT NOT NULL,
  PRIMARY KEY (`usuario_idusuario`, `postagem_idpostagem`),
  CONSTRAINT `fk_usuario_has_postagem_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `sheephub`.`usuario` (`idusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_has_postagem_postagem1`
    FOREIGN KEY (`postagem_idpostagem`)
    REFERENCES `sheephub`.`postagem` (`idpostagem`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA PLANO
-- =====================
CREATE TABLE IF NOT EXISTS plano (
  `id_plano` INT NOT NULL AUTO_INCREMENT,
  `igreja_idigreja` INT NOT NULL,
  `valor` VARCHAR(45),
  `pago` VARCHAR(45),
  PRIMARY KEY (`id_plano`),
  CONSTRAINT `fk_plano_igreja1`
    FOREIGN KEY (`igreja_idigreja`)
    REFERENCES `sheephub`.`igreja` (`idigreja`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA OFERTAS
-- =====================
CREATE TABLE IF NOT EXISTS ofertas (
  `id_oferta` INT NOT NULL AUTO_INCREMENT,
  `data_oferta` DATE,
  `valor` VARCHAR(45),
  `igreja_idigreja` INT NOT NULL,
  `forma_pagamento` VARCHAR(45),
  `descricao` VARCHAR(45),
  PRIMARY KEY (`id_oferta`),
  CONSTRAINT `fk_ofertas_igreja1`
    FOREIGN KEY (`igreja_idigreja`)
    REFERENCES `sheephub`.`igreja` (`idigreja`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA DESPESAS
-- =====================
CREATE TABLE IF NOT EXISTS despesas (
  `id_despesa` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45),
  `valor` VARCHAR(45),
  `forma_pagamento` VARCHAR(45),
  `igreja_idigreja` INT NOT NULL,
  PRIMARY KEY (`id_despesa`),
  CONSTRAINT `fk_despesas_igreja1`
    FOREIGN KEY (`igreja_idigreja`)
    REFERENCES `sheephub`.`igreja` (`idigreja`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA DEPARTAMENTO
-- =====================
CREATE TABLE IF NOT EXISTS departamento (
  `id_departamento` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45),
  `igreja_idigreja` INT NOT NULL,
  `atividade` VARCHAR(45),
  PRIMARY KEY (`id_departamento`),
  CONSTRAINT `fk_departamento_igreja1`
    FOREIGN KEY (`igreja_idigreja`)
    REFERENCES `sheephub`.`igreja` (`idigreja`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA SEGUINDO
-- =====================
CREATE TABLE IF NOT EXISTS seguindo (
  `id_seguidor` INT NOT NULL,
  `id_seguido` INT NOT NULL,
  PRIMARY KEY (`id_seguidor`, `id_seguido`),
  CONSTRAINT `fk_usuario_has_usuario_usuario1`
    FOREIGN KEY (`id_seguidor`)
    REFERENCES `sheephub`.`usuario` (`idusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_has_usuario_usuario2`
    FOREIGN KEY (`id_seguido`)
    REFERENCES `sheephub`.`usuario` (`idusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA PERMISSAO
-- =====================
CREATE TABLE IF NOT EXISTS permissao (
  `id_permissao` INT NOT NULL AUTO_INCREMENT,
  `igreja_idigreja` INT NOT NULL,
  `usuario_idusuario` INT NOT NULL,
  `data_permissao` DATETIME,
  `status` VARCHAR(45),
  PRIMARY KEY (`id_permissao`),
  CONSTRAINT `fk_igreja_has_usuario_igreja1`
    FOREIGN KEY (`igreja_idigreja`)
    REFERENCES `sheephub`.`igreja` (`idigreja`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_igreja_has_usuario_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `sheephub`.`usuario` (`idusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA NOTIFICACAO
-- =====================
CREATE TABLE IF NOT EXISTS notificacao (
  `idnotificacao` INT NOT NULL AUTO_INCREMENT,
  `data_notificacao` DATETIME,
  `tipo` VARCHAR(45),
  PRIMARY KEY (`idnotificacao`)
) ENGINE = InnoDB;

-- =====================
-- TABELA CONFIGURACAO_NOTIFICACAO
-- =====================
CREATE TABLE IF NOT EXISTS configuracao_notificacao (
  `perfil_idperfil` INT NOT NULL,
  `notificacao_idnotificacao` INT NOT NULL,
  `recebe_email` VARCHAR(3),
  `recebe_push` VARCHAR(3),
  PRIMARY KEY (`perfil_idperfil`, `notificacao_idnotificacao`),
  CONSTRAINT `fk_perfil_has_notificacao_perfil1`
    FOREIGN KEY (`perfil_idperfil`)
    REFERENCES `sheephub`.`perfil` (`idperfil`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_perfil_has_notificacao_notificacao1`
    FOREIGN KEY (`notificacao_idnotificacao`)
    REFERENCES `sheephub`.`notificacao` (`idnotificacao`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA EVENTOS
-- =====================
CREATE TABLE IF NOT EXISTS eventos (
  `ideventos` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50),
  `descricao` VARCHAR(255),
  `tipo` VARCHAR(45),
  `data_criacao` DATETIME,
  `numero_eventos` VARCHAR(45),
  `complemento_eventos` VARCHAR(45),
  `localidade_cep` INT NOT NULL,
  PRIMARY KEY (`ideventos`),
  CONSTRAINT `fk_eventos_localidade1`
    FOREIGN KEY (`localidade_cep`)
    REFERENCES `sheephub`.`localidade` (`cep`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA EVENTOS_IGREJA
-- =====================
CREATE TABLE IF NOT EXISTS eventos_igreja (
  `ideventos_igreja` VARCHAR(45) NOT NULL,
  `eventos_ideventos` INT NOT NULL,
  `igreja_idigreja` INT,
  PRIMARY KEY (`ideventos_igreja`),
  CONSTRAINT `fk_eventos_has_igreja_eventos1`
    FOREIGN KEY (`eventos_ideventos`)
    REFERENCES `sheephub`.`eventos` (`ideventos`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_eventos_has_igreja_igreja1`
    FOREIGN KEY (`igreja_idigreja`)
    REFERENCES `sheephub`.`igreja` (`idigreja`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

-- =====================
-- TABELA CONFIRMACAO
-- =====================
CREATE TABLE IF NOT EXISTS confirmacao (
  `idconfirmacao` INT NOT NULL AUTO_INCREMENT,
  `eventos_ideventos` INT NOT NULL,
  `membro_idmembro` INT NOT NULL,
  `data_confirm` DATETIME,
  `status` VARCHAR(45),
  PRIMARY KEY (`idconfirmacao`),
  CONSTRAINT `fk_confirmacao_eventos1`
    FOREIGN KEY (`eventos_ideventos`)
    REFERENCES `sheephub`.`eventos` (`ideventos`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_confirmacao_membro1`
    FOREIGN KEY (`membro_idmembro`)
    REFERENCES `sheephub`.`membro` (`idmembro`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
