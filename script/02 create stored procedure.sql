
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
where estados.id_estado=1 and b.region_beneficiario=depa;
END |
DELIMITER ;

/*********************************
-- PRUEBAS
*********************************/

CALL SP_Paquete_Finanzas('Arequipa');


