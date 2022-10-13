<?php 
include('../administrador/config/connection.php');
$nom_tipo_discapacidad = $_POST['nom_tipo_discapacidad'];

$sql = "INSERT INTO `tipo_discapacidad` (`nom_tipo_discapacidad`) values ('$nom_tipo_discapacidad')";
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