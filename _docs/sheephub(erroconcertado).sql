SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE DATABASE IF NOT EXISTS `sheephub`;
USE `sheephub`;

-- =====================
-- 1. NIVEIS_USUARIO
-- =====================
CREATE TABLE niveis_usuario (
    id_nivelusu INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL,
    descricao VARCHAR(100)
);

INSERT INTO niveis_usuario (nome, descricao) VALUES
('Administrador', 'Controle total do sistema'),
('Líder', 'Administra a igreja'),
('Líder de comunidade', 'Gerencia comunidades específicas'),
('Membro', 'Usuário regular da igreja'),
('Visitante', 'Apenas visualiza informações públicas');

-- =====================
-- 2. STATUS
-- =====================
CREATE TABLE status (
    id_status INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(20) NOT NULL,
    descricao VARCHAR(100)
);

INSERT INTO status (nome, descricao) VALUES
('Ativo', 'Item em uso normal'),
('Inativo', 'Item desativado temporariamente'),
('Pendente', 'Aguardando confirmação'),
('Excluído', 'Removido logicamente do sistema');

-- =====================
-- 3. LOCALIDADE
-- =====================
CREATE TABLE localidade (
    cep CHAR(8) NOT NULL,
    logradouro VARCHAR(60),
    bairro VARCHAR(40),
    cidade VARCHAR(30),
    uf CHAR(2) NOT NULL,
    PRIMARY KEY (cep)
) ENGINE=InnoDB;

-- =====================
-- 4. USUARIO
-- =====================


CREATE TABLE usuario (
    idusuario INT NOT NULL AUTO_INCREMENT,
    nivel INT NOT NULL,
    id_status INT NOT NULL,
	username varchar(40) unique not null,
    nome varchar(20) not 	null,
    email VARCHAR(80) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
	dt_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (idusuario),
    CONSTRAINT fk_usuario_nivel FOREIGN KEY (nivel) REFERENCES niveis_usuario(id_nivelusu),
    CONSTRAINT fk_usuario_status FOREIGN KEY (id_status) REFERENCES status(id_status)
) ENGINE=InnoDB;

INSERT INTO usuario (nivel, id_status, username, nome, email, senha) VALUES
(1, 1, 'augustus', 'Augustus', 'augustus@exemplo.com', '$2y$10$wTf/2Zz9/oW4C9uJgX1w.e.O.4uG6gP.b2L5G0F3/L6Q4A7S6Y/F9'),
(4, 1, 'membrao_legal', 'Membro Legal', 'membro.legal@exemplo.com', '$2y$10$wTf/2Zz9/oW4C9uJgX1w.e.O.4uG6gP.b2L5G0F3/L6Q4A7S6Y/F9'),
(4, 1, 'maria.souza', 'Maria Souza', 'maria.souza@exemplo.com', '$2y$10$wTf/2Zz9/oW4C9uJgX1w.e.O.4uG6gP.b2L5G0F3/L6Q4A7S6Y/F9'),
(4, 2, 'joao_bloqueado', 'Joao Bloqueado', 'joao.bloqueado@exemplo.com', '$2y$10$wTf/2Zz9/oW4C9uJgX1w.e.O.4uG6gP.b2L5G0F3/L6Q4A7S6Y/F9'),
(5, 1, 'visitante_anonimo', 'Visitante Anônimo', 'anonimo@exemplo.com', '$2y$10$wTf/2Zz9/oW4C9uJgX1w.e.O.4uG6gP.b2L5G0F3/L6Q4A7S6Y/F9');

CREATE TABLE usuario_instituicao (
    idusuario_instituicao INT NOT NULL AUTO_INCREMENT,
    nivel INT NOT NULL,
    id_status INT NOT NULL,
    cnpj VARCHAR(20) UNIQUE NOT NULL,
    telefone_instituicao CHAR(11),
    descricao longtext,
    dt_criacao_instituicao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (idusuario_instituicao),
    CONSTRAINT fk_usuario_inst_nivel FOREIGN KEY (nivel) REFERENCES niveis_usuario(id_nivelusu),
    CONSTRAINT fk_usuario_inst_status FOREIGN KEY (id_status) REFERENCES status(id_status)
) ENGINE=InnoDB;

