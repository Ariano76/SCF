CREATE DATABASE savethec_finanzas CHARACTER SET utf8mb4  COLLATE utf8mb4_spanish_ci;

SHOW CHARACTER SET LIKE 'utf%';
SHOW COLLATION WHERE Charset = 'utf8mb4';
DESCRIBE finanzas_paquete_aprobacion;
SHOW TABLE STATUS where name like 'finanzas_paquete_aprobacion';

SELECT CURRENT_DATE();

/*********************************
-- ELIMINAR TABLAS 
*********************************/

DROP TABLE if exists finanzas_paquete_detalle;
DROP TABLE if exists finanzas_proveedor_pago;
DROP TABLE if exists finanzas_paquete_aprobacion;
DROP TABLE if exists finanzas_paquete;
DROP TABLE if exists finanzas_estados;
DROP TABLE if exists finanzas_bono_conectividad;
DROP TABLE if exists finanzas_bono_familiar;

/*********************************
-- CREACION DE TABLAS 
*********************************/

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

insert into finanzas_bono_conectividad (asignacion) values (120.50);

insert into finanzas_bono_familiar (asignacion) values (300.50),(500.50),(900.50),(1300.50),(5300.50),(9300.50);

