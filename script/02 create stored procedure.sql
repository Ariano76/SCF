
/*********************************
-- CREAR STORED PROCEDURE
*********************************/

DROP PROCEDURE IF EXISTS `SP_Paquete_Finanzas`;
DELIMITER |
CREATE PROCEDURE `SP_Paquete_Finanzas`(in depa varchar(50))
BEGIN
	SELECT enc.fecha_encuesta, b.region_beneficiario, b.en_que_provincia, b.en_que_distrito, b.transit_settle, 
    b.primer_nombre, b.segundo_nombre, b.primer_apellido, b.segundo_apellido, 
    CASE b.documentos_fisico_original 
     WHEN 'Primero' THEN 'Cedula'
     WHEN 'Segundo' THEN b.tipo_identificacion
     WHEN 'Ninguno' THEN 'Cedula'
     ELSE 'Cedula'
	END AS 'Tipo de Identificacion', 
    CASE b.documentos_fisico_original
     WHEN 'Primero' THEN b.numero_cedula
     WHEN 'Segundo' THEN b.numero_identificacion
     WHEN 'Ninguno' THEN b.numero_cedula
     ELSE b.numero_cedula
	END AS 'Numero de identificacion', b.documentos_fisico_original,    
    c.cual_es_su_numero_whatsapp, c.cual_es_su_numero_recibir_sms, c.cual_es_su_direccion, 
    if(length(concat(i.nombre_1a,' ',i.nombre_1b))<3,0,1) +	if(length(concat(i.nombre_2a,' ',i.nombre_2b))<3,0,1) + 
    if(length(concat(i.nombre_3a,' ',i.nombre_3b))<3,0,1) +	if(length(concat(i.nombre_4a,' ',i.nombre_4b))<3,0,1) + 
    if(length(concat(i.nombre_5a,' ',i.nombre_5b))<3,0,1) +	if(length(concat(i.nombre_6a,' ',i.nombre_6b))<3,0,1) + 
    if(length(concat(i.nombre_7a,' ',i.nombre_7b))<3,0,1) + 1
	as 'numero de personas en la familia',
    c.tiene_los_siguientes_medios_comunicacion, c.como_accede_a_internet, 
    F_SINO(dersec.interesado_participar_nutricion) as interesado_participar_nutricion, 
    IF((c.laptop=1 or c.smartphone=1) and dersec.interesado_participar_nutricion=1 
    and (c.como_accede_a_internet="Por wifi  por horas" 
    or c.como_accede_a_internet="Un conocido le provee acceso wifi o plan de datos en celular, por algunas horas/días" 
    or c.como_accede_a_internet="Por datos de celular que recarga de forma interdiaria (prepago)" 
    or c.como_accede_a_internet="Ninguna de las anteriores"),"Si","No") as bono_nutricion,
    b.id_beneficiario
	FROM beneficiario b inner join comunicacion c on b.id_beneficiario = c.id_beneficiario
	inner join educacion e on b.id_beneficiario = e.id_beneficiario
	inner join encuesta enc on b.id_beneficiario = enc.id_beneficiario 
	inner join derivacion_sectores dersec on b.id_beneficiario = dersec.id_beneficiario 
	inner join integrantes i on b.id_beneficiario = i.id_beneficiario 
	inner join estatus est on b.id_beneficiario = est.id_beneficiario 
	inner join estados on estados.id_estado = est.id_estado 
	where estados.id_estado = 1 and b.region_beneficiario=depa and 
    b.id_beneficiario in (select fpd.id_beneficiario from finanzas_paquete_detalle fpd
	inner join finanzas_paquete_aprobacion fpa on fpd.id_paquete = fpa.id_paquete
	where fpa.id_estado = 4 and fpd.id_beneficiario not in (
	SELECT fpd.id_beneficiario FROM bd_bha_sci.finanzas_paquete_detalle as fpd
	inner join finanzas_paquete_aprobacion as fpa on fpd.id_paquete = fpa.id_paquete
	inner join finanzas_estados as fe on fpa.id_estado = fe.id_estado
	where fpa.id_estado = 2 ));
END |
DELIMITER ;


