<?php 
include('../administrador/config/connection.php');
$nom_tiempo_gestacion = $_POST['nom_tiempo_gestacion'];

$sql = "INSERT INTO `tiempo_gestacion` (`nom_tiempo_gestacion`) values ('$nom_tiempo_gestacion')";
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