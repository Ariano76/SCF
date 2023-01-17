<?php 
include('../administrador/config/connection.php');
$region_beneficiario = $_POST['region_beneficiario'];
$otra_region = $_POST['otra_region'];
$se_instalara_en_esta_region = $_POST['se_instalara_en_esta_region'];
$en_que_provincia = $_POST['en_que_provincia'];
$transit_settle = $_POST['transit_settle'];
$en_que_otro_caso_1 = $_POST['en_que_otro_caso_1'];
$en_que_distrito = $_POST['en_que_distrito'];
$en_que_otro_caso_2 = $_POST['en_que_otro_caso_2'];
$en_que_otro_caso_3 = $_POST['en_que_otro_caso_3'];
$primer_nombre = $_POST['primer_nombre'];
$segundo_nombre = $_POST['segundo_nombre'];
$primer_apellido = $_POST['primer_apellido'];
$segundo_apellido = $_POST['segundo_apellido'];
$genero = $_POST['genero'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$tiene_carne_extranjeria = $_POST['tiene_carne_extranjeria'];
$numero_cedula = $_POST['numero_cedula'];
$fecha_caducidad_cedula = $_POST['fecha_caducidad_cedula'];
$tipo_identificacion = $_POST['tipo_identificacion'];
$numero_identificacion = $_POST['numero_identificacion'];
$fecha_caducidad_identificacion = $_POST['fecha_caducidad_identificacion'];
$documentos_fisico_original = $_POST['documentos_fisico_original'];

$id = $_POST['id'];

$sql = "UPDATE `beneficiario` SET  `region_beneficiario`= '$region_beneficiario', `otra_region`='$otra_region',  `se_instalara_en_esta_region`='$se_instalara_en_esta_region',  `en_que_provincia`='$en_que_provincia',  `transit_settle`='$transit_settle',  `en_que_otro_caso_1`='$en_que_otro_caso_1'
,  `en_que_distrito`='$en_que_distrito',  `en_que_otro_caso_2`='$en_que_otro_caso_2',  `en_que_otro_caso_3`='$en_que_otro_caso_3',  `primer_nombre`='$primer_nombre',  `segundo_nombre`='$segundo_nombre',  `primer_apellido`='$primer_apellido',  `segundo_apellido`='$segundo_apellido',  `genero`='$genero',  `fecha_nacimiento`='$fecha_nacimiento',  `tiene_carne_extranjeria`='$tiene_carne_extranjeria',  `numero_cedula`='$numero_cedula',  `fecha_caducidad_cedula`='$fecha_caducidad_cedula',  `tipo_identificacion`='$tipo_identificacion',  `numero_identificacion`='$numero_identificacion',  `fecha_caducidad_identificacion`='$fecha_caducidad_identificacion',  `documentos_fisico_original`='$documentos_fisico_original'
   WHERE id_beneficiario='$id' ";

$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);

if($query==true)
{
    $data = array(
        'status'=>'true',
    );
    echo json_encode($data);
}
else
{
   $data = array(
    'status'=>'false',
);
   echo json_encode($data);
} 

?>