INSERT INTO usuario_instituicao 
(nivel, id_status, cnpj , telefone_instituicao, descricao, nome_instituicao, dt_criacao_instituicao)
VALUES
(2, 1, '12.345.678/0001-01', '$2y$10$RZHwcptxGan1I0TF5Gcm7OItAbQXrrxb4z.lynnBzrLHq8/04rZ/.', '21999998888', 'Igreja voltada à comunidade local.', '2025-01-10'),
(2, 2, '23.456.789/0001-02',  '$2y$10$RZHwcptxGan1I0TF5Gcm7OItAbQXrrxb4z.lynnBzrLHq8/04rZ/.', '21988887777', 'Igreja de jovens e atividades culturais.', '2025-02-15'),
(2, 1, '34.567.890/0001-03',  '$2y$10$RZHwcptxGan1I0TF5Gcm7OItAbQXrrxb4z.lynnBzrLHq8/04rZ/.', '21977776666', 'Igreja com foco em caridade e voluntariado.', '2025-03-20'),
(2, 1, '45.678.901/0001-04', '$2y$10$RZHwcptxGan1I0TF5Gcm7OItAbQXrrxb4z.lynnBzrLHq8/04rZ/.', '21966665555', 'Igreja com atividades educativas e sociais.', '2025-04-25');


