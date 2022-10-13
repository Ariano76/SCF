<?php 
include('../administrador/config/connection.php');
$nombre_beneficiario = $_POST['nombre_beneficiario'];
$numero_cedula = $_POST['numero_cedula'];
$nombre_1a = $_POST['nombre_1a'];
$nombre_1b = $_POST['nombre_1b'];
$apellido_1a = $_POST['apellido_1a'];
$apellido_1b = $_POST['apellido_1b'];
$genero_1 = $_POST['genero_1'];
$fecha_nacimiento_1 = $_POST['fecha_nacimiento_1'];
$relacion_1 = $_POST['relacion_1'];
$otro_1 = $_POST['otro_1'];
$tipo_identificacion_1 = $_POST['tipo_identificacion_1'];
$numero_identificacion_1 = $_POST['numero_identificacion_1'];
$nombre_2a = $_POST['nombre_2a'];
$nombre_2b = $_POST['nombre_2b'];
$apellido_2a = $_POST['apellido_2a'];
$apellido_2b = $_POST['apellido_2b'];
$genero_2 = $_POST['genero_2'];
$fecha_nacimiento_2 = $_POST['fecha_nacimiento_2'];
$relacion_2 = $_POST['relacion_2'];
$otro_2 = $_POST['otro_2'];
$tipo_identificacion_2 = $_POST['tipo_identificacion_2'];
$numero_identificacion_2 = $_POST['numero_identificacion_2'];
$nombre_3a = $_POST['nombre_3a'];
$nombre_3b = $_POST['nombre_3b'];
$apellido_3a = $_POST['apellido_3a'];
$apellido_3b = $_POST['apellido_3b'];
$genero_3 = $_POST['genero_3'];
$fecha_nacimiento_3 = $_POST['fecha_nacimiento_3'];
$relacion_3 = $_POST['relacion_3'];
$otro_3 = $_POST['otro_3'];
$tipo_identificacion_3 = $_POST['tipo_identificacion_3'];
$numero_identificacion_3 = $_POST['numero_identificacion_3'];
$nombre_4a = $_POST['nombre_4a'];
$nombre_4b = $_POST['nombre_4b'];
$apellido_4a = $_POST['apellido_4a'];
$apellido_4b = $_POST['apellido_4b'];
$genero_4 = $_POST['genero_4'];
$fecha_nacimiento_4 = $_POST['fecha_nacimiento_4'];
$relacion_4 = $_POST['relacion_4'];
$otro_4 = $_POST['otro_4'];
$tipo_identificacion_4 = $_POST['tipo_identificacion_4'];
$numero_identificacion_4 = $_POST['numero_identificacion_4'];
$nombre_5a = $_POST['nombre_5a'];
$nombre_5b = $_POST['nombre_5b'];
$apellido_5a = $_POST['apellido_5a'];
$apellido_5b = $_POST['apellido_5b'];
$genero_5 = $_POST['genero_5'];
$fecha_nacimiento_5 = $_POST['fecha_nacimiento_5'];
$relacion_5 = $_POST['relacion_5'];
$otro_5 = $_POST['otro_5'];
$tipo_identificacion_5 = $_POST['tipo_identificacion_5'];
$numero_identificacion_5 = $_POST['numero_identificacion_5'];
$nombre_6a = $_POST['nombre_6a'];
$nombre_6b = $_POST['nombre_6b'];
$apellido_6a = $_POST['apellido_6a'];
$apellido_6b = $_POST['apellido_6b'];
$genero_6 = $_POST['genero_6'];
$fecha_nacimiento_6 = $_POST['fecha_nacimiento_6'];
$relacion_6 = $_POST['relacion_6'];
$otro_6 = $_POST['otro_6'];
$tipo_identificacion_6 = $_POST['tipo_identificacion_6'];
$numero_identificacion_6 = $_POST['numero_identificacion_6'];
$nombre_7a = $_POST['nombre_7a'];
$nombre_7b = $_POST['nombre_7b'];
$apellido_7a = $_POST['apellido_7a'];
$apellido_7b = $_POST['apellido_7b'];
$genero_7 = $_POST['genero_7'];
$fecha_nacimiento_7 = $_POST['fecha_nacimiento_7'];
$relacion_7 = $_POST['relacion_7'];
$otro_7 = $_POST['otro_7'];
$tipo_identificacion_7 = $_POST['tipo_identificacion_7'];
$numero_identificacion_7 = $_POST['numero_identificacion_7'];
$id = $_POST['id'];

