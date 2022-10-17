<?php 
include('../administrador/config/connection.php');
$estado = $_POST['estado'];
$fecha_envio = $_POST['fecha_envio'];
$nombre_usuario = $_POST['nombre_usuario'];
$estado_aprobacion = $_POST['estado_aprobacion'];
$numero_beneficiarios = $_POST['numero_beneficiarios'];

$id = $_POST['id'];

$sql = "UPDATE `finanzas_paquete_aprobacion` SET  `id_estado`='$estado_aprobacion'
   WHERE id_paquete='$id' ";

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