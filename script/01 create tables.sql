CREATE DATABASE savethec_finanzas CHARACTER SET utf8mb4  COLLATE utf8mb4_spanish_ci;

SHOW CHARACTER SET LIKE 'utf%';
SHOW COLLATION WHERE Charset = 'utf8mb4';
DESCRIBE finanzas_paquete_aprobacion;
SHOW TABLE STATUS where name like 'finanzas_paquete_aprobacion';

SELECT CURRENT_DATE();

/*********************************
-- ELIMINAR TABLAS 
*********************************/

DROP TABLE if exists finanzas_periodos;
DROP TABLE if exists finanzas_paquete_detalle;
DROP TABLE if exists finanzas_proveedor_pago;
DROP TABLE if exists finanzas_paquete_aprobacion;
DROP TABLE if exists finanzas_paquete;
DROP TABLE if exists finanzas_estados;
DROP TABLE if exists finanzas_bono_conectividad;
DROP TABLE if exists finanzas_bono_familiar;
DROP TABLE if exists finanzas_tipo_documento;
DROP TABLE if exists finanzas_stage_jetperu;
DROP TABLE if exists finanzas_stage_tpp;
DROP TABLE if exists finanzas_reporte_jetperu;
DROP TABLE if exists finanzas_reporte_tpp;
DROP TABLE if exists finanzas_stage_estado_financiero;
DROP TABLE if exists finanzas_estado_financiero;
DROP TABLE if exists finanzas_stage_ppto;
DROP TABLE if exists finanzas_stage_gastos;
/*********************************
-- CREACION DE TABLAS 
*********************************/

CREATE TABLE finanzas_periodos (
	id_periodos	integer NOT NULL AUTO_INCREMENT,
	mes			varchar(2) NOT NULL,
	anio		varchar(4) NOT NULL,
	periodo		varchar(10) NOT NULL default(concat(anio,mes)),
    PRIMARY KEY (id_periodos)
) DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
ALTER TABLE finanzas_periodos ADD CONSTRAINT const_periodos UNIQUE (mes,anio);

CREATE TABLE finanzas_paquete (
	id_paquete		INTEGER NOT NULL AUTO_INCREMENT,
	fecha			DATETIME NOT NULL DEFAULT(CURRENT_TIMESTAMP),
	id_estado		INTEGER NOT NULL DEFAULT 1,
	id_usuario		INTEGER NOT NULL,
    PRIMARY KEY (id_paquete)
) DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE finanzas_paquete_aprobacion (
	id_paquete_aprobacion	INTEGER NOT NULL AUTO_INCREMENT,
	id_paquete				INTEGER NOT NULL,
	id_estado				INTEGER NOT NULL,
	fecha_aprobacion		DATETIME NOT NULL,
    observaciones			VARCHAR(200) NULL,
	id_usuario_envio		INTEGER NULL,
    id_usuario_aprobacion	INTEGER NULL,
    PRIMARY KEY (id_paquete_aprobacion)
) DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE finanzas_paquete_detalle (
	id_paquete_detalle   INTEGER NOT NULL AUTO_INCREMENT,
	id_paquete           INTEGER NOT NULL,
	id_beneficiario      INTEGER NOT NULL,
    PRIMARY KEY (id_paquete_detalle)
) DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE finanzas_proveedor_pago (
	id_proveedor_pago    	INTEGER NOT NULL AUTO_INCREMENT,
	id_paquete_aprobacion 	INTEGER NOT NULL,
	fecha                	DATETIME NOT NULL DEFAULT(CURRENT_TIMESTAMP),
	id_estado            	INTEGER NOT NULL,
	id_usuario           	INTEGER NOT NULL,
    PRIMARY KEY (id_proveedor_pago)
) DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE finanzas_estados
(	id_estado	INTEGER NOT NULL AUTO_INCREMENT,
	estado		VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_estado)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;  

