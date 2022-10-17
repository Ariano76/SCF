<?php 
include('../administrador/config/connection.php');
$nombre = $_POST['nombre'];
$numero_cedula = $_POST['numero_cedula'];
$observaciones = $_POST['observaciones'];
$id_estado = $_POST['id_estado'];

$id = $_POST['id'];

$sql = "UPDATE `estatus` SET  `observaciones`= '$observaciones', `id_estado`='$id_estado'
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