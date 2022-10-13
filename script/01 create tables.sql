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
/*********************************
-- CREACION DE TABLAS 
*********************************/
CREATE TABLE finanzas_paquete
(
	id_paquete           INTEGER NOT NULL AUTO_INCREMENT,
	fecha                DATETIME NOT NULL DEFAULT(CURRENT_TIMESTAMP),
	observaciones        VARCHAR(200) NULL,
	estado               INTEGER NOT NULL DEFAULT 1,
	id_usuario           INTEGER NOT NULL,
    PRIMARY KEY (id_paquete)
) DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE finanzas_paquete_aprobacion
(
	id_paquete_aprobacion INTEGER NOT NULL AUTO_INCREMENT,
	id_paquete           INTEGER NOT NULL,
	estado               INTEGER NOT NULL,
	fecha                DATE NOT NULL,
	id_usuario           INTEGER NOT NULL,
    PRIMARY KEY (id_paquete_aprobacion)
) DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE finanzas_paquete_detalle
(
	id_paquete_detalle   INTEGER NOT NULL AUTO_INCREMENT,
	id_paquete           INTEGER NOT NULL,
	estado               INTEGER NOT NULL,
	id_beneficiario      INTEGER NOT NULL,
    PRIMARY KEY (id_paquete_detalle)
) DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE finanzas_proveedor_pago
(
	id_proveedor_pago    INTEGER NOT NULL AUTO_INCREMENT,
	id_paquete_aprobacion INTEGER NOT NULL,
	fecha                DATE NOT NULL,
	estado               INTEGER NOT NULL,
	id_usuario           INTEGER NOT NULL,
    PRIMARY KEY (id_proveedor_pago)
) DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*********************************
-- CREACION DE LLAVES FORANEAS 
*********************************/
ALTER TABLE finanzas_paquete_aprobacion ADD FOREIGN KEY R_4 (id_paquete) REFERENCES finanzas_paquete (id_paquete);
ALTER TABLE finanzas_paquete_aprobacion ADD FOREIGN KEY R_2 (id_usuario) REFERENCES usuarios (id_usuario);

ALTER TABLE finanzas_paquete_detalle ADD FOREIGN KEY R_3 (id_paquete) REFERENCES finanzas_paquete (id_paquete);

ALTER TABLE finanzas_proveedor_pago ADD FOREIGN KEY R_6 (id_paquete_aprobacion) REFERENCES finanzas_paquete_aprobacion (id_paquete_aprobacion);
ALTER TABLE finanzas_proveedor_pago ADD FOREIGN KEY R_5 (id_usuario) REFERENCES usuarios (id_usuario);

ALTER TABLE finanzas_paquete ADD FOREIGN KEY R_1 (id_usuario) REFERENCES usuarios (id_usuario);
