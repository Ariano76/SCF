<?php 
include('../administrador/config/connection.php');
$nom_actividad = $_POST['nom_actividad'];
$fecha_actividad = $_POST['fecha_actividad'];

$id = $_POST['id'];

$sql = "UPDATE `actividad` SET  `nom_actividad`= '$nom_actividad', `fecha_actividad`='$fecha_actividad'
   WHERE id_actividad='$id' ";

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