INSERT INTO usuario_instituicao (nivel, id_status, cnpj, email_instituicao, senha_instituicao, telefone_instituicao, descricao, nome_instituicao) VALUES
(2, 1, '11222333000144', 'igreja.ativa@exemplo.com', '$2y$10$wTf/2Zz9/oW4C9uJgX1w.e.O.4uG6gP.b2L5G0F3/L6Q4A7S6Y/F9', '11987654321', 'Uma igreja que preza pela comunidade e adoração.', 'Igreja da Comunidade Ativa'),
(2, 2, '55666777000188', 'instituicao.bloqueada@exemplo.com', '$2y$10$wTf/2Zz9/oW4C9uJgX1w.e.O.4uG6gP.b2L5G0F3/L6Q4A7S6Y/F9', '21912345678', 'Instituição de caridade dedicada a ajudar os necessitados.', 'Instituição Amigos do Povo');
-- =====================
-- 5. PERFIL
-- =====================
CREATE TABLE perfil (
    idperfil INT NOT NULL AUTO_INCREMENT,
    idusuario INT NOT NULL,
    id_status INT not null,
    cep CHAR(8) NOT NULL,
    foto_perfil VARCHAR(255),
    foto_fundo VARCHAR(255),
    rede_social VARCHAR(100),
    telefone CHAR(11),
	genero ENUM('masculino', 'feminino', 'outro'),
    biografia text,
    Funcao varchar(30),
    PRIMARY KEY (idperfil),
    CONSTRAINT fk_perfil_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_perfil_status FOREIGN KEY (id_status) REFERENCES status(id_status) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_perfil_localidade FOREIGN KEY (cep) REFERENCES localidade(cep) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE perfil_instituicao (
    idperfil_instituicao INT NOT NULL AUTO_INCREMENT,
    idusuario_instituicao INT NOT NULL,
    id_status INT not null,
    cep CHAR(8) NOT NULL,
    logo VARCHAR(255),
	biografia text,
    site_instituicao VARCHAR(100),
    foto_fundo VARCHAR(255),
    rede_social VARCHAR(100),
    PRIMARY KEY (idperfil_instituicao),
    CONSTRAINT fk_perfil_inst_usuario FOREIGN KEY (idusuario_instituicao) REFERENCES usuario_instituicao(idusuario_instituicao) ON DELETE CASCADE,
	CONSTRAINT fk_perfil_inst_status FOREIGN KEY (id_status) REFERENCES status(id_status) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_perfil_inst_localidade FOREIGN KEY (cep) REFERENCES localidade(cep) ON DELETE RESTRICT ON UPDATE CASCADE
);



-- =====================
-- 7. DEPARTAMENTO (opcional)
-- =====================
CREATE TABLE departamento (
    id_departamento INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(40),
    idusuario_instituicao INT NOT NULL,
    PRIMARY KEY (id_departamento),
    CONSTRAINT fk_departamento_igreja FOREIGN KEY (idusuario_instituicao) REFERENCES usuario_instituicao(idusuario_instituicao) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================
-- 8. PERMISSAO
-- =====================

CREATE TABLE membros (
    id_membros INT NOT NULL AUTO_INCREMENT,
    data_nascimento date null,
    idusuario_instituicao INT NOT NULL,
    idusuario INT NOT NULL,
    data_permissao DATETIME,
    id_status INT NOT NULL,
    PRIMARY KEY (id_permissao),
    CONSTRAINT fk_permissao_instituicao FOREIGN KEY (idusuario_instituicao) REFERENCES usuario_instituicao(idusuario_instituicao) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_permissao_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_permissao_status FOREIGN KEY (id_status) REFERENCES status(id_status) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================
-- 9. EVENTOS
-- =====================
CREATE TABLE eventos (
    ideventos INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50),
    descricao VARCHAR(150),
    tipo VARCHAR(20),
    data_criacao DATETIME,
    cep CHAR(8) NOT NULL,
    PRIMARY KEY (ideventos),
    CONSTRAINT fk_eventos_localidade FOREIGN KEY (cep) REFERENCES localidade(cep) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================
-- 10. EVENTOS_IGREJA
-- =====================
CREATE TABLE eventos_igreja (
    ideventos_igreja INT NOT NULL AUTO_INCREMENT,
    ideventos INT NOT NULL,
    idigreja INT NOT NULL,
    PRIMARY KEY (ideventos_igreja),
    CONSTRAINT fk_eventos_igreja_eventos FOREIGN KEY (ideventos) REFERENCES eventos(ideventos) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_eventos_igreja_igreja FOREIGN KEY (idigreja) REFERENCES igreja(idigreja) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================
-- 11. USUARIO_IGREJA (substitui membro)
-- =====================
CREATE TABLE usuario_igreja (
    idusuario INT NOT NULL,
    idigreja INT NOT NULL,
    papel VARCHAR(20) DEFAULT 'Membro',
    PRIMARY KEY (idusuario, idigreja),
    CONSTRAINT fk_usuario_igreja_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_usuario_igreja_igreja FOREIGN KEY (idigreja) REFERENCES igreja(idigreja) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================
-- 12. CONFIRMACAO
-- =====================
CREATE TABLE confirmacao (
    idconfirmacao INT NOT NULL AUTO_INCREMENT,
    ideventos INT NOT NULL,
    idusuario INT NOT NULL,
    id_status INT NOT NULL,
    data_confirm DATETIME,
    PRIMARY KEY (idconfirmacao),
    CONSTRAINT fk_confirmacao_eventos FOREIGN KEY (ideventos) REFERENCES eventos(ideventos) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_confirmacao_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_confirmacao_status FOREIGN KEY (id_status) REFERENCES status(id_status) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================
-- 13. POSTAGEM, COMENTARIO, CURTIDAS
-- =====================
CREATE TABLE postagem (
    idpostagem INT NOT NULL AUTO_INCREMENT,
    idusuario INT NOT NULL,
    conteudo TEXT,
    arquivo VARCHAR(150),
    data_postagem DATETIME,
    PRIMARY KEY (idpostagem),
    CONSTRAINT fk_postagem_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE comentario (
    idcomentario INT NOT NULL AUTO_INCREMENT,
    idpostagem INT NOT NULL,
    idusuario INT NOT NULL,
    data_comentario DATETIME,
    conteudo TEXT,
    PRIMARY KEY (idcomentario),
    CONSTRAINT fk_comentario_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_comentario_postagem FOREIGN KEY (idpostagem) REFERENCES postagem(idpostagem) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE curtida_post (
    idusuario INT NOT NULL,
    idpostagem INT NOT NULL,
    PRIMARY KEY (idusuario, idpostagem),
    CONSTRAINT fk_curtida_post_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_curtida_post_postagem FOREIGN KEY (idpostagem) REFERENCES postagem(idpostagem) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE curtida_comentario (
    idcomentario INT NOT NULL,
    idusuario INT NOT NULL,
    data_curtida DATETIME,
    PRIMARY KEY (idcomentario, idusuario),
    CONSTRAINT fk_curtida_comentario FOREIGN KEY (idcomentario) REFERENCES comentario(idcomentario) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_curtida_comentario_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================
-- 14. MENSAGEM
-- =====================
CREATE TABLE mensagem (
    idmensagem INT NOT NULL AUTO_INCREMENT,
    remetente INT NOT NULL,
    destinatario INT NOT NULL,
    data_mensagem DATETIME,
    conteudo TEXT,
    arquivo VARCHAR(150),
    PRIMARY KEY (idmensagem),
    CONSTRAINT fk_mensagem_remetente FOREIGN KEY (remetente) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_mensagem_destinatario FOREIGN KEY (destinatario) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================
-- 15. PLANO, OFERTAS, DESPESAS
-- =====================
CREATE TABLE plano (
    id_plano INT NOT NULL AUTO_INCREMENT,
    idigreja INT NOT NULL,
    valor DECIMAL(10,2),
    pago VARCHAR(20),
    PRIMARY KEY (id_plano),
    CONSTRAINT fk_plano_igreja FOREIGN KEY (idigreja) REFERENCES igreja(idigreja) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE ofertas (
    id_oferta INT NOT NULL AUTO_INCREMENT,
    data_oferta DATETIME,
    valor DECIMAL(10,2),
    idigreja INT NOT NULL,
    forma_pagamento VARCHAR(20),
    descricao VARCHAR(100),
    PRIMARY KEY (id_oferta),
    CONSTRAINT fk_ofertas_igreja FOREIGN KEY (idigreja) REFERENCES igreja(idigreja) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE despesas (
    id_despesa INT NOT NULL AUTO_INCREMENT,
    descricao VARCHAR(100),
    valor DECIMAL(10,2),
    forma_pagamento VARCHAR(20),
    idigreja INT NOT NULL,
    PRIMARY KEY (id_despesa),
    CONSTRAINT fk_despesas_igreja FOREIGN KEY (idigreja) REFERENCES igreja(idigreja) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================
-- 16. SEGUINDO
-- =====================
CREATE TABLE seguindo (
    id_seguidor INT NOT NULL,
    id_seguido INT NOT NULL,
    tipo VARCHAR(20) DEFAULT 'amigo',
    PRIMARY KEY (id_seguidor, id_seguido),
    CONSTRAINT fk_seguindo_seguidor FOREIGN KEY (id_seguidor) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_seguindo_seguido FOREIGN KEY (id_seguido) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================
-- 17. NOTIFICACAO
-- =====================
CREATE TABLE notificacao (
    idnotificacao INT NOT NULL AUTO_INCREMENT,
    data_notificacao DATETIME,
    tipo VARCHAR(50),
    PRIMARY KEY (idnotificacao)
) ENGINE=InnoDB;

-- =====================
-- 18. CONFIGURACAO_NOTIFICACAO
-- =====================
CREATE TABLE configuracao_notificacao (
    idperfil INT NOT NULL,
    idnotificacao INT NOT NULL,
    recebe_email BOOLEAN,
    recebe_push BOOLEAN,
    PRIMARY KEY (idperfil, idnotificacao),
    CONSTRAINT fk_config_notificacao_perfil FOREIGN KEY (idperfil) REFERENCES perfil(idperfil) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_config_notificacao_notificacao FOREIGN KEY (idnotificacao) REFERENCES notificacao(idnotificacao) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================
-- HISTORICO_EVENTOS
-- =====================
CREATE TABLE historico_eventos (
    id_historico_eventos INT NOT NULL AUTO_INCREMENT,
    ideventos INT NOT NULL,
    usuario_idusuario INT NOT NULL,
    acao ENUM('criado','editado','excluido') NOT NULL,
    data_acao DATETIME NOT NULL,
    descricao_alteracao TEXT,
    PRIMARY KEY (id_historico_eventos),
    CONSTRAINT fk_hist_eventos_evento FOREIGN KEY (ideventos) REFERENCES eventos(ideventos) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_hist_eventos_usuario FOREIGN KEY (usuario_idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- =====================
-- HISTORICO_FINANCEIRO
-- =====================
CREATE TABLE historico_financeiro (
    id_historico_financeiro INT NOT NULL AUTO_INCREMENT,
    tipo_registro ENUM('plano','oferta','despesa') NOT NULL,
    id_registro INT NOT NULL,
    usuario_idusuario INT NOT NULL,
    valor_anterior DECIMAL(10,2),
    valor_novo DECIMAL(10,2),
    acao ENUM('criado','editado','excluido') NOT NULL,
    data_acao DATETIME NOT NULL,
    descricao_alteracao TEXT,
    PRIMARY KEY (id_historico_financeiro),
    CONSTRAINT fk_hist_fin_usuario FOREIGN KEY (usuario_idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE recuperacao_senha (
    usuario_idusuario INT NOT NULL,
    token VARCHAR(32) NOT NULL,
    expira DATETIME NOT NULL,
    PRIMARY KEY (usuario_idusuario), -- garante um token por usuário
    FOREIGN KEY (usuario_idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE
);

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
