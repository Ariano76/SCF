<?php 
include('../administrador/config/connection.php');
$nom_actividad = $_POST['nom_actividad'];
$fecha_actividad = $_POST['fecha_actividad'];

$sql = "INSERT INTO `actividad` (`nom_actividad`,`fecha_actividad`) values ('$nom_actividad', '$fecha_actividad' )";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
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