DROP PROCEDURE IF EXISTS `SP_Paquete_Finanzas_Insert`;
DELIMITER |
CREATE PROCEDURE `SP_Paquete_Finanzas_Insert`(in depa varchar(50), in usuario varchar(50), OUT success INT)
BEGIN
	DECLARE exit handler for sqlexception
    
	BEGIN     -- ERROR
		SET success = 0;
	ROLLBACK;
	END;
 
	START TRANSACTION;
    SET success = 2; -- CODIGO 2, NO EXISTEN REGISTROS PARA INSERTAR
	
    select @count_records := count(b.id_beneficiario) from beneficiario b 
	inner join estatus est on b.id_beneficiario = est.id_beneficiario 
	inner join estados on estados.id_estado = est.id_estado 
	where estados.id_estado = 1 and b.region_beneficiario = depa and 
    b.id_beneficiario in (select fpd.id_beneficiario from finanzas_paquete_detalle fpd
	inner join finanzas_paquete_aprobacion fpa on fpd.id_paquete = fpa.id_paquete
	where fpa.id_estado = 4 and fpd.id_beneficiario not in (
	SELECT fpd.id_beneficiario FROM bd_bha_sci.finanzas_paquete_detalle as fpd
	inner join finanzas_paquete_aprobacion as fpa on fpd.id_paquete = fpa.id_paquete
	inner join finanzas_estados as fe on fpa.id_estado = fe.id_estado
	where fpa.id_estado = 2 ));
    
    SET @usuario = Codigo_User(usuario);
    
    IF @count_records > 0 AND @usuario > 0 THEN
		insert into finanzas_paquete(id_usuario) values (@usuario);
		
        SET @codigo_paquete := last_insert_id();
      
		insert into finanzas_paquete_detalle(id_paquete, id_beneficiario)  
		SELECT @codigo_paquete, b.id_beneficiario FROM beneficiario b 
		inner join estatus est on b.id_beneficiario = est.id_beneficiario 
		inner join estados on estados.id_estado = est.id_estado 
		where estados.id_estado = 1 and b.region_beneficiario = depa and 
		b.id_beneficiario in (select fpd.id_beneficiario from finanzas_paquete_detalle fpd
		inner join finanzas_paquete_aprobacion fpa on fpd.id_paquete = fpa.id_paquete
		where fpa.id_estado = 4 and fpd.id_beneficiario not in (
		SELECT fpd.id_beneficiario FROM bd_bha_sci.finanzas_paquete_detalle as fpd
		inner join finanzas_paquete_aprobacion as fpa on fpd.id_paquete = fpa.id_paquete
		inner join finanzas_estados as fe on fpa.id_estado = fe.id_estado
		where fpa.id_estado = 2 ));
        
        /* estado = 2 (pendiente) */
        insert into finanzas_paquete_aprobacion(id_paquete, id_estado, id_usuario_envio) 
        values(@codigo_paquete, 2, @usuario);
        
		SET success = 1; -- CODIGO 1, SE INSERTARON REGISTROS
	END IF;
    COMMIT;
END |
DELIMITER ;

DROP PROCEDURE IF EXISTS `SP_reporte_finanzas_regiones`;
DELIMITER |
CREATE PROCEDURE `SP_reporte_finanzas_regiones`()
BEGIN
	select distinct(b.region_beneficiario) region
	FROM beneficiario b inner join estatus est on b.id_beneficiario = est.id_beneficiario 
	inner join estados on estados.id_estado = est.id_estado 
	where estados.id_estado = 1 and 
	b.id_beneficiario in (select fpd.id_beneficiario from finanzas_paquete_detalle fpd
	inner join finanzas_paquete_aprobacion fpa on fpd.id_paquete = fpa.id_paquete
	where fpa.id_estado = 4 and fpd.id_beneficiario not in (
	SELECT fpd.id_beneficiario FROM bd_bha_sci.finanzas_paquete_detalle as fpd
	inner join finanzas_paquete_aprobacion as fpa on fpd.id_paquete = fpa.id_paquete
	inner join finanzas_estados as fe on fpa.id_estado = fe.id_estado
	where fpa.id_estado = 2 )) 
	order by b.region_beneficiario;
END |
DELIMITER ;

