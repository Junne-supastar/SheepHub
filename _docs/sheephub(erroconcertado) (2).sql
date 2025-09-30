SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
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
			cep CHAR(8) NOT NULL,
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

		CREATE TABLE usuario_instituicao (
			idusuario INT PRIMARY KEY,
			cnpj CHAR(14) NOT NULL,
			site VARCHAR(100),
			rede_social VARCHAR(100),
			telefone CHAR(11),
			descricao TEXT,
			FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE
		);

		CREATE TABLE perfil_membro (
			idusuario INT PRIMARY KEY,
			cep CHAR(8),
			telefone char(20),
			genero ENUM('masculino', 'feminino', 'outro'),
			biografia TEXT,
			funcao VARCHAR(30),
			foto_perfil VARCHAR(255),
			foto_fundo VARCHAR(255),
			redes_sociais VARCHAR(100),
			CONSTRAINT fk_perfil_membro_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE,
			CONSTRAINT fk_perfil_membro_cep FOREIGN KEY (cep) REFERENCES localidade(cep)
		);

		CREATE TABLE perfil_instituicao (
			idusuario INT PRIMARY KEY,
			cnpj CHAR(14) NOT NULL,
			descricao TEXT,
			cep CHAR(8),
			site VARCHAR(100),
			telefone CHAR(11),
			foto_perfil VARCHAR(255),
			foto_fundo VARCHAR(255),
			redes_sociais VARCHAR(100),
			CONSTRAINT fk_perfil_inst_usuario FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE,
			CONSTRAINT fk_perfil_inst_cep FOREIGN KEY (cep) REFERENCES localidade(cep)
		);

		CREATE TABLE perfil_visitante (
			idusuario INT PRIMARY KEY,
			foto_perfil VARCHAR(255),
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
			cep CHAR(8) NOT NULL,
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
		(3, 1, 'comu_maria', 'Maria Comunidade', 'maria@exemplo.com', '$2y$10$qSOCWPWxEJsrWLzCx1HU2.NkR2oTdZVON5FJC8rJVUGxU3FiTDOZi');

		-- Membros
		INSERT INTO usuario (nivel, id_status, username, nome, email, senha) VALUES
		(4, 1, 'joao_silva', 'João Silva', 'joao@exemplo.com', '$2y$10$qSOCWPWxEJsrWLzCx1HU2.NkR2oTdZVON5FJC8rJVUGxU3FiTDOZi'),
		(4, 1, 'ana_pereira', 'Ana Pereira', 'ana@exemplo.com', '$2y$10$qSOCWPWxEJsrWLzCx1HU2.NkR2oTdZVON5FJC8rJVUGxU3FiTDOZi');

		-- Visitantes
		INSERT INTO usuario (nivel, id_status, username, nome, email, senha) VALUES
		(5, 1, 'visitante01', 'Visitante 01', 'visitante1@exemplo.com', '$2y$10$qSOCWPWxEJsrWLzCx1HU2.NkR2oTdZVON5FJC8rJVUGxU3FiTDOZi'),
		(5, 1, 'visitante02', 'Visitante 02', 'visitante2@exemplo.com', '$2y$10$qSOCWPWxEJsrWLzCx1HU2.NkR2oTdZVON5FJC8rJVUGxU3FiTDOZi');

		

		


		SET SQL_MODE=@OLD_SQL_MODE;
		SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
		SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;