CREATE TABLE finanzas_bono_conectividad
(	id_conectividad	INTEGER NOT NULL AUTO_INCREMENT,
	asignacion		decimal(5,2) NOT NULL,
    PRIMARY KEY (id_conectividad)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;  

CREATE TABLE finanzas_bono_familiar
(	id_familiar		INTEGER NOT NULL AUTO_INCREMENT,
	asignacion		decimal(6,2) NOT NULL,
    PRIMARY KEY (id_familiar)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;  

CREATE TABLE finanzas_tipo_documento
(	id_tipo_documento	INTEGER NOT NULL AUTO_INCREMENT,
	documento			VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_tipo_documento)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;  

CREATE TABLE finanzas_stage_jetperu
(	id_stage_jetperu       	INTEGER NOT NULL AUTO_INCREMENT,
	fecha	            	VARCHAR(50) NULL,
    nro_planilla            VARCHAR(50) NULL,
    nro_orden            	VARCHAR(50) NULL,
	region            		VARCHAR(50) NULL,
	apellidos_beneficiario	VARCHAR(50) NULL,
	nombres_beneficario		VARCHAR(50) NULL,
	tipo_documento			VARCHAR(50) NULL,
	documento_identidad   	VARCHAR(50) NULL,
	monto           		VARCHAR(50) NULL,
	estado               	VARCHAR(50) NULL,
	lugar_pago 				VARCHAR(50) NULL,
	fecha_pago 				VARCHAR(50) NULL,
	hora_pago            	VARCHAR(50) NULL,
	telefono_benef          VARCHAR(50) NULL,
	codigo_interno          VARCHAR(50) NULL,
	codSeguimiento          VARCHAR(50) NULL,
	nro_tarjeta             VARCHAR(50) NULL,
	tipo_transferencia   	VARCHAR(50) NULL,
	donante           		VARCHAR(50) NULL,
    nom_usuario           	VARCHAR(50) NULL,
    PRIMARY KEY (id_stage_jetperu)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;  

CREATE TABLE finanzas_reporte_jetperu
(	id_jetperu				INT NOT NULL AUTO_INCREMENT,
	fecha	            	date NULL,
    nro_planilla            VARCHAR(50) NULL,
    nro_orden            	INT NULL,
	region            		VARCHAR(50) NULL,
	apellidos_beneficiario	VARCHAR(50) NULL,
	nombres_beneficario		VARCHAR(50) NULL,
	tipo_documento			VARCHAR(50) NULL,
	documento_identidad   	VARCHAR(50) NULL,
	monto           		DECIMAL(6,2) NULL,
	estado               	VARCHAR(50) NULL,
	lugar_pago 				VARCHAR(50) NULL,
	fecha_pago 				DATE NULL,
	hora_pago            	TIME NULL,
	telefono_benef          VARCHAR(50) NULL,
	codigo_interno          INT NULL,
	codSeguimiento          VARCHAR(50) NULL,
	nro_tarjeta             VARCHAR(50) NULL,
	tipo_transferencia   	VARCHAR(50) NULL,
	donante           		VARCHAR(50) NULL,
    nom_usuario           	VARCHAR(50) NULL,
    PRIMARY KEY (id_jetperu)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;  

CREATE TABLE finanzas_stage_tpp
(	id_stage_tpp       		INTEGER NOT NULL AUTO_INCREMENT,
	codigo_seguimiento     	VARCHAR(50) NULL,
    nro_tarjeta				VARCHAR(50) NULL,
    tipo_documento			VARCHAR(50) NULL,
    nro_documento			VARCHAR(50) NULL,
	nombres_apellidos		VARCHAR(50) NULL,
    sucursal               	VARCHAR(50) NULL,
	estado               	VARCHAR(50) NULL,
	saldo           		VARCHAR(50) NULL,
    nom_usuario				VARCHAR(50) NULL,
    PRIMARY KEY (id_stage_tpp)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;  

CREATE TABLE finanzas_reporte_tpp
(	id_tpp       		INTEGER NOT NULL AUTO_INCREMENT,
	codigo_seguimiento	VARCHAR(50) NULL,
    nro_tarjeta			VARCHAR(50) NULL,
    tipo_documento		VARCHAR(50) NULL,
    nro_documento		VARCHAR(50) NULL,
	nombres_apellidos	VARCHAR(50) NULL,
    sucursal			VARCHAR(50) NULL,
	estado				VARCHAR(50) NULL,
	saldo				DECIMAL(6,2) NULL,
    nom_usuario			VARCHAR(50) NULL,
    PRIMARY KEY (id_tpp)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;  

CREATE TABLE finanzas_stage_estado_financiero
(	id_stage_estado     INTEGER NOT NULL AUTO_INCREMENT,
	account_			VARCHAR(50) NULL,
    period            	VARCHAR(50) NULL,
    trans_date         	VARCHAR(50) NULL,
	usd_amount			VARCHAR(50) NULL,
	cur					VARCHAR(50) NULL,
	trans_cur_amt		VARCHAR(50) NULL,
	donor_currency		VARCHAR(50) NULL,
	donor_cur_amount	VARCHAR(50) NULL,
	costc	       		VARCHAR(50) NULL,
	project           	VARCHAR(50) NULL,
	sof					VARCHAR(50) NULL,
	dea					VARCHAR(50) NULL,
	dea_t            	VARCHAR(50) NULL,
	text_		        VARCHAR(510) NULL,
	trans_no			VARCHAR(50) NULL,
	analysis_type_t     VARCHAR(50) NULL,
	analysis			VARCHAR(50) NULL,
	analysis_t			VARCHAR(50) NULL,
    PRIMARY KEY (id_stage_estado)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;  

CREATE TABLE finanzas_estado_financiero
(	id_estado_financiero	INTEGER NOT NULL AUTO_INCREMENT,
	account_		integer NULL,	
    period			integer NULL,	
    trans_date		date NULL,
	usd_amount		decimal(8,2) NULL,	
    cur				VARCHAR(50) NULL,	
    trans_cur_amt	decimal(8,2) NULL,
	donor_currency	VARCHAR(50) NULL,	
    donor_cur_amount	decimal(8,2) NULL,	
    costc			integer NULL,
	project			integer NULL,	
    sof				integer NULL,	
    dea				VARCHAR(50) NULL,	
    dea_t			VARCHAR(255) NULL,
	text_			VARCHAR(510) NULL,	
    trans_no		integer NULL,	
    analysis_type_t	VARCHAR(50) NULL,
	analysis		VARCHAR(50) NULL,	
    analysis_t		VARCHAR(255) NULL,
    PRIMARY KEY (id_estado_financiero)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;  

CREATE TABLE finanzas_stage_ppto
(	id_stage_ppto	INTEGER NOT NULL AUTO_INCREMENT,
	dea				VARCHAR(50) NULL,
    anio			VARCHAR(50) NULL,
    mes				VARCHAR(50) NULL,
    monto			VARCHAR(50) NULL,
    PRIMARY KEY (id_stage_ppto)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;  

CREATE TABLE finanzas_stage_gastos
(	id_stage_gasto	INTEGER NOT NULL AUTO_INCREMENT,
	account_f		VARCHAR(255) NULL,
    Costc			VARCHAR(255) NULL,
    Project			VARCHAR(255) NULL,
    dea				VARCHAR(255) NULL,
    dea_t			VARCHAR(255) NULL,
    period			VARCHAR(255) NULL,
    transaction_date		VARCHAR(255) NULL,
    transaction_currency	VARCHAR(255) NULL,
    amount_in_transaction_currency	VARCHAR(255) NULL,
    amount_in_usd		VARCHAR(255) NULL,
    donor_currency		VARCHAR(255) NULL,
    donor_cur_amount	VARCHAR(255) NULL,
    trans_no			VARCHAR(255) NULL,
    analysis_type		VARCHAR(255) NULL,
    analysis			VARCHAR(255) NULL,
    transaction_desc	VARCHAR(255) NULL,
    PRIMARY KEY (id_stage_gasto)
) DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;  


/*********************************
-- CREACION DE LLAVES FORANEAS 
*********************************/
ALTER TABLE finanzas_paquete_aprobacion ADD FOREIGN KEY R_4 (id_paquete) REFERENCES finanzas_paquete (id_paquete);
ALTER TABLE finanzas_paquete_aprobacion ADD FOREIGN KEY R_2 (id_usuario_envio) REFERENCES usuarios (id_usuario);
ALTER TABLE finanzas_paquete_aprobacion ADD FOREIGN KEY R_7 (id_usuario_aprobacion) REFERENCES usuarios (id_usuario);
ALTER TABLE finanzas_paquete_aprobacion ADD FOREIGN KEY R_8 (id_estado) REFERENCES finanzas_estados (id_estado);

ALTER TABLE finanzas_paquete ADD FOREIGN KEY R_1 (id_usuario) REFERENCES usuarios (id_usuario);
ALTER TABLE finanzas_paquete_detalle ADD FOREIGN KEY R_3 (id_paquete) REFERENCES finanzas_paquete (id_paquete);
ALTER TABLE finanzas_paquete ADD FOREIGN KEY R_9 (id_estado) REFERENCES finanzas_estados (id_estado);

ALTER TABLE finanzas_proveedor_pago ADD FOREIGN KEY R_6 (id_paquete_aprobacion) REFERENCES finanzas_paquete_aprobacion (id_paquete_aprobacion);
ALTER TABLE finanzas_proveedor_pago ADD FOREIGN KEY R_5 (id_usuario) REFERENCES usuarios (id_usuario);




/*********************************
-- INSERTANDO DATOS INICIALES 
*********************************/

insert into finanzas_estados (estado) values ('Enviado');
insert into finanzas_estados (estado) values ('Pendiente');
insert into finanzas_estados (estado) values ('Aprobado');
insert into finanzas_estados (estado) values ('Rechazado');

insert into finanzas_bono_conectividad (asignacion) values (120.255);

insert into finanzas_bono_familiar (asignacion) values (300.255),(2550.50),(900.50),(1300.50),(5300.50),(9300.50);
insert into finanzas_tipo_documento (documento) 
values ('DNI'),('Otro'),('CPP'),('Carnet Extranjeria'),('Ruc'),('Pasaporte'),('PTP'),('Cedula'),('Carné de Refugiado');

insert into finanzas_periodos (mes, anio) values ('01','2021'),('02','2021'),('03','2021'),('04','2021'),('05','2021'),
('06','2021'),('07','2021'),('08','2021'),('09','2021'),('10','2021'),('11','2021'),('12','2021'),('01','2022'),
('02','2022'),('03','2022'),('04','2022'),('05','2022'),('06','2022'),('07','2022'),('08','2022'),('09','2022'),
('10','2022'),('11','2022'),('12','2022');


/***********************************************
-- REINICIAR EL AUTO INCREMENTE DE LAS TABLAS 
************************************************/
ALTER TABLE finanzas_periodos AUTO_INCREMENT = 1;
truncate table finanzas_periodos ;