DROP PROCEDURE IF EXISTS `SP_reporte_finanzas_valorizacion`;
DELIMITER |
CREATE PROCEDURE `SP_reporte_finanzas_valorizacion`(in codpaquete int)
BEGIN
	select fpd.id_beneficiario, fp.id_paquete, fe.estado as estado_aprobacion,
	enc.fecha_encuesta, b.region_beneficiario, b.en_que_provincia, b.en_que_distrito, b.transit_settle, 
    b.primer_nombre, b.segundo_nombre, b.primer_apellido, b.segundo_apellido, 
    CASE b.documentos_fisico_original 
     WHEN 'Primero' THEN 'Cedula'
     WHEN 'Segundo' THEN b.tipo_identificacion
     WHEN 'Ninguno' THEN 'Cedula'
     ELSE 'Cedula'
	END AS 'Tipo de Identificacion', 
    CASE b.documentos_fisico_original
     WHEN 'Primero' THEN b.numero_cedula
     WHEN 'Segundo' THEN b.numero_identificacion
     WHEN 'Ninguno' THEN b.numero_cedula
     ELSE b.numero_cedula
	END AS 'Numero de identificacion', b.documentos_fisico_original, 
    c.cual_es_su_numero_whatsapp, c.cual_es_su_numero_recibir_sms, c.cual_es_su_direccion, 
    if(length(concat(i.nombre_1a,' ',i.nombre_1b))<3,0,1) +	if(length(concat(i.nombre_2a,' ',i.nombre_2b))<3,0,1) + 
    if(length(concat(i.nombre_3a,' ',i.nombre_3b))<3,0,1) +	if(length(concat(i.nombre_4a,' ',i.nombre_4b))<3,0,1) + 
    if(length(concat(i.nombre_5a,' ',i.nombre_5b))<3,0,1) +	if(length(concat(i.nombre_6a,' ',i.nombre_6b))<3,0,1) + 
    if(length(concat(i.nombre_7a,' ',i.nombre_7b))<3,0,1) + 1 as 'numero de personas en la familia',
    c.tiene_los_siguientes_medios_comunicacion, c.como_accede_a_internet, 
    F_SINO(dersec.interesado_participar_nutricion) as interesado_participar_nutricion, 
    IF((c.laptop=1 or c.smartphone=1) and dersec.interesado_participar_nutricion=1 
    and (c.como_accede_a_internet="Por wifi  por horas" 
    or c.como_accede_a_internet="Un conocido le provee acceso wifi o plan de datos en celular, por algunas horas/días" 
    or c.como_accede_a_internet="Por datos de celular que recarga de forma interdiaria (prepago)" 
    or c.como_accede_a_internet="Ninguna de las anteriores"),"SI","NO") as bono_nutricion,
    IF((c.laptop=1 or c.smartphone=1) and dersec.interesado_participar_nutricion=1 
    and (c.como_accede_a_internet="Por wifi  por horas" 
    or c.como_accede_a_internet="Un conocido le provee acceso wifi o plan de datos en celular, por algunas horas/días" 
    or c.como_accede_a_internet="Por datos de celular que recarga de forma interdiaria (prepago)" 
    or c.como_accede_a_internet="Ninguna de las anteriores"),
    (SELECT asignacion from finanzas_bono_conectividad where id_conectividad=1),0) as bono_conectividad, 
    curdate() as fecha_estadia_1,
    CASE if(length(concat(i.nombre_1a,' ',i.nombre_1b))<3,0,1) + if(length(concat(i.nombre_2a,' ',i.nombre_2b))<3,0,1) + 
    if(length(concat(i.nombre_3a,' ',i.nombre_3b))<3,0,1) +	if(length(concat(i.nombre_4a,' ',i.nombre_4b))<3,0,1) + 
    if(length(concat(i.nombre_5a,' ',i.nombre_5b))<3,0,1) +	if(length(concat(i.nombre_6a,' ',i.nombre_6b))<3,0,1) + 
    if(length(concat(i.nombre_7a,' ',i.nombre_7b))<3,0,1) + 1
     WHEN 1 THEN (select asignacion from finanzas_bono_familiar where id_familiar=1)
     WHEN 2 THEN (select asignacion from finanzas_bono_familiar where id_familiar=2)
     WHEN 3 THEN (select asignacion from finanzas_bono_familiar where id_familiar=3)
     WHEN 4 THEN (select asignacion from finanzas_bono_familiar where id_familiar=4)
     WHEN 5 THEN (select asignacion from finanzas_bono_familiar where id_familiar=5)
     ELSE (select asignacion from finanzas_bono_familiar where id_familiar=6)
	END AS 'importe transferido estadia_1',
    DATE_ADD(curdate(), INTERVAL 1 MONTH) as fecha_estadia_2,
    CASE if(length(concat(i.nombre_1a,' ',i.nombre_1b))<3,0,1) + if(length(concat(i.nombre_2a,' ',i.nombre_2b))<3,0,1) + 
    if(length(concat(i.nombre_3a,' ',i.nombre_3b))<3,0,1) +	if(length(concat(i.nombre_4a,' ',i.nombre_4b))<3,0,1) + 
    if(length(concat(i.nombre_5a,' ',i.nombre_5b))<3,0,1) +	if(length(concat(i.nombre_6a,' ',i.nombre_6b))<3,0,1) + 
    if(length(concat(i.nombre_7a,' ',i.nombre_7b))<3,0,1) + 1
     WHEN 1 THEN (select asignacion from finanzas_bono_familiar where id_familiar=1)
     WHEN 2 THEN (select asignacion from finanzas_bono_familiar where id_familiar=2)
     WHEN 3 THEN (select asignacion from finanzas_bono_familiar where id_familiar=3)
     WHEN 4 THEN (select asignacion from finanzas_bono_familiar where id_familiar=4)
     WHEN 5 THEN (select asignacion from finanzas_bono_familiar where id_familiar=5)
     ELSE (select asignacion from finanzas_bono_familiar where id_familiar=6)
	END AS 'importe transferido estadia_2',
    DATE_ADD(curdate(), INTERVAL 2 MONTH) as fecha_estadia_3,
    CASE if(length(concat(i.nombre_1a,' ',i.nombre_1b))<3,0,1) + if(length(concat(i.nombre_2a,' ',i.nombre_2b))<3,0,1) + 
    if(length(concat(i.nombre_3a,' ',i.nombre_3b))<3,0,1) +	if(length(concat(i.nombre_4a,' ',i.nombre_4b))<3,0,1) + 
    if(length(concat(i.nombre_5a,' ',i.nombre_5b))<3,0,1) +	if(length(concat(i.nombre_6a,' ',i.nombre_6b))<3,0,1) + 
    if(length(concat(i.nombre_7a,' ',i.nombre_7b))<3,0,1) + 1
     WHEN 1 THEN (select asignacion from finanzas_bono_familiar where id_familiar=1)
     WHEN 2 THEN (select asignacion from finanzas_bono_familiar where id_familiar=2)
     WHEN 3 THEN (select asignacion from finanzas_bono_familiar where id_familiar=3)
     WHEN 4 THEN (select asignacion from finanzas_bono_familiar where id_familiar=4)
     WHEN 5 THEN (select asignacion from finanzas_bono_familiar where id_familiar=5)
     ELSE (select asignacion from finanzas_bono_familiar where id_familiar=6)
	END AS 'importe transferido estadia_3',
    DATE_ADD(curdate(), INTERVAL 3 MONTH) as fecha_estadia_4,
    CASE if(length(concat(i.nombre_1a,' ',i.nombre_1b))<3,0,1) + if(length(concat(i.nombre_2a,' ',i.nombre_2b))<3,0,1) + 
    if(length(concat(i.nombre_3a,' ',i.nombre_3b))<3,0,1) +	if(length(concat(i.nombre_4a,' ',i.nombre_4b))<3,0,1) + 
    if(length(concat(i.nombre_5a,' ',i.nombre_5b))<3,0,1) +	if(length(concat(i.nombre_6a,' ',i.nombre_6b))<3,0,1) + 
    if(length(concat(i.nombre_7a,' ',i.nombre_7b))<3,0,1) + 1
     WHEN 1 THEN (select asignacion from finanzas_bono_familiar where id_familiar=1)
     WHEN 2 THEN (select asignacion from finanzas_bono_familiar where id_familiar=2)
     WHEN 3 THEN (select asignacion from finanzas_bono_familiar where id_familiar=3)
     WHEN 4 THEN (select asignacion from finanzas_bono_familiar where id_familiar=4)
     WHEN 5 THEN (select asignacion from finanzas_bono_familiar where id_familiar=5)
     ELSE (select asignacion from finanzas_bono_familiar where id_familiar=6)
	END AS 'importe transferido estadia_4'
	from finanzas_paquete as fp inner join finanzas_paquete_aprobacion as fpa on fp.id_paquete = fpa.id_paquete
	inner join finanzas_paquete_detalle as fpd on fp.id_paquete = fpd.id_paquete
    inner join finanzas_estados as fe on fpa.id_estado = fe.id_estado
	inner join beneficiario b on fpd.id_beneficiario = b.id_beneficiario
	inner join comunicacion c on fpd.id_beneficiario = c.id_beneficiario
	inner join educacion e on fpd.id_beneficiario = e.id_beneficiario
	inner join encuesta enc on fpd.id_beneficiario = enc.id_beneficiario 
	inner join derivacion_sectores dersec on fpd.id_beneficiario = dersec.id_beneficiario 
	inner join integrantes i on fpd.id_beneficiario = i.id_beneficiario 
	inner join estatus est on b.id_beneficiario = est.id_beneficiario 
	inner join estados on estados.id_estado = est.id_estado 
	where fp.id_paquete = codpaquete;
