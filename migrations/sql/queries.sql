CREATE TABLE empsys_maquina__fabricante (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(60) NOT NULL, ativo BOOLEAN NOT NULL);
CREATE TABLE empsys_maquina__modelo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, fabricante_id INTEGER NOT NULL, nome VARCHAR(255) NOT NULL, carga_total DOUBLE PRECISION NOT NULL, caracteristicas CLOB DEFAULT NULL, aplicacoes CLOB DEFAULT NULL, ativo BOOLEAN NOT NULL, CONSTRAINT FK_FD6D6DE8C0A0FDFA FOREIGN KEY (fabricante_id) REFERENCES empsys_maquina__fabricante (id) NOT DEFERRABLE INITIALLY IMMEDIATE);
CREATE INDEX IDX_FD6D6DE8C0A0FDFA ON empsys_maquina__modelo (fabricante_id);
CREATE TEMPORARY TABLE __temp__empsys__lista_empilhadeira AS SELECT id, modelo_id, cliente_id, local_id FROM empsys__lista_empilhadeira;
DROP TABLE empsys__lista_empilhadeira;
CREATE TABLE empsys__lista_empilhadeira (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, modelo_id INTEGER NOT NULL, cliente_id INTEGER DEFAULT NULL, local_id INTEGER NOT NULL, CONSTRAINT FK_58DD4C2EC3A9576E FOREIGN KEY (modelo_id) REFERENCES empsys_maquina__modelo (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_58DD4C2EDE734E51 FOREIGN KEY (cliente_id) REFERENCES empsys__cliente (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_58DD4C2E5D5A2101 FOREIGN KEY (local_id) REFERENCES empsys__local (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE);
INSERT INTO empsys__lista_empilhadeira (id, modelo_id, cliente_id, local_id) SELECT id, modelo_id, cliente_id, local_id FROM __temp__empsys__lista_empilhadeira;
DROP TABLE __temp__empsys__lista_empilhadeira;
CREATE INDEX IDX_58DD4C2E5D5A2101 ON empsys__lista_empilhadeira (local_id);
CREATE INDEX IDX_58DD4C2EDE734E51 ON empsys__lista_empilhadeira (cliente_id);
CREATE INDEX IDX_58DD4C2EC3A9576E ON empsys__lista_empilhadeira (modelo_id);

select * from empsys_maquina__modelo;


-- 28/05/2025
-- INSERTS

INSERT INTO empsys__modelo_empilhadeira (fabricante, modelo, carga_total, caracteristicas, aplicacoes) VALUES ('Hyster', 'H50FT', 5000, 'Motor diesel robusto; Transmissão automática; Sistema de controle de velocidade adaptativo; Cabine com isolamento acústico', 'Construção pesada; Logística de carga pesada; Portos e terminais');

INSERT INTO empsys__modelo_empilhadeira (fabricante, modelo, carga_total, caracteristicas, aplicacoes) VALUES ('Toyota', '8FGCU25', 2500, 'Motor a gás LPG; Sistema de estabilidade automática; Ergonomia avançada com assento ajustável;
Sistema de frenagem regenerativa.', 'Armazenagem em pátios; Manuseio de cargas paletizadas; Indústrias de médio porte');

INSERT INTO empsys__modelo_empilhadeira (fabricante, modelo, carga_total, caracteristicas, aplicacoes) VALUES ('Yale', 'GDP30VX', 3000, 'Motor elétrico com bateria de alta capacidade; Direção assistida elétrica; Sistema de recuperação de energia; Display digital para monitoramento', 'Armazéns internos; Indústrias de alimentos e bebidas; Centros de distribuição');

INSERT INTO empsys__modelo_empilhadeira (fabricante, modelo, carga_total, caracteristicas, aplicacoes) VALUES ('Clark', 'C30D', 3000, 'Motor diesel ou LPG (versão flex); Sistema de segurança antiqueda de carga; Suspensão ergonômica do operador; Fácil manutenção', 'Manuseio em áreas externas e internas; Indústrias químicas e metalúrgicas; Transporte de materiais pesados');

INSERT INTO empsys__modelo_empilhadeira (fabricante, modelo, carga_total, caracteristicas, aplicacoes) VALUES ('Komatsu', 'FG25T-16', 2500, 'Motor a gás LPG; Transmissão hidrostática; Sistema avançado de segurança; Controle eletrônico de aceleração', 'Indústrias automotivas; Centros de logística; Manuseio de cargas médias');

INSERT INTO empsys__cliente (razao_social, nome_fantasia, cnpj, ativo) VALUES ('Relâmpago McQueen', 'Relâmpago Marquinhos', '95', 1);

INSERT INTO empsys__local (nome, endereco, cidade, estado, cep, observacao, cliente_id) VALUES ('Depósito do Mate', 'Radiator Springs', 'Condado Carburetor', 'Gallup', '00012351', 'Local onde o Relâmpago McQueen foi detido após destruir a cidade', 1);

INSERT INTO empsys__lista_empilhadeira (modelo_id, cliente_id, local_id) VALUES (4, 1, 1);


-- 18/06/2025
-- implantando banco em postgresql e desativando o sqlite
CREATE SCHEMA empsys;
CREATE SCHEMA empsys_maquina;
CREATE TABLE empsys.local (id SERIAL NOT NULL, cliente_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, endereco VARCHAR(255) NOT NULL, cidade VARCHAR(255) NOT NULL, estado VARCHAR(10) NOT NULL, cep VARCHAR(15) NOT NULL, observacao VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id));
CREATE INDEX IDX_71CE277EDE734E51 ON empsys.local (cliente_id);
CREATE TABLE empsys.lista_empilhadeira (id SERIAL NOT NULL, modelo_id INT NOT NULL, cliente_id INT DEFAULT NULL, local_id INT NOT NULL, PRIMARY KEY(id));
CREATE INDEX IDX_B710A23CC3A9576E ON empsys.lista_empilhadeira (modelo_id);
CREATE INDEX IDX_B710A23CDE734E51 ON empsys.lista_empilhadeira (cliente_id);
CREATE INDEX IDX_B710A23C5D5A2101 ON empsys.lista_empilhadeira (local_id);
CREATE TABLE empsys_maquina.modelo (id SERIAL NOT NULL, fabricante_id INT NOT NULL, nome VARCHAR(255) NOT NULL, carga_total DOUBLE PRECISION NOT NULL, caracteristicas TEXT DEFAULT NULL, aplicacoes TEXT DEFAULT NULL, ativo BOOLEAN NOT NULL, PRIMARY KEY(id));
CREATE INDEX IDX_E79BCBCFC0A0FDFA ON empsys_maquina.modelo (fabricante_id);
CREATE TABLE empsys_maquina.fabricante (id SERIAL NOT NULL, nome VARCHAR(60) NOT NULL, ativo BOOLEAN NOT NULL, PRIMARY KEY(id));
CREATE TABLE empsys.cliente (id SERIAL NOT NULL, razao_social VARCHAR(255) NOT NULL, nome_fantasia VARCHAR(255) DEFAULT NULL, cnpj VARCHAR(15) NOT NULL, ativo BOOLEAN NOT NULL, PRIMARY KEY(id));
ALTER TABLE empsys.local ADD CONSTRAINT FK_71CE277EDE734E51 FOREIGN KEY (cliente_id) REFERENCES empsys.cliente (id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE empsys.lista_empilhadeira ADD CONSTRAINT FK_B710A23CC3A9576E FOREIGN KEY (modelo_id) REFERENCES empsys_maquina.modelo (id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE empsys.lista_empilhadeira ADD CONSTRAINT FK_B710A23CDE734E51 FOREIGN KEY (cliente_id) REFERENCES empsys.cliente (id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE empsys.lista_empilhadeira ADD CONSTRAINT FK_B710A23C5D5A2101 FOREIGN KEY (local_id) REFERENCES empsys.local (id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE empsys_maquina.modelo ADD CONSTRAINT FK_E79BCBCFC0A0FDFA FOREIGN KEY (fabricante_id) REFERENCES empsys_maquina.fabricante (id) NOT DEFERRABLE INITIALLY IMMEDIATE;

ALTER TABLE empsys.cliente ADD inscricao_estadual VARCHAR(20) DEFAULT NULL;
ALTER TABLE empsys.cliente ADD telefone VARCHAR(20) DEFAULT NULL;
ALTER TABLE empsys.cliente ADD email VARCHAR(100) DEFAULT NULL;
ALTER TABLE empsys.cliente ADD nome_responsavel VARCHAR(100) DEFAULT NULL;
ALTER TABLE empsys.cliente ADD endereco VARCHAR(255) DEFAULT NULL;
ALTER TABLE empsys.cliente ADD cidade VARCHAR(100) DEFAULT NULL;
ALTER TABLE empsys.cliente ADD estado VARCHAR(2) DEFAULT NULL;
ALTER TABLE empsys.cliente ADD cep VARCHAR(10) DEFAULT NULL;
ALTER TABLE empsys.cliente ADD data_cadastro TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL;

CREATE TABLE estado (id SERIAL NOT NULL, sigla VARCHAR(2) NOT NULL, nome VARCHAR(30) NOT NULL, ddd VARCHAR(2) NOT NULL, PRIMARY KEY(id));
ALTER TABLE empsys.cliente ALTER telefone SET NOT NULL;
ALTER TABLE empsys.cliente ALTER email SET NOT NULL;
ALTER TABLE empsys.cliente ALTER nome_responsavel SET NOT NULL;
ALTER TABLE empsys.cliente ALTER endereco SET NOT NULL;
ALTER TABLE empsys.cliente ALTER cidade SET NOT NULL;
ALTER TABLE empsys.cliente ALTER estado SET NOT NULL;
ALTER TABLE empsys.cliente ALTER cep SET NOT NULL;
ALTER TABLE empsys.cliente ALTER data_cadastro SET NOT NULL;


AC; Acre; 68
AL; Alagoas; 82
AP; Amapá; 96
AM; Amazonas; 92
BA; Bahia; 71
CE; Ceará; 85
DF; Distrito Federal; 61
ES; Espírito Santo; 27
GO; Goiás; 62
MA; Maranhão; 98
MT; Mato Grosso; 65
MS; Mato Grosso do Sul; 67
MG; Minas Gerais; 31
PA; Pará; 91
PB; Paraíba; 83
PR; Paraná; 41
PE; Pernambuco; 81
PI; Piauí; 86
RJ; Rio de Janeiro; 21
RN; Rio Grande do Norte; 84
RS; Rio Grande do Sul; 51
RO; Rondônia; 69
RR; Roraima; 95
SC; Santa Catarina; 48
SP; São Paulo; 11
SE; Sergipe; 79
TO; Tocantins; 63


1. Rust-eze Racing

Razão Social: Rust-eze Racing Produtos Automotivos LTDA

Nome Fantasia: Rust-eze Racing

CNPJ: 12.345.678/0001-90

Ativo: ✅

Local: São Paulo - SP

Empilhadeira: Modelo RZ-2000

Inscrição Estadual: 123.456.789.000

Telefone: (11) 4002-8922

E-mail: contato@rusteze.com.br

Nome Responsável: Tex Dinoco

Endereço: Av. dos Pistões, 95

Cidade: São Paulo

Estado: SP

CEP: 01000-000

Data de Cadastro: 2025-11-01

🛢 2. Dinoco Oil Company

Razão Social: Dinoco Lubrificantes e Derivados S/A

Nome Fantasia: Dinoco

CNPJ: 98.765.432/0001-12

Ativo: ✅

Local: Rio de Janeiro - RJ

Empilhadeira: Modelo DN-5000

Inscrição Estadual: 987.654.321.000

Telefone: (21) 3500-8899

E-mail: contato@dinoco.com.br

Nome Responsável: Dusty Rust-eze

Endereço: Rua do Petróleo, 250

Cidade: Rio de Janeiro

Estado: RJ

CEP: 20000-000

Data de Cadastro: 2025-11-01

⚙️ 3. Octane Gain Performance

Razão Social: Octane Gain Equipamentos Industriais LTDA

Nome Fantasia: Octane Gain

CNPJ: 56.789.012/0001-34

Ativo: ✅

Local: Belo Horizonte - MG

Empilhadeira: Modelo OG-3500

Inscrição Estadual: 456.789.123.000

Telefone: (31) 98888-5566

E-mail: suporte@octanegain.com.br

Nome Responsável: Billy Oilchanger

Endereço: Av. dos Motores, 77

Cidade: Belo Horizonte

Estado: MG

CEP: 30100-000

Data de Cadastro: 2025-11-01

🧰 4. Clutch Aid Motorsports

Razão Social: Clutch Aid Indústria de Componentes Automotivos LTDA

Nome Fantasia: Clutch Aid

CNPJ: 23.456.789/0001-56

Ativo: ✅

Local: Curitiba - PR

Empilhadeira: Modelo CA-4200

Inscrição Estadual: 789.456.123.000
12:10 02/11/2025
Telefone: (41) 97777-2233

E-mail: contato@clutchaid.com.br

Nome Responsável: Slim Hood

Endereço: Rua Turbo, 101

Cidade: Curitiba

Estado: PR

CEP: 80000-000

Data de Cadastro: 2025-11-01

🧴 5. Leak Less Indústria

Razão Social: Leak Less Indústria e Comércio de Autopeças LTDA

Nome Fantasia: Leak Less

CNPJ: 45.678.901/0001-78

Ativo: ✅

Local: Porto Alegre - RS

Empilhadeira: Modelo LL-2500

Inscrição Estadual: 654.321.987.000

Telefone: (51) 96666-1122

E-mail: comercial@leakless.com.br

Nome Responsável: Claude Scruggs

Endereço: Av. V8, 404

Cidade: Porto Alegre

Estado: RS

CEP: 90000-000

Data de Cadastro: 2025-11-01


CREATE SCHEMA empsys_local;
CREATE TABLE empsys_local.estado (id SERIAL NOT NULL, sigla VARCHAR(2) NOT NULL, nome VARCHAR(30) NOT NULL, ddd VARCHAR(2) NOT NULL, PRIMARY KEY(id));
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('AC', 'ACRE', '68' );
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('AL', 'ALAGOAS', '82');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('AP', 'AMAPÁ', '96');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('AM', 'AMAZONAS', '92');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('BA', 'BAHIA', '71');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('CE', 'CEARÁ', '85');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('DF', 'DISTRITO FEDERAL', '61');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('ES', 'ESPÍRITO SANTO', '27');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('GO', 'GOIÁS', '62');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('MA', 'MARANHÃO', '98');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('MT', 'MATO GROSSO', '65');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('MS', 'MATO GROSSO DO SUL', '67');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('MG', 'MINAS GERAIS', '31');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('PA', 'PARÁ', '91');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('PB', 'PARAÍBA', '83');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('PR', 'PARANÁ', '41');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('PE', 'PERNAMBUCO', '81');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('PI', 'PIAUÍ', '86');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('RJ', 'RIO DE JANEIRO', '21');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('RN', 'RIO GRANDE DO NORTE', '84');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('RS', 'RIO GRANDE DO SUL', '51');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('RO', 'RONDÔNIA', '69');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('RR', 'RORAIMA', '95');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('SC', 'SANTA CATARINA', '48');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('SP', 'SÃO PAULO', '11');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('SE', 'SERGIPE', '79');
INSERT INTO empsys_local.estado (sigla, nome, ddd) VALUES ('TO', 'TOCANTINS', '63');

CREATE SCHEMA empsys_cliente;
CREATE TABLE empsys_cliente.cliente (id SERIAL NOT NULL, estado_id INT NOT NULL, razao_social VARCHAR(255) NOT NULL, nome_fantasia VARCHAR(255) DEFAULT NULL, cnpj VARCHAR(15) NOT NULL, ativo BOOLEAN NOT NULL, inscricao_estadual VARCHAR(20) DEFAULT NULL, telefone VARCHAR(20) NOT NULL, email VARCHAR(100) NOT NULL, nome_responsavel VARCHAR(100) NOT NULL, endereco VARCHAR(255) NOT NULL, cidade VARCHAR(100) NOT NULL, cep VARCHAR(10) NOT NULL, data_cadastro TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id));
CREATE INDEX IDX_9CA149CD9F5A440B ON empsys_cliente.cliente (estado_id);
ALTER TABLE empsys_cliente.cliente ADD CONSTRAINT FK_9CA149CD9F5A440B FOREIGN KEY (estado_id) REFERENCES empsys_local.estado (id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE empsys_cliente.cliente ALTER cnpj TYPE VARCHAR(18);

CREATE TABLE empsys_local.local (id SERIAL NOT NULL, cliente_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, endereco VARCHAR(255) NOT NULL, cidade VARCHAR(255) NOT NULL, estado VARCHAR(10) NOT NULL, cep VARCHAR(15) NOT NULL, observacao VARCHAR(255) DEFAULT NULL, ativo BOOLEAN NOT NULL, PRIMARY KEY(id));
CREATE INDEX IDX_FF17737CDE734E51 ON empsys_local.local (cliente_id);
ALTER TABLE empsys_local.local ADD CONSTRAINT FK_FF17737CDE734E51 FOREIGN KEY (cliente_id) REFERENCES empsys_cliente.cliente (id) NOT DEFERRABLE INITIALLY IMMEDIATE;

ALTER TABLE empsys_local.local ADD estado_id INT NOT NULL;
ALTER TABLE empsys_local.local DROP estado;
ALTER TABLE empsys_local.local ADD CONSTRAINT FK_FF17737C9F5A440B FOREIGN KEY (estado_id) REFERENCES empsys_local.estado (id) NOT DEFERRABLE INITIALLY IMMEDIATE;
CREATE INDEX IDX_FF17737C9F5A440B ON empsys_local.local (estado_id);


CREATE TABLE empsys_maquina.maquina (id SERIAL NOT NULL, modelo_id INT NOT NULL, cliente_id INT DEFAULT NULL, local_id INT DEFAULT NULL, descricao VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id));
CREATE INDEX IDX_3E48271EC3A9576E ON empsys_maquina.maquina (modelo_id);
CREATE INDEX IDX_3E48271EDE734E51 ON empsys_maquina.maquina (cliente_id);
CREATE INDEX IDX_3E48271E5D5A2101 ON empsys_maquina.maquina (local_id);
ALTER TABLE empsys_maquina.maquina ADD CONSTRAINT FK_3E48271EC3A9576E FOREIGN KEY (modelo_id) REFERENCES empsys_maquina.modelo (id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE empsys_maquina.maquina ADD CONSTRAINT FK_3E48271EDE734E51 FOREIGN KEY (cliente_id) REFERENCES empsys_cliente.cliente (id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE empsys_maquina.maquina ADD CONSTRAINT FK_3E48271E5D5A2101 FOREIGN KEY (local_id) REFERENCES empsys_local.local (id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE empsys_maquina.maquina ADD ativo BOOLEAN NOT NULL;


CREATE SCHEMA empsys_checklist;
CREATE TABLE empsys_checklist.checklist (id SERIAL NOT NULL, maquina_id INT NOT NULL, nome VARCHAR(510) NOT NULL, data_hora_realizado TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, operador VARCHAR(255) NOT NULL, observacoes_complementares_de_seguranca TEXT DEFAULT NULL, nivel_oleo_motor VARCHAR(3) NOT NULL, nivel_oleo_transmissao VARCHAR(3) NOT NULL, nivel_oleo_hidraulico VARCHAR(3) NOT NULL, nivel_agua_radiador VARCHAR(3) NOT NULL, vazamento_oleo VARCHAR(3) NOT NULL, vazamento_glp VARCHAR(3) NOT NULL, nivel_oleo_freio VARCHAR(3) NOT NULL, buzina_sinalizador_sonoro VARCHAR(3) NOT NULL, farois_lanternas_giroflex VARCHAR(3) NOT NULL, retrovisor VARCHAR(3) NOT NULL, pneus VARCHAR(3) NOT NULL, freio VARCHAR(3) NOT NULL, freio_de_mao VARCHAR(3) NOT NULL, sistema_de_direcao VARCHAR(3) NOT NULL, garfos_corrente_da_torre VARCHAR(3) NOT NULL, extintor_de_incendio VARCHAR(3) NOT NULL, cinto_de_seguranca_ebanco VARCHAR(3) NOT NULL, instrumentos_do_painel VARCHAR(3) NOT NULL, funcionamento_motor VARCHAR(3) NOT NULL, pintura_ecarenagens VARCHAR(3) NOT NULL, limpeza_geral_externa VARCHAR(3) NOT NULL, PRIMARY KEY(id));
CREATE INDEX IDX_D26FC31241420729 ON empsys_checklist.checklist (maquina_id);
ALTER TABLE empsys_checklist.checklist ADD CONSTRAINT FK_D26FC31241420729 FOREIGN KEY (maquina_id) REFERENCES empsys_maquina.maquina (id) NOT DEFERRABLE INITIALLY IMMEDIATE;