$sql = "UPDATE `integrantes` SET  `nombre_1a`= '$nombre_1a', `nombre_1b`='$nombre_1b', `apellido_1a`='$apellido_1a', `apellido_1b`='$apellido_1b', `genero_1`='$genero_1', `fecha_nacimiento_1`='$fecha_nacimiento_1', `relacion_1`='$relacion_1', `otro_1`='$otro_1', `tipo_identificacion_1`='$tipo_identificacion_1', `numero_identificacion_1`='$numero_identificacion_1', `nombre_2a`= '$nombre_2a', `nombre_2b`='$nombre_2b', `apellido_2a`='$apellido_2a', `apellido_2b`='$apellido_2b', `genero_2`='$genero_2', `fecha_nacimiento_2`='$fecha_nacimiento_2', `relacion_2`='$relacion_2', `otro_2`='$otro_2', `tipo_identificacion_2`='$tipo_identificacion_2', `numero_identificacion_2`='$numero_identificacion_2', `nombre_3a`= '$nombre_3a', `nombre_3b`='$nombre_3b', `apellido_3a`='$apellido_3a', `apellido_3b`='$apellido_3b', `genero_3`='$genero_3', `fecha_nacimiento_3`='$fecha_nacimiento_3', `relacion_3`='$relacion_3', `otro_3`='$otro_3', `tipo_identificacion_3`='$tipo_identificacion_3', `numero_identificacion_3`='$numero_identificacion_3', `nombre_4a`= '$nombre_4a', `nombre_4b`='$nombre_4b', `apellido_4a`='$apellido_4a', `apellido_4b`='$apellido_4b', `genero_4`='$genero_4', `fecha_nacimiento_4`='$fecha_nacimiento_4', `relacion_4`='$relacion_4', `otro_4`='$otro_4', `tipo_identificacion_4`='$tipo_identificacion_4', `numero_identificacion_4`='$numero_identificacion_4', `nombre_5a`= '$nombre_5a', `nombre_5b`='$nombre_5b', `apellido_5a`='$apellido_5a', `apellido_5b`='$apellido_5b', `genero_5`='$genero_5', `fecha_nacimiento_5`='$fecha_nacimiento_5', `relacion_5`='$relacion_5', `otro_5`='$otro_5', `tipo_identificacion_5`='$tipo_identificacion_5', `numero_identificacion_5`='$numero_identificacion_5', `nombre_6a`= '$nombre_6a', `nombre_6b`='$nombre_6b', `apellido_6a`='$apellido_6a', `apellido_6b`='$apellido_6b', `genero_6`='$genero_6', `fecha_nacimiento_6`='$fecha_nacimiento_6', `relacion_6`='$relacion_6', `otro_6`='$otro_6', `tipo_identificacion_6`='$tipo_identificacion_6', `numero_identificacion_6`='$numero_identificacion_6', `nombre_7a`= '$nombre_7a', `nombre_7b`='$nombre_7b', `apellido_7a`='$apellido_7a', `apellido_7b`='$apellido_7b', `genero_7`='$genero_7', `fecha_nacimiento_7`='$fecha_nacimiento_7', `relacion_7`='$relacion_7', `otro_7`='$otro_7', `tipo_identificacion_7`='$tipo_identificacion_7', `numero_identificacion_7`='$numero_identificacion_7'
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