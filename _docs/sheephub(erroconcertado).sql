SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
<<<<<<< HEAD
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
=======
		SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
		SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

		drop database sheephub;
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
			cep int(8) NOT NULL,
			logradouro VARCHAR(60),
			bairro VARCHAR(40),
			cidade VARCHAR(30),
			uf CHAR(2) NOT NULL,
			PRIMARY KEY (cep)
		) ENGINE=InnoDB;

		INSERT INTO localidade (cep, logradouro, bairro, cidade, uf)
		VALUES ('12345678', 'Rua Exemplo', 'Bairro Teste', 'Cidade Exemplo', 'SP');

		-- =====================
		-- 4. USUARIO
		-- =====================


		CREATE TABLE usuario (
			idusuario INT NOT NULL AUTO_INCREMENT,
			nivel INT NOT NULL,
			id_status INT NOT NULL,
			username varchar(40) unique not null,
			nome varchar(20) not null,
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

		CREATE TABLE usuario_normal (
			idusuario INT PRIMARY KEY,
			data_nascimento DATE,
			genero ENUM('masculino', 'feminino', 'outro'),
			funcao VARCHAR(50),
			telefone CHAR(11),
			FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE
		);

		CREATE TABLE usuario_instituicao ( /*apaguei descricao e site*/
			idusuario INT PRIMARY KEY,
			cnpj CHAR(14) NOT NULL,
			rede_social VARCHAR(100),
			telefone CHAR(11),
			FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE
		);

		CREATE TABLE perfil_membro ( /*apagar genero, telefone, funcao de logn,*/
			idusuario INT,
			cep int(8),
			biografia TEXT,
			foto_perfil VARCHAR(255),
			foto_fundo VARCHAR(255),
			redes_sociais VARCHAR(100),
			CONSTRAINT fk_perfil_membro_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE,
			CONSTRAINT fk_perfil_membro_cep FOREIGN KEY (cep) REFERENCES localidade(cep)
		);

		CREATE TABLE perfil_instituicao ( /*tirei telefone*/
			idusuario INT,
			cnpj CHAR(14) NOT NULL,
			descricao TEXT,
			cep int,
			site VARCHAR(100),
			foto_perfil VARCHAR(255),
			foto_fundo VARCHAR(255),
			redes_sociais VARCHAR(100),
			CONSTRAINT fk_perfil_inst_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE,
			CONSTRAINT fk_perfil_inst_cep FOREIGN KEY (cep) REFERENCES localidade(cep)
		);

		CREATE TABLE perfil_visitante ( /*adicionei foto de fundo*/
			idusuario INT,
         cep int(8),
			foto_perfil VARCHAR(255),
			foto_fundo VARCHAR(255),
			descricao TEXT,
			redes_sociais VARCHAR(100),
			CONSTRAINT fk_perfil_visitante_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE
		);


		-- =====================
		-- 7. DEPARTAMENTO (opcional)
		-- =====================
		CREATE TABLE departamento (
			id_departamento INT NOT NULL AUTO_INCREMENT,
			nome VARCHAR(40),
			idusuario_instituicao INT NOT NULL,
			PRIMARY KEY (id_departamento),
		   CONSTRAINT fk_departamento_igreja FOREIGN KEY (idusuario_instituicao)
			REFERENCES usuario_instituicao(idusuario) ON DELETE CASCADE ON UPDATE CASCADE

		) ENGINE=InnoDB;

		-- =====================
		-- 8. PERMISSAO
		-- =====================

		CREATE TABLE membros (
			id_membros INT NOT NULL AUTO_INCREMENT,
			data_nascimento DATE NULL,
			idusuario_instituicao INT NOT NULL,
			idusuario INT NOT NULL,
			data_permissao DATETIME,
			id_status INT NOT NULL,
			PRIMARY KEY (id_membros),
			CONSTRAINT fk_permissao_instituicao
				FOREIGN KEY (idusuario_instituicao)
				REFERENCES usuario_instituicao(idusuario)
				ON DELETE CASCADE ON UPDATE CASCADE,
			CONSTRAINT fk_permissao_usuario
				FOREIGN KEY (idusuario)
				REFERENCES usuario(idusuario)
				ON DELETE CASCADE ON UPDATE CASCADE,
			CONSTRAINT fk_permissao_status
				FOREIGN KEY (id_status)
				REFERENCES status(id_status)
				ON DELETE RESTRICT ON UPDATE CASCADE
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
			cep int(8) NOT NULL,
			PRIMARY KEY (ideventos),
			CONSTRAINT fk_eventos_localidade FOREIGN KEY (cep) REFERENCES localidade(cep) ON DELETE RESTRICT ON UPDATE CASCADE
		) ENGINE=InnoDB;

		-- =====================
		-- 10. EVENTOS_INSTITUIÇÃO
		-- =====================
		CREATE TABLE eventos_instituicao (
			ideventos_instituicao INT NOT NULL AUTO_INCREMENT,
			ideventos INT NOT NULL,
			idusuario_instituicao INT NOT NULL,
			PRIMARY KEY (ideventos_instituicao),
			CONSTRAINT fk_eventos_inst_eventos FOREIGN KEY (ideventos)
				REFERENCES eventos(ideventos) ON DELETE CASCADE ON UPDATE CASCADE,
			CONSTRAINT fk_eventos_inst_instituicao FOREIGN KEY (idusuario_instituicao)
				REFERENCES usuario_instituicao(idusuario) ON DELETE CASCADE ON UPDATE CASCADE
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
			idusuario_instituicao INT NOT NULL,
			valor DECIMAL(10,2),
			pago VARCHAR(20),
			PRIMARY KEY (id_plano),
			CONSTRAINT fk_plano_instituicao FOREIGN KEY (idusuario_instituicao)
				REFERENCES usuario_instituicao(idusuario) ON DELETE CASCADE ON UPDATE CASCADE
		) ENGINE=InnoDB;


		CREATE TABLE ofertas (
			id_oferta INT NOT NULL AUTO_INCREMENT,
			data_oferta DATETIME,
			valor DECIMAL(10,2),
			idusuario_instituicao INT NOT NULL,
			forma_pagamento VARCHAR(20),
			descricao VARCHAR(100),
			PRIMARY KEY (id_oferta),
			CONSTRAINT fk_ofertas_instituicao FOREIGN KEY (idusuario_instituicao)
				REFERENCES usuario_instituicao(idusuario)
				ON DELETE CASCADE ON UPDATE CASCADE
		) ENGINE=InnoDB;


		CREATE TABLE despesas (
			id_despesa INT NOT NULL AUTO_INCREMENT,
			descricao VARCHAR(100),
			valor DECIMAL(10,2),
			forma_pagamento VARCHAR(20),
			idusuario_instituicao INT NOT NULL,
			PRIMARY KEY (id_despesa),
			 CONSTRAINT fk_despesas_instituicao FOREIGN KEY (idusuario_instituicao) REFERENCES usuario_instituicao(idusuario)
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
        
			-- =====================
			-- CAIXINHA
			-- =====================
	CREATE TABLE caixinha (
		id_caixinha INT NOT NULL AUTO_INCREMENT,
		idusuario_instituicao INT NOT NULL,  -- igreja/comunidade dona da caixinha
		nome VARCHAR(80) NOT NULL,           -- nome da caixinha
		meta DECIMAL(10,2) DEFAULT 0,        -- meta de arrecadação
		total DECIMAL(10,2) DEFAULT 0,       -- total atual
		data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
		id_status INT DEFAULT 1,             -- ativo por padrão
		PRIMARY KEY (id_caixinha),
		CONSTRAINT fk_caixinha_instituicao FOREIGN KEY (idusuario_instituicao)
			REFERENCES usuario_instituicao(idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
		CONSTRAINT fk_caixinha_status FOREIGN KEY (id_status)
			REFERENCES status(id_status) ON DELETE RESTRICT ON UPDATE CASCADE
	) ENGINE=InnoDB;
SELECT * FROM caixinha;
	CREATE TABLE contribuicao (
		id INT AUTO_INCREMENT PRIMARY KEY,
		id_caixinha INT NOT NULL,
		id_usuario INT NOT NULL,
		valor DECIMAL(10,2) NOT NULL,
		data DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
		FOREIGN KEY (id_caixinha) REFERENCES caixinha(id_caixinha) ON DELETE CASCADE,
		FOREIGN KEY (id_usuario) REFERENCES usuario(idusuario) ON DELETE CASCADE
	);

CREATE TABLE IF NOT EXISTS saques_caixinha (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_caixinha INT NOT NULL,	
  valor DECIMAL(10,2) NOT NULL,
  motivo TEXT,
  data DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_caixinha) REFERENCES caixinha(id_caixinha) ON DELETE CASCADE
) ENGINE=InnoDB;

ALTER TABLE saques_caixinha
ADD COLUMN id_usuario INT NOT NULL AFTER id_caixinha;

ALTER TABLE saques_caixinha
ADD CONSTRAINT fk_saques_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(idusuario) ON DELETE CASCADE;

		-- =====================
		-- USUÁRIOS DE TESTE
		-- =====================

	INSERT INTO localidade (cep, logradouro, bairro, cidade, uf)
	VALUES ('00000000', 'Rua Teste', 'Bairro Teste', 'Cidade Teste', 'SP');

		-- Administrador
		INSERT INTO usuario (nivel, id_status, username, nome, email, senha) VALUES
		(1, 1, 'admin_master', 'Admin Master', 'admin@exemplo.com', '$2y$10$qSOCWPWxEJsrWLzCx1HU2.NkR2oTdZVON5FJC8rJVUGxU3FiTDOZi');

		-- Líder
		INSERT INTO usuario (nivel, id_status, username, nome, email, senha) VALUES
		(2, 1, 'lider_paulo', 'Paulo Lider', 'paulo@exemplo.com', '$2y$10$qSOCWPWxEJsrWLzCx1HU2.NkR2oTdZVON5FJC8rJVUGxU3FiTDOZi');

		-- Líder de comunidade
		INSERT INTO usuario (nivel, id_status, username, nome, email, senha) VALUES
		(2, 1, 'comu_maria', 'Maria Comunidade', 'maria@exemplo.com', '$2y$10$qSOCWPWxEJsrWLzCx1HU2.NkR2oTdZVON5FJC8rJVUGxU3FiTDOZi');

		-- Membros
		INSERT INTO usuario (nivel, id_status, username, nome, email, senha) VALUES
		(4, 1, 'joao_silva', 'João Silva', 'joao@exemplo.com', '$2y$10$qSOCWPWxEJsrWLzCx1HU2.NkR2oTdZVON5FJC8rJVUGxU3FiTDOZi'),
		(4, 1, 'ana_pereira', 'Ana Pereira', 'ana@exemplo.com', '$2y$10$qSOCWPWxEJsrWLzCx1HU2.NkR2oTdZVON5FJC8rJVUGxU3FiTDOZi');

		-- Visitantes
		INSERT INTO usuario (nivel, id_status, username, nome, email, senha) VALUES
		(5, 1, 'visitante01', 'Visitante 01', 'visitante1@exemplo.com', '$2y$10$qSOCWPWxEJsrWLzCx1HU2.NkR2oTdZVON5FJC8rJVUGxU3FiTDOZi'),
		(5, 1, 'visitante02', 'Visitante 02', 'visitante2@exemplo.com', '$2y$10$qSOCWPWxEJsrWLzCx1HU2.NkR2oTdZVON5FJC8rJVUGxU3FiTDOZi');

-- POPULANDO usuario_normal
-- =====================
INSERT INTO usuario_normal (idusuario, data_nascimento, genero, funcao, telefone) VALUES
-- João Silva
((SELECT idusuario FROM usuario WHERE username = 'joao_silva'), '1990-05-15', 'masculino', 'Membro de louvor', '11987654321'),
-- Ana Pereira
((SELECT idusuario FROM usuario WHERE username = 'ana_pereira'), '1995-09-23', 'feminino', 'Professora da escola bíblica', '11976543210'),
-- Maria Souza
((SELECT idusuario FROM usuario WHERE username = 'maria.souza'), '1988-03-10', 'feminino', 'Intercessora', '11912345678');

-- =====================
-- POPULANDO usuario_instituicao
-- =====================
INSERT INTO usuario_instituicao (idusuario, cnpj, rede_social, telefone) VALUES
-- Instituição associada ao líder Paulo
((SELECT idusuario FROM usuario WHERE username = 'lider_paulo'),
 '12345678000190',  'facebook.com/igrejapaulo', '1123456789'),
-- Instituição associada à comunidade da Maria
((SELECT idusuario FROM usuario WHERE username = 'comu_maria'),
 '98765432000155', 'instagram.com/comu_maria', '1134567890');

use sheephub;
SELECT c.id_caixinha, c.nome, c.idusuario_instituicao, u.nome AS dono_nome
FROM caixinha c
JOIN usuario_instituicao ui ON c.idusuario_instituicao = ui.idusuario
JOIN usuario u ON ui.idusuario = u.idusuario;

select * from caixinha;
SELECT id_caixinha, nome, total, idusuario_instituicao FROM caixinha WHERE id_caixinha = 1;

SHOW TABLES LIKE 'saques_caixinha';

SELECT * FROM caixinha;
SELECT * FROM saques_caixinha;

		


		SET SQL_MODE=@OLD_SQL_MODE;
		SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
		SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
>>>>>>> f4d0321393a89c89697f4334f12a979a84622d46
