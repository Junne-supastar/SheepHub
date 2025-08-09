SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE DATABASE IF NOT EXISTS sheephub DEFAULT CHARACTER SET utf8;
USE sheephub;

CREATE TABLE if not exists usuario (
  id_usuario INT NOT NULL AUTO_INCREMENT,
  atividade BOOLEAN NOT NULL,
  email VARCHAR(100) NOT NULL,
  senha VARCHAR(100) NOT NULL,
  nome_usuario VARCHAR(100) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  nivel ENUM('admin', 'lider', 'membro') NOT NULL,
  PRIMARY KEY (id_usuario)
) ENGINE=InnoDB;

CREATE TABLE if not exists perfil (
  id_perfil INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  foto VARCHAR(100) NOT NULL,
  capa VARCHAR(100) NOT NULL,
  data_criacao DATE NOT NULL,
  atividade BOOLEAN NOT NULL,
  PRIMARY KEY (id_perfil),
  INDEX idx_perfil_usuario (id_usuario),
  CONSTRAINT fk_perfil_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

SHOW ENGINE INNODB STATUS;
CREATE TABLE igreja (
  id_igreja INT NOT NULL AUTO_INCREMENT,
  numero INT NOT NULL,
  cnpj VARCHAR(20) NOT NULL,
  complemento VARCHAR(100) NOT NULL,
  id_perfil INT NOT NULL,
  denominacao VARCHAR(100) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  PRIMARY KEY (id_igreja),
  INDEX idx_igreja_perfil (id_perfil),
  CONSTRAINT fk_igreja_perfil FOREIGN KEY (id_perfil) REFERENCES perfil(id_perfil)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE membro (
  id_membro INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  PRIMARY KEY (id_membro),
  INDEX idx_membro_usuario (id_usuario),
  CONSTRAINT fk_membro_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE comentario (
  id_comentario INT NOT NULL AUTO_INCREMENT,
  id_usuario INT NOT NULL,
  data_comentario DATE NOT NULL,
  conteudo VARCHAR(255) NOT NULL,
  PRIMARY KEY (id_comentario),
  INDEX idx_comentario_usuario (id_usuario),
  CONSTRAINT fk_comentario_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE curtida_comentario (
  id_comentario INT NOT NULL,
  id_usuario INT NOT NULL,
  data_curtida DATE NOT NULL,
  PRIMARY KEY (id_comentario, id_usuario),
  INDEX idx_curtida_comentario_comentario (id_comentario),
  INDEX idx_curtida_comentario_usuario (id_usuario),
  CONSTRAINT fk_curtida_comentario_comentario FOREIGN KEY (id_comentario) REFERENCES comentario(id_comentario)
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_curtida_comentario_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE mensagem (
  id_mensagem INT NOT NULL AUTO_INCREMENT,
  destinatario VARCHAR(100) NOT NULL,
  remetente VARCHAR(100) NOT NULL,
  data_mensagem DATE NOT NULL,
  id_usuario INT NOT NULL,
  conteudo VARCHAR(255) NOT NULL,
  arquivo VARCHAR(100) NOT NULL,
  PRIMARY KEY (id_mensagem),
  INDEX idx_mensagem_usuario (id_usuario),
  CONSTRAINT fk_mensagem_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE localidade (
  cep INT NOT NULL,
  id_igreja INT NOT NULL,
  uf VARCHAR(2) NOT NULL,
  municipio VARCHAR(100) NOT NULL,
  logradouro VARCHAR(100) NOT NULL,
  bairro VARCHAR(100) NOT NULL,
  cidade VARCHAR(100) NOT NULL,
  PRIMARY KEY (cep),
  INDEX idx_localidade_igreja (id_igreja),
  CONSTRAINT fk_localidade_igreja FOREIGN KEY (id_igreja) REFERENCES igreja(id_igreja)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE postagem (
  id_postagem INT NOT NULL AUTO_INCREMENT,
  conteudo VARCHAR(255) NOT NULL,
  arquivo VARCHAR(100) NOT NULL,
  data_postagem DATE NOT NULL,
  PRIMARY KEY (id_postagem)
) ENGINE=InnoDB;

CREATE TABLE curtida_post (
  id_usuario INT NOT NULL,
  id_postagem INT NOT NULL,
  PRIMARY KEY (id_usuario, id_postagem),
  INDEX idx_curtida_post_postagem (id_postagem),
  INDEX idx_curtida_post_usuario (id_usuario),
  CONSTRAINT fk_curtida_post_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_curtida_post_postagem FOREIGN KEY (id_postagem) REFERENCES postagem(id_postagem)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE plano (
  id_plano INT NOT NULL AUTO_INCREMENT,
  id_igreja INT NOT NULL,
  valor DECIMAL(10,2) NOT NULL,
  pago BOOLEAN NOT NULL,
  PRIMARY KEY (id_plano),
  INDEX idx_plano_igreja (id_igreja),
  CONSTRAINT fk_plano_igreja FOREIGN KEY (id_igreja) REFERENCES igreja(id_igreja)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE ofertas (
  id_oferta INT NOT NULL AUTO_INCREMENT,
  data_oferta DATE NOT NULL,
  valor DECIMAL(10,2) NOT NULL,
  id_igreja INT NOT NULL,
  forma_pagamento VARCHAR(50) NOT NULL,
  descricao VARCHAR(255) NOT NULL,
  PRIMARY KEY (id_oferta),
  INDEX idx_ofertas_igreja (id_igreja),
  CONSTRAINT fk_ofertas_igreja FOREIGN KEY (id_igreja) REFERENCES igreja(id_igreja)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE despesas (
  id_despesa INT NOT NULL AUTO_INCREMENT,
  descricao VARCHAR(255) NOT NULL,
  valor DECIMAL(10,2) NOT NULL,
  forma_pagamento VARCHAR(50) NOT NULL,
  id_igreja INT NOT NULL,
  PRIMARY KEY (id_despesa),
  INDEX idx_despesas_igreja (id_igreja),
  CONSTRAINT fk_despesas_igreja FOREIGN KEY (id_igreja) REFERENCES igreja(id_igreja)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE departamento (
  id_departamento INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  id_igreja INT NOT NULL,
  atividade BOOLEAN NOT NULL,
  PRIMARY KEY (id_departamento),
  INDEX idx_departamento_igreja (id_igreja),
  CONSTRAINT fk_departamento_igreja FOREIGN KEY (id_igreja) REFERENCES igreja(id_igreja)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE seguindo (
  id_seguidor INT NOT NULL,
  id_seguido INT NOT NULL,
  PRIMARY KEY (id_seguidor, id_seguido),
  INDEX idx_seguindo_seguido (id_seguido),
  INDEX idx_seguindo_seguidor (id_seguidor),
  CONSTRAINT fk_seguindo_seguidor FOREIGN KEY (id_seguidor) REFERENCES usuario(id_usuario)
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_seguindo_seguido FOREIGN KEY (id_seguido) REFERENCES usuario(id_usuario)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE permissao (
  id_permissao INT NOT NULL AUTO_INCREMENT,
  id_igreja INT NOT NULL,
  id_usuario INT NOT NULL,
  data_permissao DATETIME NOT NULL,
  status VARCHAR(50) NOT NULL,
  PRIMARY KEY (id_permissao),
  INDEX idx_permissao_usuario (id_usuario),
  INDEX idx_permissao_igreja (id_igreja),
  CONSTRAINT fk_permissao_igreja FOREIGN KEY (id_igreja) REFERENCES igreja(id_igreja)
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_permissao_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE notificacao (
  id_notificacao INT NOT NULL AUTO_INCREMENT,
  data_notificacao DATETIME NOT NULL,
  tipo VARCHAR(100) NOT NULL,
  PRIMARY KEY (id_notificacao)
) ENGINE=InnoDB;

CREATE TABLE configuracao_notificacao (
  id_perfil INT NOT NULL,
  id_notificacao INT NOT NULL,
  recebe_email BOOLEAN NOT NULL,
  recebe_push BOOLEAN NOT NULL,
  PRIMARY KEY (id_perfil, id_notificacao),
  INDEX idx_conf_notificacao_notificacao (id_notificacao),
  INDEX idx_conf_notificacao_perfil (id_perfil),
  CONSTRAINT fk_conf_notificacao_perfil FOREIGN KEY (id_perfil) REFERENCES perfil(id_perfil)
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_conf_notificacao_notificacao FOREIGN KEY (id_notificacao) REFERENCES notificacao(id_notificacao)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE eventos (
  id_eventos INT NOT NULL AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  descricao VARCHAR(255) NOT NULL,
  tipo VARCHAR(50) NOT NULL,
  data_criacao DATETIME NOT NULL,
  numero_eventos INT NOT NULL,
  complemento_eventos VARCHAR(100) NOT NULL,
  localidade_cep INT NOT NULL,
  PRIMARY KEY (id_eventos),
  INDEX idx_eventos_localidade (localidade_cep),
  CONSTRAINT fk_eventos_localidade FOREIGN KEY (localidade_cep) REFERENCES localidade(cep)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE eventos_igreja (
  id_eventos_igreja INT NOT NULL AUTO_INCREMENT,
  id_eventos INT NOT NULL,
  id_igreja INT NOT NULL,
  PRIMARY KEY (id_eventos_igreja),
  INDEX idx_eventos_igreja_igreja (id_igreja),
  INDEX idx_eventos_igreja_eventos (id_eventos),
  CONSTRAINT fk_eventos_igreja_eventos FOREIGN KEY (id_eventos) REFERENCES eventos(id_eventos)
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_eventos_igreja_igreja FOREIGN KEY (id_igreja) REFERENCES igreja(id_igreja)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE confirmacao (
  id_confirmacao INT NOT NULL AUTO_INCREMENT,
  id_eventos INT NOT NULL,
  id_membro INT NOT NULL,
  data_confirm DATE NOT NULL,
  status VARCHAR(50) NOT NULL,
  PRIMARY KEY (id_confirmacao),
  INDEX idx_confirmacao_eventos (id_eventos),
  INDEX idx_confirmacao_membro (id_membro),
  CONSTRAINT fk_confirmacao_eventos FOREIGN KEY (id_eventos) REFERENCES eventos(id_eventos)
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_confirmacao_membro FOREIGN KEY (id_membro) REFERENCES membro(id_membro)
    ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