END |
DELIMITER ;

call SP_reporte_finanzas_valorizacion(3);




/*********************************
-- CREAR FUNCIONES
*********************************/
DROP FUNCTION IF EXISTS `Codigo_User`;
DELIMITER |
CREATE FUNCTION `Codigo_User`(usuario varchar(50)) RETURNS int(11)
	NO SQL
BEGIN
	SET @usuario := (SELECT id_usuario FROM usuarios where nombre_usuario = usuario);
    IF @usuario IS NULL THEN
		RETURN 0; -- si no existe usuario devuelve 0
	ELSE
		RETURN (SELECT id_usuario FROM usuarios where nombre_usuario = usuario); 
        -- si existe el usuario devolvera su codigo
    END IF;
END |
DELIMITER ;


/*********************************
-- CREAR VISTAS
*********************************/
DROP VIEW IF EXISTS vista_finanzas_consulta;
CREATE VIEW `vista_finanzas_consulta` AS
	select fp.id_paquete,  fe1.estado, fp.fecha as 'fecha_envio', usu.nombre_usuario, 
    fe2.estado as 'estado_aprobacion', count(fpd.id_paquete_detalle) as 'numero_beneficiarios'
	from finanzas_paquete as fp inner join finanzas_paquete_aprobacion as fpa on fp.id_paquete = fpa.id_paquete
	inner join finanzas_estados as fe1 on fp.id_estado = fe1.id_estado
	inner join finanzas_estados as fe2 on fpa.id_estado = fe2.id_estado
	inner join finanzas_paquete_detalle as fpd on fp.id_paquete = fpd.id_paquete
    inner join usuarios as usu on fp.id_usuario = usu.id_usuario
	group by fp.id_paquete,  fe1.estado, fp.fecha , usu.nombre_usuario, fe2.estado;
