<?php 
include('../administrador/config/connection.php');
$nom_tipo_proyecto = $_POST['nom_tipo_proyecto'];

$sql = "INSERT INTO `tipo_proyecto` (`nom_tipo_proyecto`) values ('$nom_tipo_proyecto')";
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