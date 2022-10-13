<?php 
include('../administrador/config/connection.php');
$nom_tiempo_gestacion = $_POST['nom_tiempo_gestacion'];

$id = $_POST['id'];

$sql = "UPDATE `tiempo_gestacion` SET  `nom_tiempo_gestacion`= '$nom_tiempo_gestacion' 
WHERE id_tiempo_gestacion='$id' ";

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