DELIMITER ;

DROP VIEW IF EXISTS vista_finanzas_consulta_aprobacion;
CREATE VIEW `vista_finanzas_consulta_aprobacion` AS
	select fp.id_paquete, fe1.estado, fp.fecha as 'fecha_envio', usu.nombre_usuario, 
    fe2.estado as 'estado_aprobacion', fpa.fecha_aprobacion, fpa.observaciones, 
    count(fpd.id_paquete_detalle) as 'numero_beneficiarios'
	from finanzas_paquete as fp inner join finanzas_paquete_aprobacion as fpa on fp.id_paquete = fpa.id_paquete
	inner join finanzas_estados as fe1 on fp.id_estado = fe1.id_estado
    inner join finanzas_estados as fe2 on fpa.id_estado = fe2.id_estado
	inner join finanzas_paquete_detalle as fpd on fp.id_paquete = fpd.id_paquete
    inner join usuarios as usu on fp.id_usuario = usu.id_usuario
	group by fp.id_paquete,fe1.estado,fp.fecha,usu.nombre_usuario,fe2.estado,fpa.fecha_aprobacion,fpa.observaciones;
DELIMITER ;

drop view IF EXISTS vista_finanzas_bono_conectividad;
CREATE VIEW `vista_finanzas_bono_conectividad` AS
	SELECT id_conectividad, asignacion
    FROM finanzas_bono_conectividad;
DELIMITER ;

drop view IF EXISTS vista_finanzas_bono_familiar;
CREATE VIEW `vista_finanzas_bono_familiar` AS
	SELECT id_familiar, asignacion
    FROM finanzas_bono_familiar;
DELIMITER ;

select * from vista_finanzas_bono_conectividad;
/*********************************
-- PRUEBAS
*********************************/

CALL SP_Paquete_Finanzas('la libertad');
call SP_paquete_finanzas_enviados_consulta();
set @x = 0;
set @x = Codigo_User('casa');
select @x;

SET @success = 0;
call SP_Paquete_Finanzas_Insert('arequipa','percy',@success);
select @success;

call SP_reporte_finanzas_regiones('arequipa');
SELECT * FROM vista_finanzas_consulta ;
SELECT * FROM vista_estatus;
select * from vista_finanzas_consulta_aprobacion;

call SP_reporte_finanzas_valorizacion(3)

