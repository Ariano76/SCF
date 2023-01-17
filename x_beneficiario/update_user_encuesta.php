<?php 
include('../administrador/config/connection.php');
$nombre = $_POST['nombre'];
$fecha_encuesta = $_POST['fecha_encuesta'];
$id_encuestador = $_POST['id_encuestador'];
$nombre_encuestador = $_POST['nombre_encuestador'];
$region_encuestador = $_POST['region_encuestador'];
$como_realizo_encuesta = $_POST['como_realizo_encuesta'];
$esta_de_acuerdo = $_POST['esta_de_acuerdo'];
$id = $_POST['id'];

$sql = "UPDATE `encuesta` SET  `fecha_encuesta`= '$fecha_encuesta', `id_encuestador`='$id_encuestador',  `nombre_encuestador`='$nombre_encuestador',  `region_encuestador`='$region_encuestador',  `como_realizo_encuesta`='$como_realizo_encuesta',  `esta_de_acuerdo`='$esta_de_acuerdo' WHERE id_beneficiario='$id' ";

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