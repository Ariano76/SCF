<?php 
include('../administrador/config/connection.php');
$nom_tipo_organizacion = $_POST['nom_tipo_organizacion'];

$id = $_POST['id'];

$sql = "UPDATE `tipo_organizacion` SET  `nom_tipo_organizacion`= '$nom_tipo_organizacion' 
WHERE id_tipo_organizacion='$id' ";

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